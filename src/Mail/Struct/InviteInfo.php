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
use Zimbra\Common\Struct\{
    CalendarReplyInterface, CalTZInfoInterface, InviteComponentInterface, InviteInfoInterface
};

/**
 * InviteInfo class
 * Invite information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class InviteInfo implements InviteInfoInterface
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
     * @SerializedName("tz")
     * @Type("array<Zimbra\Mail\Struct\CalTZInfo>")
     * @XmlList(inline = true, entry = "tz")
     */
    private $timezones = [];

    /**
     * Invite components
     * @Accessor(getter="getInviteComponent", setter="setInviteComponent")
     * @SerializedName("comp")
     * @Type("Zimbra\Mail\Struct\InviteComponent")
     * @XmlElement
     */
    private ?InviteComponent $inviteComponent = NULL;

    /**
     * List of replies received from attendees.
     * @Accessor(getter="getCalendarReplies", setter="setCalendarReplies")
     * @SerializedName("replies")
     * @Type("array<Zimbra\Mail\Struct\CalendarReply>")
     * @XmlList(inline = false, entry = "reply")
     */
    private $calendarReplies = [];

    /**
     * Constructor method for InviteInfo
     *
     * @param  InviteType $calItemType
     * @param  array $timezones
     * @param  InviteComponent $inviteComponent
     * @param  array $calendarReplies
     * @return self
     */
    public function __construct(
        InviteType $calItemType,
        array $timezones = [],
        ?InviteComponent $inviteComponent = NULL,
        array $calendarReplies = []
    )
    {
        $this->setCalItemType($calItemType)
             ->setTimezones($timezones)
             ->setCalendarReplies($calendarReplies);
        if ($inviteComponent instanceof InviteComponent) {
            $this->setInviteComponent($inviteComponent);
        }
    }

    /**
     * Gets calItemType
     *
     * @return InviteType
     */
    public function getCalItemType(): InviteType
    {
        return $this->calItemType;
    }

    /**
     * Sets calItemType
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
     * Sets timezones
     *
     * @param  array $timezones
     * @return self
     */
    public function setTimezones(array $timezones): self
    {
        $this->timezones = array_filter($timezones, static fn($timezone) => $timezone instanceof CalTZInfoInterface);
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
     * @param  CalTZInfoInterface $timezone
     * @return self
     */
    public function addTimezone(CalTZInfoInterface $timezone): self
    {
        $this->timezones[] = $timezone;
        return $this;
    }

    /**
     * Gets inviteComponent
     *
     * @return InviteComponentInterface
     */
    public function getInviteComponent(): ?InviteComponentInterface
    {
        return $this->inviteComponent;
    }

    /**
     * Sets inviteComponent
     *
     * @param  InviteComponentInterface $inviteComponent
     * @return self
     */
    public function setInviteComponent(InviteComponentInterface $inviteComponent): self
    {
        $this->inviteComponent = $inviteComponent;
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
        $this->calendarReplies = array_filter($replies, static fn($reply) => $reply instanceof CalendarReplyInterface);
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
     * @param  CalendarReplyInterface $calendarReply
     * @return self
     */
    public function addCalendarReply(CalendarReplyInterface $calendarReply): self
    {
        $this->calendarReplies[] = $calendarReply;
        return $this;
    }
}
