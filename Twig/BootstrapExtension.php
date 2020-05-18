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

class BootstrapExtension extends AbstractExtension {

  /**
   * @var array
   */
  protected $config;

  public function __construct($config) {
    $this->config = $config;
  }

  public function getFilters() : array {
    $renderOptions = ['needs_environment' => true, 'is_safe' => ['html']];

    return [
      new TwigFilter('bsDropdownNavItem', [$this, 'bsRenderDropdownNavItem'], $renderOptions),
      new TwigFilter('bsDropdownStandalone', [$this, 'bsRenderDropdownStandalone'], $renderOptions),
      new TwigFilter('bsDropdownButtonGroup', [$this, 'bsRenderDropdownButtonGroup'], $renderOptions),
      new TwigFilter('bsButtonGroup', [$this, 'bsRenderButtonGroup'], $renderOptions),

      new TwigFilter('bsSpan',    [$this, 'bsRenderSpan'],    $renderOptions),
      new TwigFilter('bsLink',    [$this, 'bsRenderLink'],    $renderOptions),
      new TwigFilter('bsButton',  [$this, 'bsRenderButton'],  $renderOptions),
      new TwigFilter('bsNavItem', [$this, 'bsRenderNavItem'], $renderOptions),
      new TwigFilter('bsNavBtn',  [$this, 'bsRenderNavBtn'],  $renderOptions),
      new TwigFilter('bsBtn',     [$this, 'bsRenderBtn'],     $renderOptions),
      new TwigFilter('bsBtn1',    [$this, 'bsRenderBtn1'],    $renderOptions),
      new TwigFilter('bsBtn2',    [$this, 'bsRenderBtn2'],    $renderOptions),
    ];
  }

  public function getTests() : array {
    return [
      new TwigTest('bsLink', [$this, 'isBsLink']),
      new TwigTest('bsGroup', [$this, 'isBsGroup']),
      new TwigTest('bsDropdownItem', [$this, 'isBsDropdownItem']),
    ];
  }

  public function getFunctions() : array {
    return [
      new TwigFunction('bsUuid', [$this, 'bsUuid']),
      new TwigFunction('bsLink', [$this, 'bsLink']),
      new TwigFunction('bsGroup', [$this, 'bsGroup']),
      new TwigFunction('bsDropdownItem', [$this, 'bsDropdownItem']),
    ];
  }

  /****************************************************************************/
  /* FILTERS                                                                  */
  /****************************************************************************/

  /**
   * @param Environment $environment
   * @param BootstrapLink $bsLink
   * @param string $template
   * @param array $data
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  private function bsRenderBootstrapLink(Environment $environment, BootstrapLink $bsLink, string $template = NULL, array $data = []) : ?string {
    return $environment->render(
      $template ?: '@HBMTwigBootstrap/BootstrapLink/generic.html.twig',
      array_merge($data, ['bsLink' => $bsLink])
    );
  }

  /**
   * @param Environment $environment
   * @param BootstrapLink $bsLink
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  public function bsRenderLink(Environment $environment, BootstrapLink $bsLink) : ?string {
    return $this->bsRenderBootstrapLink($environment, $bsLink);
  }

  /**
   * @param Environment $environment
   * @param BootstrapLink $bsLink
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  public function bsRenderSpan(Environment $environment, BootstrapLink $bsLink) : ?string {
    return $this->bsRenderBootstrapLink($environment, $bsLink, NULL, ['tag' => 'span']);
  }


  /**
   * @param Environment $environment
   * @param BootstrapLink $bsLink
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  public function bsRenderButton(Environment $environment, BootstrapLink $bsLink) : ?string {
    return $this->bsRenderBootstrapLink($environment, $bsLink->class('btn'), NULL, ['tag' => 'button']);
  }

  /**
   * @param Environment $environment
   * @param BootstrapLink $bsLink
   * @param array|HtmlAttributes $attributesContainer
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  public function bsRenderNavItem(Environment $environment, BootstrapLink $bsLink, $attributesContainer = []) : ?string {
    return $this->bsRenderBootstrapLink($environment, $bsLink, '@HBMTwigBootstrap/BootstrapLink/nav-item.html.twig', ['attributesContainer' => $attributesContainer]);
  }

  /**
   * @param Environment $environment
   * @param BootstrapLink $bsLink
   * @param array|HtmlAttributes $attributesContainer
   * @param null $prefix
   * @param null $suffix
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  public function bsRenderNavBtn(Environment $environment, BootstrapLink $bsLink, $attributesContainer = [], $prefix = NULL, $suffix = NULL) : ?string {

    return $this->bsRenderBootstrapLink($environment, $bsLink->class('btn'), '@HBMTwigBootstrap/BootstrapLink/nav-item.html.twig', [
      'attributesContainer' => $attributesContainer,
      'prefix' => $prefix.'<span class="btn-text">',
      'suffix' => '</span>'.$suffix
    ]);
  }

  /**
   * @param Environment $environment
   * @param BootstrapLink $bsLink
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  public function bsRenderBtn(Environment $environment, BootstrapLink $bsLink) : ?string {
    return $this->bsRenderBootstrapLink($environment, $bsLink->class('btn'));
  }

  /**
   * @param Environment $environment
   * @param BootstrapLink $bsLink
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  public function bsRenderBtn1(Environment $environment, BootstrapLink $bsLink) : ?string {
    return $this->bsRenderBootstrapLink($environment, $bsLink->class('btn btn-primary'));
  }

  /**
   * @param Environment $environment
   * @param BootstrapLink $bsLink
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  public function bsRenderBtn2(Environment $environment, BootstrapLink $bsLink) : ?string {
    return $this->bsRenderBootstrapLink($environment, $bsLink->class('btn btn-secondary'));
  }

  /**
   * @param Environment $environment
   * @param BootstrapGroup $bsGroup
   * @param BootstrapLink|null $bsLink
   * @param HtmlAttributes|array $attributesMenu
   * @param string $htmlTag
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  private function bsRenderDropdown(Environment $environment, BootstrapGroup $bsGroup, BootstrapLink $bsLink = NULL, $attributesMenu = [], $htmlTag = 'div') : ?string {
    return $environment->render('@HBMTwigBootstrap/BootstrapGroup/dropdown.html.twig', [
      'bsGroup' => $bsGroup,
      'bsLink' => $bsLink,
      'attributesMenu' => $attributesMenu,
      'htmlTag' => $htmlTag,
    ]);
  }

  /**
   * @param Environment $environment
   * @param BootstrapGroup $bsGroup
   * @param BootstrapLink|null $bsLink
   * @param array $attributesMenu
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  public function bsRenderDropdownNavItem(Environment $environment, BootstrapGroup $bsGroup, BootstrapLink $bsLink = NULL, $attributesMenu = []) : ?string {
    $bsGroup->class('nav-item dropdown');
    $bsLink->class('nav-link')->href('#');
    return $this->bsRenderDropdown($environment, $bsGroup, $bsLink, $attributesMenu, 'li');
  }

  /**
   * @param Environment $environment
   * @param BootstrapGroup $bsGroup
   * @param BootstrapLink|null $bsLink
   * @param array $attributesMenu
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  public function bsRenderDropdownStandalone(Environment $environment, BootstrapGroup $bsGroup, BootstrapLink $bsLink = NULL, $attributesMenu = []) : ?string {
    $bsGroup->class('dropdown');
    $bsLink->class('btn')->attr('type', 'button');
    return $this->bsRenderDropdown($environment, $bsGroup, $bsLink, $attributesMenu);
  }

  /**
   * @param Environment $environment
   * @param BootstrapGroup $bsGroup
   * @param BootstrapLink|null $bsLink
   * @param array $attributesMenu
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  public function bsRenderDropdownButtonGroup(Environment $environment, BootstrapGroup $bsGroup, BootstrapLink $bsLink = NULL, $attributesMenu = []) : ?string {
    $bsGroup->class('btn-group')->attr('role', 'group');
    $bsLink->class('btn')->attr('type', 'button');
    return $this->bsRenderDropdown($environment, $bsGroup, $bsLink, $attributesMenu);
  }

  /**
   * @param Environment $environment
   * @param BootstrapGroup $bsGroup
   *
   * @return string|null
   *
   * @throws \Twig\Error\LoaderError
   * @throws \Twig\Error\RuntimeError
   * @throws \Twig\Error\SyntaxError
   */
  public function bsRenderButtonGroup(Environment $environment, BootstrapGroup $bsGroup) : ?string {
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

  /****************************************************************************/
  /* FUNCTIONS                                                                */
  /****************************************************************************/

  /**
   * @param null $postfix
   * @param null $prefix
   * @param bool $more_entropy
   *
   * @return string
   */
  public function bsUuid($postfix = NULL, $prefix = NULL, $more_entropy = FALSE) {
    return uniqid($prefix, $more_entropy).$postfix;
  }

  /**
   * @param null|string $text
   *
   * @return BootstrapLink
   */
  public function bsLink($text = NULL) : BootstrapLink {
    return new BootstrapLink($text, $this->config);
  }

  /**
   * @param null|string $mode
   *
   * @return BootstrapGroup
   */
  public function bsGroup($mode = NULL) : BootstrapGroup {
    return new BootstrapGroup($mode, $this->config);
  }

  /**
   * @param null|string $text
   *
   * @return BootstrapDropdownItem
   */
  public function bsDropdownItem($text = NULL) : BootstrapDropdownItem {
    return new BootstrapDropdownItem($text, $this->config);
  }

  /****************************************************************************/
  /* TESTS                                                                    */
  /****************************************************************************/

  /**
   * @param $var
   *
   * @return bool
   */
  public function isBsLink($var) : bool {
    return $var instanceof BootstrapLink;
  }

  /**
   * @param $var
   *
   * @return bool
   */
  public function isBsGroup($var) : bool {
    return $var instanceof BootstrapGroup;
  }

  /**
   * @param $var
   *
   * @return bool
   */
  public function isBsDropdownItem($var) : bool {
    return $var instanceof BootstrapDropdownItem;
  }

}
