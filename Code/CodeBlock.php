<?php

namespace Slov\Expression\Code;

/** Блок кода (список связанных инструкций) */
class CodeBlock extends CodePart
{
    /** @var string[] список меток инструкций входящих в блок кода */
    protected $statementLabelList;

    protected function getContextList(CodeContext $codeContext)
    {
        return $codeContext->getCodeBlockList();
    }

    

}