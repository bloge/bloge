# Bloge

![bloge](doge.png)

> Wow. So bloge. Much php.

## About

**Bloge** `/blɒgi:/` – PHP static website generator.

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

Next thing you want to do is to start with `bloge/starter-pack`. You can 
clone it via composer somewhere on webserver:

```sh
composer create-project bloge/starter-pack
```

In current directory will be created Bloge starter pack website. You can 
explore its source code and read manual provided by starter pack.

Also checkout the advanced pack that comes with FrontMatter content and Twig 
templates `bloge/advanced-pack`:

```sh
composer create-project bloge/advanced-pack
```

### Packs and documentation

Packs and documentation might be found in [wiki](https://github.com/bloge/bloge/wiki).

## License

See LICENSE.txt.

### Logo

Logo was created by [Iryna Ivanova](http://owlblinked.tk)