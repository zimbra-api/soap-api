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
use Zimbra\Common\Struct\{CalendarReplyInterface, CalTZInfoInterface, InviteComponentInterface};

/**
 * MPInviteInfo class
 * MP invite information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MPInviteInfo
{
    /**
     * Calendar item type - appt|task
     * 
     * @var InviteType
     */
    #[Accessor(getter: 'getCalItemType', setter: 'setCalItemType')]
    #[SerializedName('type')]
    #[XmlAttribute]
    private InviteType $calItemType;

    /**
     * Timezones
     * 
     * @var array
     */
    #[Accessor(getter: 'getTimezones', setter: 'setTimezones')]
    #[Type('array<Zimbra\Mail\Struct\CalTZInfo>')]
    #[XmlList(inline: true, entry: 'tz', namespace: 'urn:zimbraMail')]
    private $timezones = [];

    /**
     * List of replies received from attendees.
     * 
     * @var array
     */
    #[Accessor(getter: 'getCalendarReplies', setter: 'setCalendarReplies')]
    #[SerializedName('replies')]
    #[Type('array<Zimbra\Mail\Struct\CalendarReply>')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    #[XmlList(inline: false, entry: 'reply', namespace: 'urn:zimbraMail')]
    private $calendarReplies = [];

    /**
     * Invite components
     * 
     * @var array
     */
    #[Accessor(getter: 'getInviteComponents', setter: 'setInviteComponents')]
    #[Type('array<Zimbra\Mail\Struct\InviteComponent>')]
    #[XmlList(inline: true, entry: 'comp', namespace: 'urn:zimbraMail')]
    private $inviteComponents = [];

    /**
     * Constructor
     *
     * @param  InviteType $calItemType
     * @param  array $timezones
     * @param  array $calendarReplies
     * @param  array $inviteComponents
     * @return self
     */
    public function __construct(
        ?InviteType $calItemType = null,
        array $timezones = [],
        array $calendarReplies = [],
        array $inviteComponents = []
    )
    {
        $this->setCalItemType($calItemType ?? InviteType::APPOINTMENT)
             ->setTimezones($timezones)
             ->setCalendarReplies($calendarReplies)
             ->setInviteComponents($inviteComponents);
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
            $timezones, static fn ($timezone) => $timezone instanceof CalTZInfoInterface
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
     * Set calendarReplies
     *
     * @param  array $replies
     * @return self
     */
    public function setCalendarReplies(array $replies): self
    {
        $this->calendarReplies = array_filter(
            $replies, static fn ($reply) => $reply instanceof CalendarReplyInterface
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
    public function addCalendarReply(CalendarReplyInterface $calendarReply): self
    {
        $this->calendarReplies[] = $calendarReply;
        return $this;
    }

    /**
     * Set inviteComponents
     *
     * @param  array $components
     * @return self
     */
    public function setInviteComponents(array $components): self
    {
        $this->inviteComponents = array_filter(
            $components, static fn ($component) => $component instanceof InviteComponent
        );
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
