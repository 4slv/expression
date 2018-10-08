<?php

namespace Slov\Expression\tests;


use PHPUnit\Framework\TestCase;
use Slov\Expression\TextExpression\TextExpression;
use Slov\Expression\ExpressionException;
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
            # комментарии в текстовом выражениии
            ['/* Пример */
                1 + 1
              /* комментария */', 2],
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
            ['{days} (3 days - 1 day)', 2],
            [
                '{date} 2018.03.21 23:09:33',
                DateTime::createFromFormat('Y.m.d H:i:s', '2018.03.21 00:00:00')
            ],
            ['{days in year} 2018.03.21', 365],
            ['{days in year} 2020.03.21', 366],
            # выражение с несколькими операциями
            ['33 - 2 * 4 ** 2', 1],
            # выражения со скобками
            ['33 - 2 * (3 + 1) ** 2', 1],
            [
                "$creditAmount * (($ratePerMonth * (1 + $ratePerMonth) ** $creditMonths) / ((1 + $ratePerMonth) ** $creditMonths - 1))",
                Money::create(4257045)
            ],

            // daysOperation
            ['{days} 0', DateInterval::createFromDateString('0 day')],
            ['{days} 1', DateInterval::createFromDateString('1 day')],
            ['{days} 365', DateInterval::createFromDateString('365 day')],
            ['{days} 365 days', 365],
            ['{days} (2018.01.01 - 2017.01.01)', 365],
            ['{days} (2016.09.13 - 2016.07.13) - 1', 61],

            // FirstYearDayOperation
            ['{first year day} 2018.05.10', DateTime::createFromFormat('Y.m.d H:i:s', '2018.01.01 00:00:00')],
            ['{first year day} 2022.06.12 08:56:10', DateTime::createFromFormat('Y.m.d H:i:s', '2022.01.01 00:00:00')],

            //IntOperation
            ['{int} 1.1', 1],
            ['{int} 2.195896', 2],
            ['{int} 3.9', 3],

            //equal, int
            ['3 == 3', true],
            ['1 == 3', false],
            //equal, float
            ['3.14 == 3.14', true],
            ['3.14 == 2.14', false],
            //equal, DateTime
            ['2018.06.19 15:06:00 == 2018.06.19 15:06:00', true],
            ['2018.06.19 15:06:00 == 2018.06.19 15:06:01', false],
            //equal, DateInterval
            ['6 day == 6 day', true],
            ['6 day == 5 day', false],
            //equal, Money
            ['300$ == 300$', true],
            ['300$ == 301$', false],

            //greater, int
            ['3 > 2', true],
            ['3 > 3', false],
            ['3 > 4', false],
            //greater, float
            ['3.14 > 3.13', true],
            ['3.14 > 3.14', false],
            ['3.14 > 3.15', false],
            //greater, DateTime
            ['2018.06.19 15:06:00 > 2018.06.19 15:05:59', true],
            ['2018.06.19 15:06:00 > 2018.06.19 15:06:00', false],
            ['2018.06.19 15:06:00 > 2018.06.19 15:06:01', false],
            //greater, DateInterval
            ['6 day > 5 day', true],
            ['6 day > 6 day', false],
            ['6 day > 7 day', false],
            //greater, Money
            ['301$ > 300$', true],
            ['300$ > 300$', false],
            ['300$ > 301$', false],

            //less, int
            ['3 < 4', true],
            ['3 < 3', false],
            ['3 < 2', false],
            //less, float
            ['3.14 < 3.15', true],
            ['3.14 < 3.14', false],
            ['3.14 < 3.13', false],
            //less, DateTime
            ['2018.06.19 15:06:00 < 2018.06.19 15:06:01', true],
            ['2018.06.19 15:06:00 < 2018.06.19 15:06:00', false],
            ['2018.06.19 15:06:00 < 2018.06.19 15:05:59', false],
            //less, DateInterval
            ['6 day < 7 day', true],
            ['6 day < 6 day', false],
            ['6 day < 5 day', false],
            //less, Money
            ['300$ < 301$', true],
            ['300$ < 300$', false],
            ['301$ < 300$', false],

            //greater or equals, int
            ['3 >= 2', true],
            ['3 >= 3', true],
            ['3 >= 4', false],
            //greater or equals, float
            ['3.14 >= 3.13', true],
            ['3.14 >= 3.14', true],
            ['3.14 >= 3.15', false],
            //greater or equals, DateTime
            ['2018.06.19 15:06:00 >= 2018.06.19 15:05:59', true],
            ['2018.06.19 15:06:00 >= 2018.06.19 15:06:00', true],
            ['2018.06.19 15:06:00 >= 2018.06.19 15:06:01', false],
            //greater or equals, DateInterval
            ['6 day >= 5 day', true],
            ['6 day >= 6 day', true],
            ['6 day >= 7 day', false],
            //greater or equals, Money
            ['301$ >= 300$', true],
            ['300$ >= 300$', true],
            ['300$ >= 301$', false],

            //less or equals, int
            ['3 <= 4', true],
            ['3 <= 3', true],
            ['3 <= 2', false],
            //less or equals, float
            ['3.14 <= 3.15', true],
            ['3.14 <= 3.14', true],
            ['3.14 <= 3.13', false],
            //less or equals, DateTime
            ['2018.06.19 15:06:00 <= 2018.06.19 15:06:01', true],
            ['2018.06.19 15:06:00 <= 2018.06.19 15:06:00', true],
            ['2018.06.19 15:06:00 <= 2018.06.19 15:05:59', false],
            //less or equals, DateInterval
            ['6 day <= 7 day', true],
            ['6 day <= 6 day', true],
            ['6 day <= 5 day', false],
            //less or equals, Money
            ['300$ <= 301$', true],
            ['300$ <= 300$', true],
            ['301$ <= 300$', false],
        ];
    }

    /**
     * @param string $code
     * @param float|int|Money $expectedResult
     * @dataProvider expressionsDataProvider
     * @throws ExpressionException
     */
    public function testExpressions($code, $expectedResult)
    {
        $textExpression = new TextExpression();
        $actualResult = $textExpression
            ->setCode($code)->execute();
        $this->assertEquals($expectedResult, $actualResult);
    }
}