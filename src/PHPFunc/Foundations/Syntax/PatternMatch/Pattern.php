<?php declare(strict_types = 1);

namespace FunPHP\Foundations\Syntax\PatternMatch;

/**
 * @template T
 * @template R
 */
abstract class Pattern {}

/**
 * @template T
 * @template R
 * @extends Pattern<T, R>
 */
final class CaseValue extends Pattern {
    /** @var class-string<T> */
    private $type;

    /** @var R */
    private $value;

    /**
     * @param class-string<T> $type
     * @param R $value
     */
    public function __construct(string $type, $value) {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @return class-string<T>
     */
    public function getType() : string {
        return $this->type;
    }

    /**
     * @return R
     */
    public function getValue() {
        return $this->value;
    }
}

/**
 * @template T
 * @template R
 * @extends Pattern<T, R>
 */
final class DefaultValue extends Pattern {
    
    /** @var R $value */
    private $value;

    /**
     * @param R $value
     */
    public function __construct($value) {
        $this->value = $value;
    }

    /**
     * @return R
     */
    public function getValue() {
        return $this->value;
    }
}