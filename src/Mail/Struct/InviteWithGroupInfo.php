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
     * @Type("string")
     * @XmlAttribute
     */
    private $calItemType;

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
     * @param  string $calItemType
     * @param  array $timezones
     * @param  InviteComponentWithGroupInfo $inviteComponent
     * @param  array $calendarReplies
     * @return self
     */
    public function __construct(
        string $calItemType = '',
        array $timezones = [],
        array $inviteComponents = [],
        array $calendarReplies = []
    )
    {
        $this->setCalItemType($calItemType)
             ->setTimezones($timezones)
             ->setInviteComponents($inviteComponents)
             ->setCalendarReplies($calendarReplies);
    }

    /**
     * Gets calItemType
     *
     * @return InviteType
     */
    public function getCalItemType(): string
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
     * Sets timezones
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
     * Gets timezones
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
     * Gets inviteComponents
     *
     * @return array
     */
    public function getInviteComponent(): array
    {
        return $this->inviteComponents;
    }

    /**
     * Sets inviteComponents
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
     * Sets calendarReplies
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
     * Gets calendarReplies
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
