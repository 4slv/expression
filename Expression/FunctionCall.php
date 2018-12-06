<?php

namespace Slov\Expression\Expression;

use Slov\Expression\Bracket\BracketParserAccessor;
use Slov\Expression\Bracket\BracketType;
use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Functions\StaticFunctionList;
use Slov\Expression\Type\TypeName;
use Slov\Expression\Type\TypeRegExp;


/** Вызов функции */
class FunctionCall extends ExpressionPart
{
    use BracketParserAccessor;

    const PHP_TEMPLATE = "%callMethod%('%functionName%', [%parametersList%])";

    /** @var string название функции */
    protected $functionName;

    /** @var string[] список меток параметров */
    protected $parameterLabelList;

    /** @var TypeName тип возвращаемого значения */
    protected $returnType;

        /**
     * @return string название функции
     */
    public function getFunctionName(): string
    {
        return $this->functionName;
    }

    /**
     * @param string $functionName название функции
     * @return $this
     */
    protected function setFunctionName(string $functionName)
    {
        $this->functionName = $functionName;
        return $this;
    }

    /**
     * @return string[] список меток параметров
     */
    public function getParameterLabelList(): array
    {
        return $this->parameterLabelList;
    }

    /**
     * @param string[] $parameterLabelList список меток параметров
     * @return $this
     */
    protected function setParameterLabelList(array $parameterLabelList)
    {
        $this->parameterLabelList = $parameterLabelList;
        return $this;
    }

    /**
     * @return TypeName тип возвращаемого значения
     */
    public function getReturnType(): TypeName
    {
        return $this->returnType;
    }

    /**
     * @param TypeName $returnType тип возвращаемого значения
     * @return $this
     */
    public function setReturnType(TypeName $returnType)
    {
        $this->returnType = $returnType;
        return $this;
    }

    public function parse(CodeContext $codeContext)
    {
        try{
            $this->parseFunction($codeContext);
        } catch (CodeParseException $exception) {
            $this->showErrorPath($exception);
        }
        return parent::parse($codeContext);
    }

    /**
     * Разбор псевдокода функции
     * @param CodeContext $codeContext контекст кода
     * @throws CodeParseException
     */
    protected function parseFunction(CodeContext $codeContext): void
    {
        if(preg_match('/'.TypeRegExp::FUNCTION.'/msi', $this->getCode(), $match))
        {
            $returnType = $match[3];
            $functionName = $match[4];

            if($functionName !== $returnType && TypeName::has($returnType) && TypeName::has($functionName))
            {
                throw new CodeParseException(
                    $this->getCode(). " :: type '$returnType' does not match function name '$functionName'"
                );
            }

            if(TypeName::has($functionName) === false && strlen($returnType) === 0)
            {
                throw new CodeParseException(
                    $this->getCode(). " :: function '$functionName' has no return type"
                );
            }

            if(TypeName::has($functionName) === false && StaticFunctionList::exists($functionName) === false)
            {
                throw new CodeParseException(
                    $this->getCode(). " :: function '$functionName' does not defined"
                );
            }

            $returnType = TypeName::has($functionName)
                ? $functionName
                : $returnType;

            $this->parseReturnType($returnType);
            $this->setFunctionName($functionName);
            $parametersCode = $this
                ->getBracketParser()
                ->parseFirstGroupContent(
                    $match[5],
                    BracketType::byValue(BracketType::ROUND_BRACKETS)
                );
            $this->parseParametersList($codeContext, $parametersCode);
        } else {
            throw new CodeParseException($this->getCode(). ' :: is not a function');
        }
    }

    /**
     * Разбор возвращаемого значения функции
     * @param string $returnTypeValue текстовое обозначение возвращаемого значения функции
     * @throws CodeParseException
     */
    protected function parseReturnType(string $returnTypeValue): void
    {
        if(TypeName::has($returnTypeValue))
        {
            $this->setReturnType(TypeName::byValue($returnTypeValue));
        } else {
            throw new CodeParseException($returnTypeValue. ' :: incorrect return type');
        }
    }

    /**
     * Разбор списка параметров
     * @param CodeContext $codeContext контекст кода
     * @param string $parametersCode псевдокод списка параметров
     * @throws CodeParseException
     */
    protected function parseParametersList(CodeContext $codeContext, string $parametersCode)
    {
        $parameterLabelList = [];
        $parameterCodeList = $this
            ->getBracketParser()
            ->split(
                $parametersCode,
                BracketType::byValue(BracketType::ROUND_BRACKETS),
                ','
            );
        foreach($parameterCodeList as $parameterCode)
        {
            if(strlen(trim($parametersCode)) > 0){
                $parameterLabelList[] = $this
                    ->createExpressionWithBrackets()
                    ->setCode($parameterCode)
                    ->parse($codeContext)
                    ->getLabel();
            }
        }
        $this->setParameterLabelList($parameterLabelList);
    }

    protected function typeDefinition(CodeContext $codeContext): TypeName
    {
        return $this->getReturnType();
    }

    protected function getContextList(CodeContext $codeContext)
    {
        return $codeContext->getFunctionCallList();
    }

    public function toPhp(CodeContext $codeContext): string
    {
        $parametersPhpList = [];
        foreach ($this->getParameterLabelList() as $parameterLabel)
        {
            $parametersPhpList[] = $codeContext
                ->getExpressionList()
                ->get($parameterLabel)
                ->getPhp();
        }

        $replace = [
            '%callMethod%' =>  StaticFunctionList::class. '::call',
            '%functionName%' => $this->getFunctionName(),
            '%parametersList%' => implode(', ', $parametersPhpList)
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            self::PHP_TEMPLATE
        );
    }
}