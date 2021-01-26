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
use Zimbra\Enum\AlarmAction;
use Zimbra\Struct\AlarmInfoInterface;
use Zimbra\Struct\AlarmTriggerInfoInterface;
use Zimbra\Struct\CalendarAttachInterface;
use Zimbra\Struct\CalendarAttendeeInterface;
use Zimbra\Struct\DurationInfoInterface;
use Zimbra\Struct\XPropInterface;

/**
 * AlarmInfo class
 * Alarm information
 *
 * @package   Zimbra
 * @subpackage Mail
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="alarm")
 */
class AlarmInfo implements AlarmInfoInterface
{
    /**
     * Alarm action
     * Possible values: DISPLAY|AUDIO|EMAIL|PROCEDURE|X_YAHOO_CALENDAR_ACTION_IM|X_YAHOO_CALENDAR_ACTION_MOBILE
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Enum\AlarmAction")
     * @XmlAttribute
     */
    private $action;

    /**
     * Alarm trigger information
     * @Accessor(getter="getTrigger", setter="setTrigger")
     * @SerializedName("trigger")
     * @Type("Zimbra\Mail\Struct\AlarmTriggerInfo")
     * @XmlElement
     */
    private $trigger;

    /**
     * Alarm repeat information
     * @Accessor(getter="getRepeat", setter="setRepeat")
     * @SerializedName("repeat")
     * @Type("Zimbra\Mail\Struct\DurationInfo")
     * @XmlElement
     */
    private $repeat;

    /**
     * Alarm description
     * action=DISPLAY: Reminder text to display
     * action=EMAIL|X_YAHOO_CALENDAR_ACTION_IM|X_YAHOO_CALENDAR_ACTION_MOBILE: EMail body
     * action=PROCEDURE: Description text
     * @Accessor(getter="getDescription", setter="setDescription")
     * @SerializedName("desc")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $description;

    /**
     * Information on attachment
     * @Accessor(getter="getAttach", setter="setAttach")
     * @SerializedName("attach")
     * @Type("Zimbra\Mail\Struct\CalendarAttach")
     * @XmlElement
     */
    private $attach;

    /**
     * Alarm summary
     * @Accessor(getter="getSummary", setter="setSummary")
     * @SerializedName("summary")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $summary;

    /**
     * Attendee information
     * @Accessor(getter="getAttendees", setter="setAttendees")
     * @SerializedName("at")
     * @Type("array<Zimbra\Mail\Struct\CalendarAttendee>")
     * @XmlList(inline = true, entry = "at")
     */
    private $attendees;

    /**
     * Non-standard properties (see RFC2445 section 4.8.8.1)
     * @Accessor(getter="getXProps", setter="setXProps")
     * @SerializedName("xprop")
     * @Type("array<Zimbra\Mail\Struct\XProp>")
     * @XmlList(inline = true, entry = "xprop")
     */
    private $xProps;

    /**
     * Constructor method for AlarmInfo
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
        AlarmAction $action,
        ?AlarmTriggerInfo $trigger = NULL,
        ?DurationInfo $repeat = NULL,
        ?string $description = NULL,
        ?CalendarAttach $attach = NULL,
        ?string $summary = NULL,
        array $attendees = [],
        array $xProps = []
    )
    {
        $this->setAction($action)
             ->setAttendees($attendees)
             ->setXProps($xProps);
        if ($trigger instanceof AlarmTriggerInfo) {
            $this->setTrigger($trigger);
        }
        if ($repeat instanceof DurationInfo) {
            $this->setRepeat($repeat);
        }
        if (NULL !== $description) {
            $this->setDescription($description);
        }
        if ($attach instanceof CalendarAttach) {
            $this->setAttach($attach);
        }
        if (NULL !== $summary) {
            $this->setSummary($summary);
        }
    }

    /**
     * Gets action
     *
     * @return AlarmAction
     */
    public function getAction(): AlarmAction
    {
        return $this->action;
    }

    /**
     * Sets action
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
     * Gets the trigger
     *
     * @return AlarmTriggerInfoInterface
     */
    public function getTrigger(): ?AlarmTriggerInfoInterface
    {
        return $this->trigger;
    }

    /**
     * Sets the trigger
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
     * Gets the repeat
     *
     * @return DurationInfoInterface
     */
    public function getRepeat(): ?DurationInfoInterface
    {
        return $this->repeat;
    }

    /**
     * Sets the repeat
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
     * Gets the description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Sets the description
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
     * Gets the attach
     *
     * @return CalendarAttachInterface
     */
    public function getAttach(): ?CalendarAttachInterface
    {
        return $this->attach;
    }

    /**
     * Sets the attach
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
     * Gets the summary
     *
     * @return string
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * Sets the summary
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
        $this->attendees = [];
        foreach ($attendees as $attendee) {
            if ($attendee instanceof CalendarAttendeeInterface) {
                $this->attendees[] = $attendee;
            }
        }
        return $this;
    }

    /**
     * Gets attendees
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
        $this->xProps = [];
        foreach ($xProps as $xProp) {
            if ($xProp instanceof XPropInterface) {
                $this->xProps[] = $xProp;
            }
        }
        return $this;
    }

    /**
     * Gets xProps
     *
     * @return array
     */
    public function getXProps(): array
    {
        return $this->xProps;
    }
}
