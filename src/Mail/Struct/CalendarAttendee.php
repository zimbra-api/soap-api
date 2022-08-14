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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Enum\ParticipationStatus as PartStat;
use Zimbra\Common\Struct\{CalendarAttendeeInterface, XParamInterface};

/**
 * CalendarAttendee struct class
 * Calendar attendee information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CalendarAttendee implements CalendarAttendeeInterface
{
    /**
     * Email address (without "MAILTO:")
     * 
     * @Accessor(getter="getAddress", setter="setAddress")
     * @SerializedName("a")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getAddress', setter: 'setAddress')]
    #[SerializedName(name: 'a')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $address;

    /**
     * URL - has same value as email-address.
     * 
     * @Accessor(getter="getUrl", setter="setUrl")
     * @SerializedName("url")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getUrl', setter: 'setUrl')]
    #[SerializedName(name: 'url')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $url;

    /**
     * Friendly name - "CN" in iCalendar
     * 
     * @Accessor(getter="getDisplayName", setter="setDisplayName")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getDisplayName', setter: 'setDisplayName')]
    #[SerializedName(name: 'd')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $displayName;

    /**
     * iCalendar SENT-BY
     * 
     * @Accessor(getter="getSentBy", setter="setSentBy")
     * @SerializedName("sentBy")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getSentBy', setter: 'setSentBy')]
    #[SerializedName(name: 'sentBy')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $sentBy;

    /**
     * iCalendar DIR - Reference to a directory entry associated with the calendar user. the property.
     * 
     * @Accessor(getter="getDir", setter="setDir")
     * @SerializedName("dir")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getDir', setter: 'setDir')]
    #[SerializedName(name: 'dir')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $dir;

    /**
     * iCalendar LANGUAGE - As defined in RFC5646 * (e.g. "en-US")
     * 
     * @Accessor(getter="getLanguage", setter="setLanguage")
     * @SerializedName("lang")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getLanguage', setter: 'setLanguage')]
    #[SerializedName(name: 'lang')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $language;

    /**
     * iCalendar CUTYPE (Calendar user type)
     * 
     * @Accessor(getter="getCuType", setter="setCuType")
     * @SerializedName("cutype")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getCuType', setter: 'setCuType')]
    #[SerializedName(name: 'cutype')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $cuType;

    /**
     * iCalendar ROLE
     * 
     * @Accessor(getter="getRole", setter="setRole")
     * @SerializedName("role")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getRole', setter: 'setRole')]
    #[SerializedName(name: 'role')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $role;

    /**
     * iCalendar PTST (Participation status)
     * Valid values - NE|AC|TE|DE|DG|CO|IN|WE|DF
     * Meanings: 
     * "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo),
     * "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     * 
     * @Accessor(getter="getPartStat", setter="setPartStat")
     * @SerializedName("ptst")
     * @Type("Enum<Zimbra\Common\Enum\ParticipationStatus>")
     * @XmlAttribute
     * 
     * @var PartStat
     */
    #[Accessor(getter: 'getPartStat', setter: 'setPartStat')]
    #[SerializedName(name: 'ptst')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\ParticipationStatus>')]
    #[XmlAttribute]
    private $partStat;

    /**
     * RSVP flag.  Set if response requested, unset if no response requested
     * @Accessor(getter="getRsvp", setter="setRsvp")
     * @SerializedName("rsvp")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getRsvp', setter: 'setRsvp')]
    #[SerializedName(name: 'rsvp')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $rsvp;

    /**
     * iCalendar MEMBER - The group or list membership of the calendar user
     * 
     * @Accessor(getter="getMember", setter="setMember")
     * @SerializedName("member")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getMember', setter: 'setMember')]
    #[SerializedName(name: 'member')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $member;

    /**
     * iCalendar DELEGATED-TO
     * 
     * @Accessor(getter="getDelegatedTo", setter="setDelegatedTo")
     * @SerializedName("delegatedTo")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getDelegatedTo', setter: 'setDelegatedTo')]
    #[SerializedName(name: 'delegatedTo')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $delegatedTo;

    /**
     * iCalendar DELEGATED-FROM
     * 
     * @Accessor(getter="getDelegatedFrom", setter="setDelegatedFrom")
     * @SerializedName("delegatedFrom")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getDelegatedFrom', setter: 'setDelegatedFrom')]
    #[SerializedName(name: 'delegatedFrom')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $delegatedFrom;

    /**
     * Non-standard parameters (XPARAMs)
     * 
     * @Accessor(getter="getXParams", setter="setXParams")
     * @Type("array<Zimbra\Mail\Struct\XParam>")
     * @XmlList(inline=true, entry="xparam", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: "getXParams", setter: "setXParams")]
    #[Type(name: 'array<Zimbra\Mail\Struct\XParam>')]
    #[XmlList(inline: true, entry: "xparam", namespace: 'urn:zimbraMail')]
    private $xParams;

    /**
     * Constructor
     *
     * @param string $attendeeEmail
     * @param string $attendeeName
     * @param string $role
     * @param PartStat $partStat
     * @param bool $rsvp
     * @param array $xParams
     * @return self
     */
    public function __construct(
        ?string $attendeeEmail = NULL,
        ?string $attendeeName = NULL,
        ?string $role = NULL,
        ?PartStat $partStat = NULL,
        ?bool $rsvp = NULL,
        array $xParams = []
    )
    {
        $this->setXParams($xParams);
        if (NULL !== $attendeeEmail) {
            $this->setAddress($attendeeEmail);
        }
        if (NULL !== $attendeeName) {
            $this->setDisplayName($attendeeName);
        }
        if (NULL !== $role) {
            $this->setRole($role);
        }
        if ($partStat instanceof PartStat) {
            $this->setPartStat($partStat);
        }
        if (NULL !== $rsvp) {
            $this->setRsvp($rsvp);
        }
    }

    /**
     * Get the address
     *
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Set the address
     *
     * @param  string $address
     * @return self
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get the url
     *
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Set the url
     *
     * @param  string $url
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get the displayName
     *
     * @return string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Set the displayName
     *
     * @param  string $displayName
     * @return self
     */
    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Get the sentBy
     *
     * @return string
     */
    public function getSentBy(): ?string
    {
        return $this->sentBy;
    }

    /**
     * Set the sentBy
     *
     * @param  string $sentBy
     * @return self
     */
    public function setSentBy(string $sentBy): self
    {
        $this->sentBy = $sentBy;
        return $this;
    }

    /**
     * Get the dir
     *
     * @return string
     */
    public function getDir(): ?string
    {
        return $this->dir;
    }

    /**
     * Set the dir
     *
     * @param  string $dir
     * @return self
     */
    public function setDir(string $dir): self
    {
        $this->dir = $dir;
        return $this;
    }

    /**
     * Get the language
     *
     * @return string
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * Set the language
     *
     * @param  string $language
     * @return self
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Get the cuType
     *
     * @return string
     */
    public function getCuType(): ?string
    {
        return $this->cuType;
    }

    /**
     * Set the cuType
     *
     * @param  string $cuType
     * @return self
     */
    public function setCuType(string $cuType): self
    {
        $this->cuType = $cuType;
        return $this;
    }

    /**
     * Get the role
     *
     * @return string
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * Set the role
     *
     * @param  string $role
     * @return self
     */
    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get the partStat
     *
     * @return PartStat
     */
    public function getPartStat(): ?PartStat
    {
        return $this->partStat;
    }

    /**
     * Set the partStat
     *
     * @param  PartStat $partStat
     * @return self
     */
    public function setPartStat(PartStat $partStat): self
    {
        $this->partStat = $partStat;
        return $this;
    }

    /**
     * Get the rsvp
     *
     * @return bool
     */
    public function getRsvp(): ?bool
    {
        return $this->rsvp;
    }

    /**
     * Set the rsvp
     *
     * @param  bool $rsvp
     * @return self
     */
    public function setRsvp(bool $rsvp): self
    {
        $this->rsvp = $rsvp;
        return $this;
    }

    /**
     * Get the member
     *
     * @return string
     */
    public function getMember(): ?string
    {
        return $this->member;
    }

    /**
     * Set the member
     *
     * @param  string $member
     * @return self
     */
    public function setMember(string $member): self
    {
        $this->member = $member;
        return $this;
    }

    /**
     * Get the delegatedTo
     *
     * @return string
     */
    public function getDelegatedTo(): ?string
    {
        return $this->delegatedTo;
    }

    /**
     * Set the delegatedTo
     *
     * @param  string $delegatedTo
     * @return self
     */
    public function setDelegatedTo(string $delegatedTo): self
    {
        $this->delegatedTo = $delegatedTo;
        return $this;
    }

    /**
     * Get the delegatedFrom
     *
     * @return string
     */
    public function getDelegatedFrom(): ?string
    {
        return $this->delegatedFrom;
    }

    /**
     * Set the delegatedFrom
     *
     * @param  string $delegatedFrom
     * @return self
     */
    public function setDelegatedFrom(string $delegatedFrom): self
    {
        $this->delegatedFrom = $delegatedFrom;
        return $this;
    }

    /**
     * Add xParam
     *
     * @param  XParamInterface $xParam
     * @return self
     */
    public function addXParam(XParamInterface $xParam): self
    {
        $this->xParams[] = $xParam;
        return $this;
    }

    /**
     * Set xParams
     *
     * @param  array $xParams
     * @return self
     */
    public function setXParams(array $xParams): self
    {
        $this->xParams = array_filter($xParams, static fn ($xParam) => $xParam instanceof XParamInterface);
        return $this;
    }

    /**
     * Get xParams
     *
     * @return array
     */
    public function getXParams(): array
    {
        return $this->xParams;
    }
}
