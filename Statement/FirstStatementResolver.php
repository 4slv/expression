<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Code\CodeParseException;

/** Определение первой инструкции */
class FirstStatementResolver
{
    /** @var StatementCodeParserFactory Фабрика способов разбора псевдокода на код инструкций */
    protected $statementCodeParserFactory;

    /** @var StatementFactory фабрика инструкций */
    protected $statementFactory;

    /**
     * @return StatementCodeParserFactory Фабрика способов разбора псевдокода на код инструкций
     */
    protected function getStatementCodeParserFactory(): StatementCodeParserFactory
    {
        if(is_null($this->statementCodeParserFactory))
        {
            $this->statementCodeParserFactory = new StatementCodeParserFactory();
        }
        return $this->statementCodeParserFactory;
    }

    /**
     * @return StatementFactory фабрика инструкций
     */
    protected function getStatementFactory(): StatementFactory
    {
        if(is_null($this->statementFactory))
        {
            $this->statementFactory = new StatementFactory();
        }
        return $this->statementFactory;
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
            ->getStatementCodeParserFactory()
            ->getElementByType($statementType)
            ->parse($code);

        return $this
            ->getStatementFactory()
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
            if(
                $position !==false
                &&
                $position < $minPosition
            )
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
        /** @var StatementType[] $result */
        $result = StatementTypePart::getEnumerators();
        return $result;
    }
}