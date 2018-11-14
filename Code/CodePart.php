<?php

namespace Slov\Expression\Code;

/** Часть псевдо кода */
abstract class CodePart implements CodeParser, CodeToPhp
{
    use CodeAccessor;
    use PhpAccessor;
    use LabelAccessor;

    /**
     * @throws CodeParseException
     */
    protected function toPhpParseError()
    {
        throw new CodeParseException($this->getCode(). ' :: impossible convert to php');
    }

    abstract protected function getContextList(CodeContext $codeContext);
}