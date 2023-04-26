<?php

namespace HBM\TwigBootstrapBundle\Utils;

use HBM\TwigAttributesBundle\Utils\HtmlTagTrait;

class BootstrapLink extends BootstrapItem {

  use HtmlTagTrait;

  /**
   * @var string[]
   */
  private array $icons = [];

  private ?string $text;

  /**
   * BootstrapLink constructor.
   *
   * @param string|null $text
   * @param array $config
   */
  public function __construct(?string $text = NULL, array $config = []) {
    parent::__construct($config);
    $this->tag = 'a';
    $this->text = $text;
  }

  /**
   * Returns a copy of the bootstrap link.
   *
   * @return BootstrapLink
   */
  public function copy() : self {
    $copy = new BootstrapLink();
    $copy->setIcons($this->getIcons());
    $copy->setText($this->getText());
    $copy->setAttributes($this->getAttributes()->copy());

    return $copy;
  }

  /****************************************************************************/

  public function icon() {
    return $this->icons(...func_get_args());
  }

  public function icons() {
    if (func_num_args() === 0) {
      return $this->getIcons();
    }

    $this->addIcons(...func_get_args());

    return $this;
  }

  public function addIcon($icons) : self {
    return $this->addIcons($icons);
  }

  public function addIcons($icons) : self {
    if (!is_array($icons)) {
      $icons = [$icons];
    }

    foreach ($icons as $icon) {
      $iconParts = explode(' ', $icon);
      if (count(array_intersect($iconParts, ['fa', 'fas', 'far', 'fal', 'fab'])) === 0) {
        $iconParts[] = $this->config['fontawesome']['default_class'] ?? 'fas';
      }
      $this->icons[] = implode(' ', $iconParts);
    }

    return $this;
  }

  public function setIcons($icons) : self {
    if ($icons === NULL) {
      $this->icons = [];
    } else {
      if (!is_array($icons)) {
        $icons = [$icons];
      }
      $this->icons = $icons;
    }

    return $this;
  }

  public function getIcon() : array {
    return $this->icons;
  }

  public function getIcons() : array {
    return $this->icons;
  }

  /****************************************************************************/

  public function text() {
    if (func_num_args() === 0) {
      return $this->getText();
    }

    foreach (func_get_args() as $text) {
      $this->addText($text);
    }

    return $this;
  }

  public function addText($text) : self {
    $this->text .= $text;

    return $this;
  }

  public function setText($text) : self {
    $this->text = $text;

    return $this;
  }

  public function getText() : ?string {
    return $this->text;
  }

  /****************************************************************************/

  public function disabled() : self {
    if ((func_num_args() === 0) || func_get_arg(0)) {
      $this->getAttributes()->disabled(TRUE);
      $this->attr('aria-disabled', TRUE);
      $this->class('disabled');
    }

    return $this;
  }

  /****************************************************************************/

  /**
   * @return string
   */
  protected function renderAttributes(): string {
    return (string) $this->getAttributes();
  }

}
