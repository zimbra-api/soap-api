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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * Mountpoint struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class Mountpoint extends Folder
{
    /**
     * Primary email address of the owner of the linked-to resource
     * @Accessor(getter="getOwnerEmail", setter="setOwnerEmail")
     * @SerializedName("owner")
     * @Type("string")
     * @XmlAttribute
     */
    private $ownerEmail;

    /**
     * Zimbra ID (guid) of the owner of the linked-to resource
     * @Accessor(getter="getOwnerAccountId", setter="setOwnerAccountId")
     * @SerializedName("zid")
     * @Type("string")
     * @XmlAttribute
     */
    private $ownerAccountId;

    /**
     * Item ID of the linked-to resource in the remote mailbox
     * @Accessor(getter="getRemoteFolderId", setter="setRemoteFolderId")
     * @SerializedName("rid")
     * @Type("integer")
     * @XmlAttribute
     */
    private $remoteFolderId;

    /**
     * UUID of the linked-to resource in the remote mailbox
     * @Accessor(getter="getRemoteUuid", setter="setRemoteUuid")
     * @SerializedName("ruuid")
     * @Type("string")
     * @XmlAttribute
     */
    private $remoteUuid;

    /**
     * The name presently used for the item by the owner
     * @Accessor(getter="getRemoteFolderName", setter="setRemoteFolderName")
     * @SerializedName("oname")
     * @Type("string")
     * @XmlAttribute
     */
    private $remoteFolderName;

    /**
     * If set, client should display reminders for shared appointments/tasks
     * @Accessor(getter="getReminderEnabled", setter="setReminderEnabled")
     * @SerializedName("reminder")
     * @Type("bool")
     * @XmlAttribute
     */
    private $reminderEnabled;

    /**
     * If "tr" is true in the request, broken is set if this is a broken link
     * @Accessor(getter="getBroken", setter="setBroken")
     * @SerializedName("broken")
     * @Type("bool")
     * @XmlAttribute
     */
    private $broken;

    /**
     * Constructor method for Mountpoint
     * 
     * @param  string $id
     * @param  string $uuid
     * @return self
     */
    public function __construct(
        string $id,
        string $uuid,
        ?string $ownerEmail = NULL,
        ?string $ownerAccountId = NULL,
        ?int $remoteFolderId = NULL,
        ?string $remoteUuid = NULL,
        ?string $remoteFolderName = NULL,
        ?bool $reminderEnabled = NULL,
        ?bool $broken = NULL
    )
    {
    	parent::__construct($id, $uuid);
        if (NULL !== $ownerEmail) {
            $this->setOwnerEmail($ownerEmail);
        }
        if (NULL !== $ownerAccountId) {
            $this->setOwnerAccountId($ownerAccountId);
        }
        if (NULL !== $remoteFolderId) {
            $this->setRemoteFolderId($remoteFolderId);
        }
        if (NULL !== $remoteUuid) {
            $this->setRemoteUuid($remoteUuid);
        }
        if (NULL !== $remoteFolderName) {
            $this->setRemoteFolderName($remoteFolderName);
        }
        if (NULL !== $reminderEnabled) {
            $this->setReminderEnabled($reminderEnabled);
        }
        if (NULL !== $broken) {
            $this->setBroken($broken);
        }
    }

    /**
     * Gets ownerEmail
     *
     * @return string
     */
    public function getOwnerEmail(): ?string
    {
        return $this->ownerEmail;
    }

    /**
     * Sets ownerEmail
     *
     * @param  string $ownerEmail
     * @return self
     */
    public function setOwnerEmail(string $ownerEmail)
    {
        $this->ownerEmail = $ownerEmail;
        return $this;
    }

    /**
     * Gets ownerAccountId
     *
     * @return string
     */
    public function getOwnerAccountId(): ?string
    {
        return $this->ownerAccountId;
    }

    /**
     * Sets ownerAccountId
     *
     * @param  string $ownerAccountId
     * @return self
     */
    public function setOwnerAccountId(string $ownerAccountId)
    {
        $this->ownerAccountId = $ownerAccountId;
        return $this;
    }

    /**
     * Gets remoteFolderId
     *
     * @return int
     */
    public function getRemoteFolderId(): ?int
    {
        return $this->remoteFolderId;
    }

    /**
     * Sets remoteFolderId
     *
     * @param  int $remoteFolderId
     * @return self
     */
    public function setRemoteFolderId(int $remoteFolderId)
    {
        $this->remoteFolderId = $remoteFolderId;
        return $this;
    }

    /**
     * Gets remoteUuid
     *
     * @return string
     */
    public function getRemoteUuid(): ?string
    {
        return $this->remoteUuid;
    }

    /**
     * Sets remoteUuid
     *
     * @param  string $remoteUuid
     * @return self
     */
    public function setRemoteUuid(string $remoteUuid)
    {
        $this->remoteUuid = $remoteUuid;
        return $this;
    }

    /**
     * Gets remoteFolderName
     *
     * @return string
     */
    public function getRemoteFolderName(): ?string
    {
        return $this->remoteFolderName;
    }

    /**
     * Sets remoteFolderName
     *
     * @param  string $remoteFolderName
     * @return self
     */
    public function setRemoteFolderName(string $remoteFolderName)
    {
        $this->remoteFolderName = $remoteFolderName;
        return $this;
    }

    /**
     * Gets reminderEnabled
     *
     * @return bool
     */
    public function getReminderEnabled(): ?bool
    {
        return $this->reminderEnabled;
    }

    /**
     * Sets reminderEnabled
     *
     * @param  bool $reminderEnabled
     * @return self
     */
    public function setReminderEnabled(bool $reminderEnabled)
    {
        $this->reminderEnabled = $reminderEnabled;
        return $this;
    }

    /**
     * Gets broken
     *
     * @return bool
     */
    public function getBroken(): ?bool
    {
        return $this->broken;
    }

    /**
     * Sets broken
     *
     * @param  bool $broken
     * @return self
     */
    public function setBroken(bool $broken)
    {
        $this->broken = $broken;
        return $this;
    }
}
