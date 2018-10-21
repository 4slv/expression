<?php

namespace Slov\Expression;

use Slov\Expression\Statement\ComplexStatementList;
use Slov\Expression\Statement\SimpleStatementList;
use Slov\Expression\Statement\Statement;

/** Преобразователь псевдо кода */
class CodeTransform implements ToPhpTransformer
{
    use CodeAccessorTrait,
        CodeContextAccessor;

    public function toPhp($code, $codeContext): string
    {
        $phpCode = '';
        $this->setCode($code);

        foreach ($this->toStatementList() as $statement)
        {
            $phpCode .= $statement->toPhp($statement->getCode(), $codeContext);
        }
        return $phpCode;
    }

    /**
     * @return Statement[] список инструкций
     */
    private function toStatementList()
    {
        $parsedCode = $this
            ->createCodeParser()
            ->setCodeContext($this->getCodeContext())
            ->parse($this->getCode());
        preg_match_all(
            '/('.SimpleStatementList::LABEL_NAME. '\d+|'. ComplexStatementList::LABEL_NAME. '\d+'.')/',
            $parsedCode,
            $match
        );
        return $this->buildStatementList($match[1]);
    }

    /**
     * @param string[] $statementLabelList список меток инструкций
     * @return Statement[] список инструкций
     */
    private function buildStatementList($statementLabelList)
    {
        $statementList = [];
        foreach($statementLabelList as $statementLabel){
            $statementType = rtrim($statementLabel, '0123456789');
            switch ($statementType){
                case SimpleStatementList::LABEL_NAME:
                    $statementList[] = $this->getSimpleStatementList()->get($statementLabel);
                    break;
                case ComplexStatementList::LABEL_NAME:
                    $statementList[] = $this->getComplexStatementList()->get($statementLabel);
                    break;
            }
        }
        return $statementList;
    }

    /**
     * @return CodeParser парсер кода
     */
    private function createCodeParser()
    {
        return new CodeParser();
    }
}