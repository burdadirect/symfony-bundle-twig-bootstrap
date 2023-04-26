<?php

namespace HBM\TwigBootstrapBundle\Utils;

class BootstrapGroup extends BootstrapItem {

  public const MODE_DROPDOWN = 'dropdown';
  public const MODE_BUTTONGROUP = 'buttongroup';

  private ?string $mode;

  private array $items = [];

  /**
   * BootstrapLink constructor.
   *
   * @param string|null $mode
   * @param array $config
   */
  public function __construct(?string $mode = NULL, array $config = []) {
    parent::__construct($config);
    $this->mode = $mode;
  }

  /****************************************************************************/

  /**
   * Set mode.
   *
   * @param string|null $mode
   *
   * @return static
   */
  public function setMode(?string $mode = NULL): static {
    $this->mode = $mode;

    return $this;
  }

  /**
   * Get mode.
   *
   * @return string|null
   */
  public function getMode(): ?string {
    return $this->mode;
  }

  /****************************************************************************/

  /**
   * Add item.
   *
   * @param BootstrapItem|string $item
   * @param string|null $key
   *
   * @return static
   */
  public function addItem(BootstrapItem|string $item, string $key = NULL): static {
    if ($key) {
      $this->items[$key] = $item;
    } else {
      $this->items[] = $item;
    }

    return $this;
  }

  /**
   * Remove item.
   *
   * @param string|int $keyOrIndex
   *
   * @return static
   */
  public function removeItem(string|int $keyOrIndex): static {
    unset($this->items[$keyOrIndex]);

    return $this;
  }

  /**
   * Set items.
   *
   * @param array $items
   *
   * @return static
   */
  public function setItems(array $items): static {
    $this->items = $items;

    return $this;
  }

  /**
   * Get items.
   *
   * @return array
   */
  public function getItems(): array {
    return $this->items;
  }

}
