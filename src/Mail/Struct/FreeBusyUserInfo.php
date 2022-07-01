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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

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
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Free slots
     * 
     * @Accessor(getter="getFreeSlots", setter="setFreeSlots")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyFREEslot>")
     * @XmlList(inline=true, entry="f", namespace="urn:zimbraMail")
     */
    private $freeSlots = [];

    /**
     * Busy slots
     * 
     * @Accessor(getter="getBusySlots", setter="setBusySlots")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyBUSYslot>")
     * @XmlList(inline=true, entry="b", namespace="urn:zimbraMail")
     */
    private $busySlots = [];

    /**
     * Tentative slots
     * 
     * @Accessor(getter="getTentativeSlots", setter="setTentativeSlots")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyBUSYTENTATIVEslot>")
     * @XmlList(inline=true, entry="t", namespace="urn:zimbraMail")
     */
    private $tentativeSlots = [];

    /**
     * Unavailable slots
     * 
     * @Accessor(getter="getUnavailableSlots", setter="setUnavailableSlots")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyBUSYUNAVAILABLEslot>")
     * @XmlList(inline=true, entry="u", namespace="urn:zimbraMail")
     */
    private $unavailableSlots = [];

    /**
     * No data slots
     * 
     * @Accessor(getter="getNodataSlots", setter="setNodataSlots")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyNODATAslot>")
     * @XmlList(inline=true, entry="n", namespace="urn:zimbraMail")
     */
    private $nodataSlots = [];

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
     * @return array
     */
    public function getFreeSlots(): array
    {
        return $this->freeSlots;
    }

    /**
     * Sets free slots
     *
     * @return self
     */
    public function setFreeSlots(array $slots): self
    {
        $this->freeSlots = array_filter($slots, static fn ($slot) => $slot instanceof FreeBusyFREEslot);
        return $this;
    }

    /**
     * Gets busy slots
     *
     * @return array
     */
    public function getBusySlots(): array
    {
        return $this->busySlots;
    }

    /**
     * Sets busy slots
     *
     * @return self
     */
    public function setBusySlots(array $slots): self
    {
        $this->busySlots = array_filter($slots, static fn ($slot) => $slot instanceof FreeBusyBUSYslot);
        return $this;
    }

    /**
     * Gets tentative slots
     *
     * @return array
     */
    public function getTentativeSlots(): array
    {
        return $this->tentativeSlots;
    }

    /**
     * Sets tentative slots
     *
     * @return self
     */
    public function setTentativeSlots(array $slots): self
    {
        $this->tentativeSlots = array_filter($slots, static fn ($slot) => $slot instanceof FreeBusyBUSYTENTATIVEslot);
        return $this;
    }

    /**
     * Gets unavailable slots
     *
     * @return array
     */
    public function getUnavailableSlots(): array
    {
        return $this->unavailableSlots;
    }

    /**
     * Sets unavailable slots
     *
     *
     * @return self
     */
    public function setUnavailableSlots(array $slots): self
    {
        $this->unavailableSlots = array_filter($slots, static fn ($slot) => $slot instanceof FreeBusyBUSYUNAVAILABLEslot);
        return $this;
    }

    /**
     * Gets no data slots
     *
     * @Type("array<Zimbra\Mail\Struct\FreeBusyNODATAslot>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="n", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getNodataSlots(): array
    {
        return $this->nodataSlots;
    }

    /**
     * Sets no data slots
     *
     * @return self
     */
    public function setNodataSlots(array $slots): self
    {
        $this->nodataSlots = array_filter($slots, static fn ($slot) => $slot instanceof FreeBusyNODATAslot);
        return $this;
    }

    /**
     * Add free busy slot
     *
     * @param  FreeBusySlot $element
     * @return self
     */
    public function addElement(FreeBusySlot $element): self
    {
        if ($element instanceof FreeBusyFREEslot) {
            $this->freeSlots[] = $element;
        }
        if ($element instanceof FreeBusyBUSYslot) {
            $this->busySlots[] = $element;
        }
        if ($element instanceof FreeBusyBUSYTENTATIVEslot) {
            $this->tentativeSlots[] = $element;
        }
        if ($element instanceof FreeBusyBUSYUNAVAILABLEslot) {
            $this->unavailableSlots[] = $element;
        }
        if ($element instanceof FreeBusyNODATAslot) {
            $this->nodataSlots[] = $element;
        }
        return $this;
    }

    /**
     * Set free busy slots
     *
     * @param  array $elements
     * @return self
     */
    public function setElements(array $elements): self
    {
        $this->setFreeSlots($elements)
             ->setBusySlots($elements)
             ->setTentativeSlots($elements)
             ->setUnavailableSlots($elements)
             ->setNodataSlots($elements);
        return $this;
    }

    /**
     * Gets free busy slots
     *
     * @return array
     */
    public function getElements(): array
    {
        return array_values(array_merge(
            $this->freeSlots,
            $this->busySlots,
            $this->tentativeSlots,
            $this->unavailableSlots,
            $this->nodataSlots
        ));
    }
}
