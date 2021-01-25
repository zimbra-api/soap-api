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
     * @Accessor(getter="getHeader", setter="setHeader")
     * @SerializedName("category")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "category")
     */
    private $categories;

    /**
     * Comments - for iCalendar COMMENT properties
     * @Accessor(getter="getHeader", setter="setHeader")
     * @SerializedName("comment")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "comment")
     */
    private $comments;

    /**
     * Contacts - for iCalendar CONTACT properties
     * @Accessor(getter="getHeader", setter="setHeader")
     * @SerializedName("contact")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "contact")
     */
    private $contacts;

    /**
     * for iCalendar GEO property
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("geo")
     * @Type("Zimbra\Mail\Struct\GeoInfo")
     * @XmlElement
     */
    private $geo;

    /**
     * Attendees
     * @Accessor(getter="getHeader", setter="setHeader")
     * @SerializedName("at")
     * @Type("array<Zimbra\Mail\Struct\CalendarAttendee>")
     * @XmlList(inline = true, entry = "at")
     */
    private $attendees;

    /**
     * Alarm information
     * @Accessor(getter="getHeader", setter="setHeader")
     * @SerializedName("alarm")
     * @Type("array<Zimbra\Mail\Struct\AlarmInfo>")
     * @XmlList(inline = true, entry = "alarm")
     */
    private $alarms;

    /**
     * XPROP properties
     * @Accessor(getter="getHeader", setter="setHeader")
     * @SerializedName("xprop")
     * @Type("array<Zimbra\Mail\Struct\XProp>")
     * @XmlList(inline = true, entry = "xprop")
     */
    private $xProps;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $fragment;

    /**
     * Present if noBlob is set and invite has a plain text description
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("desc")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $description;

    /**
     * Present if noBlob is set and invite has an HTML description
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("descHtml")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $htmlDescription;

    /**
     * Organizer
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("or")
     * @Type("Zimbra\Mail\Struct\CalOrganizer")
     * @XmlElement
     */
    private $organizer;

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
