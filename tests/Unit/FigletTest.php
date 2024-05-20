<?php

use Amasiye\Figlet\Figlet;


it('can create a Figlet instance', function() {
    $figlet = new Figlet();
    expect($figlet)->not->toBeNull();
});

it('can render text with default font', function() {
    $figlet = new Figlet();
    $output = $figlet->render('Test');
    expect($output)->toBe(get_default_big_font_text());
});

it('can render text with slant font', function () {
  $figlet = new Figlet();
  $figlet->setFont('slant');
  $output = $figlet->render('Test');

  expect($output)->toBe(get_slant_font_text());
});

it('can render text that is stretched and colorized', function() {
    $figlet = new Figlet();
    $figlet->setFontStretching(1)
      ->setFontColor('red')
      ->setBackgroundColor('light_gray');

    $output = $figlet->render('Test');
    expect($output)->toBe(get_modified_default_big_font_text('0;31', '47'));
});

it('throws an exception when given an undefined font color', function() {
    $figlet = new Figlet();
    $figlet->setFontColor('bright_red');
    $figlet->render('Test');
})->throws(InvalidArgumentException::class);

it('throws an exception when given an undefined background color', function() {
    $figlet = new Figlet();
    $figlet->setBackgroundColor('bright_light_gray');
    $figlet->render('Test');
})->throws(InvalidArgumentException::class);

it('can change the font and render text with cached letters', function() {
    $figlet = new Figlet();
    $figlet->setFont('slant');
    $figlet->render('Test');
    $figlet->setFont('big');
    $figlet->render('Test');
    $output = $figlet->render('Test');

    expect($output)->toBe(get_default_big_font_text());
});

it('can render text with a new font directory', function() {
    $figlet = new Figlet();
    $figlet->setFontDir(__DIR__ . '/../font/')
      ->setFont('slant');

    $output = $figlet->render('Test');
    expect($output)->toBe(get_slant_font_text());
});

it('throws an exception when an invalid font file is set', function() {
    $figlet = new Figlet();
    $figlet
      ->setFontDir(__DIR__ . '/../font/')
      ->setFont('badfile');

    $figlet->render('Test');
})->throws(Exception::class);