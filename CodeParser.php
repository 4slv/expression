<?php

namespace Slov\Expression;

use Slov\Expression\Statement\ComplexStatementRegexp;
use Slov\Expression\Statement\StatementFactoryAccessor;

/** Разбор кода */
class CodeParser
{
    use CodeAccessorTrait,
        CodeContextAccessor,
        StatementFactoryAccessor;

    /** Замена псевдо кода метками инструкций
     * @param string $code псевдо код
     * @return string метки инструкций
     */
    public function parse($code)
    {
        $code = $this->parseAllComplexStatements($code);
        return $this->parseAllSimpleStatements($code);
    }

    /** Замена псевдо кода метками составных инструкций
     * @param string $code псевдо код
     * @return string псевдо код с метками составных инструкций
     */
    private function parseAllComplexStatements($code)
    {
        return $code;
    }

    /** Замена псевдо кода метками инструкций
     * @param string $code псевдо код
     * @return string псевдо код с метками инструкций
     */
    private function parseAllSimpleStatements($code)
    {
        return $code;
    }


    /** @return ComplexStatementRegexp регулярное выражение составной инструкции */
    private function parseComplexStatement($code)
    {
        $code = $this->getCode();
        foreach($this->getComplexStatementRegexpList() as $complexStatementRegexp)
        {
            $regexp = $complexStatementRegexp->getValue();
            if(preg_match('/^'. $regexp. '$/', $code, $match)){
                return $complexStatementRegexp;
            }
        }
        return null;
    }

    /**
     * @return ComplexStatementRegexp[] список регулярных выражений для составных инструкций
     */
    private function getComplexStatementRegexpList()
    {
        return ComplexStatementRegexp::getEnumerators();
    }
}