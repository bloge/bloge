# Bloge

<img src="doge.png" align="right" width="200">

**Bloge** `/blɒgi:/` – flexible PHP static website generator.

The difference between Bloge and other static website generators is in its 
flexible API which allows you swap content formats (and storages), 
template engines, and static compilers. You can use any folder structure you want.

Complete freedom, basically.

> Such limitless, much flexible. wow.

## Features

* Simple and flexible API
* Compile app to static HTML (or anything else)
* Content route aliases, maps and ignores
* Content processing
* Data mapping
* Complete freedom of choice: swappable content formats, template engines, 
  compilation methods, website structure. Basically, your limitation is 
  imagination

## Getting started

To start with Bloge you need:

* PHP 5.4 or higher
* Terminal (CLI PHP)
* Composer

You can install it from [packagist](https://packagist.org/packages/bloge/bloge) 
via composer:

```sh
composer require bloge/bloge
``` 

And then read the doce's (which aren't ready yet).

## Basic packs

You also may want to try some basic packs.

You may start with `bloge/starter-pack`. You can install it via composer 
somewhere on webserver:

```sh
composer create-project bloge/starter-pack
```

In current directory will be created Bloge starter pack website. Explore its 
source code and read manual provided by starter pack.

Also checkout the advanced pack that comes with front matter content and Twig 
templates `bloge/advanced-pack`:

```sh
composer create-project bloge/advanced-pack
```

## Documentation and packs

Documentation and list of packs might be found in [wiki](https://github.com/bloge/bloge/wiki).

## Logo and License

See LICENSE.txt.

Logo was created by [Iryna Ivanova](http://owlblinked.tk). Thanks to her for 
such an AWESOME :fire: bloge logo. 