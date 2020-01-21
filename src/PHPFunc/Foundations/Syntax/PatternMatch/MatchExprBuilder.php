<?php declare(strict_types = 1);

namespace FunPHP\Foundations\Syntax\PatternMatch;

use FunPHP\Foundations\Syntax\PatternMatch\Pattern;
use FunPHP\Foundations\Syntax\PatternMatch\CaseValue;
use FunPHP\Foundations\Syntax\PatternMatch\DefaultValue;
use FunPHP\Foundations\Syntax\PatternMatch\MatchExpression;

/**
 *  @template T
 */
final class MatchExprBuilder {
    /** @var class-string<T> */
    protected $type;

    /**
     * @param class-string<T> $type
     */
    public function __construct(string $type) {
        $this->type = $type;
    }

    /**
     * @template R
     * @param class-string<T> $pattern
     * @param R $eval
     * @return MatchExpression<T, R>
     */
    public function case(string $pattern, $eval) : MatchExpression {
        return MatchExpression::create($this->type, new CaseValue($pattern, $eval));
    }

    /**
     * @template R
     * @param R $eval
     * @return MatchExpression<T, R>
     */
    public function default($eval) : MatchExpression {
        return MatchExpression::create($this->type, new DefaultValue($eval));
    }
}