# Bloge

![bloge](doge.png)

> Wow. So bloge. Much php.

## About

**Bloge** `/blɒgi:/` – PHP static website generator.

The difference between Bloge and other static website generators is its 
flexible API which allows you swap content formats (and storages), 
template engines, static compilers. You can use any folder structure you want.

The freedom of choice is yours.

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

## Example

A dead-simple example with Bloge:

```php
<?php

// app.php

use Bloge\Apps\BasicApp;
use Bloge\Content\PHP as Content;
use Bloge\Renderers\PHP as Renderer;

return new App(
    new Content(__DIR__ . '/content'),
    new Renderer(__DIR__ . '/theme')
);

// index.php

require 'vendor/autoload.php';

$app = require 'app.php';

try {
    echo $app->render($_GET['route']);
} catch (Bloge\NotFoundException $e) {
    echo $app->render('404');
}
```
    
And to build it down to static HTML website:

```sh
# Create folder build
mkdir build

# Build application content to build folder
php vendor/bin/bloge app.php build
```

## Getting started

To start with Bloge you need:

* PHP 5.4 or higher
* Terminal (CLI PHP)
* Composer

Next thing you want to do is to install `bloge/starter-pack` via composer 
somewhere on webserver:

```sh
composer create-project bloge/starter-pack
```

In current directory will be created Bloge starter pack website. You can 
explore its source code and read manual provided by this starter pack.

Also checkout the advanced pack that comes with FrontMatter content and Twig 
templates `bloge/advanced-pack`:

```sh
composer create-project bloge/advanced-pack
```

## License

See LICENSE.txt.