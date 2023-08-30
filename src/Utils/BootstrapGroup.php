<?php

namespace HBM\TwigBootstrapBundle\Utils;

class BootstrapGroup extends BootstrapItem
{
    public const MODE_DROPDOWN    = 'dropdown';
    public const MODE_BUTTONGROUP = 'buttongroup';

    private ?string $mode;

    private array $items = [];

    /**
     * BootstrapLink constructor.
     */
    public function __construct(string $mode = null, array $config = [])
    {
        parent::__construct($config);
        $this->mode = $mode;
    }

    /**
     * Set mode.
     */
    public function setMode(string $mode = null): static
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * Get mode.
     */
    public function getMode(): ?string
    {
        return $this->mode;
    }

    /**
     * Add item.
     */
    public function addItem(BootstrapItem|string $item, string $key = null): static
    {
        if ($key) {
            $this->items[$key] = $item;
        } else {
            $this->items[] = $item;
        }

        return $this;
    }

    /**
     * Remove item.
     */
    public function removeItem(string|int $keyOrIndex): static
    {
        unset($this->items[$keyOrIndex]);

        return $this;
    }

    /**
     * Set items.
     */
    public function setItems(array $items): static
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items.
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
