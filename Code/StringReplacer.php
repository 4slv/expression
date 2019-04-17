<?php

namespace Slov\Expression\Code;

/* Заменитель строк */
trait StringReplacer
{
    /** Однократная замена подстроки
     * @param string $search искомая строка
     * @param string $replace строка для замены
     * @param string $subject строка в которой производится замена
     * @return string
     */
    protected function stringReplaceOnce($search, $replace, $subject)
    {
        $pos = strpos($subject, $search);
        if ($pos !== false) {
            return substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }
}