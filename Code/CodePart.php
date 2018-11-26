<?php

namespace Slov\Expression\Code;

use Slov\Expression\CodePartFactory;

/** Часть псевдо кода */
abstract class CodePart implements CodeParserInterface, CodeToPhp
{
    use CodeAccessor;
    use PhpAccessor;
    use LabelAccessor;
    use CodePartFactory;

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
        /** @var CodePartList $contextList */
        $contextList = $this->getContextList($codeContext);
        $label = $contextList->append($this);
        $this->setLabel($label);
        $php = $this->toPhp($codeContext);
        $this->setPhp($php);
        return $this;
    }

    abstract protected function getContextList(CodeContext $codeContext);
}