<?php declare(strict_types=1);
/**
 * This file is name of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Enum\MsgContent;
use Zimbra\Common\Struct\AttributeName;

/**
 * MsgSpec class
 * Message Specifications.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MsgSpec
{
    /**
     * Message ID.  Can contain a subpart identifier (e.g. "775-778") to return a message
     * stored as a subpart of some other mail-item, specifically for Messages stored as part of Appointments
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Supply a "part" and the retrieved data will be on the specified message/rfc822
     * subpart. If the part does not exist or is not a message/rfc822 part, mail.NO_SUCH_PART MailServiceException
     * will be thrown
     * 
     * @Accessor(getter="getPart", setter="setPart")
     * @SerializedName("part")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getPart', setter: 'setPart')]
    #[SerializedName('part')]
    #[Type('string')]
    #[XmlAttribute]
    private $part;

    /**
     * Set to return the raw message content rather than a parsed mime structure;
     * (default is unset.  if message is too big or not ASCII, a content servlet URL is returned)
     * 
     * @Accessor(getter="getRaw", setter="setRaw")
     * @SerializedName("raw")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getRaw', setter: 'setRaw')]
    #[SerializedName('raw')]
    #[Type('bool')]
    #[XmlAttribute]
    private $raw;

    /**
     * Set to mark the message as read, unset to leave the read status unchanged.
     * By default, the read status is left unchanged.
     * 
     * @Accessor(getter="getMarkRead", setter="setMarkRead")
     * @SerializedName("read")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getMarkRead', setter: 'setMarkRead')]
    #[SerializedName('read')]
    #[Type('bool')]
    #[XmlAttribute]
    private $markRead;

    /**
     * Use {max-inlined-length} to limit the length of the text inlined into body
     * bcontent>.
     * Only applicable when <raw> is unset. Ignored when <raw> is set.
     * (Default is unset, meaning no limit)
     * 
     * @Accessor(getter="getMaxInlinedLength", setter="setMaxInlinedLength")
     * @SerializedName("max")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getMaxInlinedLength', setter: 'setMaxInlinedLength')]
    #[SerializedName('max')]
    #[Type('int')]
    #[XmlAttribute]
    private $maxInlinedLength;

    /**
     * If set, never inline raw <content> for messages, specify by <url> instead.
     * Only applicable when <raw> is set.  <b>Ignored</b> when <raw> is unset.
     * (Default is unset - meaning inline content unless it is too big, in which case the <url> method will be used)
     * 
     * @Accessor(getter="getUseContentUrl", setter="setUseContentUrl")
     * @SerializedName("useContentUrl")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getUseContentUrl', setter: 'setUseContentUrl')]
    #[SerializedName('useContentUrl')]
    #[Type('bool')]
    #[XmlAttribute]
    private $useContentUrl;

    /**
     * Set to return defanged HTML content by default.  (default is unset.)
     * 
     * @Accessor(getter="getWantHtml", setter="setWantHtml")
     * @SerializedName("html")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getWantHtml', setter: 'setWantHtml')]
    #[SerializedName('html')]
    #[Type('bool')]
    #[XmlAttribute]
    private $wantHtml;

    /**
     * Set to return IMAP UID.  (default is unset.)
     * 
     * @Accessor(getter="getWantImapUid", setter="setWantImapUid")
     * @SerializedName("wantImapUid")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getWantImapUid', setter: 'setWantImapUid')]
    #[SerializedName('wantImapUid')]
    #[Type('bool')]
    #[XmlAttribute]
    private $wantImapUid;

    /**
     * Set to return Modified Sequence.  (default is unset.)
     * 
     * @Accessor(getter="getWantModifiedSequence", setter="setWantModifiedSequence")
     * @SerializedName("wantModSeq")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getWantModifiedSequence', setter: 'setWantModifiedSequence')]
    #[SerializedName('wantModSeq')]
    #[Type('bool')]
    #[XmlAttribute]
    private $wantModifiedSequence;

    /**
     * Set to "neuter" <IMG> tags returned in HTML content; this involves
     * switching the <src> attribute to <dfsrc> so that images don't display by default (default is set.)
     * 
     * @Accessor(getter="getNeuter", setter="setNeuter")
     * @SerializedName("neuter")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getNeuter', setter: 'setNeuter')]
    #[SerializedName('neuter')]
    #[Type('bool')]
    #[XmlAttribute]
    private $neuter;

    /**
     * Recurrence ID in format YYYYMMDD[ThhmmssZ].  Used only when making GetMsg call
     * to open an instance of a recurring appointment.  The value specified is the date/time data of the
     * RECURRENCE-ID of the instance being requested.
     * 
     * @Accessor(getter="getRecurIdZ", setter="setRecurIdZ")
     * @SerializedName("ridZ")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getRecurIdZ', setter: 'setRecurIdZ')]
    #[SerializedName('ridZ')]
    #[Type('string')]
    #[XmlAttribute]
    private $recurIdZ;

    /**
     * Set to return group info (isGroup and exp flags) on <e> elements in the
     * response (default is unset.)
     * 
     * @Accessor(getter="getNeedCanExpand", setter="setNeedCanExpand")
     * @SerializedName("needExp")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getNeedCanExpand', setter: 'setNeedCanExpand')]
    #[SerializedName('needExp')]
    #[Type('bool')]
    #[XmlAttribute]
    private $needCanExpand;

    /**
     * wantContent = "full" to get the complete message along with the quoted content
     * wantContent = "original" to get the message without quoted content
     * wantContent = "both" to get complete message as well as the message without quoted content
     * By default wantContent = "full"
     * Only applicable when <raw> is unset.
     * Note: Quoted text identification is a best effort. It is not supported by any RFCs
     * 
     * @Accessor(getter="getWantContent", setter="setWantContent")
     * @SerializedName("wantContent")
     * @Type("Enum<Zimbra\Common\Enum\MsgContent>")
     * @XmlAttribute
     * 
     * @var MsgContent
     */
    #[Accessor(getter: 'getWantContent', setter: 'setWantContent')]
    #[SerializedName('wantContent')]
    #[Type('Enum<Zimbra\Common\Enum\MsgContent>')]
    #[XmlAttribute]
    private ?MsgContent $wantContent;

    /**
     * Requested headers.  if <header>s are requested, any matching headers are
     * inlined into the response (not available when raw is set)
     * 
     * @Accessor(getter="getHeaders", setter="setHeaders")
     * @Type("array<Zimbra\Common\Struct\AttributeName>")
     * @XmlList(inline=true, entry="header", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getHeaders', setter: 'setHeaders')]
    #[Type('array<Zimbra\Common\Struct\AttributeName>')]
    #[XmlList(inline: true, entry: 'header', namespace: 'urn:zimbraMail')]
    private $headers = [];

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $part
     * @param  bool $raw
     * @param  bool $markRead
     * @param  int $maxInlinedLength
     * @param  bool $useContentUrl
     * @param  bool $wantHtml
     * @param  bool $wantImapUid
     * @param  bool $wantModifiedSequence
     * @param  bool $neuter
     * @param  string $recurIdZ
     * @param  bool $needCanExpand
     * @param  MsgContent $wantContent
     * @param  array $headers
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?string $part = NULL,
        ?bool $raw = NULL,
        ?bool $markRead = NULL,
        ?int $maxInlinedLength = NULL,
        ?bool $useContentUrl = NULL,
        ?bool $wantHtml = NULL,
        ?bool $wantImapUid = NULL,
        ?bool $wantModifiedSequence = NULL,
        ?bool $neuter = NULL,
        ?string $recurIdZ = NULL,
        ?bool $needCanExpand = NULL,
        ?MsgContent $wantContent = NULL,
        array $headers = []
    )
    {
        $this->setHeaders($headers);
        $this->wantContent = $wantContent;
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $part) {
            $this->setPart($part);
        }
        if (NULL !== $raw) {
            $this->setRaw($raw);
        }
        if (NULL !== $markRead) {
            $this->setMarkRead($markRead);
        }
        if (NULL !== $maxInlinedLength) {
            $this->setMaxInlinedLength($maxInlinedLength);
        }
        if (NULL !== $useContentUrl) {
            $this->setUseContentUrl($useContentUrl);
        }
        if (NULL !== $wantHtml) {
            $this->setWantHtml($wantHtml);
        }
        if (NULL !== $wantImapUid) {
            $this->setWantImapUid($wantImapUid);
        }
        if (NULL !== $wantModifiedSequence) {
            $this->setWantModifiedSequence($wantModifiedSequence);
        }
        if (NULL !== $neuter) {
            $this->setNeuter($neuter);
        }
        if (NULL !== $recurIdZ) {
            $this->setRecurIdZ($recurIdZ);
        }
        if (NULL !== $needCanExpand) {
            $this->setNeedCanExpand($needCanExpand);
        }
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get part
     *
     * @return string
     */
    public function getPart(): ?string
    {
        return $this->part;
    }

    /**
     * Set part
     *
     * @param  string $part
     * @return self
     */
    public function setPart(string $part): self
    {
        $this->part = $part;
        return $this;
    }

    /**
     * Get raw
     *
     * @return bool
     */
    public function getRaw(): ?bool
    {
        return $this->raw;
    }

    /**
     * Set raw
     *
     * @param  bool $raw
     * @return self
     */
    public function setRaw(bool $raw): self
    {
        $this->raw = $raw;
        return $this;
    }

    /**
     * Get markRead
     *
     * @return bool
     */
    public function getMarkRead(): ?bool
    {
        return $this->markRead;
    }

    /**
     * Set markRead
     *
     * @param  bool $markRead
     * @return self
     */
    public function setMarkRead(bool $markRead): self
    {
        $this->markRead = $markRead;
        return $this;
    }

    /**
     * Get wantHtml
     *
     * @return bool
     */
    public function getWantHtml(): ?bool
    {
        return $this->wantHtml;
    }

    /**
     * Set wantHtml
     *
     * @param  bool $wantHtml
     * @return self
     */
    public function setWantHtml(bool $wantHtml): self
    {
        $this->wantHtml = $wantHtml;
        return $this;
    }

    /**
     * Get wantImapUid
     *
     * @return bool
     */
    public function getWantImapUid(): ?bool
    {
        return $this->wantImapUid;
    }

    /**
     * Set wantImapUid
     *
     * @param  bool $wantImapUid
     * @return self
     */
    public function setWantImapUid(bool $wantImapUid): self
    {
        $this->wantImapUid = $wantImapUid;
        return $this;
    }

    /**
     * Get wantModifiedSequence
     *
     * @return bool
     */
    public function getWantModifiedSequence(): ?bool
    {
        return $this->wantModifiedSequence;
    }

    /**
     * Set wantModifiedSequence
     *
     * @param  bool $wantModifiedSequence
     * @return self
     */
    public function setWantModifiedSequence(bool $wantModifiedSequence): self
    {
        $this->wantModifiedSequence = $wantModifiedSequence;
        return $this;
    }

    /**
     * Get neuter
     *
     * @return bool
     */
    public function getNeuter(): ?bool
    {
        return $this->neuter;
    }

    /**
     * Set neuter
     *
     * @param  bool $neuter
     * @return self
     */
    public function setNeuter(bool $neuter): self
    {
        $this->neuter = $neuter;
        return $this;
    }

    /**
     * Get recurIdZ
     *
     * @return string
     */
    public function getRecurIdZ(): ?string
    {
        return $this->recurIdZ;
    }

    /**
     * Set recurIdZ
     *
     * @param  string $recurIdZ
     * @return self
     */
    public function setRecurIdZ(string $recurIdZ): self
    {
        $this->recurIdZ = $recurIdZ;
        return $this;
    }

    /**
     * Get maxInlinedLength
     *
     * @return int
     */
    public function getMaxInlinedLength(): ?int
    {
        return $this->maxInlinedLength;
    }

    /**
     * Set maxInlinedLength
     *
     * @param  int $maxInlinedLength
     * @return self
     */
    public function setMaxInlinedLength(int $maxInlinedLength): self
    {
        $this->maxInlinedLength = $maxInlinedLength;
        return $this;
    }

    /**
     * Get useContentUrl
     *
     * @return bool
     */
    public function getUseContentUrl(): ?bool
    {
        return $this->useContentUrl;
    }

    /**
     * Set useContentUrl
     *
     * @param  bool $useContentUrl
     * @return self
     */
    public function setUseContentUrl(bool $useContentUrl): self
    {
        $this->useContentUrl = $useContentUrl;
        return $this;
    }

    /**
     * Get needCanExpand
     *
     * @return bool
     */
    public function getNeedCanExpand(): ?bool
    {
        return $this->needCanExpand;
    }

    /**
     * Set needCanExpand
     *
     * @param  bool $needCanExpand
     * @return self
     */
    public function setNeedCanExpand(bool $needCanExpand): self
    {
        $this->needCanExpand = $needCanExpand;
        return $this;
    }

    /**
     * Get wantContent
     *
     * @return MsgContent
     */
    public function getWantContent(): ?MsgContent
    {
        return $this->wantContent;
    }

    /**
     * Set wantContent
     *
     * @param  MsgContent $wantContent
     * @return self
     */
    public function setWantContent(MsgContent $wantContent): self
    {
        $this->wantContent = $wantContent;
        return $this;
    }

    /**
     * Set headers
     *
     * @param  array $headers
     * @return self
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = array_filter($headers, static fn ($header) => $header instanceof AttributeName);
        return $this;
    }

    /**
     * Get headers
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Add header
     *
     * @param  AttributeName $header
     * @return self
     */
    public function addHeader(AttributeName $header): self
    {
        $this->headers[] = $header;
        return $this;
    }
}
