<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * MailboxInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MailboxInfo
{
    /**
     * ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("integer")
     * @XmlAttribute
     */
    private $id;

    /**
     * Group ID
     * @Accessor(getter="getGroupId", setter="setGroupId")
     * @SerializedName("groupId")
     * @Type("integer")
     * @XmlAttribute
     */
    private $groupId;

    /**
     * Account ID
     * @Accessor(getter="getAccountId", setter="setAccountId")
     * @SerializedName("accountId")
     * @Type("string")
     * @XmlAttribute
     */
    private $accountId;

    /**
     * Index volume ID
     * @Accessor(getter="getIndexVolumeId", setter="setIndexVolumeId")
     * @SerializedName("indexVolumeId")
     * @Type("integer")
     * @XmlAttribute
     */
    private $indexVolumeId;

    /**
     * Item ID checkpoint
     * @Accessor(getter="getItemIdCheckPoint", setter="setItemIdCheckPoint")
     * @SerializedName("itemIdCheckPoint")
     * @Type("integer")
     * @XmlAttribute
     */
    private $itemIdCheckPoint;

    /**
     * Contact count
     * @Accessor(getter="getContactCount", setter="setContactCount")
     * @SerializedName("contactCount")
     * @Type("integer")
     * @XmlAttribute
     */
    private $contactCount;

    /**
     * Size checkpoint
     * @Accessor(getter="getSizeCheckPoint", setter="setSizeCheckPoint")
     * @SerializedName("sizeCheckPoint")
     * @Type("integer")
     * @XmlAttribute
     */
    private $sizeCheckPoint;

    /**
     * Change checkpoint
     * @Accessor(getter="getChangeCheckPoint", setter="setChangeCheckPoint")
     * @SerializedName("changeCheckPoint")
     * @Type("integer")
     * @XmlAttribute
     */
    private $changeCheckPoint;

    /**
     * Tracking Sync
     * @Accessor(getter="getTrackingSync", setter="setTrackingSync")
     * @SerializedName("trackingSync")
     * @Type("integer")
     * @XmlAttribute
     */
    private $trackingSync;

    /**
     * Tracking IMAP
     * @Accessor(getter="isTrackingImap", setter="setTrackingImap")
     * @SerializedName("trackingImap")
     * @Type("bool")
     * @XmlAttribute
     */
    private $trackingImap;

    /**
     * Last Backup At
     * @Accessor(getter="getLastBackupAt", setter="setLastBackupAt")
     * @SerializedName("lastBackupAt")
     * @Type("integer")
     * @XmlAttribute
     */
    private $lastBackupAt;

    /**
     * Last SOAP access
     * @Accessor(getter="getLastSoapAccess", setter="setLastSoapAccess")
     * @SerializedName("lastSoapAccess")
     * @Type("integer")
     * @XmlAttribute
     */
    private $lastSoapAccess;

    /**
     * New Messages
     * @Accessor(getter="getNewMessages", setter="setNewMessages")
     * @SerializedName("newMessages")
     * @Type("integer")
     * @XmlAttribute
     */
    private $newMessages;

    /**
     * Constructor method for MailboxInfo
     * @param int $id
     * @param int $groupId
     * @param string $accountId
     * @param int $indexVolumeId
     * @param int $itemIdCheckPoint
     * @param int $contactCount
     * @param int $sizeCheckPoint
     * @param int $changeCheckPoint
     * @param int $trackingSync
     * @param bool $trackingImap
     * @param int $lastBackupAt
     * @param int $lastSoapAccess
     * @param int $newMessages
     * @return self
     */
    public function __construct(
        int $id,
        int $groupId,
        string $accountId,
        int $indexVolumeId,
        int $itemIdCheckPoint,
        int $contactCount,
        int $sizeCheckPoint,
        int $changeCheckPoint,
        int $trackingSync,
        bool $trackingImap,
        int $lastBackupAt,
        int $lastSoapAccess,
        int $newMessages
    )
    {
        $this->id = $id;
        $this->groupId = $groupId;
        $this->accountId = $accountId;
        $this->indexVolumeId = $indexVolumeId;
        $this->itemIdCheckPoint = $itemIdCheckPoint;
        $this->contactCount = $contactCount;
        $this->sizeCheckPoint = $sizeCheckPoint;
        $this->changeCheckPoint = $changeCheckPoint;
        $this->trackingSync = $trackingSync;
        $this->trackingImap = $trackingImap;
        $this->lastBackupAt = $lastBackupAt;
        $this->lastSoapAccess = $lastSoapAccess;
        $this->newMessages = $newMessages;
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets groupId
     *
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * Sets groupId
     *
     * @param  int $canExpand
     * @return bool
     */
    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * Gets accountId
     *
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * Sets accountId
     *
     * @param  string $accountId
     * @return self
     */
    public function setAccountId(string $accountId): self
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * Gets indexVolumeId
     *
     * @return int
     */
    public function getIndexVolumeId(): int
    {
        return $this->indexVolumeId;
    }

    /**
     * Sets indexVolumeId
     *
     * @param  int $indexVolumeId
     * @return self
     */
    public function setIndexVolumeId(int $indexVolumeId): self
    {
        $this->indexVolumeId = $indexVolumeId;
        return $this;
    }

    /**
     * Gets itemIdCheckPoint
     *
     * @return int
     */
    public function getItemIdCheckPoint(): int
    {
        return $this->itemIdCheckPoint;
    }

    /**
     * Sets itemIdCheckPoint
     *
     * @param  int $itemIdCheckPoint
     * @return self
     */
    public function setItemIdCheckPoint(int $itemIdCheckPoint): self
    {
        $this->itemIdCheckPoint = $itemIdCheckPoint;
        return $this;
    }

    /**
     * Gets contactCount
     *
     * @return int
     */
    public function getContactCount(): int
    {
        return $this->contactCount;
    }

    /**
     * Sets contactCount
     *
     * @param  int $contactCount
     * @return self
     */
    public function setContactCount(int $contactCount): self
    {
        $this->contactCount = $contactCount;
        return $this;
    }

    /**
     * Gets sizeCheckPoint
     *
     * @return int
     */
    public function getSizeCheckPoint(): int
    {
        return $this->sizeCheckPoint;
    }

    /**
     * Sets sizeCheckPoint
     *
     * @param  int $tagNames
     * @return self
     */
    public function setSizeCheckPoint(int $sizeCheckPoint): self
    {
        $this->sizeCheckPoint = $sizeCheckPoint;
        return $this;
    }

    /**
     * Gets changeCheckPoint
     *
     * @return int
     */
    public function getChangeCheckPoint(): int
    {
        return $this->changeCheckPoint;
    }

    /**
     * Sets changeCheckPoint
     *
     * @param  int $changeCheckPoint
     * @return self
     */
    public function setChangeCheckPoint(int $changeCheckPoint): self
    {
        $this->changeCheckPoint = $changeCheckPoint;
        return $this;
    }

    /**
     * Gets trackingSync
     *
     * @return int
     */
    public function getTrackingSync(): int
    {
        return $this->trackingSync;
    }

    /**
     * Sets trackingSync
     *
     * @param  int $trackingSync
     * @return self
     */
    public function setTrackingSync(int $trackingSync): self
    {
        $this->trackingSync = $trackingSync;
        return $this;
    }

    /**
     * Gets trackingImap
     *
     * @return bool
     */
    public function isTrackingImap(): bool
    {
        return $this->trackingImap;
    }

    /**
     * Sets trackingImap
     *
     * @param  bool $trackingImap
     * @return self
     */
    public function setTrackingImap(bool $trackingImap): self
    {
        $this->trackingImap = $trackingImap;
        return $this;
    }

    /**
     * Gets lastBackupAt
     *
     * @return int
     */
    public function getLastBackupAt(): int
    {
        return $this->lastBackupAt;
    }

    /**
     * Sets lastBackupAt
     *
     * @param  int $lastBackupAt
     * @return self
     */
    public function setLastBackupAt(int $lastBackupAt): self
    {
        $this->lastBackupAt = $lastBackupAt;
        return $this;
    }

    /**
     * Gets lastSoapAccess
     *
     * @return int
     */
    public function getLastSoapAccess(): int
    {
        return $this->lastSoapAccess;
    }

    /**
     * Sets lastSoapAccess
     *
     * @param  int $lastSoapAccess
     * @return self
     */
    public function setLastSoapAccess(int $lastSoapAccess): self
    {
        $this->lastSoapAccess = $lastSoapAccess;
        return $this;
    }

    /**
     * Gets newMessages
     *
     * @return int
     */
    public function getNewMessages(): int
    {
        return $this->newMessages;
    }

    /**
     * Sets newMessages
     *
     * @param  int $newMessages
     * @return self
     */
    public function setNewMessages(int $newMessages): self
    {
        $this->newMessages = $newMessages;
        return $this;
    }
}
