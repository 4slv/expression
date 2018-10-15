<?php

namespace Slov\Expression;

use Slov\Expression\Statement\ComplexStatement;
use Slov\Expression\Statement\ComplexStatementList;
use Slov\Expression\Statement\ComplexStatementName;
use Slov\Expression\Statement\ComplexStatementRegexp;
use Slov\Expression\Statement\StatementBuilderAccessor;

/** Разбор кода */
class CodeParser
{
    use CodeAccessorTrait,
        CodeContextAccessor,
        StatementBuilderAccessor;

    /** @var int количество производимых замен инструкций за раз */
    private static $oneStatementReplace = 1;

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
        $codeParsed = $code;
        $complexStatementList = $this->getComplexStatementList();
        while ($complexStatement = $this->parseComplexStatement($codeParsed))
        {
            $label = $complexStatementList->getFreeLabel();
            $complexStatementList->append($complexStatement);
            $codeParsed = str_replace(
                $complexStatement->getCode(),
                $label,
                $codeParsed,
                self::$oneStatementReplace
            );
        }
        return $codeParsed;
    }

    /** Замена псевдо кода метками инструкций
     * @param string $code псевдо код
     * @return string псевдо код с метками инструкций
     */
    private function parseAllSimpleStatements($code)
    {
        $codeParsed = $code;
        $simpleStatementCodeList = preg_split('/'. ComplexStatementList::LABEL_NAME. '\d+/', $code);
        $simpleStatementList = $this->getSimpleStatementList();

        foreach ($simpleStatementCodeList as $simpleStatementCode)
        {
            $label = $simpleStatementList->getFreeLabel();
            $simpleStatement = $this->getSimpleStatementBuilder()
                ->build($simpleStatementCode);
            $simpleStatementList->append($simpleStatement);
            $codeParsed = str_replace(
                $simpleStatementCode,
                $label,
                $codeParsed,
                self::$oneStatementReplace
            );
        }
        return $codeParsed;
    }


    /**
     * @param string $code псевдо код
     * @return null|ComplexStatement составная инструкция
     */
    private function parseComplexStatement($code)
    {
        foreach($this->getComplexStatementRegexpList() as $complexStatementRegexp)
        {
            $regexp = $complexStatementRegexp->getValue();
            if(preg_match('/'. $regexp. '/msi', $code, $match)){
                $regexpName = $complexStatementRegexp->getName();
                $complexStatementName = ComplexStatementName::byName($regexpName);
                return $this
                    ->getComplexStatementBuilder()
                    ->build(
                        $complexStatementName,
                        $match
                    );
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