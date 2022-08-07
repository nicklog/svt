<?php

declare(strict_types=1);

namespace App\Infrastructure\Menu\Extension;

use Knp\Menu\Factory\ExtensionInterface;
use Knp\Menu\ItemInterface;

final class IconifyExtension implements ExtensionInterface
{
    private const KEY_NAME = 'icon';

    /**
     * @inheritDoc
     */
    public function buildOptions(array $options): array
    {
        return [...[
            self::KEY_NAME => null,
        ], ...$options,
        ];
    }

    /**
     * @inheritDoc
     */
    public function buildItem(ItemInterface $item, array $options): void
    {
        $item->setExtra(self::KEY_NAME, $options[self::KEY_NAME] ?? null);
    }
}
