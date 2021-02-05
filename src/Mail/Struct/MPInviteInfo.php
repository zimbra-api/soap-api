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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlList, XmlRoot};

use Zimbra\Enum\InviteType;

use Zimbra\Struct\CalendarReplyInterface;
use Zimbra\Struct\CalTZInfoInterface;
use Zimbra\Struct\InviteComponentInterface;

/**
 * MPInviteInfo class
 * MP invite information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="inv")
 */
class MPInviteInfo
{
    /**
     * Calendar item type - appt|task
     * @Accessor(getter="getCalItemType", setter="setCalItemType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\InviteType")
     * @XmlAttribute
     */
    private $calItemType;

    /**
     * Timezones
     * @Accessor(getter="getTimezones", setter="setTimezones")
     * @SerializedName("tz")
     * @Type("array<Zimbra\Mail\Struct\CalTZInfo>")
     * @XmlList(inline = true, entry = "tz")
     */
    private $timezones = [];

    /**
     * List of replies received from attendees.
     * @Accessor(getter="getCalendarReplies", setter="setCalendarReplies")
     * @SerializedName("replies")
     * @Type("array<Zimbra\Mail\Struct\CalendarReply>")
     * @XmlList(inline = false, entry = "reply")
     */
    private $calendarReplies = [];

    /**
     * Invite components
     * @Accessor(getter="getInviteComponents", setter="setInviteComponents")
     * @SerializedName("comp")
     * @Type("array<Zimbra\Mail\Struct\InviteComponent>")
     * @XmlList(inline = true, entry = "comp")
     */
    private $inviteComponents = [];

    /**
     * Constructor method for MPInviteInfo
     *
     * @param  InviteType $calItemType
     * @param  array $timezones
     * @param  array $calendarReplies
     * @param  array $inviteComponents
     * @return self
     */
    public function __construct(
        InviteType $calItemType,
        array $timezones = [],
        array $calendarReplies = [],
        array $inviteComponents = []
    )
    {
        $this->setCalItemType($calItemType)
             ->setTimezones($timezones)
             ->setCalendarReplies($calendarReplies)
             ->setInviteComponents($inviteComponents);
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
        $this->timezones = [];
        foreach ($timezones as $timezone) {
            if ($timezone instanceof CalTZInfoInterface) {
                $this->timezones[] = $timezone;
            }
        }
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
     * Sets calendarReplies
     *
     * @param  array $calendarReplies
     * @return self
     */
    public function setCalendarReplies(array $calendarReplies): self
    {
        $this->calendarReplies = [];
        foreach ($calendarReplies as $calendarReply) {
            if ($calendarReply instanceof CalendarReplyInterface) {
                $this->calendarReplies[] = $calendarReply;
            }
        }
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

    /**
     * Sets inviteComponents
     *
     * @param  array $inviteComponents
     * @return self
     */
    public function setInviteComponents(array $inviteComponents): self
    {
        $this->inviteComponents = [];
        foreach ($inviteComponents as $inviteComponent) {
            if ($inviteComponent instanceof InviteComponent) {
                $this->inviteComponents[] = $inviteComponent;
            }
        }
        return $this;
    }

    /**
     * Gets inviteComponents
     *
     * @return array
     */
    public function getInviteComponents(): array
    {
        return $this->inviteComponents;
    }

    /**
     * Add inviteComponent
     *
     * @param  InviteComponent $inviteComponent
     * @return self
     */
    public function addInviteComponent(InviteComponent $inviteComponent): self
    {
        $this->inviteComponents[] = $inviteComponent;
        return $this;
    }
}