<?php

namespace HBM\TwigBootstrapBundle\Utils;

use HBM\TwigAttributesBundle\Utils\HtmlAttributes;
use HBM\TwigAttributesBundle\Utils\HtmlAttributesTrait;

abstract class BootstrapItem {

  use HtmlAttributesTrait;

  protected array $config;

  protected HtmlAttributes $attributes;

  /**
   * BootstrapItem constructor.
   *
   * @param array $config
   */
  public function __construct(array $config = []) {
    $this->config = $config;
    $this->attributes = new HtmlAttributes();
  }

  /****************************************************************************/

  /**
   * @param $key
   * @param $value
   *
   * @return static
   */
  public function attr($key, $value): static {
    $this->getAttributes()->set($key, $value);

    return $this;
  }

  /**
   * @return static|HtmlAttributes
   */
  public function attributes(): HtmlAttributes|static {
    if (func_num_args() === 0) {
      return $this->attributes;
    }

    if (func_num_args() === 1) {
      $this->setAttributes(new HtmlAttributes(func_get_arg(0)));
    }

    return $this;
  }

  /**
   * @param HtmlAttributes $attributes
   *
   * @return static
   */
  public function setAttributes(HtmlAttributes $attributes): static {
    $this->attributes = $attributes;

    return $this;
  }

  /**
   * @return HtmlAttributes
   */
  public function getAttributes(): HtmlAttributes {
    return $this->attributes;
  }

  /**
   * @return HtmlAttributes
   */
  public function getAttributesObject(): HtmlAttributes {
    return $this->attributes;
  }

}
