<?php


namespace Slov\Expression;


use Slov\Expression\Interfaces\Operand;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\TemplateProcessor\TemplateProcessor;
use Slov\Expression\TextExpression\FunctionList;
use Slov\Expression\TextExpression\VariableList;

class ExpressionCache extends Expression implements Operand
{



    const template = 'expression';

    /** @var string */
    protected $functionName;

    /** @var string результат рассчёта первого операнда */
    protected $firstOperandCodeResult;

    /** @var string результат рассчёта второго операнда */
    protected $secondOperandCodeResult;

    /** @var FunctionList */
    protected $functionList;

    /** @var VariableList */
    protected $variableList;

    /**
     * @return mixed|null
     */
    public function getFunctionName()
    {
        return $this->functionName;
    }

    /**
     * @param mixed $functionName
     * @return $this
     */
    public function setFunctionName($functionName)
    {
        $this->functionName = $functionName;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getFirstOperandCodeResult(): ?string
    {
        return $this->firstOperandCodeResult;
    }

    /**
     * @param string $firstOperandCodeResult
     * @return $this
     */
    public function setFirstOperandCodeResult(?string $firstOperandCodeResult)
    {
        $this->firstOperandCodeResult = $firstOperandCodeResult;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSecondOperandCodeResult(): ?string
    {
        return $this->secondOperandCodeResult;
    }

    /**
     * @param string $secondOperandCodeResult
     * @return $this
     */
    public function setSecondOperandCodeResult(?string $secondOperandCodeResult)
    {
        $this->secondOperandCodeResult = $secondOperandCodeResult;
        return $this;
    }


    /**
     * @return FunctionList|null
     */
    public function getFunctionList(): ?FunctionList
    {
        return $this->functionList;
    }

    /**
     * @param FunctionList $functionList
     * @return $this
     */
    public function setFunctionList(?FunctionList $functionList)
    {
        $this->functionList = $functionList;
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getVariableList()
    {
        return $this->variableList;
    }

    /**
     * @param mixed $variableList
     * @return $this
     */
    public function setVariableList($variableList)
    {
        $this->variableList = $variableList;
        return $this;
    }


    /**
     * @param array $variables
     * @return string
     */
    protected function render($variables = [])
    {
        return TemplateProcessor::getInstance()->render(TemplateProcessor::getInstance()->getTemplateByName(static::template),$variables);
    }



    public function calculate()
    {
        return $this->createExpressionCacheFile()
            ->getFunctionName()($this->getFunctionList(),$this->getVariableList());
    }

    public function createExpressionCacheFile()
    {
        $fileName = md5($this->getTextDescription());
        $this->setFunctionName('expression'.$fileName);
        $fileFullName = implode(DIRECTORY_SEPARATOR,[__DIR__,'tmp',$fileName.'.php']);
        if(!file_exists($fileFullName)) {
            $phpExpressionText =$this->render(
            [
                'name' => $this->getFunctionName(),
                'body' => $this->generatePhpCode()
            ]);
            file_put_contents($fileFullName, $phpExpressionText);
        }
        require_once $fileFullName;
        return $this;

    }

    public function generatePhpCode()
    {
        $this->setFirstOperandCodeResult($this->getFirstOperand()->generatePhpCode());
        $this->setSecondOperandCodeResult($this->getSecondOperand()->generatePhpCode());
        try {
            return $this
                    ->getOperation()
                    ->setFirstOperand($this->getFirstOperand())
                    ->setSecondOperand($this->getSecondOperand())
                    ->setFirstOperandCode($this->getFirstOperandCodeResult())
                    ->setSecondOperandCode($this->getSecondOperandCodeResult())
                    ->generatePhpCode();
        } catch (CalculationException $exception)
        {
            throw new CalculationException(
                $exception->getMessage().
                "\n===\n".
                $this->getTextDescription()
            );
        }
    }



    public function getType()
    {
        /** @var OperationCache $operation */
        $operation = $this
            ->getOperation();
        return $operation
            ->setFirstOperand($this->getFirstOperand())
            ->setSecondOperand($this->getSecondOperand())
            ->resolveReturnTypeName();
    }


}