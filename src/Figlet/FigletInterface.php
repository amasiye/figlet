<?php

/**
 * This is the part of Povils open-source library.
 *
 * @author Povilas Susinskas
 */

namespace Povils\Figlet;

/**
 * Interface FigletInterface
 *
 * @package Povils\Figlet
 */
interface FigletInterface
{
    /**
     * Sets background color.
     *
     * @param string $color Background color.
     *
     * @return FigletInterface Figlet object.
     */
    public function setBackgroundColor(string $color): FigletInterface;

    /**
     * Sets the font.
     *
     * @param string $fontName Name of the font.
     *
     * @return FigletInterface Figlet object.
     */
    public function setFont(string $fontName): FigletInterface;

    /**
     * Sets font color.
     *
     * @param string $color Font color.
     *
     * @return FigletInterface Figlet object.
     */
    public function setFontColor(string $color): FigletInterface;

    /**
     * Sets font directory.
     *
     * @param string $fontDir Font directory.
     *
     * @return FigletInterface Figlet object.
     */
    public function setFontDir(string $fontDir): FigletInterface;

    /**
     * Sets font horizontal layout.
     *
     * @param int $stretching Font stretching.
     *
     * @return FigletInterface Figlet object.
     */
    public function setFontStretching(int $stretching): FigletInterface;

    /**
     * Writes text.
     *
     * @param string $text Text to write.
     *
     * @return FigletInterface Figlet object.
     */
    public function write(string $text): FigletInterface;

    /**
     * Renders text.
     *
     * @param string $text Text to render.
     *
     * @return string Rendered text.
     */
    public function render(string $text): string;
}
