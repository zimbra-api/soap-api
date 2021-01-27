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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlList, XmlRoot};

use Zimbra\Struct\InviteComponentInterface;

/**
 * InviteComponent struct class
 * Invitation Component
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="inv")
 */
class InviteComponent extends InviteComponentCommon implements InviteComponentInterface
{
    /**
     * Categories - for iCalendar CATEGORY properties
     * @Accessor(getter="getCategories", setter="setCategories")
     * @SerializedName("category")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "category")
     */
    private $categories;

    /**
     * Comments - for iCalendar COMMENT properties
     * @Accessor(getter="getComments", setter="setComments")
     * @SerializedName("comment")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "comment")
     */
    private $comments;

    /**
     * Contacts - for iCalendar CONTACT properties
     * @Accessor(getter="getContacts", setter="setContacts")
     * @SerializedName("contact")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "contact")
     */
    private $contacts;

    /**
     * for iCalendar GEO property
     * @Accessor(getter="getGeo", setter="setGeo")
     * @SerializedName("geo")
     * @Type("Zimbra\Mail\Struct\GeoInfo")
     * @XmlElement
     */
    private $geo;

    /**
     * Attendees
     * @Accessor(getter="getAttendees", setter="setAttendees")
     * @SerializedName("at")
     * @Type("array<Zimbra\Mail\Struct\CalendarAttendee>")
     * @XmlList(inline = true, entry = "at")
     */
    private $attendees;

    /**
     * Alarm information
     * @Accessor(getter="getAlarms", setter="setAlarms")
     * @SerializedName("alarm")
     * @Type("array<Zimbra\Mail\Struct\AlarmInfo>")
     * @XmlList(inline = true, entry = "alarm")
     */
    private $alarms;

    /**
     * XPROP properties
     * @Accessor(getter="getXProps", setter="setXProps")
     * @SerializedName("xprop")
     * @Type("array<Zimbra\Mail\Struct\XProp>")
     * @XmlList(inline = true, entry = "xprop")
     */
    private $xProps;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $fragment;

    /**
     * Present if noBlob is set and invite has a plain text description
     * @Accessor(getter="getDescription", setter="setDescription")
     * @SerializedName("desc")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $description;

    /**
     * Present if noBlob is set and invite has an HTML description
     * @Accessor(getter="getHtmlDescription", setter="setHtmlDescription")
     * @SerializedName("descHtml")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $htmlDescription;

    /**
     * Organizer
     * @Accessor(getter="getOrganizer", setter="setOrganizer")
     * @SerializedName("or")
     * @Type("Zimbra\Mail\Struct\CalOrganizer")
     * @XmlElement
     */
    private $organizer;

    /**
     * Recurrence information
     * @Accessor(getter="getRecurrence", setter="setRecurrence")
     * @SerializedName("recur")
     * @Type("Zimbra\Mail\Struct\RecurrenceInfo")
     * @XmlElement
     */
    private $recurrence;

    /**
     * Recurrence id, if this is an exception
     * @Accessor(getter="getExceptionId", setter="setExceptionId")
     * @SerializedName("exceptId")
     * @Type("Zimbra\Mail\Struct\ExceptionRecurIdInfo")
     * @XmlElement
     */
    private $exceptionId;

    /**
     * Start date-time (required)
     * @Accessor(getter="getDtStart", setter="setDtStart")
     * @SerializedName("s")
     * @Type("Zimbra\Mail\Struct\DtTimeInfo")
     * @XmlElement
     */
    private $dtStart;

    /**
     * End date-time
     * @Accessor(getter="getDtEnd", setter="setDtEnd")
     * @SerializedName("e")
     * @Type("Zimbra\Mail\Struct\DtTimeInfo")
     * @XmlElement
     */
    private $dtEnd;

    /**
     * Duration
     * @Accessor(getter="getDuration", setter="setDuration")
     * @SerializedName("dur")
     * @Type("Zimbra\Mail\Struct\DurationInfo")
     * @XmlElement
     */
    private $duration;

    /**
     * Constructor method for InviteComponent
     * 
     * @param int $index
     * @param bool $negative
     * @param string $header
     * @return self
     */
    public function __construct(?int $index = NULL, ?bool $negative = NULL, ?string $header = NULL)
    {
    	parent::__construct($index, $negative);
        if (NULL !== $header) {
            $this->setHeader($header);
        }
    }

    /**
     * Gets header
     *
     * @return string
     */
    public function getHeader(): ?string
    {
        return $this->header;
    }

    /**
     * Sets header
     *
     * @param  string $header
     * @return self
     */
    public function setHeader(string $header)
    {
        $this->header = $header;
        return $this;
    }
}
