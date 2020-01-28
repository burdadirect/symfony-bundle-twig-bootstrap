# HBM Twig Extensions Bundle

## Team

### Developers
Christian Puchinger - christian.puchinger@playboy.de

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require burdanews/symfony-bundle-twig-bootstrap
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Enable the Bundle

With Symfony 4 the bundle is enabled automatically for all environments (see `config/bundles.php`). 

### Step 3: Configuration

```yml
hbm_twig_bootstrap:
  fontawesome:
    default_class: 'fas'
```

## Usage

### Buttons/Links

Available for:
- link (`a`)
- btn (`a.btn`)
- btn1 (`a.btn.btn-primary`)
- btn2 (`a.btn.btn-secondary`)
- button (`button.btn`)

```twig
{% import '@HBMTwigExtensions/macrosBootstrap.html.twig' as macrosBootstrap %}

{% set link = bsLink().title('This is a title').icon('fa-pencil').href('...') %}

{{ macrosBootstrap.link(link.text('Just a link')) }}
{{ macrosBootstrap.btn1(link) }}
{{ macrosBootstrap.btn2(link) }}
{{ macrosBootstrap.btn(link.class('btn-danger')) }}
{{ macrosBootstrap.button(link) }}
```

#### Output
```html
<a href="..."><span class="btn-text"><i class="fa fa-pencil"></i>Just a link</span></a>
<a class="btn btn-primary" href="..."><span class="btn-text"><i class="fa fa-pencil"></i>This is a title</span></a>
<a class="btn btn-secondary" href="..."><span class="btn-text"><i class="fa fa-pencil"></i>This is a title</span></a>
<a class="btn btn-danger" href="..."><span class="btn-text"><i class="fa fa-pencil"></i>This is a title</span></a>
<button class="btn" href="..."><span class="btn-text"><i class="fa fa-pencil"></i>This is a title</span></button>
```

### Dropdowns

Available for:
- dropdownStandalone
- dropdownButtonGroup

```twig
{% import '@HBMTwigExtensions/macrosBootstrap.html.twig' as macrosBootstrap %}

{% set ddi =[] %}

{% set ddi = ddi|push(bsDropdownItem().header('Header 1')) %}
{% set ddi = ddi|push(bsLink('Text 1').href('...')) %}
{% set ddi = ddi|push(bsLink('Text 2').href('...')) %}

{% set ddi = ddi|push(bsDropdownItem().header('Header 2')) %}
{% set ddi = ddi|push(bsLink('Text 3').href('...')) %}
{% set ddi = ddi|push(bsLink('Text 4').href('...')) %}

{% set ddi = ddi|push(bsDropdownItem().divider(true)) %}
{% set ddi = ddi|push(bsLink('Text 5').href('...')) %}

{{ macrosBootstrap.dropdownStandalone(bsLink('Dropdown Text').icon('fa-plus').class('btn-primary'), ddi) }}
```

#### Output
```html
<div class="dropdown">
    <button class="btn-primary btn dropdown-toggle" title="Dropdown Text" id="5e30b82698df1-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="btn-text"><span class="fa-plus fas"></span>&nbsp;Dropdown Text</span>
    </button>
    <div class="dropdown-menu" aria-labelledby="5e30b82698df1-dropdown">
        <div class="dropdown-header">Header 1</div>
        <a class="dropdown-item" href="...">Text 1</a>
        <a class="dropdown-item" href="...">Text 2</a>
        <div class="dropdown-header">Header 2</div>
        <a class="dropdown-item" href="...">Text 3</a>
        <a class="dropdown-item" href="...">Text 4</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="...">Text 5</a>
    </div>
</div>
```

### Nav-Item

```twig
{% import '@HBMTwigExtensions/macrosBootstrap.html.twig' as macrosBootstrap %}

{% set link = bsLink().title('This is a title').icon('fa-pencil').href('...') %}

{{ macrosBootstrap.navItem(link) }}
```

#### Output
```html
<li class="nav-item">
  <a class="nav-link" href="..."><i class="fa fa-pencil"></i>This is a title</a>
</li>
```
