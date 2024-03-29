<?php

namespace HBM\TwigBootstrapBundle\Utils;

use HBM\TwigAttributesBundle\Utils\HtmlAttributes;
use HBM\TwigAttributesBundle\Utils\HtmlAttributesTrait;

abstract class BootstrapItem
{
    use HtmlAttributesTrait;

    protected array $config;

    protected HtmlAttributes $attributes;

    /**
     * BootstrapItem constructor.
     */
    public function __construct(array $config = [])
    {
        $this->config     = $config;
        $this->attributes = new HtmlAttributes();
    }

    public function attr($key, $value): static
    {
        $this->getAttributes()->set($key, $value);

        return $this;
    }

    public function attributes(): HtmlAttributes|static
    {
        if (func_num_args() === 0) {
            return $this->attributes;
        }

        if (func_num_args() === 1) {
            $this->setAttributes(new HtmlAttributes(func_get_arg(0)));
        }

        return $this;
    }

    public function setAttributes(HtmlAttributes $attributes): static
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getAttributes(): HtmlAttributes
    {
        return $this->attributes;
    }

    public function getAttributesObject(): HtmlAttributes
    {
        return $this->attributes;
    }
}
