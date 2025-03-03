<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * ShareInfo class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ShareInfo
{
    /**
     * Owner ID
     *
     * @var string
     */
    #[Accessor(getter: "getOwnerId", setter: "setOwnerId")]
    #[SerializedName("ownerId")]
    #[Type("string")]
    #[XmlAttribute]
    private string $ownerId;

    /**
     * Owner email
     *
     * @var string
     */
    #[Accessor(getter: "getOwnerEmail", setter: "setOwnerEmail")]
    #[SerializedName("ownerEmail")]
    #[Type("string")]
    #[XmlAttribute]
    private string $ownerEmail;

    /**
     * Owner display name
     *
     * @var string
     */
    #[Accessor(getter: "getOwnerDisplayName", setter: "setOwnerDisplayName")]
    #[SerializedName("ownerName")]
    #[Type("string")]
    #[XmlAttribute]
    private  string$ownerDisplayName;

    /**
     * Folder ID
     *
     * @var int
     */
    #[Accessor(getter: "getFolderId", setter: "setFolderId")]
    #[SerializedName("folderId")]
    #[Type("int")]
    #[XmlAttribute]
    private int $folderId;

    /**
     * Folder UUID
     *
     * @var string
     */
    #[Accessor(getter: "getFolderUuid", setter: "setFolderUuid")]
    #[SerializedName("folderUuid")]
    #[Type("string")]
    #[XmlAttribute]
    private string $folderUuid;

    /**
     * Fully qualified path
     *
     * @var string
     */
    #[Accessor(getter: "getFolderPath", setter: "setFolderPath")]
    #[SerializedName("folderPath")]
    #[Type("string")]
    #[XmlAttribute]
    private string $folderPath;

    /**
     * Default type
     *
     * @var string
     */
    #[Accessor(getter: "getDefaultView", setter: "setDefaultView")]
    #[SerializedName("view")]
    #[Type("string")]
    #[XmlAttribute]
    private string $defaultView;

    /**
     * Rights
     *
     * @var string
     */
    #[Accessor(getter: "getRights", setter: "setRights")]
    #[SerializedName("rights")]
    #[Type("string")]
    #[XmlAttribute]
    private string $rights;

    /**
     * Grantee type
     *
     * @var string
     */
    #[Accessor(getter: "getGranteeType", setter: "setGranteeType")]
    #[SerializedName("granteeType")]
    #[Type("string")]
    #[XmlAttribute]
    private string $granteeType;

    /**
     * Grantee ID
     *
     * @var string
     */
    #[Accessor(getter: "getGranteeId", setter: "setGranteeId")]
    #[SerializedName("granteeId")]
    #[Type("string")]
    #[XmlAttribute]
    private string $granteeId;

    /**
     * Grantee name
     *
     * @var string
     */
    #[Accessor(getter: "getGranteeName", setter: "setGranteeName")]
    #[SerializedName("granteeName")]
    #[Type("string")]
    #[XmlAttribute]
    private string $granteeName;

    /**
     * Grantee display name
     *
     * @var string
     */
    #[
        Accessor(
            getter: "getGranteeDisplayName",
            setter: "setGranteeDisplayName"
        )
    ]
    #[SerializedName("granteeDisplayName")]
    #[Type("string")]
    #[XmlAttribute]
    private string $granteeDisplayName;

    /**
     * Returned if the share is already mounted.
     * Contains the folder id of the mountpoint in the local mailbox.
     *
     * @var string
     */
    #[Accessor(getter: "getMountpointId", setter: "setMountpointId")]
    #[SerializedName("mid")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $mountpointId = null;

    /**
     * Active sync is disabled.
     *
     * @var bool
     */
    #[Accessor(getter: "isActiveSyncDisabled", setter: "setActiveSyncDisabled")]
    #[SerializedName("activeSyncDisabled")]
    #[Type("bool")]
    #[XmlAttribute]
    private bool $activeSyncDisabled = false;

    /**
     * Constructor
     *
     * @param string $ownerId
     * @param string $ownerEmail
     * @param string $ownerDisplayName
     * @param int $folderId
     * @param string $folderUuid
     * @param string $folderPath
     * @param string $defaultView
     * @param string $rights
     * @param string $granteeType
     * @param string $granteeId
     * @param string $granteeName
     * @param string $granteeDisplayName
     * @param string $mountpointId
     * @param bool $activeSyncDisabled
     * @return self
     */
    public function __construct(
        string $ownerId = "",
        string $ownerEmail = "",
        string $ownerDisplayName = "",
        int $folderId = 0,
        string $folderUuid = "",
        string $folderPath = "",
        string $defaultView = "",
        string $rights = "",
        string $granteeType = "",
        string $granteeId = "",
        string $granteeName = "",
        string $granteeDisplayName = "",
        ?string $mountpointId = null,
        bool $activeSyncDisabled = false
    ) {
        $this->setOwnerId($ownerId)
            ->setOwnerEmail($ownerEmail)
            ->setOwnerDisplayName($ownerDisplayName)
            ->setFolderId($folderId)
            ->setFolderUuid($folderUuid)
            ->setFolderPath($folderPath)
            ->setDefaultView($defaultView)
            ->setRights($rights)
            ->setGranteeType($granteeType)
            ->setGranteeId($granteeId)
            ->setGranteeName($granteeName)
            ->setGranteeDisplayName($granteeDisplayName)
            ->setActiveSyncDisabled($activeSyncDisabled);

        if (null !== $mountpointId) {
            $this->setMountpointId($mountpointId);
        }
    }

    /**
     * Get ownerId
     *
     * @return string
     */
    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    /**
     * Set ownerId
     *
     * @param  string $ownerId
     * @return self
     */
    public function setOwnerId(string $ownerId): self
    {
        $this->ownerId = $ownerId;
        return $this;
    }

    /**
     * Get folderUuid
     *
     * @return string
     */
    public function getFolderUuid(): string
    {
        return $this->folderUuid;
    }

    /**
     * Set folderUuid
     *
     * @param  string $folderUuid
     * @return self
     */
    public function setFolderUuid(string $folderUuid): self
    {
        $this->folderUuid = $folderUuid;
        return $this;
    }

    /**
     * Get ownerEmail
     *
     * @return string
     */
    public function getOwnerEmail(): string
    {
        return $this->ownerEmail;
    }

    /**
     * Set ownerEmail
     *
     * @param  string $ownerEmail
     * @return self
     */
    public function setOwnerEmail(string $ownerEmail): self
    {
        $this->ownerEmail = $ownerEmail;
        return $this;
    }

    /**
     * Get ownerDisplayName
     *
     * @return string
     */
    public function getOwnerDisplayName(): string
    {
        return $this->ownerDisplayName;
    }

    /**
     * Set ownerDisplayName
     *
     * @param  string $ownerDisplayName
     * @return self
     */
    public function setOwnerDisplayName(string $ownerDisplayName): self
    {
        $this->ownerDisplayName = $ownerDisplayName;
        return $this;
    }

    /**
     * Get folderId
     *
     * @return int
     */
    public function getFolderId(): int
    {
        return $this->folderId;
    }

    /**
     * Set folderId
     *
     * @param  int $folderId
     * @return self
     */
    public function setFolderId(int $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Get folderPath
     *
     * @return string
     */
    public function getFolderPath(): string
    {
        return $this->folderPath;
    }

    /**
     * Set folderPath
     *
     * @param  string $folderPath
     * @return self
     */
    public function setFolderPath(string $folderPath): self
    {
        $this->folderPath = $folderPath;
        return $this;
    }

    /**
     * Get defaultView
     *
     * @return string
     */
    public function getDefaultView(): string
    {
        return $this->defaultView;
    }

    /**
     * Set defaultView
     *
     * @param  string $defaultView
     * @return self
     */
    public function setDefaultView(string $defaultView): self
    {
        $this->defaultView = $defaultView;
        return $this;
    }

    /**
     * Get rights
     *
     * @return string
     */
    public function getRights(): string
    {
        return $this->rights;
    }

    /**
     * Set rights
     *
     * @param  string $rights
     * @return self
     */
    public function setRights(string $rights): self
    {
        $this->rights = $rights;
        return $this;
    }

    /**
     * Get granteeType
     *
     * @return string
     */
    public function getGranteeType(): string
    {
        return $this->granteeType;
    }

    /**
     * Set granteeType
     *
     * @param  string $granteeType
     * @return self
     */
    public function setGranteeType(string $granteeType): self
    {
        $this->granteeType = $granteeType;
        return $this;
    }

    /**
     * Get granteeId
     *
     * @return string
     */
    public function getGranteeId(): string
    {
        return $this->granteeId;
    }

    /**
     * Set granteeId
     *
     * @param  string $granteeId
     * @return self
     */
    public function setGranteeId(string $granteeId): self
    {
        $this->granteeId = $granteeId;
        return $this;
    }

    /**
     * Get granteeName
     *
     * @return string
     */
    public function getGranteeName(): string
    {
        return $this->granteeName;
    }

    /**
     * Set granteeName
     *
     * @param  string $granteeName
     * @return self
     */
    public function setGranteeName(string $granteeName): self
    {
        $this->granteeName = $granteeName;
        return $this;
    }

    /**
     * Get granteeDisplayName
     *
     * @return string
     */
    public function getGranteeDisplayName(): string
    {
        return $this->granteeDisplayName;
    }

    /**
     * Set granteeDisplayName
     *
     * @param  string $granteeDisplayName
     * @return self
     */
    public function setGranteeDisplayName(string $granteeDisplayName): self
    {
        $this->granteeDisplayName = $granteeDisplayName;
        return $this;
    }

    /**
     * Get mountpointId
     *
     * @return string
     */
    public function getMountpointId(): string
    {
        return $this->mountpointId;
    }

    /**
     * Set mountpointId
     *
     * @param  string $mountpointId
     * @return self
     */
    public function setMountpointId(string $mountpointId): self
    {
        $this->mountpointId = $mountpointId;
        return $this;
    }

    /**
     * Is active sync disabled
     *
     * @return bool
     */
    public function isActiveSyncDisabled(): bool
    {
        return $this->activeSyncDisabled;
    }

    /**
     * Set active sync disabled
     *
     * @param  bool $activeSyncDisabled
     * @return self
     */
    public function setActiveSyncDisabled(bool $activeSyncDisabled): self
    {
        $this->activeSyncDisabled = $activeSyncDisabled;
        return $this;
    }
}
