<?php

namespace Slov\Expression\Code;

use Slov\Expression\Functions\FunctionList;
use Slov\Expression\Functions\FunctionListBuilder;

/** Запуск псевдокода */
class CodeExecutor
{
    use CodeAccessor;
    use CodePartFactory;

    /** @var CodeContext контекст кода */
    protected $codeContext;

    /** @var array ассоциативный массив вида: название переменной => значение переменной */
    protected $variableList;

    /** @var FunctionList список пользовательских функций */
    protected $userFunctionList;

    /**
     * @param FunctionList|null $userFunctionList список пользовательских функци2
     * @throws CodeParseException
     */
    public function __construct(FunctionList $userFunctionList = null)
    {
        $this->variableList = [];
        $this->userFunctionList = $userFunctionList ?? new FunctionList();
        $this->initFunctionList();
    }

    /**
     * @return CodeContext контекст кода
     */
    public function getCodeContext(): CodeContext
    {
        return $this->codeContext;
    }

    /**
     * @param CodeContext $codeContext контекст кода
     * @return $this
     */
    public function setCodeContext(CodeContext $codeContext)
    {
        $this->codeContext = $codeContext;
        return $this;
    }

    /**
     * @return array список переменных
     */
    public function getVariableList(): array
    {
        return $this->variableList;
    }

    /**
     * @param array $variableList список переменных
     * @return $this
     */
    protected function setVariableList(array $variableList)
    {
        $this->variableList = $variableList;
        return $this;
    }

    /**
     * Инициализация списка функций
     * @throws CodeParseException
     */
    protected function initFunctionList(): void
    {
        $functionListBuilder = new FunctionListBuilder();
        $functionListBuilder
            ->setUserFunctionList($this->userFunctionList)
            ->build();
    }

    /**
     * @param string $variableName значение переменной
     * @return mixed
     */
    public function getVariableByName(string $variableName)
    {
        return $this->variableList[$variableName] ?? null;
    }

    /** Выполнить псевдо код
     * @return $this
     * @throws CodeParseException
     */
    public function execute()
    {
        $codeBlock = $this
            ->createCodeBlock()
            ->setCode($this->getCode())
            ->parse($this->getCodeContext())
            ->getPhp();
        $returnVariableList = $this
            ->getReturnVariableListCode();

        $code = $codeBlock. "\n". $returnVariableList;

        $variableList = eval($code);
        $this->setVariableList($variableList);
        return $this;
    }

    /**
     * @return string код возврата
     */
    protected function getReturnVariableListCode(): string
    {
        $variableToString = [];
        $variableList = $this->getCodeContext()->getVariableList()->getList();
        foreach ($variableList as $variableName => $variableCode)
        {
            $variableToString[] = "'$variableName' => $variableName ?? null";
        }
        return
            str_replace(
                '%variableStringList%',
                implode(", ", $variableToString),
                'return [%variableStringList%];'
            );
    }
}