<?php

namespace HBM\TwigBootstrapBundle\Utils;

use HBM\TwigAttributesBundle\Utils\HtmlAttributes;

class BootstrapDropdownItem extends BootstrapLink {

  private ?bool $divider = null;

  private ?string $header = null;

  /**
   * @param BootstrapLink $bsLink
   *
   * @return static
   */
  public function apply(BootstrapLink $bsLink): static {
    $this->setTag($bsLink->getTag());
    $this->setIcons($bsLink->getIcons());
    $this->setText($bsLink->getText());
    $this->setAttributes(new HtmlAttributes($bsLink->getAttributes()));

    return $this;
  }

  /****************************************************************************/

  /**
   * @return bool|static|null
   */
  public function divider(): bool|static|null {
    if (func_num_args() === 0) {
      return $this->divider;
    }

    $this->divider = (bool) func_get_arg(0);

    return $this;
  }

  /**
   * @return string|static|null
   */
  public function header(): string|static|null {
    if (func_num_args() === 0) {
      return $this->header;
    }

    $this->header = (string) func_get_arg(0);

    return $this;
  }

}
