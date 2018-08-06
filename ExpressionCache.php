<?php


namespace Slov\Expression;


use Slov\Expression\TextExpression\FunctionList;
use Slov\Expression\TemplateProcessor\TemplateProcessor;
use Slov\Helper\StringHelper;
use function Sodium\crypto_box_publickey_from_secretkey;

class ExpressionCache extends Expression
{


    const template = 'expression';

    /**
     * @var FunctionList
     */
    protected $functionList;


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

    protected function getTemplate()
    {
        return TemplateProcessor::getInstance()->getTemplateByName(static::template);
    }




    public function calculate()
    {
        $fileName = md5($this->getTextDescription());
        $functionName = 'expression'.$fileName;
        $fileFullName = implode(DIRECTORY_SEPARATOR,[__DIR__,'tmp',$fileName.'.php']);
        if(!file_exists($fileFullName)) {
            $phpExpressionText = StringHelper::replacePatterns(
                $this->getTemplate(),
                [
                    '%name%' => $functionName,
                    '%body%' => $this->generatePhpCode()
                ]
            );
            file_put_contents($fileFullName, $phpExpressionText);
        }
        require_once $fileFullName;
        return $functionName($this->getFunctionList());

    }

    public function generatePhpCode()
    {
        $this->setFirstOperandResult($this->getFirstOperand()->calculate());
        $this->setSecondOperandResult($this->getSecondOperand()->calculate());
//        try {
            return $this
                ->getOperation()
                ->setFirstOperand($this->getFirstOperandResult())
                ->setSecondOperand($this->getSecondOperandResult())
                ->generatePhpCode();
//        } catch (CalculationException $exception)
//        {
//            throw new CalculationException(
//                $exception->getMessage().
//                "\n===\n".
//                $this->getTextDescription()
//            );
//        }
    }
}