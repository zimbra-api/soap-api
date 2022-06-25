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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};

/**
 * Invitation struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class Invitation
{
    /**
     * Calendar item type - appt|task
     * @Accessor(getter="getCalItemType", setter="setCalItemType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $calItemType;

    /**
     * Sequence number
     * @Accessor(getter="getSequence", setter="setSequence")
     * @SerializedName("seq")
     * @Type("integer")
     * @XmlAttribute
     */
    private $sequence;

    /**
     * Original mail item ID for invite
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("integer")
     * @XmlAttribute
     */
    private $id;

    /**
     * Component number
     * @Accessor(getter="getComponentNum", setter="setComponentNum")
     * @SerializedName("compNum")
     * @Type("integer")
     * @XmlAttribute
     */
    private $componentNum;

    /**
     * Recurrence ID in format : YYMMDD[THHMMSS[Z]]
     * @Accessor(getter="getRecurrenceId", setter="setRecurrenceId")
     * @SerializedName("recurId")
     * @Type("string")
     * @XmlAttribute
     */
    private $recurrenceId;

    /**
     * Timezones
     * @Accessor(getter="getTimezones", setter="setTimezones")
     * @SerializedName("tz")
     * @Type("array<Zimbra\Mail\Struct\CalTZInfo>")
     * @XmlList(inline=true, entry="tz")
     */
    private $timezones = [];

    /**
     * Invite component
     * @Accessor(getter="getInviteComponent", setter="setInviteComponent")
     * @SerializedName("comp")
     * @Type("Zimbra\Mail\Struct\InviteComponent")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?InviteComponent $inviteComponent = NULL;

    /**
     * Mime parts
     * @Accessor(getter="getPartInfos", setter="setPartInfos")
     * @SerializedName("mp")
     * @Type("array<Zimbra\Mail\Struct\PartInfo>")
     * @XmlList(inline=true, entry="mp")
     */
    private $partInfos = [];

    /**
     * Share notifications
     * @Accessor(getter="getShareNotifications", setter="setShareNotifications")
     * @SerializedName("shr")
     * @Type("array<Zimbra\Mail\Struct\ShareNotification>")
     * @XmlList(inline=true, entry="shr")
     */
    private $shareNotifications = [];

    /**
     * Distribution list subscription notifications
     * @Accessor(getter="getDlSubs", setter="setDlSubs")
     * @SerializedName("dlSubs")
     * @Type("array<Zimbra\Mail\Struct\DLSubscriptionNotification>")
     * @XmlList(inline=true, entry="dlSubs")
     */
    private $dlSubs = [];

    /**
     * Constructor method
     *
     * @return self
     */
    public function __construct(
        string $calItemType,
        int $sequence,
        int $id,
        int $componentNum,
        ?string $recurrenceId = NULL,
        array $timezones = [],
        ?InviteComponent $inviteComponent = NULL,
        array $partInfos = [],
        array $shareNotifications = [],
        array $dlSubs = []
    )
    {
        $this->setTimezones($timezones)
             ->setPartInfos($partInfos)
             ->setShareNotifications($shareNotifications)
             ->setDlSubs($dlSubs)
             ->setCalItemType($calItemType)
             ->setSequence($sequence)
             ->setId($id)
             ->setComponentNum($componentNum);
        if (NULL !== $recurrenceId) {
            $this->setRecurrenceId($recurrenceId);
        }
        if ($inviteComponent instanceof InviteComponent) {
            $this->setInviteComponent($inviteComponent);
        }
    }

    /**
     * Gets calItemType
     *
     * @return string
     */
    public function getCalItemType(): ?string
    {
        return $this->calItemType;
    }

    /**
     * Sets calItemType
     *
     * @param  string $calItemType
     * @return self
     */
    public function setCalItemType(string $calItemType): self
    {
        $this->calItemType = $calItemType;
        return $this;
    }

    /**
     * Gets sequence
     *
     * @return int
     */
    public function getSequence(): ?int
    {
        return $this->sequence;
    }

    /**
     * Sets sequence
     *
     * @param  int $sequence
     * @return self
     */
    public function setSequence(int $sequence): self
    {
        $this->sequence = $sequence;
        return $this;
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets componentNum
     *
     * @return int
     */
    public function getComponentNum(): ?int
    {
        return $this->componentNum;
    }

    /**
     * Sets componentNum
     *
     * @param  int $componentNum
     * @return self
     */
    public function setComponentNum(int $componentNum): self
    {
        $this->componentNum = $componentNum;
        return $this;
    }

    /**
     * Gets recurrenceId
     *
     * @return string
     */
    public function getRecurrenceId(): ?string
    {
        return $this->recurrenceId;
    }

    /**
     * Sets recurrenceId
     *
     * @param  string $recurrenceId
     * @return self
     */
    public function setRecurrenceId(string $recurrenceId): self
    {
        $this->recurrenceId = $recurrenceId;
        return $this;
    }

    /**
     * Add timezone
     *
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function addTimezone(CalTZInfo $timezone): self
    {
        $this->timezones[] = $timezone;
        return $this;
    }

    /**
     * Set timezones
     *
     * @param  array $timezones
     * @return self
     */
    public function setTimezones(array $timezones): self
    {
        $this->timezones = array_filter($timezones, static fn($timezone) => $timezone instanceof CalTZInfo);
        return $this;
    }

    /**
     * Gets timezones
     *
     * @return array
     */
    public function getTimezones(): array
    {
        return $this->timezones;
    }

    /**
     * Gets inviteComponent
     *
     * @return InviteComponent
     */
    public function getInviteComponent(): ?InviteComponent
    {
        return $this->inviteComponent;
    }

    /**
     * Sets inviteComponent
     *
     * @param  InviteComponent $inviteComponent
     * @return self
     */
    public function setInviteComponent(InviteComponent $inviteComponent): self
    {
        $this->inviteComponent = $inviteComponent;
        return $this;
    }

    /**
     * Add partInfo
     *
     * @param  PartInfo $partInfo
     * @return self
     */
    public function addPartInfo(PartInfo $partInfo): self
    {
        $this->partInfos[] = $partInfo;
        return $this;
    }

    /**
     * Set partInfos
     *
     * @param  array $partInfos
     * @return self
     */
    public function setPartInfos(array $partInfos): self
    {
        $this->partInfos = array_filter($partInfos, static fn($partInfo) => $partInfo instanceof PartInfo);
        return $this;
    }

    /**
     * Gets partInfos
     *
     * @return array
     */
    public function getPartInfos(): array
    {
        return $this->partInfos;
    }

    /**
     * Add shareNotification
     *
     * @param  ShareNotification $shareNotification
     * @return self
     */
    public function addShareNotification(ShareNotification $shareNotification): self
    {
        $this->shareNotifications[] = $shareNotification;
        return $this;
    }

    /**
     * Set shareNotifications
     *
     * @param  array $notifications
     * @return self
     */
    public function setShareNotifications(array $notifications): self
    {
        $this->shareNotifications = array_filter($notifications, static fn($notification) => $notification instanceof ShareNotification);
        return $this;
    }

    /**
     * Gets shareNotifications
     *
     * @return array
     */
    public function getShareNotifications(): array
    {
        return $this->shareNotifications;
    }

    /**
     * Add dlSub
     *
     * @param  DLSubscriptionNotification $dlSub
     * @return self
     */
    public function addDlSub(DLSubscriptionNotification $dlSub): self
    {
        $this->dlSubs[] = $dlSub;
        return $this;
    }

    /**
     * Set dlSubs
     *
     * @param  array $dlSubs
     * @return self
     */
    public function setDlSubs(array $dlSubs): self
    {
        $this->dlSubs = array_filter($dlSubs, static fn($dlSub) => $dlSub instanceof DLSubscriptionNotification);
        return $this;
    }

    /**
     * Gets dlSubs
     *
     * @return array
     */
    public function getDlSubs(): array
    {
        return $this->dlSubs;
    }
}
