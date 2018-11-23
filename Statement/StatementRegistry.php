<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Code\CodeParseException;

/** Реестр инструкций */
class StatementRegistry
{
    /** @var Statement[] список инструкций */
    protected $list;

    /** @var SimpleStatement простая инструкция */
    protected $simpleStatement;

    /**
     * @return Statement[]
     */
    public function getList(): array
    {
        if(is_null($this->list))
        {
            $this->list = [
                StatementType::SIMPLE_STATEMENT => $this->getSimpleStatement()
            ];
        }
        return $this->list;
    }

    /**
     * Получение инструкции по типу инструкции
     * @param StatementType $statementType тип инструкции
     * @return Statement инструкция
     * @throws CodeParseException
     */
    public function getElementByType(StatementType $statementType): Statement
    {
        $list = $this->getList();
        if(array_key_exists($statementType->getValue(), $list)){
            return $list[$statementType->getValue()];
        }
        throw new CodeParseException($statementType->getValue(). ' not exists in '. self::class);
    }

    /**
     * @return SimpleStatement простая инструкция
     */
    public function getSimpleStatement(): SimpleStatement
    {
        if(is_null($this->simpleStatement))
        {
            $this->simpleStatement = new SimpleStatement();
        }
        return $this->simpleStatement;
    }


}