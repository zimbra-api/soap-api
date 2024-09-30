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
use Zimbra\Common\Enum\AlarmAction;
use Zimbra\Common\Struct\{
    AlarmInfoInterface,
    AlarmTriggerInfoInterface,
    CalendarAttachInterface,
    CalendarAttendeeInterface,
    DurationInfoInterface,
    XPropInterface
};

/**
 * AlarmInfo class
 * Alarm information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AlarmInfo implements AlarmInfoInterface
{
    /**
     * Alarm action
     * Possible values: DISPLAY|AUDIO|EMAIL|PROCEDURE|X_YAHOO_CALENDAR_ACTION_IM|X_YAHOO_CALENDAR_ACTION_MOBILE
     *
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Enum<Zimbra\Common\Enum\AlarmAction>")
     * @XmlAttribute
     *
     * @var AlarmAction
     */
    #[Accessor(getter: "getAction", setter: "setAction")]
    #[SerializedName("action")]
    #[Type("Enum<Zimbra\Common\Enum\AlarmAction>")]
    #[XmlAttribute]
    private AlarmAction $action;

    /**
     * Alarm trigger information
     *
     * @Accessor(getter="getTrigger", setter="setTrigger")
     * @SerializedName("trigger")
     * @Type("Zimbra\Mail\Struct\AlarmTriggerInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var AlarmTriggerInfoInterface
     */
    #[Accessor(getter: "getTrigger", setter: "setTrigger")]
    #[SerializedName("trigger")]
    #[Type(AlarmTriggerInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?AlarmTriggerInfoInterface $trigger;

    /**
     * Alarm repeat information
     *
     * @Accessor(getter="getRepeat", setter="setRepeat")
     * @SerializedName("repeat")
     * @Type("Zimbra\Mail\Struct\DurationInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var DurationInfoInterface
     */
    #[Accessor(getter: "getRepeat", setter: "setRepeat")]
    #[SerializedName("repeat")]
    #[Type(DurationInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?DurationInfoInterface $repeat;

    /**
     * Alarm description
     * action=DISPLAY: Reminder text to display
     * action=EMAIL|X_YAHOO_CALENDAR_ACTION_IM|X_YAHOO_CALENDAR_ACTION_MOBILE: EMail body
     * action=PROCEDURE: Description text
     *
     * @Accessor(getter="getDescription", setter="setDescription")
     * @SerializedName("desc")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     *
     * @var string
     */
    #[Accessor(getter: "getDescription", setter: "setDescription")]
    #[SerializedName("desc")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private $description;

    /**
     * Information on attachment
     *
     * @Accessor(getter="getAttach", setter="setAttach")
     * @SerializedName("attach")
     * @Type("Zimbra\Mail\Struct\CalendarAttach")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var CalendarAttachInterface
     */
    #[Accessor(getter: "getAttach", setter: "setAttach")]
    #[SerializedName("attach")]
    #[Type(CalendarAttach::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?CalendarAttachInterface $attach;

    /**
     * Alarm summary
     *
     * @Accessor(getter="getSummary", setter="setSummary")
     * @SerializedName("summary")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     *
     * @var string
     */
    #[Accessor(getter: "getSummary", setter: "setSummary")]
    #[SerializedName("summary")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private $summary;

    /**
     * Attendee information
     *
     * @Accessor(getter="getAttendees", setter="setAttendees")
     * @Type("array<Zimbra\Mail\Struct\CalendarAttendee>")
     * @XmlList(inline=true, entry="at", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getAttendees", setter: "setAttendees")]
    #[Type("array<Zimbra\Mail\Struct\CalendarAttendee>")]
    #[XmlList(inline: true, entry: "at", namespace: "urn:zimbraMail")]
    private $attendees = [];

    /**
     * Non-standard properties (see RFC2445 section 4.8.8.1)
     *
     * @Accessor(getter="getXProps", setter="setXProps")
     * @Type("array<Zimbra\Mail\Struct\XProp>")
     * @XmlList(inline=true, entry="xprop", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getXProps", setter: "setXProps")]
    #[Type("array<Zimbra\Mail\Struct\XProp>")]
    #[XmlList(inline: true, entry: "xprop", namespace: "urn:zimbraMail")]
    private $xProps = [];

    /**
     * Constructor
     *
     * @param  AlarmAction $action
     * @param  AlarmTriggerInfo $trigger
     * @param  DurationInfo $repeat
     * @param  string $description
     * @param  CalendarAttach $attach
     * @param  string $summary
     * @param  array $attendees
     * @param  array $xProps
     * @return self
     */
    public function __construct(
        ?AlarmAction $action = null,
        ?AlarmTriggerInfo $trigger = null,
        ?DurationInfo $repeat = null,
        ?string $description = null,
        ?CalendarAttach $attach = null,
        ?string $summary = null,
        array $attendees = [],
        array $xProps = []
    ) {
        $this->setAction($action ?? new AlarmAction("DISPLAY"))
            ->setAttendees($attendees)
            ->setXProps($xProps);
        $this->trigger = $trigger;
        $this->repeat = $repeat;
        $this->attach = $attach;
        if (null !== $description) {
            $this->setDescription($description);
        }
        if (null !== $summary) {
            $this->setSummary($summary);
        }
    }

    /**
     * Get action
     *
     * @return AlarmAction
     */
    public function getAction(): AlarmAction
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  AlarmAction $action
     * @return self
     */
    public function setAction(AlarmAction $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Get the trigger
     *
     * @return AlarmTriggerInfoInterface
     */
    public function getTrigger(): ?AlarmTriggerInfoInterface
    {
        return $this->trigger;
    }

    /**
     * Set the trigger
     *
     * @param  AlarmTriggerInfoInterface $trigger
     * @return self
     */
    public function setTrigger(AlarmTriggerInfoInterface $trigger): self
    {
        $this->trigger = $trigger;
        return $this;
    }

    /**
     * Get the repeat
     *
     * @return DurationInfoInterface
     */
    public function getRepeat(): ?DurationInfoInterface
    {
        return $this->repeat;
    }

    /**
     * Set the repeat
     *
     * @param  DurationInfoInterface $repeat
     * @return self
     */
    public function setRepeat(DurationInfoInterface $repeat): self
    {
        $this->repeat = $repeat;
        return $this;
    }

    /**
     * Get the description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the description
     *
     * @param  string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the attach
     *
     * @return CalendarAttachInterface
     */
    public function getAttach(): ?CalendarAttachInterface
    {
        return $this->attach;
    }

    /**
     * Set the attach
     *
     * @param  CalendarAttachInterface $attach
     * @return self
     */
    public function setAttach(CalendarAttachInterface $attach): self
    {
        $this->attach = $attach;
        return $this;
    }

    /**
     * Get the summary
     *
     * @return string
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * Set the summary
     *
     * @param  string $summary
     * @return self
     */
    public function setSummary(string $summary): self
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Add attendee
     *
     * @param  CalendarAttendeeInterface $attendee
     * @return self
     */
    public function addAttendee(CalendarAttendeeInterface $attendee): self
    {
        $this->attendees[] = $attendee;
        return $this;
    }

    /**
     * Set attendees
     *
     * @param  array $attendees
     * @return self
     */
    public function setAttendees(array $attendees): self
    {
        $this->attendees = array_filter(
            $attendees,
            static fn($attendee) => $attendee instanceof
                CalendarAttendeeInterface
        );
        return $this;
    }

    /**
     * Get attendees
     *
     * @return array
     */
    public function getAttendees(): array
    {
        return $this->attendees;
    }

    /**
     * Add xProp
     *
     * @param  XPropInterface $xProp
     * @return self
     */
    public function addXProp(XPropInterface $xProp): self
    {
        $this->xProps[] = $xProp;
        return $this;
    }

    /**
     * Set xProps
     *
     * @param  array $xProps
     * @return self
     */
    public function setXProps(array $xProps): self
    {
        $this->xProps = array_filter(
            $xProps,
            static fn($xProp) => $xProp instanceof XPropInterface
        );
        return $this;
    }

    /**
     * Get xProps
     *
     * @return array
     */
    public function getXProps(): array
    {
        return $this->xProps;
    }
}
