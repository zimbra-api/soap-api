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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailboxInfo
{
    /**
     * ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('int')]
    #[XmlAttribute]
    private $id;

    /**
     * Group ID
     * 
     * @Accessor(getter="getGroupId", setter="setGroupId")
     * @SerializedName("groupId")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getGroupId', setter: 'setGroupId')]
    #[SerializedName('groupId')]
    #[Type('int')]
    #[XmlAttribute]
    private $groupId;

    /**
     * Account ID
     * 
     * @Accessor(getter="getAccountId", setter="setAccountId")
     * @SerializedName("accountId")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getAccountId', setter: 'setAccountId')]
    #[SerializedName('accountId')]
    #[Type('string')]
    #[XmlAttribute]
    private $accountId;

    /**
     * Index volume ID
     * 
     * @Accessor(getter="getIndexVolumeId", setter="setIndexVolumeId")
     * @SerializedName("indexVolumeId")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getIndexVolumeId', setter: 'setIndexVolumeId')]
    #[SerializedName('indexVolumeId')]
    #[Type('int')]
    #[XmlAttribute]
    private $indexVolumeId;

    /**
     * Item ID checkpoint
     * 
     * @Accessor(getter="getItemIdCheckPoint", setter="setItemIdCheckPoint")
     * @SerializedName("itemIdCheckPoint")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getItemIdCheckPoint', setter: 'setItemIdCheckPoint')]
    #[SerializedName('itemIdCheckPoint')]
    #[Type('int')]
    #[XmlAttribute]
    private $itemIdCheckPoint;

    /**
     * Contact count
     * 
     * @Accessor(getter="getContactCount", setter="setContactCount")
     * @SerializedName("contactCount")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getContactCount', setter: 'setContactCount')]
    #[SerializedName('contactCount')]
    #[Type('int')]
    #[XmlAttribute]
    private $contactCount;

    /**
     * Size checkpoint
     * 
     * @Accessor(getter="getSizeCheckPoint", setter="setSizeCheckPoint")
     * @SerializedName("sizeCheckPoint")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getSizeCheckPoint', setter: 'setSizeCheckPoint')]
    #[SerializedName('sizeCheckPoint')]
    #[Type('int')]
    #[XmlAttribute]
    private $sizeCheckPoint;

    /**
     * Change checkpoint
     * 
     * @Accessor(getter="getChangeCheckPoint", setter="setChangeCheckPoint")
     * @SerializedName("changeCheckPoint")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getChangeCheckPoint', setter: 'setChangeCheckPoint')]
    #[SerializedName('changeCheckPoint')]
    #[Type('int')]
    #[XmlAttribute]
    private $changeCheckPoint;

    /**
     * Tracking Sync
     * 
     * @Accessor(getter="getTrackingSync", setter="setTrackingSync")
     * @SerializedName("trackingSync")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getTrackingSync', setter: 'setTrackingSync')]
    #[SerializedName('trackingSync')]
    #[Type('int')]
    #[XmlAttribute]
    private $trackingSync;

    /**
     * Tracking IMAP
     * 
     * @Accessor(getter="isTrackingImap", setter="setTrackingImap")
     * @SerializedName("trackingImap")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isTrackingImap', setter: 'setTrackingImap')]
    #[SerializedName('trackingImap')]
    #[Type('bool')]
    #[XmlAttribute]
    private $trackingImap;

    /**
     * Last Backup At
     * 
     * @Accessor(getter="getLastBackupAt", setter="setLastBackupAt")
     * @SerializedName("lastBackupAt")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getLastBackupAt', setter: 'setLastBackupAt')]
    #[SerializedName('lastBackupAt')]
    #[Type('int')]
    #[XmlAttribute]
    private $lastBackupAt;

    /**
     * Last SOAP access
     * 
     * @Accessor(getter="getLastSoapAccess", setter="setLastSoapAccess")
     * @SerializedName("lastSoapAccess")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getLastSoapAccess', setter: 'setLastSoapAccess')]
    #[SerializedName('lastSoapAccess')]
    #[Type('int')]
    #[XmlAttribute]
    private $lastSoapAccess;

    /**
     * New Messages
     * 
     * @Accessor(getter="getNewMessages", setter="setNewMessages")
     * @SerializedName("newMessages")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getNewMessages', setter: 'setNewMessages')]
    #[SerializedName('newMessages')]
    #[Type('int')]
    #[XmlAttribute]
    private $newMessages;

    /**
     * Constructor
     * 
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
        int $id = 0,
        int $groupId = 0,
        string $accountId = '',
        int $indexVolumeId = 0,
        int $itemIdCheckPoint = 0,
        int $contactCount = 0,
        int $sizeCheckPoint = 0,
        int $changeCheckPoint = 0,
        int $trackingSync = 0,
        bool $trackingImap = FALSE,
        int $lastBackupAt = 0,
        int $lastSoapAccess = 0,
        int $newMessages = 0
    )
    {
        $this->setId($id)
             ->setGroupId($groupId)
             ->setAccountId($accountId)
             ->setIndexVolumeId($indexVolumeId)
             ->setItemIdCheckPoint($itemIdCheckPoint)
             ->setContactCount($contactCount)
             ->setSizeCheckPoint($sizeCheckPoint)
             ->setChangeCheckPoint($changeCheckPoint)
             ->setTrackingSync($trackingSync)
             ->setTrackingImap($trackingImap)
             ->setLastBackupAt($lastBackupAt)
             ->setLastSoapAccess($lastSoapAccess)
             ->setNewMessages($newMessages);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get groupId
     *
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * Set groupId
     *
     * @param  int $groupId
     * @return self
     */
    public function setGroupId(int $groupId): self
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * Get accountId
     *
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * Set accountId
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
     * Get indexVolumeId
     *
     * @return int
     */
    public function getIndexVolumeId(): int
    {
        return $this->indexVolumeId;
    }

    /**
     * Set indexVolumeId
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
     * Get itemIdCheckPoint
     *
     * @return int
     */
    public function getItemIdCheckPoint(): int
    {
        return $this->itemIdCheckPoint;
    }

    /**
     * Set itemIdCheckPoint
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
     * Get contactCount
     *
     * @return int
     */
    public function getContactCount(): int
    {
        return $this->contactCount;
    }

    /**
     * Set contactCount
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
     * Get sizeCheckPoint
     *
     * @return int
     */
    public function getSizeCheckPoint(): int
    {
        return $this->sizeCheckPoint;
    }

    /**
     * Set sizeCheckPoint
     *
     * @param  int $sizeCheckPoint
     * @return self
     */
    public function setSizeCheckPoint(int $sizeCheckPoint): self
    {
        $this->sizeCheckPoint = $sizeCheckPoint;
        return $this;
    }

    /**
     * Get changeCheckPoint
     *
     * @return int
     */
    public function getChangeCheckPoint(): int
    {
        return $this->changeCheckPoint;
    }

    /**
     * Set changeCheckPoint
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
     * Get trackingSync
     *
     * @return int
     */
    public function getTrackingSync(): int
    {
        return $this->trackingSync;
    }

    /**
     * Set trackingSync
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
     * Get trackingImap
     *
     * @return bool
     */
    public function isTrackingImap(): bool
    {
        return $this->trackingImap;
    }

    /**
     * Set trackingImap
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
     * Get lastBackupAt
     *
     * @return int
     */
    public function getLastBackupAt(): int
    {
        return $this->lastBackupAt;
    }

    /**
     * Set lastBackupAt
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
     * Get lastSoapAccess
     *
     * @return int
     */
    public function getLastSoapAccess(): int
    {
        return $this->lastSoapAccess;
    }

    /**
     * Set lastSoapAccess
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
     * Get newMessages
     *
     * @return int
     */
    public function getNewMessages(): int
    {
        return $this->newMessages;
    }

    /**
     * Set newMessages
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
