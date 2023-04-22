<?php

/**
 * This is the part of Povils open-source library.
 *
 * @author Povilas Susinskas
 */

namespace Amasiye\Figlet;

use Exception;

/**
 * Class FontManager
 *
 * @package Amasiye\Figlet
 */
class FontManager
{
    /**
     * Defines Figlet file format.
     */
    const FIGLET_FORMAT = 'flf';

    /**
     * The first five characters(signature) in the entire file must be "flf2a".
     */
    const VALID_FONT_SIGNATURE = 'flf2a';

    /**
     * @var Font
     */
    private $font;

  /**
   * Loads Font.
   *
   * @param string $fontName Name of the font.
   * @param string $fontDirectory Directory where font is located.
   *
   * @return Font|null Font object or null if no font is loaded.
   * @throws Exception
   */
    public function loadFont(string $fontName, string $fontDirectory): ?Font
    {
        if ($this->needLoad($fontName)) {
           return $this->createFont($fontName, $fontDirectory);
        }

        return $this->currentFont();
    }

    /**
     * Return current loaded font.
     *
     * @return Font|null Font object or null if no font is loaded.
     */
    private function currentFont(): ?Font
    {
        return $this->font;
    }

    /**
     * Creates Font.
     *
     * @param string $fontName Name of the font.
     * @param string $fontDirectory Directory where font is located.
     *
     * @return Font Font object.
     * @throws Exception
     */
    private function createFont(string $fontName, string $fontDirectory): Font
    {
        $font = new Font();

        $fileName = $this->getFileName($fontName, $fontDirectory);

        $fileCollection = file($fileName);

        $font->setFileCollection($fileCollection);
        $font->setName($fontName);

        $font = $this->setFontParameters($font);

        $this->setCurrentFont($font);

        return $font;
    }

    /**
     * @param Font $font
     *
     * @return Font
     */
    private function setFontParameters(Font $font): Font
    {
        $parameters = $this->extractHeadlineParameters($font->getFileCollection());

        $font
            ->setSignature($parameters['signature'])
            ->setHardBlank($parameters['hard_blank'])
            ->setHeight($parameters['height'])
            ->setMaxLength($parameters['max_length'])
            ->setOldLayout($parameters['old_layout'])
            ->setCommentLines($parameters['comment_lines'])
            ->setPrintDirection($parameters['print_direction'])
            ->setFullLayout($parameters['full_layout']);

        return $font;
    }

    /**
     * Extracts Figlet headline parameters.
     *
     * @param array $fileCollection Collection of lines from Figlet font file.
     *
     * @return array Array of headline parameters.
     */
    private function extractHeadlineParameters(array $fileCollection): array
    {
        $parameters = [];

        sscanf(
            $fileCollection[0],
            '%5s%c %d %*d %d %d %d %d %d',
            $parameters['signature'],
            $parameters['hard_blank'],
            $parameters['height'],
            $parameters['max_length'],
            $parameters['old_layout'],
            $parameters['comment_lines'],
            $parameters['print_direction'],
            $parameters['full_layout']
        );

        if ($parameters['signature'] !== self::VALID_FONT_SIGNATURE) {
            throw new \InvalidArgumentException('Invalid font file signature: ' . $parameters['signature']);
        }

        return $parameters;
    }

    /**
     * Checks if it is needed to load font.
     *
     * @param string $fontName Name of the font.
     *
     * @return bool True if it is needed to load font, false otherwise.
     */
    private function needLoad(string $fontName): bool
    {
        return null === $this->currentFont() || $fontName !== $this->currentFont()->getName();
    }

    /**
     * Gets file name.
     *
     * @param string $fontName Name of the font.
     * @param string $fontDirectory Directory where font is located.
     *
     * @return string File name.
     * @throws Exception If file does not exist.
     */
    private function getFileName(string $fontName, string $fontDirectory): string
    {
        $fileName = $fontDirectory . $fontName . '.' . self::FIGLET_FORMAT;

        if (false === file_exists($fileName)) {
            throw new Exception('Could not open ' . $fileName);
        }

        return $fileName;
    }

    /**
     * Sets current font.
     *
     * @param Font $font Font object.
     */
    private function setCurrentFont(Font $font): void
    {
        $this->font = $font;
    }
}
