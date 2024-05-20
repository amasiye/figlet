<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

// uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/


/**
 * @return string
 */
function get_default_big_font_text(): string
{
  return
    '  _______                _   ' . "\n" .
    ' |__   __|              | |  ' . "\n" .
    '    | |      ___   ___  | |_ ' . "\n" .
    '    | |     / _ \ / __| | __|' . "\n" .
    '    | |    |  __/ \__ \ | |_ ' . "\n" .
    '    |_|     \___| |___/  \__|' . "\n" .
    '                             ' . "\n" .
    '                             ' . "\n";
}

/**
 * @param string $fontColor
 * @param string $backgroundColor
 * @return string
 */
function get_modified_default_big_font_text(string $fontColor, string $backgroundColor): string
{
  return
    "\033[" . $fontColor . 'm' . "\033[" . $backgroundColor . 'm' .
    '  _______                   _    ' . "\n" .
    ' |__   __|                 | |   ' . "\n" .
    '    | |       ___    ___   | |_  ' . "\n" .
    '    | |      / _ \  / __|  | __| ' . "\n" .
    '    | |     |  __/  \__ \  | |_  ' . "\n" .
    '    |_|      \___|  |___/   \__| ' . "\n" .
    '                                 ' . "\n" .
    '                                 ' . "\n" .
    "\033[0m";
}

/**
 * @return string
 */
function get_slant_font_text(): string
{
  return
    '  ______                 __ ' .  "\n" .
    ' /_  __/  ___    _____  / /_' .  "\n" .
    '  / /    / _ \  / ___/ / __/' .  "\n" .
    ' / /    /  __/ (__  ) / /_  ' .  "\n" .
    '/_/     \___/ /____/  \__/  ' .  "\n" .
    '                            ' .  "\n";
}