<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Mail\Struct\{CalReply, SetCalendarItemInfo};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SetAppointmentRequest class
 * Directly set status of an entire appointment.  This API is intended for mailbox
 * Migration (ie migrating a mailbox onto this server) and is not used by normal mail clients.
 * Need to specify folder for appointment
 * Need way to add message WITHOUT processing it for calendar parts.
 * Need to generate and patch-in the iCalendar for the <inv> but w/o actually processing the
 * <inv> as a new request
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SetAppointmentRequest extends SoapRequest
{
    /**
     * Flags
     * 
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getFlags', setter: 'setFlags')]
    #[SerializedName(name: 'f')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $flags;

    /**
     * Tags (Deprecated - use <b>{tag-names}</b> instead)
     * 
     * @Accessor(getter="getTags", setter="setTags")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getTags', setter: 'setTags')]
    #[SerializedName(name: 't')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $tags;

    /**
     * Comma separated list of tag names
     * 
     * @Accessor(getter="getTagNames", setter="setTagNames")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getTagNames', setter: 'setTagNames')]
    #[SerializedName(name: 'tn')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $tagNames;

    /**
     * ID of folder to create appointment in
     * 
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolderId', setter: 'setFolderId')]
    #[SerializedName(name: 'l')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $folderId;

    /**
     * Set if all alarms have been dismissed; if this is set, nextAlarm should not be set
     * 
     * @Accessor(getter="getNoNextAlarm", setter="setNoNextAlarm")
     * @SerializedName("noNextAlarm")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getNoNextAlarm', setter: 'setNoNextAlarm')]
    #[SerializedName(name: 'noNextAlarm')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $noNextAlarm;

    /**
     * If specified, time when next alarm should go off.
     * If missing, two possibilities:
     * - if noNextAlarm isn't set, keep current next alarm time (this is a backward compatibility case)
     * - if noNextAlarm is set, indicates all alarms have been dismissed
     * 
     * @Accessor(getter="getNextAlarm", setter="setNextAlarm")
     * @SerializedName("nextAlarm")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getNextAlarm', setter: 'setNextAlarm')]
    #[SerializedName(name: 'nextAlarm')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $nextAlarm;

    /**
     * Default calendar item information
     * 
     * @Accessor(getter="getDefaultId", setter="setDefaultId")
     * @SerializedName("default")
     * @Type("Zimbra\Mail\Struct\SetCalendarItemInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var SetCalendarItemInfo
     */
    #[Accessor(getter: "getDefaultId", setter: "setDefaultId")]
    #[SerializedName(name: 'default')]
    #[Type(name: SetCalendarItemInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $defaultId;

    /**
     * Calendar item information for exceptions
     * 
     * @Accessor(getter="getExceptions", setter="setExceptions")
     * @Type("array<Zimbra\Mail\Struct\SetCalendarItemInfo>")
     * @XmlList(inline=true, entry="except", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getExceptions', setter: 'setExceptions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\SetCalendarItemInfo>')]
    #[XmlList(inline: true, entry: 'except', namespace: 'urn:zimbraMail')]
    private $exceptions = [];

    /**
     * Calendar item information for cancellations
     * 
     * @Accessor(getter="getCancellations", setter="setCancellations")
     * @Type("array<Zimbra\Mail\Struct\SetCalendarItemInfo>")
     * @XmlList(inline=true, entry="cancel", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getCancellations', setter: 'setCancellations')]
    #[Type(name: 'array<Zimbra\Mail\Struct\SetCalendarItemInfo>')]
    #[XmlList(inline: true, entry: 'cancel', namespace: 'urn:zimbraMail')]
    private $cancellations = [];

    /**
     * List of replies received from attendees.  If SetAppointmenRequest doesn't contain
     * a <replies> block, existing replies will be kept.  If <replies> element is provided with
     * no <reply> elements inside, existing replies will be removed, replaced with an empty set.
     * If <replies> contains one or more <reply> elements, existing replies are replaced with the
     * ones provided.
     * 
     * @Accessor(getter="getReplies", setter="setReplies")
     * @SerializedName("replies")
     * @Type("array<Zimbra\Mail\Struct\CalReply>")
     * @XmlElement(namespace="urn:zimbraMail")
     * @XmlList(inline=false, entry="reply", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getReplies', setter: 'setReplies')]
    #[SerializedName(name: 'replies')]
    #[Type(name: 'array<Zimbra\Mail\Struct\CalReply>')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    #[XmlList(inline: false, entry: 'reply', namespace: 'urn:zimbraMail')]
    private $replies = [];

    /**
     * Constructor
     *
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  string $folderId
     * @param  bool $noNextAlarm
     * @param  int $nextAlarm
     * @param  SetCalendarItemInfo $defaultId
     * @param  array $exceptions
     * @param  array $cancellations
     * @param  array $replies
     * @return self
     */
    public function __construct(
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?string $folderId = NULL,
        ?bool $noNextAlarm = NULL,
        ?int $nextAlarm = NULL,
        ?SetCalendarItemInfo $defaultId = NULL,
        array $exceptions = [],
        array $cancellations = [],
        array $replies = []
    )
    {
        $this->setExceptions($exceptions)
             ->setCancellations($cancellations)
             ->setReplies($replies);
        if (NULL !== $flags) {
            $this->setFlags($flags);
        }
        if (NULL !== $tags) {
            $this->setTags($tags);
        }
        if (NULL !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (NULL !== $noNextAlarm) {
            $this->setNoNextAlarm($noNextAlarm);
        }
        if (NULL !== $nextAlarm) {
            $this->setNextAlarm($nextAlarm);
        }
        if ($defaultId instanceof SetCalendarItemInfo) {
            $this->setDefaultId($defaultId);
        }
    }

    /**
     * Get flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Set flags
     *
     * @param  string $flags
     * @return self
     */
    public function setFlags(string $flags): self
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * Set tags
     *
     * @param  string $tags
     * @return self
     */
    public function setTags(string $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Get tagNames
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Set tagNames
     *
     * @param  string $tagNames
     * @return self
     */
    public function setTagNames(string $tagNames): self
    {
        $this->tagNames = $tagNames;
        return $this;
    }

    /**
     * Get folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Set folderId
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId(string $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Get noNextAlarm
     *
     * @return bool
     */
    public function getNoNextAlarm(): ?bool
    {
        return $this->noNextAlarm;
    }

    /**
     * Set noNextAlarm
     *
     * @param  bool $noNextAlarm
     * @return self
     */
    public function setNoNextAlarm(bool $noNextAlarm): self
    {
        $this->noNextAlarm = $noNextAlarm;
        return $this;
    }

    /**
     * Get nextAlarm
     *
     * @return int
     */
    public function getNextAlarm(): ?int
    {
        return $this->nextAlarm;
    }

    /**
     * Set nextAlarm
     *
     * @param  int $nextAlarm
     * @return self
     */
    public function setNextAlarm(int $nextAlarm): self
    {
        $this->nextAlarm = $nextAlarm;
        return $this;
    }

    /**
     * Get defaultId
     *
     * @return SetCalendarItemInfo
     */
    public function getDefaultId(): ?SetCalendarItemInfo
    {
        return $this->defaultId;
    }

    /**
     * Set defaultId
     *
     * @param  SetCalendarItemInfo $defaultId
     * @return self
     */
    public function setDefaultId(SetCalendarItemInfo $defaultId): self
    {
        $this->defaultId = $defaultId;
        return $this;
    }

    /**
     * Add exception
     *
     * @param  SetCalendarItemInfo $except
     * @return self
     */
    public function addException(SetCalendarItemInfo $except): self
    {
        $this->exceptions[] = $except;
        return $this;
    }

    /**
     * Set exceptions
     *
     * @param  array $exceptions
     * @return self
     */
    public function setExceptions(array $exceptions): self
    {
        $this->exceptions = array_filter($exceptions, static fn ($except) => $except instanceof SetCalendarItemInfo);
        return $this;
    }

    /**
     * Get exceptions
     *
     * @return array
     */
    public function getExceptions(): array
    {
        return $this->exceptions;
    }

    /**
     * Add cancellation
     *
     * @param  SetCalendarItemInfo $cancel
     * @return self
     */
    public function addCancellation(SetCalendarItemInfo $cancel): self
    {
        $this->cancellations[] = $cancel;
        return $this;
    }

    /**
     * Set cancellations
     *
     * @param  array $cancellations
     * @return self
     */
    public function setCancellations(array $cancellations): self
    {
        $this->cancellations = array_filter($cancellations, static fn ($cancel) => $cancel instanceof SetCalendarItemInfo);
        return $this;
    }

    /**
     * Get cancellations
     *
     * @return array
     */
    public function getCancellations(): array
    {
        return $this->cancellations;
    }

    /**
     * Add reply
     *
     * @param  CalReply $reply
     * @return self
     */
    public function addReply(CalReply $reply): self
    {
        $this->replies[] = $reply;
        return $this;
    }

    /**
     * Set replies
     *
     * @param  array $replies
     * @return self
     */
    public function setReplies(array $replies): self
    {
        $this->replies = array_filter($replies, static fn ($reply) => $reply instanceof CalReply);
        return $this;
    }

    /**
     * Get replies
     *
     * @return array
     */
    public function getReplies(): array
    {
        return $this->replies;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SetAppointmentEnvelope(
            new SetAppointmentBody($this)
        );
    }
}
