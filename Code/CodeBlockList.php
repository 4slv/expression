<?php

namespace Slov\Expression\Code;

/** Список блоков кода */
class CodeBlockList extends CodePartList
{
    const LABEL_PREFIX = 'CodePart';

    public function getLabelPrefix(): string
    {
        return self::LABEL_PREFIX;
    }

    /** Добавление элемента в список
     * @param CodeBlock $listElement элемент списка
     * @param string $elementLabel метка элемента списка
     * @return string метка добавленного элемента */
    public function append($listElement, $elementLabel = null)
    {
        return parent::append($listElement, $elementLabel);
    }

    /** Получение элемента по метке
     * @param string $label метка элемента списка
     * @return CodeBlock элемент списка
     * @throws CodeParseException */
    public function get($label)
    {
        /** @var CodeBlock $result */
        $result = parent::get($label);
        return $result;
    }

    /**
     * @return CodeBlock[] список элементов
     */
    public function getList(): array
    {
        return $this->list;
    }
}