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
use Zimbra\Common\Enum\InviteType;

/**
 * InviteWithGroupInfo class
 * Invite information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class InviteWithGroupInfo
{
    /**
     * Invite type - appt|task
     * @Accessor(getter="getCalItemType", setter="setCalItemType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\InviteType")
     * @XmlAttribute
     */
    private InviteType $calItemType;

    /**
     * Timezones
     * @Accessor(getter="getTimezones", setter="setTimezones")
     * @Type("array<Zimbra\Mail\Struct\CalTZInfo>")
     * @XmlList(inline=true, entry="tz", namespace="urn:zimbraMail")
     */
    private $timezones = [];

    /**
     * Invite components
     * @Accessor(getter="getInviteComponents", setter="setInviteComponents")
     * @Type("array<Zimbra\Mail\Struct\InviteComponentWithGroupInfo>")
     * @XmlList(inline=true, entry="comp", namespace="urn:zimbraMail")
     */
    private $inviteComponents = [];

    /**
     * Replies
     * @Accessor(getter="getCalendarReplies", setter="setCalendarReplies")
     * @SerializedName("replies")
     * @Type("array<Zimbra\Mail\Struct\CalendarReply>")
     * @XmlElement(namespace="urn:zimbraMail")
     * @XmlList(inline=false, entry="reply", namespace="urn:zimbraMail")
     */
    private $calendarReplies = [];

    /**
     * Constructor method for InviteWithGroupInfo
     *
     * @param  InviteType $calItemType
     * @param  array $timezones
     * @param  array $inviteComponents
     * @param  array $calendarReplies
     * @return self
     */
    public function __construct(
        ?InviteType $calItemType = NULL,
        array $timezones = [],
        array $inviteComponents = [],
        array $calendarReplies = []
    )
    {
        $this->setCalItemType($calItemType ?? InviteType::APPOINTMENT())
             ->setTimezones($timezones)
             ->setInviteComponents($inviteComponents)
             ->setCalendarReplies($calendarReplies);
    }

    /**
     * Get calItemType
     *
     * @return InviteType
     */
    public function getCalItemType(): InviteType
    {
        return $this->calItemType;
    }

    /**
     * Set calItemType
     *
     * @param  InviteType $calItemType
     * @return self
     */
    public function setCalItemType(InviteType $calItemType): self
    {
        $this->calItemType = $calItemType;
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
        $this->timezones = array_filter($timezones, static fn ($timezone) => $timezone instanceof CalTZInfo);
        return $this;
    }

    /**
     * Get timezones
     *
     * @return array
     */
    public function getTimezones(): array
    {
        return $this->timezones;
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
     * Get inviteComponents
     *
     * @return array
     */
    public function getInviteComponents(): array
    {
        return $this->inviteComponents;
    }

    /**
     * Set inviteComponents
     *
     * @param  array $inviteComponents
     * @return self
     */
    public function setInviteComponents(array $components): self
    {
        $this->inviteComponents = array_filter($components, static fn ($component) => $component instanceof InviteComponentWithGroupInfo);
        return $this;
    }

    /**
     * Add invite component
     *
     * @param  InviteComponentWithGroupInfo $component
     * @return self
     */
    public function addInviteComponent(InviteComponentWithGroupInfo $component): self
    {
        $this->inviteComponents[] = $component;
        return $this;
    }

    /**
     * Set calendarReplies
     *
     * @param  array $replies
     * @return self
     */
    public function setCalendarReplies(array $replies): self
    {
        $this->calendarReplies = array_filter($replies, static fn ($reply) => $reply instanceof CalendarReply);
        return $this;
    }

    /**
     * Get calendarReplies
     *
     * @return array
     */
    public function getCalendarReplies(): array
    {
        return $this->calendarReplies;
    }

    /**
     * Add calendarReply
     *
     * @param  CalendarReply $calendarReply
     * @return self
     */
    public function addCalendarReply(CalendarReply $calendarReply): self
    {
        $this->calendarReplies[] = $calendarReply;
        return $this;
    }
}
