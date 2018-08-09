<?php


namespace Slov\Expression\OperationCache\Traits;


use Slov\Expression\CalculationException;
use Slov\Expression\Type\TypeName;

trait Extremum
{

    /** @var  TypeName */
    protected $typeList;

    /**
     * @return string
     * @throws CalculationException
     */
    public function generatePhpCode()
    {

        $param = '['.implode(',', array_map(function($item){
            return $item->generatePhpCode();
        },$this->getParameterList())).']';
        $templateName = $this->getTypeList() == TypeName::MONEY() ? 'money' : 'numeric';
        return $this->render($templateName,['list' => $param]);
    }

    /**
     * @return TypeName
     * @throws CalculationException
     */
    protected function getTypeList()
    {
        if(is_null($this->typeList)) {
            $cycleFor =  function($array,$types){
                foreach ($array as $element) {
                    if(!in_array($element->getType(),$types))
                        return false;
                }
                return true;
            };
            if($cycleFor($this->getParameterList(),[TypeName::MONEY()]))
                $this->typeList = TypeName::MONEY();
            elseif($cycleFor($this->getParameterList(),[TypeName::INT(),TypeName::FLOAT()]))
                $this->typeList = TypeName::FLOAT();
            else
                $this->throwOperationException();
        }
        return $this->typeList;
    }

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        try {
            return $this->getTypeList();
        }catch (CalculationException $exception){
            return TypeName::UNKNOWN();
        }
    }
}