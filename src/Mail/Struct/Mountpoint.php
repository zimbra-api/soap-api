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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Mountpoint extends Folder
{
    /**
     * Primary email address of the owner of the linked-to resource
     * 
     * @var string
     */
    #[Accessor(getter: 'getOwnerEmail', setter: 'setOwnerEmail')]
    #[SerializedName('owner')]
    #[Type('string')]
    #[XmlAttribute]
    private $ownerEmail;

    /**
     * Zimbra ID (guid) of the owner of the linked-to resource
     * 
     * @var string
     */
    #[Accessor(getter: 'getOwnerAccountId', setter: 'setOwnerAccountId')]
    #[SerializedName('zid')]
    #[Type('string')]
    #[XmlAttribute]
    private $ownerAccountId;

    /**
     * Item ID of the linked-to resource in the remote mailbox
     * 
     * @var int
     */
    #[Accessor(getter: 'getRemoteFolderId', setter: 'setRemoteFolderId')]
    #[SerializedName('rid')]
    #[Type('int')]
    #[XmlAttribute]
    private $remoteFolderId;

    /**
     * UUID of the linked-to resource in the remote mailbox
     * 
     * @var string
     */
    #[Accessor(getter: 'getRemoteUuid', setter: 'setRemoteUuid')]
    #[SerializedName('ruuid')]
    #[Type('string')]
    #[XmlAttribute]
    private $remoteUuid;

    /**
     * The name presently used for the item by the owner
     * 
     * @var string
     */
    #[Accessor(getter: 'getRemoteFolderName', setter: 'setRemoteFolderName')]
    #[SerializedName('oname')]
    #[Type('string')]
    #[XmlAttribute]
    private $remoteFolderName;

    /**
     * If set, client should display reminders for shared appointments/tasks
     * 
     * @var bool
     */
    #[Accessor(getter: 'getReminderEnabled', setter: 'setReminderEnabled')]
    #[SerializedName('reminder')]
    #[Type('bool')]
    #[XmlAttribute]
    private $reminderEnabled;

    /**
     * If "tr" is true in the request, broken is set if this is a broken link
     * 
     * @var bool
     */
    #[Accessor(getter: 'getBroken', setter: 'setBroken')]
    #[SerializedName('broken')]
    #[Type('bool')]
    #[XmlAttribute]
    private $broken;

    /**
     * Constructor
     * 
     * @param  string $id
     * @param  string $uuid
     * @param  string $ownerEmail
     * @param  string $ownerAccountId
     * @param  int $remoteFolderId
     * @param  string $remoteUuid
     * @param  string $remoteFolderName
     * @param  bool $reminderEnabled
     * @param  bool $broken
     * @return self
     */
    public function __construct(
        string $id = '',
        string $uuid = '',
        ?string $ownerEmail = null,
        ?string $ownerAccountId = null,
        ?int $remoteFolderId = null,
        ?string $remoteUuid = null,
        ?string $remoteFolderName = null,
        ?bool $reminderEnabled = null,
        ?bool $broken = null
    )
    {
    	parent::__construct($id, $uuid);
        if (null !== $ownerEmail) {
            $this->setOwnerEmail($ownerEmail);
        }
        if (null !== $ownerAccountId) {
            $this->setOwnerAccountId($ownerAccountId);
        }
        if (null !== $remoteFolderId) {
            $this->setRemoteFolderId($remoteFolderId);
        }
        if (null !== $remoteUuid) {
            $this->setRemoteUuid($remoteUuid);
        }
        if (null !== $remoteFolderName) {
            $this->setRemoteFolderName($remoteFolderName);
        }
        if (null !== $reminderEnabled) {
            $this->setReminderEnabled($reminderEnabled);
        }
        if (null !== $broken) {
            $this->setBroken($broken);
        }
    }

    /**
     * Get ownerEmail
     *
     * @return string
     */
    public function getOwnerEmail(): ?string
    {
        return $this->ownerEmail;
    }

    /**
     * Set ownerEmail
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
     * Get ownerAccountId
     *
     * @return string
     */
    public function getOwnerAccountId(): ?string
    {
        return $this->ownerAccountId;
    }

    /**
     * Set ownerAccountId
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
     * Get remoteFolderId
     *
     * @return int
     */
    public function getRemoteFolderId(): ?int
    {
        return $this->remoteFolderId;
    }

    /**
     * Set remoteFolderId
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
     * Get remoteUuid
     *
     * @return string
     */
    public function getRemoteUuid(): ?string
    {
        return $this->remoteUuid;
    }

    /**
     * Set remoteUuid
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
     * Get remoteFolderName
     *
     * @return string
     */
    public function getRemoteFolderName(): ?string
    {
        return $this->remoteFolderName;
    }

    /**
     * Set remoteFolderName
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
     * Get reminderEnabled
     *
     * @return bool
     */
    public function getReminderEnabled(): ?bool
    {
        return $this->reminderEnabled;
    }

    /**
     * Set reminderEnabled
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
     * Get broken
     *
     * @return bool
     */
    public function getBroken(): ?bool
    {
        return $this->broken;
    }

    /**
     * Set broken
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
