<?php

namespace Slov\Expression\Statement;


/** Список составных инструкций */
class ComplexStatementList
{
    const  LABEL_NAME = 'ComplexStatement';

    /** @var ComplexStatement[] список составных инструкций */
    private $list = [];

    public function append(ComplexStatement $statement)
    {
        $label = $this->getFreeLabel();
        $this->list[$label] = $statement;
        return $label;
    }

    /**
     * @param string $label метка составной инструкции
     * @return bool true - инструкция с указанной меткой существует
     */
    public function exists(string $label): bool
    {
        return array_key_exists($label, $this->list);
    }

    /**
     * @param string $label метка составной инструкции
     * @return ComplexStatement|null
     */
    public function get(string $label): ?ComplexStatement
    {
        return $this->exists($label) ?
            $this->list[$label]
            : null;
    }

    /**
     * @return ComplexStatement[] список всех составных инструкций
     */
    public function getAll()
    {
        return $this->list;
    }

    /**
     * @return string получение свободной метки
     */
    public function getFreeLabel(): string
    {
        return self::LABEL_NAME. count($this->list);
    }
}