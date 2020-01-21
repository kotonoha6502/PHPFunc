<?php declare(strict_types = 1);

namespace PHPFunc\Foundations\Syntax\PatternMatch;

use PHPFunc\Foundations\Syntax\PatternMatch\Pattern;
use PHPFunc\Foundations\Syntax\PatternMatch\DefaultValue;
use PHPFunc\Foundations\Syntax\PatternMatch\CaseValue;
use PHPFunc\Foundations\Exception\PatternMatchFailureException;

/**
 * @template T
 * @template R
 */
final class MatchExpression {
    /** @var class-string<T> $type */
    private $type;

    /** @var array<int, Pattern<T, R>> */
    private $patterns;

    /**
     * @param class-string<T> $type
     * @param array<int, Pattern<T, R>> $patterns
     */
    private function __construct(string $type, array $patterns) {
        $this->type = $type;
        $this->patterns = $patterns;
    }

    /**
     * @param class-string<T> $type
     * @param Pattern<T, R> $pattern
     * @return MatchExpression<T, R>
     */
    public static function create(string $type, Pattern $pattern) {
        return new static($type, [$pattern]);
    }

    /**
     * @param class-string<T> $type
     * @param R $eval
     * @return MatchExpression<T, R>
     */
    public function case(string $type, $eval) :self {
        return new MatchExpression($this->type, [
            ...$this->patterns,
            new CaseValue($type, $eval)
        ]);
    }

    /**
     * @param R $eval
     * @return MatchExpression<T, R>
     */
    public function default($eval) :self {
        return new MatchExpression($this->type, [
            ...$this->patterns,
            new DefaultValue($eval)
        ]);
    }

    /**
     * @param T $target
     * @return R
     */
    public function on($target) {
        foreach ($this->patterns as $pattern) {
            if ($pattern instanceof DefaultValue) {
                return $pattern->getValue();
            }

            if ($pattern instanceof CaseValue) {
                $type = $pattern->getType();
                if ($target instanceof $type){
                    return $pattern->getValue();
                }
            }
        }

        throw new \RuntimeException("Non-exhaustive patterns.");
    }
}