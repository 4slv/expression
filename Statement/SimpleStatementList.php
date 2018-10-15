<?php

namespace Slov\Expression\Statement;

/** Список составных инструкций */
class SimpleStatementList
{
    const  LABEL_NAME = 'SimpleStatement';

    /** @var SimpleStatement[] список простых инструкций */
    private $list = [];

    public function append(SimpleStatement $statement)
    {
        $label = $this->getFreeLabel();
        $this->list[$label] = $statement;
        return $label;
    }

    /**
     * @param string $label метка простой инструкции
     * @return bool true - инструкция с указанной меткой существует
     */
    public function exists(string $label): bool
    {
        return array_key_exists($label, $this->list);
    }

    /**
     * @param string $label метка простой инструкции
     * @return SimpleStatement|null
     */
    public function get(string $label): ?SimpleStatement
    {
        return $this->exists($label) ?
            $this->list[$label]
            : null;
    }

    /**
     * @return SimpleStatement[] список всех простых инструкций
     */
    public function getAll()
    {
        return $this->list;
    }

    /**
     * @return string получение свободной метки
     */
    private function getFreeLabel(): string
    {
        return self::LABEL_NAME. count($this->list);
    }
}