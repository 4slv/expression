<?php

namespace Slov\Expression\Type;

use DateTime;
use Slov\Expression\TemplateProcessor\SingleTemplate;

/** Тип дата и время */
class DateTimeType extends Type
{
    use SingleTemplate;

    const template = 'date_time';

    const templateFolder = 'type';

    public function getType()
    {
        return new TypeName(TypeName::DATE_TIME);
    }

    /**
     * @return DateTime
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param DateTime $value
     * @return $this;
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $string строковое представление значения
     * @return DateTime значение
     */
    public function stringToValue($string)
    {
        preg_match('/^'. TypeRegExp::DATE_TIME. '$/', $string, $match);

        $date = $match[1];
        $time = isset($match[2]) && strlen($match[2]) > 0 ? $match[2] : ' 00:00:00';
        $microseconds = isset($match[3]) ? $match[3] : null;

        $dateTime = implode('', [$date, $time, $microseconds]);

        if(isset($microseconds)) {
            return DateTime::createFromFormat('Y.m.d H:i:s.u', $dateTime);
        }
        return DateTime::createFromFormat('Y.m.d H:i:s', $dateTime);
    }

    public function generatePhpCode(): string
    {
        return $this->render(['date' => $this->getValue()->format('Y-m-d H:i:s')]);
    }
}