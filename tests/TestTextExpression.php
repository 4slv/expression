<?php

namespace Slov\Expression\tests;


use PHPUnit\Framework\TestCase;
use Slov\Expression\ExpressionException;
use Slov\Expression\TextExpression\FunctionList;
use Slov\Expression\TextExpression\TextExpression;
use Slov\Expression\TextExpression\VariableList;
use Slov\Expression\Type\FloatType;
use Slov\Expression\Type\IntType;
use Slov\Expression\Type\MoneyType;
use Slov\Expression\Type\TypeFactory;
use Slov\Expression\Type\TypeName;
use Slov\Money\Money;
use DateInterval;
use DateTime;

class TestTextExpression extends TestCase
{

    public function expressionsDataProvider()
    {
        $creditAmount = '3500000$';
        $ratePerMonth = 12.25 / 12 / 100;
        $creditMonths = 12 * 15;
        return [
            # операции с целыми числами
            ['2 + 1', 3],
            ['2 - 1', 1],
            ['15 * 12', 180],
            ['4 / 2', 2],
            ['5 % 3', 2],
            ['2 ** 3', 8],
            # операции с плавающей запятой
            ['2.1 + 1', 3.1],
            ['2 - 0.9', 1.1],
            ['1.1 * 2.2', 2.42],
            ['12.25 / 12', 12.25 / 12],
            ['5.1 % 3.9', 2],
            ['2.1 ** 2' , 4.41],
            # операции с деньгами
            ['2$ + 1$', Money::create(300)],
            ['2$ - 1$', Money::create(100)],
            ['2$ * 3', Money::create(600)],
            ['4$ / 2', Money::create(200)],
            ['2$10 + 1$', Money::create(310)],
            ['2$ - $90', Money::create(110)],
            ['1$10 * 2.2', Money::create(242)],
            # операции с датами
            [
                '2018.02.05 + 1 day',
                DateTime::createFromFormat('Y.m.d H:i:s', '2018.02.06 00:00:00')
            ],
            [
                '2018.02.05 - 1 day',
                DateTime::createFromFormat('Y.m.d H:i:s', '2018.02.04 00:00:00')
            ],
            [
                '2018.02.05 - 2018.02.04',
                DateTime::createFromFormat('Y.m.d', '2018.02.04')
                ->diff(DateTime::createFromFormat('Y.m.d', '2018.02.05'))
            ],
            ['3 days - 1 day', DateInterval::createFromDateString('+2 day')],
            ['{days} (3 days - 1 day)', 2],
            [
                '{date} 2018.03.21 23:09:33',
                DateTime::createFromFormat('Y.m.d H:i:s', '2018.03.21 00:00:00')
            ],
            ['{days in year} 2018.03.21', 365],
            ['{days in year} 2020.03.21', 366],
            # выражения со скобками
            ['33 - 2 * (3 + 1) ** 2', 1],
            [
                "$creditAmount * (($ratePerMonth * (1 + $ratePerMonth) ** $creditMonths) / ((1 + $ratePerMonth) ** $creditMonths - 1))",
                Money::create(4257045)
            ]
        ];
    }

    /**
     * @param string $expressionText
     * @param float|int|Money $expectedResult
     * @dataProvider expressionsDataProvider
     * @throws ExpressionException
     */
    public function testExpressions($expressionText, $expectedResult)
    {
        $textExpression = new TextExpression();
        $textExpression->setExpressionText($expressionText);
        $expression = $textExpression->toExpression();
        $actualResult = $expression->calculate()->getValue();
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function expressionVariablesDataProvider()
    {
        return [
            ['12.25', '350000000', '180', 4257045]
        ];
    }

    /**
     * @param float $yearPercent годовая ставка
     * @param int $creditAmount сумма займа в копейках
     * @param int $creditMonths число месяцев в кредите
     * @param int $expectedAnnuityPayment ожидаемое значение ануитетного платежа
     * @dataProvider expressionVariablesDataProvider
     */
    public function testExpressionVariables($yearPercent, $creditAmount, $creditMonths, $expectedAnnuityPayment)
    {
        $monthsInYear = '12';
        $rateToPercentFactor = '100';

        $variablesList = new VariableList();
        $variablesList
            ->append('yearPercent', TypeFactory::getInstance()->createFloat()->setValue($yearPercent))
            ->append('monthsInYear', TypeFactory::getInstance()->createInt()->setValue($monthsInYear))
            ->append('rateToPercentFactor', TypeFactory::getInstance()->createInt()->setValue($rateToPercentFactor));

        $ratePerMonthFormula = '$yearPercent / $monthsInYear / $rateToPercentFactor';

        $ratePerMonthTextExpression = new TextExpression();
        $ratePerMonthTextExpression
            ->setExpressionText($ratePerMonthFormula)
            ->setVariableList($variablesList);
        $ratePerMonth = $ratePerMonthTextExpression->toExpression();

        $variablesList
            ->append('creditAmount', TypeFactory::getInstance()->createMoney()->setValue(Money::create($creditAmount)))
            ->append('ratePerMonth', $ratePerMonth)
            ->append('creditMonths', TypeFactory::getInstance()->createInt()->setValue($creditMonths));

        $annuityPaymentFormula = '$creditAmount * (($ratePerMonth * (1 + $ratePerMonth) ** $creditMonths) / ((1 + $ratePerMonth) ** $creditMonths - 1))';

        $annuityPaymentTextExpression = new TextExpression();
        $annuityPaymentTextExpression
            ->setExpressionText($annuityPaymentFormula)
            ->setVariableList($variablesList);

        $actualAnnuityPayment = $annuityPaymentTextExpression->toExpression()->calculate()->getValue()->getAmount();

        $this->assertEquals($expectedAnnuityPayment, $actualAnnuityPayment);
    }

    /**
     * @param float $yearPercent годовая ставка
     * @param int $creditAmount сумма займа в копейках
     * @param int $creditMonths число месяцев в кредите
     * @param int $expectedAnnuityPayment ожидаемое значение ануитетного платежа
     * @dataProvider expressionVariablesDataProvider
     */
    public function testExpressionFunctions($yearPercent, $creditAmount, $creditMonths, $expectedAnnuityPayment)
    {
        $monthsInYear = 12;
        $rateToPercentFactor = 100;

        /**
         * @param FloatType $yearPercent годовая ставка
         * @param MoneyType $creditAmount сумма займа в копейках
         * @param IntType $creditMonths число месяцев в кредите
         * @return MoneyType
         */
        $annuityPayment = function($yearPercent, $creditAmount, $creditMonths) use ($monthsInYear, $rateToPercentFactor)
        {

            $ratePerMonth = $yearPercent->getValue() / $monthsInYear / $rateToPercentFactor;
            $months = $creditMonths->getValue();
            $creditAmountFactor = (($ratePerMonth * (1 + $ratePerMonth) ** $months) / ((1 + $ratePerMonth) ** $months - 1));

            $result = TypeFactory::getInstance()->createMoney();

            return $result->setValue($creditAmount->getValue()->mul($creditAmountFactor));
        };

        $functionList = new FunctionList();
        $functionList->append('annuityPayment', new TypeName(TypeName::MONEY), $annuityPayment);

        $creditAmountVariable = TypeFactory::getInstance()->createMoney();

        $variablesList = new VariableList();
        $variablesList
            ->append('yearPercent', TypeFactory::getInstance()->createFloat()->setValue($yearPercent))
            ->append('creditAmount', $creditAmountVariable->setValue(Money::create($creditAmount)))
            ->append('creditMonths', TypeFactory::getInstance()->createInt()->setValue($creditMonths));

        $annuityPaymentFormula = '$annuityPayment[$yearPercent, $creditAmount, $creditMonths]';
        $annuityPaymentTextExpression = new TextExpression();
        $annuityPaymentTextExpression
            ->setFunctionList($functionList)
            ->setVariableList($variablesList)
            ->setExpressionText($annuityPaymentFormula);

        $annuityPaymentExpression = $annuityPaymentTextExpression->toExpression();

        $actualAnnuityPayment = $annuityPaymentExpression->calculate()->getValue()->getAmount();
        $this->assertEquals($expectedAnnuityPayment, $actualAnnuityPayment);

        $creditAmountVariable->setValue(Money::create(300000000));

        $newActualAnnuityPayment = $annuityPaymentExpression->calculate()->getValue()->getAmount();

        $this->assertEquals(3648896, $newActualAnnuityPayment);
    }
}