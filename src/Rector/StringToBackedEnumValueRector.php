<?php

declare(strict_types=1);

namespace WickedByte\EmbracingEnums\Rector;

use PhpParser\Node;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\EnumCase;
use Rector\Contract\Rector\ConfigurableRectorInterface;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use WickedByte\EmbracingEnums\HttpMethod;

class StringToBackedEnumValueRector extends AbstractRector implements ConfigurableRectorInterface
{
    /**
     * @var array<StringToBackedEnumValue>
     */
    private array $refactors = [];

    public function __construct(private readonly ValueResolver $value_resolver)
    {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Changes strings to specific backed Enum values', [new ConfiguredCodeSample(
            <<<'CODE_SAMPLE'
            final class SomeSubscriber
            {
                public static function getSubscribedEvents()
                {
                    return ['http_method' => 'GET'];
                }
            }
            CODE_SAMPLE,
            <<<'CODE_SAMPLE'
            final class SomeSubscriber
            {
                public static function getSubscribedEvents()
                {
                    return ['http_method' => HttpMethod::GET->value];
                }
            }
            CODE_SAMPLE,
            [new StringToBackedEnumValue(HttpMethod::Get)],
        )]);
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [
            String_::class,
            EnumCase::class,
        ];
    }

    public function refactor(Node $node): Node|null
    {
        foreach ($this->refactors as $refactor) {
            foreach ($refactor->skip_files as $file_path) {
                if (\str_ends_with($this->file->getFilePath(), $file_path)) {
                    continue 2;
                }
            }

            if ($node instanceof EnumCase) {
                /** @phpstan-ignore method.nonObject (scope attribute is either null or has method) */
                if ($node->getAttribute('scope')?->getClassReflection()?->getName() === $refactor->enum::class) {
                    $node->expr?->setAttribute('skip-this-enum-case', true);
                }
                continue;
            }

            if (!$node instanceof String_) {
                continue;
            }

            if (!$this->value_resolver->isValue($node, $refactor->string ?? $refactor->enum->value)) {
                continue;
            }

            if ($node->getAttribute('skip-this-enum-case')) {
                continue;
            }

            return $this->nodeFactory->createPropertyFetch(
                $this->nodeFactory->createClassConstFetch($refactor->enum::class, $refactor->enum->name),
                'value',
            );
        }

        return null;
    }

    public function configure(array $configuration): void
    {
        foreach ($configuration as $config) {
            \assert($config instanceof StringToBackedEnumValue);
            $this->refactors[] = $config;
        }
    }
}
