<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodePart;
use Slov\Expression\Type\TypeNameAccessor;

abstract class ExpressionPart extends CodePart
{
    use TypeNameAccessor;
}