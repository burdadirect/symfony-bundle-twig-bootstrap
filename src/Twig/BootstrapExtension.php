<?php

namespace HBM\TwigBootstrapBundle\Twig;

use HBM\TwigAttributesBundle\Utils\HtmlAttributes;
use HBM\TwigBootstrapBundle\Utils\BootstrapDropdownItem;
use HBM\TwigBootstrapBundle\Utils\BootstrapGroup;
use HBM\TwigBootstrapBundle\Utils\BootstrapLink;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\TwigTest;

class BootstrapExtension extends AbstractExtension
{
    protected array $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getFilters(): array
    {
        $renderOptions = ['needs_environment' => true, 'is_safe' => ['html']];

        return [
          new TwigFilter('bsDropdownNavItem', $this->bsRenderDropdownNavItem(...), $renderOptions),
          new TwigFilter('bsDropdownStandalone', $this->bsRenderDropdownStandalone(...), $renderOptions),
          new TwigFilter('bsDropdownButtonGroup', $this->bsRenderDropdownButtonGroup(...), $renderOptions),
          new TwigFilter('bsButtonGroup', $this->bsRenderButtonGroup(...), $renderOptions),

          new TwigFilter('bsSpan', $this->bsRenderSpan(...), $renderOptions),
          new TwigFilter('bsLink', $this->bsRenderLink(...), $renderOptions),
          new TwigFilter('bsButton', $this->bsRenderButton(...), $renderOptions),
          new TwigFilter('bsNavItem', $this->bsRenderNavItem(...), $renderOptions),
          new TwigFilter('bsNavItem1', $this->bsRenderNavItem1(...), $renderOptions),
          new TwigFilter('bsNavItem2', $this->bsRenderNavItem2(...), $renderOptions),
          new TwigFilter('bsNavBtn', $this->bsRenderNavBtn(...), $renderOptions),
          new TwigFilter('bsBtn', $this->bsRenderBtn(...), $renderOptions),
          new TwigFilter('bsBtn1', $this->bsRenderBtn1(...), $renderOptions),
          new TwigFilter('bsBtn2', $this->bsRenderBtn2(...), $renderOptions),

          new TwigFilter('bsDropdownItem', $this->bsRenderDropdownItem(...), $renderOptions),
        ];
    }

    public function getTests(): array
    {
        return [
          new TwigTest('bsLink', [$this, 'isBsLink']),
          new TwigTest('bsGroup', [$this, 'isBsGroup']),
          new TwigTest('bsDropdownItem', [$this, 'isBsDropdownItem']),
        ];
    }

    public function getFunctions(): array
    {
        return [
          new TwigFunction('bsUuid', $this->bsUuid(...)),
          new TwigFunction('bsLink', $this->bsLink(...)),
          new TwigFunction('bsGroup', $this->bsGroup(...)),
          new TwigFunction('bsDropdownItem', $this->bsDropdownItem(...)),
        ];
    }

    /* FILTERS */

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    private function bsRenderBootstrapLink(Environment $environment, BootstrapLink $bsLink, string $template = null, array $data = []): ?string
    {
        return $environment->render(
            $template ?: '@HBMTwigBootstrap/BootstrapLink/generic.html.twig',
            array_merge($data, ['bsLink' => $bsLink])
        );
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderLink(Environment $environment, BootstrapLink $bsLink): ?string
    {
        return $this->bsRenderBootstrapLink($environment, $bsLink);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderSpan(Environment $environment, BootstrapLink $bsLink): ?string
    {
        return $this->bsRenderBootstrapLink($environment, $bsLink, null, ['tag' => 'span']);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderButton(Environment $environment, BootstrapLink $bsLink): ?string
    {
        return $this->bsRenderBootstrapLink($environment, $bsLink->class('btn'), null, ['tag' => 'button']);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderNavItem(Environment $environment, BootstrapLink $bsLink, HtmlAttributes|array $attributesContainer = []): ?string
    {
        return $this->bsRenderBootstrapLink($environment, $bsLink, '@HBMTwigBootstrap/BootstrapLink/nav-item.html.twig', ['attributesContainer' => $attributesContainer]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderNavItem1(Environment $environment, BootstrapLink $bsLink, HtmlAttributes|array $attributesContainer = []): ?string
    {
        return $this->bsRenderNavItem($environment, $bsLink->class('btn btn-primary'), $attributesContainer);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderNavItem2(Environment $environment, BootstrapLink $bsLink, HtmlAttributes|array $attributesContainer = []): ?string
    {
        return $this->bsRenderNavItem($environment, $bsLink->class('btn btn-secondary'), $attributesContainer);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderNavBtn(Environment $environment, BootstrapLink $bsLink, HtmlAttributes|array $attributesContainer = [], string $prefix = null, string $suffix = null): ?string
    {
        return $this->bsRenderBootstrapLink($environment, $bsLink->class('btn'), '@HBMTwigBootstrap/BootstrapLink/nav-item.html.twig', [
          'attributesContainer' => $attributesContainer,
          'prefix'              => $prefix . '<span class="btn-text">',
          'suffix'              => '</span>' . $suffix,
        ]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderBtn(Environment $environment, BootstrapLink $bsLink): ?string
    {
        return $this->bsRenderBootstrapLink($environment, $bsLink->class('btn'));
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderBtn1(Environment $environment, BootstrapLink $bsLink): ?string
    {
        return $this->bsRenderBootstrapLink($environment, $bsLink->class('btn btn-primary'));
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderBtn2(Environment $environment, BootstrapLink $bsLink): ?string
    {
        return $this->bsRenderBootstrapLink($environment, $bsLink->class('btn btn-secondary'));
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    private function bsRenderDropdown(Environment $environment, BootstrapGroup $bsGroup, BootstrapLink $bsLink = null, HtmlAttributes|array $attributesMenu = [], string $htmlTag = 'div'): ?string
    {
        return $environment->render('@HBMTwigBootstrap/BootstrapGroup/dropdown.html.twig', [
          'bsGroup'        => $bsGroup,
          'bsLink'         => $bsLink,
          'attributesMenu' => $attributesMenu,
          'htmlTag'        => $htmlTag,
        ]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderDropdownNavItem(Environment $environment, BootstrapGroup $bsGroup, BootstrapLink $bsLink, HtmlAttributes|array $attributesMenu = []): ?string
    {
        $bsGroup->class('nav-item dropdown');
        $bsLink->class('nav-link')->href('#');

        return $this->bsRenderDropdown($environment, $bsGroup, $bsLink, $attributesMenu, 'li');
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderDropdownStandalone(Environment $environment, BootstrapGroup $bsGroup, BootstrapLink $bsLink, HtmlAttributes|array $attributesMenu = []): ?string
    {
        $bsGroup->class('dropdown');
        $bsLink->class('btn')->attr('type', 'button');

        return $this->bsRenderDropdown($environment, $bsGroup, $bsLink, $attributesMenu);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderDropdownButtonGroup(Environment $environment, BootstrapGroup $bsGroup, BootstrapLink $bsLink, HtmlAttributes|array $attributesMenu = []): ?string
    {
        $bsGroup->class('btn-group')->attr('role', 'group');
        $bsLink->class('btn')->attr('type', 'button');

        return $this->bsRenderDropdown($environment, $bsGroup, $bsLink, $attributesMenu);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderButtonGroup(Environment $environment, BootstrapGroup $bsGroup): ?string
    {
        $attributes = $bsGroup->attributes();
        $attributes->set('role', 'group');
        $attributes->setIfEmpty('aria-label', $bsGroup->title() ?: 'Button-Gruppe');

        if (!$attributes->hasClass('btn-group') && !$attributes->hasClass('btn-group-vertical')) {
            $bsGroup->class('btn-group');
        }

        return $environment->render('@HBMTwigBootstrap/BootstrapGroup/button-group.html.twig', [
          'bsGroup' => $bsGroup,
        ]);
    }

    /**
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bsRenderDropdownItem(Environment $environment, BootstrapLink|BootstrapDropdownItem $bsDropdownItem): ?string
    {
        if (!($bsDropdownItem instanceof BootstrapDropdownItem)) {
            $bsDropdownItem = (new BootstrapDropdownItem())->apply($bsDropdownItem);
        }

        return $environment->render('@HBMTwigBootstrap/BootstrapDropdownItem/generic.html.twig', [
          'item' => $bsDropdownItem,
        ]);
    }

    /* FUNCTIONS */

    public function bsUuid(mixed $postfix = null, mixed $prefix = null, bool $more_entropy = false): string
    {
        return uniqid($prefix ?? '', $more_entropy) . $postfix;
    }

    public function bsLink(string $text = null): BootstrapLink
    {
        return new BootstrapLink($text, $this->config);
    }

    public function bsGroup(string $mode = null): BootstrapGroup
    {
        return new BootstrapGroup($mode, $this->config);
    }

    public function bsDropdownItem(string $text = null): BootstrapDropdownItem
    {
        return new BootstrapDropdownItem($text, $this->config);
    }

    /* TESTS */

    public function isBsLink($var): bool
    {
        return $var instanceof BootstrapLink;
    }

    public function isBsGroup($var): bool
    {
        return $var instanceof BootstrapGroup;
    }

    public function isBsDropdownItem($var): bool
    {
        return $var instanceof BootstrapDropdownItem;
    }
}
