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
            //['{days} (3 days - 1 day)', 2],
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