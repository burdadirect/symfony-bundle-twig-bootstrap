<?php

namespace HBM\TwigBootstrapBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HBMTwigBootstrapBundle extends Bundle {

  public function getPath(): string {
    return \dirname(__DIR__);
  }

}
