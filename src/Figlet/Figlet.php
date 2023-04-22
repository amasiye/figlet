<?php

/**
 * This is the part of Povils open-source library.
 *
 * @author Povilas Susinskas
 */

namespace Amasiye\Figlet;

use Exception;

/**
 * Class Figlet
 *
 * @package Amasiye\Figlet
 */
class Figlet implements FigletInterface
{
    /**
     * Defines first ASCII character code (blank/space).
     */
    const FIRST_ASCII_CHARACTER = 32;

    /**
     * @var ColorManager Color manager object.
     */
    private ColorManager $colorManager;

    /**
     * @var FontManager Font manager object.
     */
    private FontManager $fontManager;

    /**
     * @var Font Font object.
     */
    private Font $font;

    /**
     * @var string Background color.
     */
    private string $backgroundColor;

    /**
     * @var string Font color.
     */
    private string $fontColor;

    /**
     * @var string Font name.
     */
    private string $fontName;

    /**
     * @var string Font directory.
     */
    private string $fontDir;

    /**
     * @var int Font stretching.
     */
    private int $stretching;

    /**
     * This array will hold used Figlet characters.
     *
     * @var array Characters array.
     */
    private array $characters = [];

    /**
     * Figlet constructor.
     */
    public function __construct()
    {
        $this->fontDir = __DIR__ . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR;
        $this->fontName = 'big';
        $this->stretching = 0;
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function write(string $text): FigletInterface
    {
        echo $this->render($text);

        return $this;
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function render(string $text): string
    {
        $this->font = $this->getFontManager()->loadFont($this->fontName, $this->fontDir);

        $figletText = $this->generateFigletText($text);

        if ($this->fontColor || $this->backgroundColor) {
            $figletText = $this->colorize($figletText);
        }

        return $figletText;
    }

    /**
     * {@inheritdoc}
     */
    public function setBackgroundColor(string $color): FigletInterface
    {
        $this->backgroundColor = $color;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setFontColor(string $color): FigletInterface
    {
        $this->fontColor = $color;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setFont(string $fontName): FigletInterface
    {
        $this->fontName = $fontName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setFontDir(string $fontDir): FigletInterface
    {
        $this->fontDir = $fontDir;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setFontStretching(int $stretching): FigletInterface
    {
        $this->stretching = $stretching;

        return $this;
    }

    /**
     * Unset some arrays and objects.
     */
    public function clear(): void
    {
        unset($this->characters, $this->font);
    }

    /**
     * Generates Figlet text.
     *
     * @param string $text Text to generate Figlet text.
     *
     * @return string Figlet text.
     */
    private function generateFigletText(string $text): string
    {
        $figletCharacters = $this->getFigletCharacters($text);

        return $this->combineFigletCharacters($figletCharacters);
    }

    /**
     * @param string $text Text to colorize.
     *
     * @return array Colorized text.
     */
    private function getFigletCharacters(string $text): array
    {
        $figletCharacters = [];
        foreach (str_split($text) as $character) {
            $figletCharacters[] = $this->getFigletCharacter($character);
        }

        return $figletCharacters;
    }

    /**
     * @param string $character Character to colorize.
     *
     * @return array Colorized character.
     */
    private function getFigletCharacter(string $character): array
    {
        if (isset($this->characters[$this->fontName][$character])) {
            return $this->characters[$this->fontName][$character];
        }

        $figletCharacter = [];

        $lines = $this->getFigletCharacterLines($character);

        foreach ($lines as $line) {
            $figletCharacter[] = str_replace(
                ['@', $this->font->getHardBlank()],
                ['', ' '],
                $line
            );
        }

        $this->characters[$this->fontName][$character] = $figletCharacter;

        return $figletCharacter;
    }

    /**
     * @param string $character Character to get lines.
     *
     * @return array Figlet character lines.
     */
    private function getFigletCharacterLines(string $character): array
    {
        $letterStartPosition = $this->getLetterStartPosition($character);

        return array_slice($this->font->getFileCollection(), $letterStartPosition, $this->font->getHeight());
    }

    /**
     * @param array $figletCharacters Figlet characters.
     *
     * @return string Figlet text.
     */
    private function combineFigletCharacters(array $figletCharacters): string
    {
        $figletText = '';

        $height = $this->font->getHeight();
        for ($line = 0; $line < $height; $line++) {
            $singleLine = '';
            foreach ($figletCharacters as $charactersLines) {
                $singleLine .= $charactersLines[$line] . $this->addStretching();
            }
            $singleLine = $this->removeNewlines($singleLine);
            $figletText .= $singleLine . "\n";
        }

        return $figletText;
    }

    /**
     * Colorize text.
     *
     * @param string $figletText
     *
     * @return string
     * @throws Exception
     */
    private function colorize(string $figletText): string
    {
        return $this
            ->getColorManager()
            ->colorize(
                $figletText,
                $this->fontColor,
                $this->backgroundColor
            );
    }

    /**
     * @return ColorManager Color manager.
     */
    private function getColorManager(): ColorManager
    {
      return $this->colorManager;
    }

    /**
     * @return FontManager Font manager.
     */
    private function getFontManager(): FontManager
    {
      return $this->fontManager;
    }

    /**
     * Remove newlines characters.
     *
     * @param string $singleLine Single line.
     *
     * @return string Single line without newlines.
     */
    private function removeNewlines(string $singleLine): string
    {
       return preg_replace('/[\\r\\n]*/', '', $singleLine);
    }

    /**
     * Adds space(s) in the end to Figlet character.
     *
     * @return string Space(s) to add.
     */
    private function addStretching(): string
    {
        if (0 < $this->stretching) {
            $stretchingSpace = ' ';
        } else {
            $stretchingSpace = '';
            $this->stretching = 0;
        }

        return str_repeat($stretchingSpace, $this->stretching);
    }

    /**
     * @param string $character
     *
     * @return float|int
     */
    private function getLetterStartPosition(string $character): float|int
    {
        return ((ord($character) - self::FIRST_ASCII_CHARACTER) * $this->font->getHeight()) + 1 + $this->font->getCommentLines();
    }
}
