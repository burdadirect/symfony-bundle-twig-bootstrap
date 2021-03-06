<?php

namespace HBM\TwigBootstrapBundle\Utils;

use HBM\TwigAttributesBundle\Utils\HtmlAttributes;
use HBM\TwigAttributesBundle\Utils\HtmlAttributesTrait;

abstract class BootstrapItem {

  use HtmlAttributesTrait;

  /**
   * @var array
   */
  protected $config;

  /**
   * @var HtmlAttributes
   */
  protected $attributes;

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
   * @return $this
   */
  public function attr($key, $value) {
    $this->getAttributes()->set($key, $value);

    return $this;
  }

  /**
   * @return $this|HtmlAttributes
   */
  public function attributes() {
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
   * @return $this
   */
  public function setAttributes(HtmlAttributes $attributes) : self {
    $this->attributes = $attributes;

    return $this;
  }

  /**
   * @return HtmlAttributes
   */
  public function getAttributes() : HtmlAttributes {
    return $this->attributes;
  }

  /**
   * @return HtmlAttributes
   */
  public function getAttributesObject() : HtmlAttributes {
    return $this->attributes;
  }

}
