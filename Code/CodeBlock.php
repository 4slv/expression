<?php

namespace Slov\Expression\Code;

use Slov\Expression\Statement\FirstStatementResolver;

/** Блок кода (список связанных инструкций) */
class CodeBlock extends CodePart
{
    /** @var string[] список меток инструкций входящих в блок кода */
    protected $statementLabelList = [];

    /** @var FirstStatementResolver определение первой инструкции */
    protected $firstStatementResolver;

    /**
     * @return string[] список меток инструкций входящих в блок кода
     */
    public function getStatementLabelList(): array
    {
        return $this->statementLabelList;
    }

    /**
     * @return FirstStatementResolver определение первой инструкции
     */
    public function getFirstStatementResolver(): FirstStatementResolver
    {
        if(is_null($this->firstStatementResolver))
        {
            $this->firstStatementResolver = new FirstStatementResolver();
        }
        return $this->firstStatementResolver;
    }

    /**
     * Добавить метку инструкции в конец списка
     * @param string $statementLabel метка инструкции
     */
    protected function append($statementLabel): void
    {
        $this->statementLabelList[] = $statementLabel;
    }

    protected function getContextList(CodeContext $codeContext)
    {
        return $codeContext->getCodeBlockList();
    }

    public function parse(CodeContext $codeContext)
    {
        $this->parseStatementList($codeContext);
        return parent::parse($codeContext);
    }

    /**
     * Разбор кода на инструкции
     * @param CodeContext $codeContext контекст кода
     * @throws CodeParseException
     */
    protected function parseStatementList(CodeContext $codeContext): void
    {
        $code = $this->getCode();
        while($statement = $this->getFirstStatementResolver()->resolve($code))
        {
            $statementLabel = $statement
                ->parse($codeContext)
                ->getLabel();
            $this->append($statementLabel);

            $replaceOnce = 1;
            $code = str_replace(
                $statement->getCode(),
                '',
                $code,
                $replaceOnce
            );
        }
    }

    public function toPhp(CodeContext $codeContext): string
    {
        $statementPhpList = [];

        foreach($this->getStatementLabelList() as $statementLabel){
            $statementPhpList[] = $codeContext
                ->getStatementList()
                ->get($statementLabel)
                ->getPhp();
        }


        return implode("\n", $statementPhpList);
    }

}