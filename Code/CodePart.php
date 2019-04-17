<?php

namespace Slov\Expression\Code;

/** Часть псевдо кода */
abstract class CodePart implements CodeParserInterface, CodeToPhp
{
    use CodeAccessor;
    use PhpAccessor;
    use LabelAccessor;
    use CodePartFactory;
    use StringReplacer;

    /**
     * @throws CodeParseException
     */
    protected function toPhpParseError()
    {
        throw new CodeParseException($this->getCode(). ' :: impossible convert to php');
    }

    /** разбор кода операнда
     * @param CodeContext $codeContext контекст кода
     * @return $this
     * @throws CodeParseException */
    public function parse(CodeContext $codeContext)
    {
        try{
            /** @var CodePartList $contextList */
            $contextList = $this->getContextList($codeContext);
            $label = $contextList->append($this);
            $this->setLabel($label);
            $php = $this->toPhp($codeContext);
            $this->setPhp($php);
        } catch (CodeParseException $exception) {
            $this->showErrorPath($exception);
        }
        return $this;
    }

    /**
     * Отображение пути ошибки разбора
     * @param CodeParseException $exception исключение
     * @throws CodeParseException
     */
    protected function showErrorPath(CodeParseException $exception)
    {
        throw new CodeParseException(
            $exception->getMessage().
            "\n===\n".
            $this->getCode().
            "\n"
        );
    }

    abstract protected function getContextList(CodeContext $codeContext);
}