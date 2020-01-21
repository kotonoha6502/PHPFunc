<?php declare(strict_types = 1);

namespace FunPHP\Foundations\Rules\PatternMatch;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

class NonExhaustivePatternsRule implements Rule {

    public function getNodeType(): string {
        return Node\Expr\MethodCall::class;
    }

    public function processNode(Node $node, Score $score): array {
        if ($node->name instanceof Node\Identifier)  {
            return [];
        }

        if ($node->name->toLowerString() !== 'on') {
            return [];
        }

        $calledOnType = $scope->getType($node->var)
    }
}