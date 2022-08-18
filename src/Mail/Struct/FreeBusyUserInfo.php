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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
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
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Free slots
     * 
     * @Accessor(getter="getFreeSlots", setter="setFreeSlots")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyFREEslot>")
     * @XmlList(inline=true, entry="f", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getFreeSlots', setter: 'setFreeSlots')]
    #[Type('array<Zimbra\Mail\Struct\FreeBusyFREEslot>')]
    #[XmlList(inline: true, entry: 'f', namespace: 'urn:zimbraMail')]
    private $freeSlots = [];

    /**
     * Busy slots
     * 
     * @Accessor(getter="getBusySlots", setter="setBusySlots")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyBUSYslot>")
     * @XmlList(inline=true, entry="b", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getBusySlots', setter: 'setBusySlots')]
    #[Type('array<Zimbra\Mail\Struct\FreeBusyBUSYslot>')]
    #[XmlList(inline: true, entry: 'b', namespace: 'urn:zimbraMail')]
    private $busySlots = [];

    /**
     * Tentative slots
     * 
     * @Accessor(getter="getTentativeSlots", setter="setTentativeSlots")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyBUSYTENTATIVEslot>")
     * @XmlList(inline=true, entry="t", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getTentativeSlots', setter: 'setTentativeSlots')]
    #[Type('array<Zimbra\Mail\Struct\FreeBusyBUSYTENTATIVEslot>')]
    #[XmlList(inline: true, entry: 't', namespace: 'urn:zimbraMail')]
    private $tentativeSlots = [];

    /**
     * Unavailable slots
     * 
     * @Accessor(getter="getUnavailableSlots", setter="setUnavailableSlots")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyBUSYUNAVAILABLEslot>")
     * @XmlList(inline=true, entry="u", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getUnavailableSlots', setter: 'setUnavailableSlots')]
    #[Type('array<Zimbra\Mail\Struct\FreeBusyBUSYUNAVAILABLEslot>')]
    #[XmlList(inline: true, entry: 'u', namespace: 'urn:zimbraMail')]
    private $unavailableSlots = [];

    /**
     * No data slots
     * 
     * @Accessor(getter="getNodataSlots", setter="setNodataSlots")
     * @Type("array<Zimbra\Mail\Struct\FreeBusyNODATAslot>")
     * @XmlList(inline=true, entry="n", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getNodataSlots', setter: 'setNodataSlots')]
    #[Type('array<Zimbra\Mail\Struct\FreeBusyNODATAslot>')]
    #[XmlList(inline: true, entry: 'n', namespace: 'urn:zimbraMail')]
    private $nodataSlots = [];

    /**
     * Constructor
     * 
     * @param  string $id
     * @param  array $elements
     * @return self
     */
    public function __construct(string $id = '', array $elements = [])
    {
        $this->setId($id)
             ->setFreeSlots($elements)
             ->setBusySlots($elements)
             ->setTentativeSlots($elements)
             ->setUnavailableSlots($elements)
             ->setNodataSlots($elements);
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get free slots
     *
     * @return array
     */
    public function getFreeSlots(): array
    {
        return $this->freeSlots;
    }

    /**
     * Set free slots
     *
     * @return self
     */
    public function setFreeSlots(array $slots): self
    {
        $this->freeSlots = array_values(
            array_filter($slots, static fn ($slot) => $slot instanceof FreeBusyFREEslot)
        );
        return $this;
    }

    /**
     * Get busy slots
     *
     * @return array
     */
    public function getBusySlots(): array
    {
        return $this->busySlots;
    }

    /**
     * Set busy slots
     *
     * @return self
     */
    public function setBusySlots(array $slots): self
    {
        $this->busySlots = array_values(
            array_filter($slots, static fn ($slot) => $slot instanceof FreeBusyBUSYslot)
        );
        return $this;
    }

    /**
     * Get tentative slots
     *
     * @return array
     */
    public function getTentativeSlots(): array
    {
        return $this->tentativeSlots;
    }

    /**
     * Set tentative slots
     *
     * @return self
     */
    public function setTentativeSlots(array $slots): self
    {
        $this->tentativeSlots = array_values(
            array_filter($slots, static fn ($slot) => $slot instanceof FreeBusyBUSYTENTATIVEslot)
        );
        return $this;
    }

    /**
     * Get unavailable slots
     *
     * @return array
     */
    public function getUnavailableSlots(): array
    {
        return $this->unavailableSlots;
    }

    /**
     * Set unavailable slots
     *
     *
     * @return self
     */
    public function setUnavailableSlots(array $slots): self
    {
        $this->unavailableSlots = array_values(
            array_filter($slots, static fn ($slot) => $slot instanceof FreeBusyBUSYUNAVAILABLEslot)
        );
        return $this;
    }

    /**
     * Get no data slots
     *
     * @return array
     */
    public function getNodataSlots(): array
    {
        return $this->nodataSlots;
    }

    /**
     * Set no data slots
     *
     * @return self
     */
    public function setNodataSlots(array $slots): self
    {
        $this->nodataSlots = array_values(
            array_filter($slots, static fn ($slot) => $slot instanceof FreeBusyNODATAslot)
        );
        return $this;
    }

    /**
     * Get free busy slots
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
