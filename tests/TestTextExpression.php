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
            //['1', 1],
            ['1 + 1', 2]
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