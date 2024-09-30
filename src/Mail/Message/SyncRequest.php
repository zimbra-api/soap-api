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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SyncRequest class
 * Sync
 * Sync on other mailbox is done via specifying target account in SOAP header
 * If we're delta syncing on another user's mailbox and any folders have changed:
 * - If there are now no visible folders, you'll get an empty <folder> element
 * - If there are any visible folders, you'll get the full visible folder hierarchy
 * If a {root-folder-id} other than the mailbox root (folder 1) is requested or if not all folders are visible
 * when syncing to another user's mailbox, all changed items in other folders are presented as deletes
 * If the response is a mail.MUST_RESYNC fault, client has fallen too far out of date and must re-initial sync
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SyncRequest extends SoapRequest
{
    /**
     * Token - not provided for initial sync
     *
     * @Accessor(getter="getToken", setter="setToken")
     * @SerializedName("token")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getToken", setter: "setToken")]
    #[SerializedName("token")]
    #[Type("string")]
    #[XmlAttribute]
    private $token;

    /**
     * Calendar date. If present, omit all appointments and tasks that don't have
     * a recurrence ending after that time (specified in ms)
     *
     * @Accessor(getter="getCalendarCutoff", setter="setCalendarCutoff")
     * @SerializedName("calCutoff")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getCalendarCutoff", setter: "setCalendarCutoff")]
    #[SerializedName("calCutoff")]
    #[Type("int")]
    #[XmlAttribute]
    private $calendarCutoff;

    /**
     * Earliest Message date.
     * If present, omit all Messages and conversations that are older than time (specified in seconds)
     * "Note:value in seconds, unlike calCutoff which is in milliseconds"
     *
     * @Accessor(getter="getMsgCutoff", setter="setMsgCutoff")
     * @SerializedName("msgCutoff")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getMsgCutoff", setter: "setMsgCutoff")]
    #[SerializedName("msgCutoff")]
    #[Type("int")]
    #[XmlAttribute]
    private $msgCutoff;

    /**
     * Root folder ID.
     * If present, we start sync there rather than at folder 11
     *
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getFolderId", setter: "setFolderId")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private $folderId;

    /**
     * If specified and set, deletes are also broken down by item type
     *
     * @Accessor(getter="getTypedDeletes", setter="setTypedDeletes")
     * @SerializedName("typed")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getTypedDeletes", setter: "setTypedDeletes")]
    #[SerializedName("typed")]
    #[Type("bool")]
    #[XmlAttribute]
    private $typedDeletes;

    /**
     * maximum number of deleted item ids returned in a response.
     *
     * @Accessor(getter="getDeleteLimit", setter="setDeleteLimit")
     * @SerializedName("deleteLimit")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getDeleteLimit", setter: "setDeleteLimit")]
    #[SerializedName("deleteLimit")]
    #[Type("int")]
    #[XmlAttribute]
    private $deleteLimit;

    /**
     * maximum number of modified item ids returned in a response.
     *
     * @Accessor(getter="getChangeLimit", setter="setChangeLimit")
     * @SerializedName("changeLimit")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getChangeLimit", setter: "setChangeLimit")]
    #[SerializedName("changeLimit")]
    #[Type("int")]
    #[XmlAttribute]
    private $changeLimit;

    /**
     * Constructor
     *
     * @param  string $token
     * @param  int $calendarCutoff
     * @param  int $msgCutoff
     * @param  string $folderId
     * @param  bool $typedDeletes
     * @param  int $deleteLimit
     * @param  int $changeLimit
     * @return self
     */
    public function __construct(
        ?string $token = null,
        ?int $calendarCutoff = null,
        ?int $msgCutoff = null,
        ?string $folderId = null,
        ?bool $typedDeletes = null,
        ?int $deleteLimit = null,
        ?int $changeLimit = null
    ) {
        if (null !== $token) {
            $this->setToken($token);
        }
        if (null !== $calendarCutoff) {
            $this->setCalendarCutoff($calendarCutoff);
        }
        if (null !== $msgCutoff) {
            $this->setMsgCutoff($msgCutoff);
        }
        if (null !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (null !== $typedDeletes) {
            $this->setTypedDeletes($typedDeletes);
        }
        if (null !== $deleteLimit) {
            $this->setDeleteLimit($deleteLimit);
        }
        if (null !== $changeLimit) {
            $this->setChangeLimit($changeLimit);
        }
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set token
     *
     * @param  string $token
     * @return self
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get calendarCutoff
     *
     * @return int
     */
    public function getCalendarCutoff(): ?int
    {
        return $this->calendarCutoff;
    }

    /**
     * Set calendarCutoff
     *
     * @param  int $calendarCutoff
     * @return self
     */
    public function setCalendarCutoff(int $calendarCutoff): self
    {
        $this->calendarCutoff = $calendarCutoff;
        return $this;
    }

    /**
     * Get msgCutoff
     *
     * @return int
     */
    public function getMsgCutoff(): ?int
    {
        return $this->msgCutoff;
    }

    /**
     * Set msgCutoff
     *
     * @param  int $msgCutoff
     * @return self
     */
    public function setMsgCutoff(int $msgCutoff): self
    {
        $this->msgCutoff = $msgCutoff;
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
     * Get typedDeletes
     *
     * @return bool
     */
    public function getTypedDeletes(): ?bool
    {
        return $this->typedDeletes;
    }

    /**
     * Set typedDeletes
     *
     * @param  bool $typedDeletes
     * @return self
     */
    public function setTypedDeletes(bool $typedDeletes): self
    {
        $this->typedDeletes = $typedDeletes;
        return $this;
    }

    /**
     * Get deleteLimit
     *
     * @return int
     */
    public function getDeleteLimit(): ?int
    {
        return $this->deleteLimit;
    }

    /**
     * Set deleteLimit
     *
     * @param  int $deleteLimit
     * @return self
     */
    public function setDeleteLimit(int $deleteLimit): self
    {
        $this->deleteLimit = $deleteLimit;
        return $this;
    }

    /**
     * Get changeLimit
     *
     * @return int
     */
    public function getChangeLimit(): ?int
    {
        return $this->changeLimit;
    }

    /**
     * Set changeLimit
     *
     * @param  int $changeLimit
     * @return self
     */
    public function setChangeLimit(int $changeLimit): self
    {
        $this->changeLimit = $changeLimit;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SyncEnvelope(new SyncBody($this));
    }
}
