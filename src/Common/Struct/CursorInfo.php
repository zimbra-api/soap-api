<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * CursorInfo class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CursorInfo
{
    /**
     * Id
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Sort val
     * 
     * @var string
     */
    #[Accessor(getter: 'getSortVal', setter: 'setSortVal')]
    #[SerializedName('sortVal')]
    #[Type('string')]
    #[XmlAttribute]
    private $sortVal;

    /**
     * End sort val
     * 
     * @var string
     */
    #[Accessor(getter: 'getEndSortVal', setter: 'setEndSortVal')]
    #[SerializedName('endSortVal')]
    #[Type('string')]
    #[XmlAttribute]
    private $endSortVal;

    /**
     * Include offset
     * 
     * @var bool
     */
    #[Accessor(getter: 'getIncludeOffset', setter: 'setIncludeOffset')]
    #[SerializedName('includeOffset')]
    #[Type('bool')]
    #[XmlAttribute]
    private $includeOffset;

    /**
     * Constructor
     * 
     * @param string $id
     * @param string $sortVal
     * @param string $endSortVal
     * @param bool $includeOffset
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?string $sortVal = NULL,
        ?string $endSortVal = NULL,
        ?bool   $includeOffset = NULL
    )
    {
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $sortVal) {
            $this->setSortVal($sortVal);
        }
        if (NULL !== $endSortVal) {
            $this->setEndSortVal($endSortVal);
        }
        if (NULL !== $includeOffset) {
            $this->setIncludeOffset($includeOffset);
        }
    }

    /**
     * Get an id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set an id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get sortVal
     *
     * @return string
     */
    public function getSortVal(): ?string
    {
        return $this->sortVal;
    }

    /**
     * Set sortVal
     *
     * @param  string $sortVal
     * @return self
     */
    public function setSortVal(string $sortVal): self
    {
        $this->sortVal = $sortVal;
        return $this;
    }

    /**
     * Get an endSortVal
     *
     * @return string
     */
    public function getEndSortVal(): ?string
    {
        return $this->endSortVal;
    }

    /**
     * Set endSortVal
     *
     * @param  string $endSortVal
     * @return self
     */
    public function setEndSortVal(string $endSortVal): self
    {
        $this->endSortVal = $endSortVal;
        return $this;
    }

    /**
     * Get includeOffset
     *
     * @return bool
     */
    public function getIncludeOffset(): ?bool
    {
        return $this->includeOffset;
    }

    /**
     * Set includeOffset
     *
     * @param  bool $includeOffset
     * @return self
     */
    public function setIncludeOffset(bool $includeOffset): self
    {
        $this->includeOffset = $includeOffset;
        return $this;
    }
}
