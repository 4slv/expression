<?php

namespace Slov\Expression\Code;

/** Часть псевдо кода */
abstract class CodePart implements CodeParser, CodeToPhp
{
    use CodeAccessor;
}