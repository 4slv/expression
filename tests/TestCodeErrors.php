<?php

namespace Slov\Expression\tests;


use PHPUnit\Framework\TestCase;
use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeExecutor;
use Slov\Expression\Code\CodeParseException;

class TestCodeErrors extends TestCase
{
    /**
     * @param string $code псевдокод
     * @param string $expectedError текст ожидаемой ошибки
     * @dataProvider errorDataProvider
     */
    public function testError($code, $expectedError)
    {
        $expressionText = $code;

        try{
            $codeContext = new CodeContext();
            $codeExecutor = new CodeExecutor();
            $codeExecutor
                ->setCode($expressionText)
                ->setCodeContext($codeContext)
                ->execute();
        } catch (CodeParseException $exception){
            $this->assertEquals($expectedError, $exception->getMessage());
        }

    }

    public function errorDataProvider()
    {
        return [
            [
                '$result = 0',
                '$result = 0 :: code is not correct statement'
            ],
            explode(
                "\n### Error ###\n",
                file_get_contents(__DIR__. '/errorCases/intAddMoneyError.txt')
            ),
            explode(
                "\n### Error ###\n",
                file_get_contents(__DIR__. '/errorCases/isNotCorrectStatementError.txt')
            ),
        ];
    }
}