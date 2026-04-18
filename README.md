# Figlet text render
	  ______ _       _      _              _____  _    _ _____  
	 |  ____(_)     | |    | |            |  __ \| |  | |  __ \ 
	 | |__   _  __ _| | ___| |_   ______  | |__) | |__| | |__) |
	 |  __| | |/ _` | |/ _ \ __| |______| |  ___/|  __  |  ___/ 
	 | |    | | (_| | |  __/ |_           | |    | |  | | |     
	 |_|    |_|\__, |_|\___|\__|          |_|    |_|  |_|_|     
	            __/ |                                          
               |___/                                            	         

[![Total Downloads](https://poser.pugx.org/amasiye/figlet/downloads)](https://packagist.org/packages/amasiye/figlet)
[![License](https://poser.pugx.org/amasiye/figlet/license)](https://packagist.org/packages/amasiye/figlet)

## Installation

 Available as [Composer] package [amasiye/figlet].

```
composer require amasiye/figlet
```


[composer]: http://getcomposer.org/
[amasiye/figlet]: https://packagist.org/packages/amasiye/figlet

## What is this? And what is Figlet?

This is a PHP 8.2+ library which renders or outputs Figlet text in your console.
Figlet is a computer program that generates text banners, in a variety of typefaces, composed of letters made up of conglomerations of smaller ASCII characters

## Usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Amasiye\Figlet\Figlet;

// Default font is "big"
$figlet = new Figlet();

//Outputs "Figlet" text using "small" red font in blue background.
$figlet
    ->setFont('small')
    ->setFontColor('red')
    ->setBackgroundColor('blue')
    ->write('Figlet');

//Returns rendered string.
$renderedFiglet = $figlet->render('Another Figlet');

// Change default font directory
$figlet->setFontDir(__DIR__ . '/fonts');

// Add spaces between letters
$figlet->setFontStretching(3);
```

#### Also there is figlet command line. Usage is quite straightforward.
```bash
    ./figlet 'some figlet text' --font block --color yellow --bg-color blue --stretching 2
```

##### To make figlet executable from everywhere
 - (Linux and OSX) Symlink figlet script file to one of the $PATH (e.g /usr/local/bin/figlet)

##### For more options:
```bash
    ./figlet -h
```
