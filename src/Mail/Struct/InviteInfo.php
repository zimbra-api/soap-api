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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};
use Zimbra\Common\Enum\InviteType;
use Zimbra\Common\Struct\{
    CalendarReplyInterface,
    CalTZInfoInterface,
    InviteComponentInterface,
    InviteInfoInterface
};

/**
 * InviteInfo class
 * Invite information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InviteInfo implements InviteInfoInterface
{
    /**
     * Invite type - appt|task
     *
     * @var InviteType
     */
    #[Accessor(getter: "getCalItemType", setter: "setCalItemType")]
    #[SerializedName("type")]
    #[XmlAttribute]
    private InviteType $calItemType;

    /**
     * Timezones
     *
     * @var array
     */
    #[Accessor(getter: "getTimezones", setter: "setTimezones")]
    #[Type("array<Zimbra\Mail\Struct\CalTZInfo>")]
    #[XmlList(inline: true, entry: "tz", namespace: "urn:zimbraMail")]
    private array $timezones = [];

    /**
     * Invite components
     *
     * @var InviteComponentInterface
     */
    #[Accessor(getter: "getInviteComponent", setter: "setInviteComponent")]
    #[SerializedName("comp")]
    #[Type(InviteComponent::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?InviteComponentInterface $inviteComponent;

    /**
     * List of replies received from attendees.
     *
     * @var array
     */
    #[Accessor(getter: "getCalendarReplies", setter: "setCalendarReplies")]
    #[SerializedName("replies")]
    #[Type("array<Zimbra\Mail\Struct\CalendarReply>")]
    #[XmlElement(namespace: "urn:zimbraMail")]
    #[XmlList(inline: false, entry: "reply", namespace: "urn:zimbraMail")]
    private array $calendarReplies = [];

    /**
     * Constructor
     *
     * @param  InviteType $calItemType
     * @param  array $timezones
     * @param  InviteComponent $inviteComponent
     * @param  array $calendarReplies
     * @return self
     */
    public function __construct(
        ?InviteType $calItemType = null,
        array $timezones = [],
        ?InviteComponent $inviteComponent = null,
        array $calendarReplies = []
    ) {
        $this->setCalItemType($calItemType ?? InviteType::APPOINTMENT)
            ->setTimezones($timezones)
            ->setCalendarReplies($calendarReplies);
        $this->inviteComponent = $inviteComponent;
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
        $this->timezones = array_filter(
            $timezones,
            static fn($timezone) => $timezone instanceof CalTZInfoInterface
        );
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
     * @param  CalTZInfoInterface $timezone
     * @return self
     */
    public function addTimezone(CalTZInfoInterface $timezone): self
    {
        $this->timezones[] = $timezone;
        return $this;
    }

    /**
     * Get inviteComponent
     *
     * @return InviteComponentInterface
     */
    public function getInviteComponent(): ?InviteComponentInterface
    {
        return $this->inviteComponent;
    }

    /**
     * Set inviteComponent
     *
     * @param  InviteComponentInterface $inviteComponent
     * @return self
     */
    public function setInviteComponent(
        InviteComponentInterface $inviteComponent
    ): self {
        $this->inviteComponent = $inviteComponent;
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
        $this->calendarReplies = array_filter(
            $replies,
            static fn($reply) => $reply instanceof CalendarReplyInterface
        );
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
     * @param  CalendarReplyInterface $calendarReply
     * @return self
     */
    public function addCalendarReply(
        CalendarReplyInterface $calendarReply
    ): self {
        $this->calendarReplies[] = $calendarReply;
        return $this;
    }
}
