<?php

namespace HBM\TwigBootstrapBundle\Utils;

class BootstrapLink extends BootstrapItem {

  /**
   * @var string[]
   */
  private $icons = [];

  /**
   * @var string
   */
  private $text;

  /**
   * BootstrapLink constructor.
   *
   * @param string|null $text
   * @param array $config
   */
  public function __construct($text = NULL, array $config = []) {
    parent::__construct($config);
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
    $this->getAttributes()->disabled();
    $this->attr('aria-disabled', true);
    $this->class('disabled');

    return $this;
  }

}
