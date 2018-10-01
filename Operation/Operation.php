<?php

namespace Slov\Expression\Operation;

use Slov\Expression\CodeAccessor;
use Slov\Expression\StringToPhp;
use Slov\Expression\Type\TypeName;

/** Операция с типами */
abstract class Operation implements StringToPhp {

    use CodeAccessor;
    use OperationTrait;

    /** @return string шаблон выражения на php */
    abstract public function getPhpTemplate(): string;

    /** @return TypeName название типа */
    abstract protected function resolveReturnTypeName();
}