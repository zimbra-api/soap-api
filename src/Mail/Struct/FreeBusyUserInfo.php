<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, Exclude, SerializedName, Type, VirtualProperty, XmlAttribute, XmlList};

/**
 * FreeBusyUserInfo struct class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FreeBusyUserInfo
{
    /**
     * Account identifier (email or id)
     * "id" is always account email; it is not zimbraId as the attribute name may suggest
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Free/Busy slots
     * @Exclude
     */
    private $elements = [];

    /**
     * Constructor method for FreeBusyUserInfo
     * 
     * @param  string $id
     * @param  array $elements
     * @return self
     */
    public function __construct(string $id = '', array $elements = [])
    {
        $this->setId($id)
             ->setElements($elements);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
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
     * Gets free slots
     *
     * @SerializedName("f")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyFREEslot>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="f", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getFreeSlots(): array
    {
        return array_filter($this->elements, static fn ($slot) => $slot instanceof FreeBusyFREEslot);
    }

    /**
     * Gets busy slots
     *
     * @SerializedName("b")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyBUSYslot>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="b", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getBusySlots(): array
    {
        return array_filter($this->elements, static fn ($slot) => $slot instanceof FreeBusyBUSYslot);
    }

    /**
     * Gets tentative slots
     *
     * @SerializedName("t")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyBUSYTENTATIVEslot>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="t", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getTentativeSlots(): array
    {
        return array_filter($this->elements, static fn ($slot) => $slot instanceof FreeBusyBUSYTENTATIVEslot);
    }

    /**
     * Gets unavailable slots
     *
     * @SerializedName("u")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyBUSYUNAVAILABLEslot>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="u", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getUnavailableSlots(): array
    {
        return array_filter($this->elements, static fn ($slot) => $slot instanceof FreeBusyBUSYUNAVAILABLEslot);
    }

    /**
     * Gets no data slots
     *
     * @SerializedName("n")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyNODATAslot>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="n", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getNodataSlots(): array
    {
        return array_filter($this->elements, static fn ($slot) => $slot instanceof FreeBusyNODATAslot);
    }

    /**
     * Add dataSource
     *
     * @param  FreeBusySlot $dataSource
     * @return self
     */
    public function addElement(FreeBusySlot $dataSource): self
    {
        $this->elements[] = $dataSource;
        return $this;
    }

    /**
     * Set elements
     *
     * @param  array $elements
     * @return self
     */
    public function setElements(array $elements): self
    {
        $this->elements = array_filter($elements, static fn ($source) => $source instanceof FreeBusySlot);
        return $this;
    }

    /**
     * Gets elements
     *
     * @return array
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    public static function elementTypes(): array
    {
        return [
            'f' => FreeBusyFREEslot::class,
            'b' => FreeBusyBUSYslot::class,
            't' => FreeBusyBUSYTENTATIVEslot::class,
            'u' => FreeBusyBUSYUNAVAILABLEslot::class,
            'n' => FreeBusyNODATAslot::class,
        ];
    }
}
