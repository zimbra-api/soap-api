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
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SyncRequest extends Request
{
    /**
     * Token - not provided for initial sync
     * 
     * @Accessor(getter="getToken", setter="setToken")
     * @SerializedName("token")
     * @Type("string")
     * @XmlAttribute
     */
    private $token;

    /**
     * Calendar date. If present, omit all appointments and tasks that don't have
     * a recurrence ending after that time (specified in ms)
     * 
     * @Accessor(getter="getCalendarCutoff", setter="setCalendarCutoff")
     * @SerializedName("calCutoff")
     * @Type("integer")
     * @XmlAttribute
     */
    private $calendarCutoff;

    /**
     * Earliest Message date.  If present, omit all Messages and conversations that
     * are older than time (specified in seconds) "Note:value in seconds, unlike calCutoff which is in milliseconds"
     * 
     * @Accessor(getter="getMsgCutoff", setter="setMsgCutoff")
     * @SerializedName("msgCutoff")
     * @Type("integer")
     * @XmlAttribute
     */
    private $msgCutoff;

    /**
     * Root folder ID.  If present, we start sync there rather than at folder 11
     * 
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * If specified and set, deletes are also broken down by item type
     * 
     * @Accessor(getter="getTypedDeletes", setter="setTypedDeletes")
     * @SerializedName("typed")
     * @Type("bool")
     * @XmlAttribute
     */
    private $typedDeletes;

    /**
     * maximum number of deleted item ids returned in a response.
     * 
     * @Accessor(getter="getDeleteLimit", setter="setDeleteLimit")
     * @SerializedName("deleteLimit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $deleteLimit;

    /**
     * maximum number of modified item ids returned in a response.
     * 
     * @Accessor(getter="getChangeLimit", setter="setChangeLimit")
     * @SerializedName("changeLimit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $changeLimit;

    /**
     * Constructor method for AutoCompleteRequest
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
        ?string $token = NULL,
        ?int $calendarCutoff = NULL,
        ?int $msgCutoff = NULL,
        ?string $folderId = NULL,
        ?bool $typedDeletes = NULL,
        ?int $deleteLimit = NULL,
        ?int $changeLimit = NULL
    )
    {
        if (NULL !== $token) {
            $this->setToken($token);
        }
        if (NULL !== $calendarCutoff) {
            $this->setCalendarCutoff($calendarCutoff);
        }
        if (NULL !== $msgCutoff) {
            $this->setMsgCutoff($msgCutoff);
        }
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (NULL !== $typedDeletes) {
            $this->setTypedDeletes($typedDeletes);
        }
        if (NULL !== $deleteLimit) {
            $this->setDeleteLimit($deleteLimit);
        }
        if (NULL !== $changeLimit) {
            $this->setChangeLimit($changeLimit);
        }
    }

    /**
     * Gets token
     *
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Sets token
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
     * Gets calendarCutoff
     *
     * @return int
     */
    public function getCalendarCutoff(): ?int
    {
        return $this->calendarCutoff;
    }

    /**
     * Sets calendarCutoff
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
     * Gets msgCutoff
     *
     * @return int
     */
    public function getMsgCutoff(): ?int
    {
        return $this->msgCutoff;
    }

    /**
     * Sets msgCutoff
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
     * Gets folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Sets folderId
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
     * Gets typedDeletes
     *
     * @return bool
     */
    public function getTypedDeletes(): ?bool
    {
        return $this->typedDeletes;
    }

    /**
     * Sets typedDeletes
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
     * Gets deleteLimit
     *
     * @return int
     */
    public function getDeleteLimit(): ?int
    {
        return $this->deleteLimit;
    }

    /**
     * Sets deleteLimit
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
     * Gets changeLimit
     *
     * @return int
     */
    public function getChangeLimit(): ?int
    {
        return $this->changeLimit;
    }

    /**
     * Sets changeLimit
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new SyncEnvelope(
            new SyncBody($this)
        );
    }
}
