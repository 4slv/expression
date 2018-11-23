<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Code\CodeParseException;

/** Определение первой инструкции */
class FirstStatementResolver
{
    /** @var StatementCodeParserRegistry реестр способов разбора псевдокода на код инструкций */
    protected $statementCodeParserRegistry;

    /** @var StatementRegistry реестр инструкций */
    protected $statementRegistry;

    /**
     * @return StatementCodeParserRegistry реестр способов разбора псевдокода на код инструкций
     */
    protected function getStatementCodeParserRegistry(): StatementCodeParserRegistry
    {
        if(is_null($this->statementCodeParserRegistry))
        {
            $this->statementCodeParserRegistry = new StatementCodeParserRegistry();
        }
        return $this->statementCodeParserRegistry;
    }

    /**
     * @return StatementRegistry реестр инструкций
     */
    protected function getStatementRegistry(): StatementRegistry
    {
        if(is_null($this->statementRegistry))
        {
            $this->statementRegistry = new StatementRegistry();
        }
        return $this->statementRegistry;
    }

    /**
     * определение первой инструкции
     * @param string $code псевдо код
     * @return null|Statement инструкция
     * @throws CodeParseException
     */
    public function resolve(string $code): ?Statement
    {
        try{
            $statementType = $this->resolveFirstStatementType($code);
        } catch (CodeParseException $exception){
            return null;
        }

        $statementCode = $this
            ->getStatementCodeParserRegistry()
            ->getElementByType($statementType)
            ->parse($code);

        return $this
            ->getStatementRegistry()
            ->getElementByType($statementType)
            ->setCode($statementCode);
    }

    /**
     * регулярное выражение для типа первой инструкции
     * @param string $code псевдокод
     * @return StatementType регулярное выражение для типа инструкции
     * @throws CodeParseException
     */
    protected function resolveFirstStatementType(string $code): StatementType
    {
        $minPosition = INF;
        $resultStatementTypePart = null;
        foreach($this->getStatementTypePartList() as $statementTypePart){
            $position = strpos($code, $statementTypePart->getValue());
            if($position < $minPosition)
            {
                $minPosition = $position;
                $resultStatementTypePart = $statementTypePart;
            }
        }

        if(isset($resultStatementTypePart))
        {
            return StatementType::byName($resultStatementTypePart->getName());
        }

        throw new CodeParseException($code. ' :: code does not contain statement');
    }

    /**
     * @return StatementType[] список частей типов инструкций
     */
    protected function getStatementTypePartList()
    {
        return StatementTypePart::getConstants();
    }
}