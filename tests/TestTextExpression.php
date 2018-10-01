<?php

namespace Slov\Expression\tests;


use PHPUnit\Framework\TestCase;
use Slov\Expression\TextExpression\SimpleTextExpression;
use Slov\Money\Money;

class TestTextExpression extends TestCase
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
        ];
    }

    /**
     * @param string $code
     * @param float|int|Money $expectedResult
     * @dataProvider expressionsDataProvider
     */
    public function testExpressions($code, $expectedResult)
    {
        $textExpression = new SimpleTextExpression();
        $actualResult = $textExpression->toPhp($code);
        $this->assertEquals($expectedResult, $actualResult);
    }


}