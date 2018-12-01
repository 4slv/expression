<?php

namespace Slov\Expression\tests;


use PHPUnit\Framework\TestCase;
use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeExecutor;
use Slov\Expression\Code\CodeParseException;
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
                '2018.02.05.033333',
                DateTime::createFromFormat('Y.m.d H:i:s.u', '2018.02.05 00:00:00.033333')
            ],
            [
                '2018.02.05 22:30:23.033333',
                DateTime::createFromFormat('Y.m.d H:i:s.u', '2018.02.05 22:30:23.033333')
            ],
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
            ['(int) days(3 days - 1 day)', 2],
            [
                '(dateTime) date(2018.03.21 23:09:33)',
                DateTime::createFromFormat('Y.m.d H:i:s', '2018.03.21 00:00:00')
            ],
            ['(int) daysInYear(2018.03.21)', 365],
            ['(int) daysInYear(2020.03.21)', 366],
            # выражение с несколькими операциями
            ['33 - 2 * 4 ** 2', 1],
            # выражения со скобками
            ['33 - 2 * (3 + 1) ** 2', 1],
            [
                "$creditAmount * (($ratePerMonth * (1 + $ratePerMonth) ** $creditMonths) / ((1 + $ratePerMonth) ** $creditMonths - 1))",
                Money::create(4257045)
            ],
            // функция days
            ['(dateInterval) days(0)', DateInterval::createFromDateString('0 day')],
            ['(dateInterval) days(1)', DateInterval::createFromDateString('1 day')],
            ['(dateInterval) days(365)', DateInterval::createFromDateString('365 day')],
            ['(int) days(365 days)', 365],
            ['(int) days(2018.01.01 - 2017.01.01)', 365],
            ['(int) days(2016.09.13 - 2016.07.13) - 1', 61],
            // функция FirstYearDay
            ['(dateTime) firstYearDay(2018.05.10)', DateTime::createFromFormat('Y.m.d H:i:s', '2018.01.01 00:00:00')],
            ['(dateTime) firstYearDay(2022.06.12 08:56:10)', DateTime::createFromFormat('Y.m.d H:i:s', '2022.01.01 00:00:00')],
            // функция IntOperation
            ['(int) int(1.1)', 1],
            ['(int) int(2.195896)', 2],
            ['(int) int(3.9)', 3],
            // функция equal, int
            ['3 == 3', true],
            ['1 == 3', false],
            // функция equal, float
            ['3.14 == 3.14', true],
            ['3.14 == 2.14', false],
            // функция equal, DateTime
            ['2018.06.19 15:06:00 == 2018.06.19 15:06:00', true],
            ['2018.06.19 15:06:00 == 2018.06.19 15:06:01', false],
            // функция equal, DateInterval
            ['6 day == 6 day', true],
            ['6 day == 5 day', false],
            // функция equal, Money
            ['300$ == 300$', true],
            ['300$ == 301$', false],

            // функция greater, int
            ['3 > 2', true],
            ['3 > 3', false],
            ['3 > 4', false],
            // функция greater, float
            ['3.14 > 3.13', true],
            ['3.14 > 3.14', false],
            ['3.14 > 3.15', false],
            // функция greater, DateTime
            ['2018.06.19 15:06:00 > 2018.06.19 15:05:59', true],
            ['2018.06.19 15:06:00 > 2018.06.19 15:06:00', false],
            ['2018.06.19 15:06:00 > 2018.06.19 15:06:01', false],
            // функция greater, DateInterval
            ['6 day > 5 day', true],
            ['6 day > 6 day', false],
            ['6 day > 7 day', false],
            // функция greater, Money
            ['301$ > 300$', true],
            ['300$ > 300$', false],
            ['300$ > 301$', false],

            // функция less, int
            ['3 < 4', true],
            ['3 < 3', false],
            ['3 < 2', false],
            // функция less, float
            ['3.14 < 3.15', true],
            ['3.14 < 3.14', false],
            ['3.14 < 3.13', false],
            // функция less, DateTime
            ['2018.06.19 15:06:00 < 2018.06.19 15:06:01', true],
            ['2018.06.19 15:06:00 < 2018.06.19 15:06:00', false],
            ['2018.06.19 15:06:00 < 2018.06.19 15:05:59', false],
            // функция less, DateInterval
            ['6 day < 7 day', true],
            ['6 day < 6 day', false],
            ['6 day < 5 day', false],
            // функция less, Money
            ['300$ < 301$', true],
            ['300$ < 300$', false],
            ['301$ < 300$', false],

            // функция greater or equals, int
            ['3 >= 2', true],
            ['3 >= 3', true],
            ['3 >= 4', false],
            // функция greater or equals, float
            ['3.14 >= 3.13', true],
            ['3.14 >= 3.14', true],
            ['3.14 >= 3.15', false],
            // функция greater or equals, DateTime
            ['2018.06.19 15:06:00 >= 2018.06.19 15:05:59', true],
            ['2018.06.19 15:06:00 >= 2018.06.19 15:06:00', true],
            ['2018.06.19 15:06:00 >= 2018.06.19 15:06:01', false],
            // функция greater or equals, DateInterval
            ['6 day >= 5 day', true],
            ['6 day >= 6 day', true],
            ['6 day >= 7 day', false],
            // функция greater or equals, Money
            ['301$ >= 300$', true],
            ['300$ >= 300$', true],
            ['300$ >= 301$', false],

            // функция less or equals, int
            ['3 <= 4', true],
            ['3 <= 3', true],
            ['3 <= 2', false],
            // функция less or equals, float
            ['3.14 <= 3.15', true],
            ['3.14 <= 3.14', true],
            ['3.14 <= 3.13', false],
            // функция less or equals, DateTime
            ['2018.06.19 15:06:00 <= 2018.06.19 15:06:01', true],
            ['2018.06.19 15:06:00 <= 2018.06.19 15:06:00', true],
            ['2018.06.19 15:06:00 <= 2018.06.19 15:05:59', false],
            // функция less or equals, DateInterval
            ['6 day <= 7 day', true],
            ['6 day <= 6 day', true],
            ['6 day <= 5 day', false],
            // функция less or equals, Money
            ['300$ <= 301$', true],
            ['300$ <= 300$', true],
            ['301$ <= 300$', false],
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
        $codeBlock = new CodeExecutor();
        $variableName = '$result';
        $actualResult = $codeBlock
            ->setCode("$variableName = ". $expressionText. ';')
            ->setCodeContext($codeContext)
            ->execute()
            ->getVariableByName($variableName);

        $this->assertEquals($expectedResult, $actualResult);
    }
}