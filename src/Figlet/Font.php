<?php

/**
 * This is the part of Povils open-source library.
 *
 * @author Povilas Susinskas
 */

namespace Povils\Figlet;

/**
 * Class Font
 *
 * @package Povils\Figlet
 */
class Font
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var array
     */
    private array $fileCollection;

    /**
     * @var string
     */
    private string $signature;

    /**
     * @var string
     */
    private string $hardBlank;

    /**
     * @var int
     */
    private int $height;

    /**
     * @var int
     */
    private int $maxLength;

    /**
     * @var int
     */
    private int $oldLayout;

    /**
     * @var int
     */
    private int $commentLines;

    /**
     * @var int
     */
    private int $printDirection;

    /**
     * @var int
     */
    private int $fullLayout;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Font
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function getFileCollection(): array
    {
        return $this->fileCollection;
    }

    /**
     * @param array $fileCollection
     *
     * @return Font
     */
    public function setFileCollection(array $fileCollection): static
    {
        $this->fileCollection = $fileCollection;

        return $this;
    }


    /**
     * @return string
     */
    public function getHardBlank(): string
    {
        return $this->hardBlank;
    }

    /**
     * @param string $hardBlank
     *
     * @return Font
     */
    public function setHardBlank(string $hardBlank): static
    {
        $this->hardBlank = $hardBlank;

        return $this;
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @param string $signature
     *
     * @return Font
     */
    public function setSignature(string $signature): static
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     *
     * @return Font
     */
    public function setHeight(int $height): static
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return int
     */
    public function getOldLayout(): int
    {
        return $this->oldLayout;
    }

    /**
     * @param int $oldLayout
     *
     * @return Font
     */
    public function setOldLayout(int $oldLayout): static
    {
        $this->oldLayout = $oldLayout;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxLength(): int
    {
        return $this->maxLength;
    }

    /**
     * @param int $maxLength
     *
     * @return Font
     */
    public function setMaxLength(int $maxLength): static
    {
        $this->maxLength = $maxLength;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrintDirection(): int
    {
        return $this->printDirection;
    }

    /**
     * @param int $printDirection
     *
     * @return Font
     */
    public function setPrintDirection(int $printDirection): static
    {
        $this->printDirection = $printDirection;

        return $this;
    }

    /**
     * @return int
     */
    public function getCommentLines(): int
    {
        return $this->commentLines;
    }

    /**
     * @param int $commentLines
     *
     * @return Font
     */
    public function setCommentLines(int $commentLines): static
    {
        $this->commentLines = $commentLines;

        return $this;
    }

    /**
     * @return int
     */
    public function getFullLayout(): int
    {
        return $this->fullLayout;
    }

    /**
     * @param int $fullLayout
     *
     * @return Font
     */
    public function setFullLayout(int $fullLayout): static
    {
        $this->fullLayout = $fullLayout;

        return $this;
    }
}
