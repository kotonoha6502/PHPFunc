<?php declare(strict_types = 1);

use \FunPHP\Foundations\Syntax\PatternMatch\MatchExprBuilder;

if (!function_exists("match")) {
    /**
     * @template T
     * @param class-string<T> $type
     * @return MatchExprBuilder<T>
     */
    function match($type) {
        return new MatchExprBuilder($type);
    }
}