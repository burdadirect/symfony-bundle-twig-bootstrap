<?php

namespace HBM\TwigBootstrapBundle\Utils;

class BootstrapGroup extends BootstrapItem {

  public const MODE_DROPDOWN = 'dropdown';
  public const MODE_BUTTONGROUP = 'buttongroup';

  /**
   * @var string
   */
  private $mode;

  /**
   * @var array
   */
  private $items;

  /**
   * BootstrapLink constructor.
   *
   * @param string|null $mode
   * @param array $config
   */
  public function __construct($mode = NULL, array $config = []) {
    parent::__construct($config);
    $this->mode = $mode;
  }

  /****************************************************************************/

  /**
   * Set mode.
   *
   * @param string $mode
   *
   * @return self
   */
  public function setMode(string $mode = NULL) : self {
    $this->mode = $mode;

    return $this;
  }

  /**
   * Get mode.
   *
   * @return string|null
   */
  public function getMode() : ?string {
    return $this->mode;
  }

  /****************************************************************************/

  /**
   * Add item.
   *
   * @param BootstrapItem|string $item
   * @param string|null $key
   *
   * @return self
   */
  public function addItem($item, string $key = NULL) : self {
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
   * @param $keyOrIndex
   *
   * @return self
   */
  public function removeItem($keyOrIndex) : self {
    unset($this->items[$keyOrIndex]);

    return $this;
  }

  /**
   * Set items.
   *
   * @param array $items
   *
   * @return self
   */
  public function setItems(array $items) : self {
    $this->items = $items;

    return $this;
  }

  /**
   * Get items.
   *
   * @return array
   */
  public function getItems() : ?array {
    return $this->items;
  }

}
