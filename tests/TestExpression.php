<?php

namespace Slov\Expression\tests;


use PHPUnit\Framework\TestCase;
use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeExecutor;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Functions\FunctionList;
use Slov\Money\Money;
use DateInterval;
use DateTime;

class TestExpression extends TestCase
{
    public function expressionsDataProvider()
    {
        $creditAmount = '3500000$';
        $ratePerMonth = 12.25 / 12 / 100;
        $creditMonths = 12 * 15;
        return [
            # коментарии
            ['$result = 2 + 1; /* многострочный
                комментарий */', 3],
            # операции с целыми числами
            ['$result = 2 + 1;', 3],
            ['$result = 2 - 1;', 1],
            ['$result = 15 * 12;', 180],
            ['$result = 4 / 2;', 2],
            ['$result = 5 % 3;', 2],
            ['$result = 2 ** 3;', 8],
            # операции с плавающей запятой
            ['$result = 2.1 + 1;', 3.1],
            ['$result = 2 - 0.9;', 1.1],
            ['$result = 1.1 * 2.2;', 2.42],
            ['$result = 12.25 / 12;', 12.25 / 12],
            ['$result = 5.1 % 3.9;', 2],
            ['$result = 2.1 ** 2;' , 4.41],
            # операции с деньгами
            ['$result = 2$ + 1$;', Money::create(300)],
            ['$result = 2$ - 1$;', Money::create(100)],
            ['$result = 2$ * 3;', Money::create(600)],
            ['$result = 4$ / 2;', Money::create(200)],
            ['$result = 2$10 + 1$;', Money::create(310)],
            ['$result = 2$ - $90;', Money::create(110)],
            ['$result = 1$10 * 2.2;', Money::create(242)],
            # операции с датами
            [
                '$result = 2018.02.05.033333;',
                DateTime::createFromFormat('Y.m.d H:i:s.u', '2018.02.05 00:00:00.033333')
            ],
            [
                '$result = 2018.02.05 22:30:23.033333;',
                DateTime::createFromFormat('Y.m.d H:i:s.u', '2018.02.05 22:30:23.033333')
            ],
            [
                '$result = 2018.02.05 + 1 day;',
                DateTime::createFromFormat('Y.m.d H:i:s', '2018.02.06 00:00:00')
            ],
            [
                '$result = 2018.02.05 - 1 day;',
                DateTime::createFromFormat('Y.m.d H:i:s', '2018.02.04 00:00:00')
            ],
            [
                '$result = 2018.02.05 - 2018.02.04;',
                DateTime::createFromFormat('Y.m.d', '2018.02.04')
                    ->diff(DateTime::createFromFormat('Y.m.d', '2018.02.05'))
            ],
            ['$result = 3 days - 1 day;', DateInterval::createFromDateString('+2 day')],
            [
                '$result = 2018.02.05 - 1 day;',
                DateTime::createFromFormat('Y.m.d H:i:s', '2018.02.04 00:00:00')
            ],
            [
                '$result = 2018.02.05 - 2018.02.04;',
                DateTime::createFromFormat('Y.m.d', '2018.02.04')
                    ->diff(DateTime::createFromFormat('Y.m.d', '2018.02.05'))
            ],
            ['$result = 3 days - 1 day;', DateInterval::createFromDateString('+2 day')],
            ['$result = (int) days(3 days - 1 day);', 2],
            [
                '$result = (dateTime) date(2018.03.21 23:09:33);',
                DateTime::createFromFormat('Y.m.d H:i:s', '2018.03.21 00:00:00')
            ],
            ['$result = (int) daysInYear(2018.03.21);', 365],
            ['$result = (int) daysInYear(2020.03.21);', 366],
            # выражение с несколькими операциями
            ['$result = 33 - 2 * 4 ** 2;', 1],
            # выражения со скобками
            ['$result = 33 - 2 * (3 + 1) ** 2;', 1],
            [
                '$result = '. "$creditAmount * (($ratePerMonth * (1 + $ratePerMonth) ** $creditMonths) / ((1 + $ratePerMonth) ** $creditMonths - 1));",
                Money::create(4257045)
            ],
            // функция days
            ['$result = (dateInterval) days(0);', DateInterval::createFromDateString('0 day')],
            ['$result = (dateInterval) days(1);', DateInterval::createFromDateString('1 day')],
            ['$result = (dateInterval) days(365);', DateInterval::createFromDateString('365 day')],
            ['$result = (int) days(365 days);', 365],
            ['$result = (int) days(2018.01.01 - 2017.01.01);', 365],
            ['$result = (int) days(2016.09.13 - 2016.07.13) - 1;', 61],
            // функция FirstYearDay
            ['$result = (dateTime) firstYearDay(2018.05.10);', DateTime::createFromFormat('Y.m.d H:i:s', '2018.01.01 00:00:00')],
            ['$result = (dateTime) firstYearDay(2022.06.12 08:56:10);', DateTime::createFromFormat('Y.m.d H:i:s', '2022.01.01 00:00:00')],
            // функция IntOperation
            ['$result = int(1.1);', 1],
            ['$result = int(2.195896);', 2],
            ['$result = int(3.9);', 3],

            // функция equal, int
            ['$result = 3 == 3;', true],
            ['$result = 1 == 3;', false],
            // функция equal, float
            ['$result = 3.14 == 3.14;', true],
            ['$result = 3.14 == 2.14;', false],
            // функция equal, DateTime
            ['$result = 2018.06.19 15:06:00 == 2018.06.19 15:06:00;', true],
            ['$result = 2018.06.19 15:06:00 == 2018.06.19 15:06:01;', false],
            // функция equal, DateInterval
            ['$result = 6 day == 6 day;', true],
            ['$result = 6 day == 5 day;', false],
            // функция equal, Money
            ['$result = 300$ == 300$;', true],
            ['$result = 300$ == 301$;', false],

            // функция notEqual, int
            ['$result = 3 != 3;', false],
            ['$result = 1 != 3;', true],
            // функция notEqual, float
            ['$result = 3.14 != 3.14;', false],
            ['$result = 3.14 != 2.14;', true],
            // функция notEqual, DateTime
            ['$result = 2018.06.19 15:06:00 != 2018.06.19 15:06:00;', false],
            ['$result = 2018.06.19 15:06:00 != 2018.06.19 15:06:01;', true],
            // функция notEqual, DateInterval
            ['$result = 6 day != 6 day;', false],
            ['$result = 6 day != 5 day;', true],
            // функция notEqual, Money
            ['$result = 300$ != 300$;', false],
            ['$result = 300$ != 301$;', true],

            // функция greater, int
            ['$result = 3 > 2;', true],
            ['$result = 3 > 3;', false],
            ['$result = 3 > 4;', false],
            // функция greater, float
            ['$result = 3.14 > 3.13;', true],
            ['$result = 3.14 > 3.14;', false],
            ['$result = 3.14 > 3.15;', false],
            // функция greater, DateTime
            ['$result = 2018.06.19 15:06:00 > 2018.06.19 15:05:59;', true],
            ['$result = 2018.06.19 15:06:00 > 2018.06.19 15:06:00;', false],
            ['$result = 2018.06.19 15:06:00 > 2018.06.19 15:06:01;', false],
            // функция greater, DateInterval
            ['$result = 6 day > 5 day;', true],
            ['$result = 6 day > 6 day;', false],
            ['$result = 6 day > 7 day;', false],
            // функция greater, Money
            ['$result = 301$ > 300$;', true],
            ['$result = 300$ > 300$;', false],
            ['$result = 300$ > 301$;', false],

            // функция less, int
            ['$result = 3 < 4;', true],
            ['$result = 3 < 3;', false],
            ['$result = 3 < 2;', false],
            // функция less, float
            ['$result = 3.14 < 3.15;', true],
            ['$result = 3.14 < 3.14;', false],
            ['$result = 3.14 < 3.13;', false],
            // функция less, DateTime
            ['$result = 2018.06.19 15:06:00 < 2018.06.19 15:06:01;', true],
            ['$result = 2018.06.19 15:06:00 < 2018.06.19 15:06:00;', false],
            ['$result = 2018.06.19 15:06:00 < 2018.06.19 15:05:59;', false],
            // функция less, DateInterval
            ['$result = 6 day < 7 day;', true],
            ['$result = 6 day < 6 day;', false],
            ['$result = 6 day < 5 day;', false],
            // функция less, Money
            ['$result = 300$ < 301$;', true],
            ['$result = 300$ < 300$;', false],
            ['$result = 301$ < 300$;', false],

            // функция greater or equals, int
            ['$result = 3 >= 2;', true],
            ['$result = 3 >= 3;', true],
            ['$result = 3 >= 4;', false],
            // функция greater or equals, float
            ['$result = 3.14 >= 3.13;', true],
            ['$result = 3.14 >= 3.14;', true],
            ['$result = 3.14 >= 3.15;', false],
            // функция greater or equals, DateTime
            ['$result = 2018.06.19 15:06:00 >= 2018.06.19 15:05:59;', true],
            ['$result = 2018.06.19 15:06:00 >= 2018.06.19 15:06:00;', true],
            ['$result = 2018.06.19 15:06:00 >= 2018.06.19 15:06:01;', false],
            // функция greater or equals, DateInterval
            ['$result = 6 day >= 5 day;', true],
            ['$result = 6 day >= 6 day;', true],
            ['$result = 6 day >= 7 day;', false],
            // функция greater or equals, Money
            ['$result = 301$ >= 300$;', true],
            ['$result = 300$ >= 300$;', true],
            ['$result = 300$ >= 301$;', false],

            // функция less or equals, int
            ['$result = 3 <= 4;', true],
            ['$result = 3 <= 3;', true],
            ['$result = 3 <= 2;', false],
            // функция less or equals, float
            ['$result = 3.14 <= 3.15;', true],
            ['$result = 3.14 <= 3.14;', true],
            ['$result = 3.14 <= 3.13;', false],
            // функция less or equals, DateTime
            ['$result = 2018.06.19 15:06:00 <= 2018.06.19 15:06:01;', true],
            ['$result = 2018.06.19 15:06:00 <= 2018.06.19 15:06:00;', true],
            ['$result = 2018.06.19 15:06:00 <= 2018.06.19 15:05:59;', false],
            // функция less or equals, DateInterval
            ['$result = 6 day <= 7 day;', true],
            ['$result = 6 day <= 6 day;', true],
            ['$result = 6 day <= 5 day;', false],
            // функция less or equals, Money
            ['$result = 300$ <= 301$;', true],
            ['$result = 300$ <= 300$;', true],
            ['$result = 301$ <= 300$;', false],
            // операция логичческого не
            ['$result = !true;', false],
            ['$result = !false;', true],
            // логическая операция and
            ['$result = false && false;', false],
            ['$result = false && true;', false],
            ['$result = true && false;', false],
            ['$result = true && true;', true],
            // логическая операция or
            ['$result = false || false;', false],
            ['$result = false || true;', true],
            ['$result = true || false;', true],
            ['$result = true || true;', true],
            // тернарный опреатор ... ? ... : ...
            ['$result = 1 > 2 ? 1 : 2;', 2],
            ['$result = 1 < 2 ? 1 : 2;', 1],
            ['$result = 1 < 2 && 2 < 3 ? 1 : 2;', 1],
            ['$result = 1 < 2 && 2 > 3 ? 1 : 2;', 2],
            ['$result = 1 < 2 ? 1 + 1 : 2 + 2;', 2],
            ['$result = 1 > 2 ? 1 + 1 : 2 + 2;', 4],
            ['$result = (1 > 0 ? 1 : 0) + (1 > 2 ? 1 : 2) * (2 > 1 ? 3 : 2);', 7],
            ['$result = 2 > 1 ? int((int) days(2018.01.02 - 2018.01.01) / 14) + 1 : 1;', 1],

            // оператор присваивания
            ['$result = true;', true],
            ['$i = 1; $result = true ? $i : 2;', 1],
            ['$i = 1; $result = (true ? $i : 2) + $i;', 2],
            ['$i = 1; $i = $i + 1; $result = $i;', 2],
            ['
             $creditMonths = 180;
             $creditAmount = 350000000;
             $yearPercent = 12.25;
             $monthsInYear = 12;
             $rateToPercentFactor = 100;
             $ratePerMonth = $yearPercent / $monthsInYear / $rateToPercentFactor;
             $result = int(
                $creditAmount
                *
                (
                    ($ratePerMonth * (1 + $ratePerMonth) ** $creditMonths)
                    /
                    ((1 + $ratePerMonth) ** $creditMonths - 1)
                )
             );',
                4257045
            ],

            // цикл for
            ['for($i = 1; $i < 10; $i = $i + 1){$result = $i;}', 9],
            ['for($i = 1; $i < 10; $i = $i + 1){$result = $i % 2 > 0 ? 1 : 2;}', 1],

            // функция min, max
            ['$result = (int) min(3,2,1);', 1],
            ['$result = (int) max(1,2,3);', 3],
            ['$result = (money) min(3$, 1$, 2$);', Money::create(100)],
            ['$result = (money) max(1$, 3$, 2$);', Money::create(300)],
            [
                '$result = (dateTime) min(2018.01.01, 2015.02.02, 2016.03.03);',
                DateTime::createFromFormat('Y.m.d H:i:s', '2015.02.02 00:00:00')
            ],
            [
                '$result = (dateTime) max(2018.01.01, 2019.02.02, 2016.03.03);',
                DateTime::createFromFormat('Y.m.d H:i:s', '2019.02.02 00:00:00')
            ],

            // функция money
            ['$result = money(100);', Money::create(100)],
            // функция int
            ['$result = int(1$01);', 101],

            // проверка приоритета выполнения операций
            ['$result = 7 - 2 * 3;', 1],
            ['$result = 7 - 2 - 3;', 2],
            ['$result = 1 < 2 + 1;', true],
            [
                '$result = money(int(200000$) * 0.03822 * ((1 + 0.03822) ** 8) / ((1 + 0.03822) ** 8 - 1));',
                Money::create(2948761)
            ],

            ['$result = \'abc\';', 'abc'],

            ['$result = (boolean) isNull(1);', false],
            ['$result = (boolean) isNull(null);', true],

            ['$result = (boolean) isNotNull(1);', true],
            ['$result = (boolean) isNotNull(null);', false],
        ];
    }

    /**
     * @param string $expressionText текст выражения
     * @param mixed $expectedResult ожидаемый результат выражения
     * @dataProvider expressionsDataProvider
     * @throws CodeParseException
     */
    public function testExpressions($expressionText, $expectedResult)
    {
        $codeContext = new CodeContext();
        $codeExecutor = new CodeExecutor();
        $variableName = '$result';
        $actualResult = $codeExecutor
            ->setCode($expressionText)
            ->setCodeContext($codeContext)
            ->execute()
            ->getVariableByName($variableName);

        $this->assertEquals($expectedResult, $actualResult);
    }


    public function testExpressionFunction()
    {
        $monthsInYear = 12;
        $rateToPercentFactor = 100;

        /**
         * Рассчёт ануитетного платежа
         * @param float $yearPercent годовая ставка
         * @param Money $creditAmount сумма займа в копейках
         * @param int $creditMonths число месяцев в кредите
         * @return Money
         */
        $annuityPayment = function($yearPercent, $creditAmount, $creditMonths) use ($monthsInYear, $rateToPercentFactor)
        {

            $ratePerMonth = $yearPercent / $monthsInYear / $rateToPercentFactor;
            $months = $creditMonths;
            $creditAmountFactor = (($ratePerMonth * (1 + $ratePerMonth) ** $months) / ((1 + $ratePerMonth) ** $months - 1));

            return $creditAmount->mul($creditAmountFactor);
        };

        $expressionText = '
            $yearPercent = 12.25;
            $creditAmount = 350000000$;
            $creditMonths = 180;
            $result = (money) annuityPayment($yearPercent, $creditAmount, $creditMonths);
            ';
        $functionList = new FunctionList();
        $functionList->append($annuityPayment, 'annuityPayment');
        $codeContext = new CodeContext();
        $codeExecutor = new CodeExecutor($functionList);
        $variableName = '$result';
        $actualResult = $codeExecutor
            ->setCode($expressionText)
            ->setCodeContext($codeContext)
            ->execute()
            ->getVariableByName($variableName);

        $this->assertEquals(Money::create(425704547), $actualResult);
    }

    /**
     * Конкатинирование строк
     * @param string $leftString левая строка
     * @param string $rightString правая строка
     * @return string
     */
    public function concat($leftString, $rightString) {
        return $leftString. $rightString;
    }

    public function testExpressionFunctionsOrder()
    {
        $expressionText = '$result = 
            (string) concat(
                (string) concat(
                    (string) concat(\'a\', \'b\'),
                    (string) concat(\'c\', \'d\')
                ),
                \'e\'
            );';
        $functionList = new FunctionList();
        $functionList->append([$this, 'concat'], 'concat');
        $codeContext = new CodeContext();
        $codeExecutor = new CodeExecutor($functionList);
        $variableName = '$result';
        $actualResult = $codeExecutor
            ->setCode($expressionText)
            ->setCodeContext($codeContext)
            ->execute()
            ->getVariableByName($variableName);

        $this->assertEquals('abcde', $actualResult);
    }

    public function testExpressionFunctionsWithoutParams()
    {
        $funcWithoutParams = function () {
            return 100;
        };

        $expressionText = '$result = (int) func();';

        $functionList = new FunctionList();
        $functionList->append($funcWithoutParams, 'func');
        $codeContext = new CodeContext();
        $codeExecutor = new CodeExecutor($functionList);
        $variableName = '$result';
        $actualResult = $codeExecutor
            ->setCode($expressionText)
            ->setCodeContext($codeContext)
            ->execute()
            ->getVariableByName($variableName);

        $this->assertEquals(100, $actualResult);
    }

    public function testForeachWithFunction()
    {
        $expressionText = '
            $result = \'\';
            for($i = 0; $i < 10; $i = $i + 1)
            {
                $result = (string) concat($result, $i);
            }
        ';
        $functionList = new FunctionList();
        $functionList->append([$this, 'concat'], 'concat');
        $codeContext = new CodeContext();
        $codeExecutor = new CodeExecutor($functionList);
        $variableName = '$result';
        $actualResult = $codeExecutor
            ->setCode($expressionText)
            ->setCodeContext($codeContext)
            ->execute()
            ->getVariableByName($variableName);

        $this->assertEquals('0123456789', $actualResult);
    }

    public function testForeachWithIf()
    {
        $expressionText = '
            $result = \'\';
            for($i = 0; $i < 10; $i = $i + 1)
            {
                if($i % 2 > 0)
                {
                    $result = (string) concat($result, $i);
                }
            }
        ';
        $functionList = new FunctionList();
        $functionList->append([$this, 'concat'], 'concat');
        $codeContext = new CodeContext();
        $codeExecutor = new CodeExecutor($functionList);
        $variableName = '$result';
        $actualResult = $codeExecutor
            ->setCode($expressionText)
            ->setCodeContext($codeContext)
            ->execute()
            ->getVariableByName($variableName);

        $this->assertEquals('13579', $actualResult);
    }

    public function testForeachEmptyBody()
    {
        $expressionText = 'for($result = 0; $result < 10; $result = $result + 1){}';
        $codeContext = new CodeContext();
        $codeExecutor = new CodeExecutor();
        $variableName = '$result';
        $actualResult = $codeExecutor
            ->setCode($expressionText)
            ->setCodeContext($codeContext)
            ->execute()
            ->getVariableByName($variableName);

        $this->assertEquals(10, $actualResult);
    }

    public function testExpressionFunctionsWithoutReturnType()
    {
        $funcWithoutReturn = function () {};

        $expressionText = '$result = func();';

        $functionList = new FunctionList();
        $functionList->append($funcWithoutReturn, 'func');
        $codeContext = new CodeContext();
        $codeExecutor = new CodeExecutor($functionList);
        $variableName = '$result';
        $actualResult = $codeExecutor
            ->setCode($expressionText)
            ->setCodeContext($codeContext)
            ->execute()
            ->getVariableByName($variableName);

        $this->assertEquals(null, $actualResult);
    }
}