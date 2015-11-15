<?php

/**
 * This is the part of Povils open-source library.
 *
 * @author Povilas Susinskas
 *
 * @email povilassusinskas@gmail.com
 */

namespace Povils\Figlet;

/**
 * Class Figlet
 *
 * @package Povils\Figlet
 */
class Figlet implements FigletInterface
{
    /**
     * Defines first ASCII character code (blank/space).
     */
    const FIRST_ASCII_CHARACTER = 32;

    /**
     * @var ColorManager
     */
    private $colorManager;

    /**
     * @var FontManager
     */
    private $fontManager;

    /**
     * @var Font
     */
    private $font;

    /**
     * @var string
     */
    private $backgroundColor;

    /**
     * @var string
     */
    private $fontColor;

    /**
     * @var string
     */
    private $fontName;

    /**
     * @var string
     */
    private $fontDir;

    /**
     * @var int
     */
    private $stretching = 0;

    /**
     * This array will hold used Figlet characters.
     *
     * @var array
     */
    private $characters = [];

    /**
     * Outputs Figlet text.
     *
     * @param string $text
     *
     * @return FigletInterface
     */
    public function write($text)
    {
        echo $this->render($text);

        return $this;
    }

    /**
     * Renders Figlet text.
     *
     * @param $text
     *
     * @return string
     * @throws \Exception
     */
    public function render($text)
    {
        $this->font = $this->getFontManager()->loadFont($this->fontName, $this->fontDir);

        $figletCharacters = [];
        foreach (str_split($text) as $character) {
            $figletCharacters[] = $this->getFigletCharacter($character);
        }

        $figletText = $this
            ->getColorManager()
            ->colorize(
                $this->combineFigletCharacters($figletCharacters),
                $this->fontColor,
                $this->backgroundColor
            );

        return $figletText;
    }

    /**
     * @param string $color
     *
     * @return FigletInterface
     */
    public function setBackgroundColor($color)
    {
        $this->backgroundColor = $color;

        return $this;
    }

    /**
     * @param string $color
     *
     * @return FigletInterface
     */
    public function setFontColor($color)
    {
        $this->fontColor = $color;

        return $this;
    }

    /**
     * @param string $fontName
     *
     * @return FigletInterface
     */
    public function setFont($fontName)
    {
        $this->fontName = $fontName;

        return $this;
    }

    /**
     * @param string $fontDir
     *
     * @return FigletInterface
     */
    public function setFontDir($fontDir)
    {
        $this->fontDir = $fontDir;

        return $this;
    }

    /**
     * @param int $stretching
     *
     * @return FigletInterface
     */
    public function setFontStretching($stretching)
    {
        $this->stretching = $stretching;

        return $this;
    }

    /**
     * @param string $character
     *
     * @return array
     */
    private function getFigletCharacter($character)
    {
        if (isset($this->characters[$character])) {
            return $this->characters[$character];
        }

        $figletCharacter = [];

        $lines = $this->getFigletCharacterLines($character);

        foreach ($lines as $line) {
            $figletCharacter[] = str_replace(
                ['@', '$'],
                ['', ' '],
                $line
            );
        }

        $this->characters[$character] = $figletCharacter;

        return $figletCharacter;
    }

    /**
     * @param string $character
     *
     * @return array
     */
    private function getFigletCharacterLines($character)
    {
        $letterStarts = ((ord($character) - self::FIRST_ASCII_CHARACTER) * $this->font->getHeight()) + 1 + $this->font->getCommentLines();

        $lines = array_slice($this->font->getFileCollection(), $letterStarts, $this->font->getHeight());

        return $lines;
    }

    /**
     * Combines Figlet characters to one.
     *
     * @param array $figletCharacters
     *
     * @return string
     */
    private function combineFigletCharacters($figletCharacters)
    {
        $figletText = '';

        if (is_int($this->stretching) && 0 < $this->stretching) {
            $stretchingSpace = ' ';
        } else {
            $stretchingSpace = '';
        }

        for ($line = 0; $line < $this->font->getHeight(); $line++) {
            $singleLine = '';
            foreach ($figletCharacters as $charactersLines) {
                $singleLine .= $charactersLines[$line] . str_repeat($stretchingSpace, $this->stretching);
            }
            $singleLine = preg_replace('/[\\r\\n]*/', '', $singleLine);
            $figletText .= $singleLine . "\n";
        }

        return $figletText;
    }

    /**
     * @return ColorManager
     */
    private function getColorManager()
    {
        if (null === $this->colorManager) {
            return $this->colorManager = new ColorManager();
        }

        return $this->colorManager;
    }

    /**
     * @return FontManager
     */
    private function getFontManager()
    {
        if (null === $this->fontManager) {
            return $this->fontManager = new FontManager();
        }

        return $this->fontManager;
    }
}
