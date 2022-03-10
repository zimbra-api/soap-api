<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * ShareInfo class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ShareInfo
{
    /**
     * Owner ID
     * @Accessor(getter="getOwnerId", setter="setOwnerId")
     * @SerializedName("ownerId")
     * @Type("string")
     * @XmlAttribute
     */
    private $ownerId;

    /**
     * Owner email
     * @Accessor(getter="getOwnerEmail", setter="setOwnerEmail")
     * @SerializedName("ownerEmail")
     * @Type("string")
     * @XmlAttribute
     */
    private $ownerEmail;

    /**
     * Owner display name
     * @Accessor(getter="getOwnerDisplayName", setter="setOwnerDisplayName")
     * @SerializedName("ownerName")
     * @Type("string")
     * @XmlAttribute
     */
    private $ownerDisplayName;

    /**
     * Folder ID
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("folderId")
     * @Type("integer")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * Folder UUID
     * @Accessor(getter="getFolderUuid", setter="setFolderUuid")
     * @SerializedName("folderUuid")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderUuid;

    /**
     * Fully qualified path
     * @Accessor(getter="getFolderPath", setter="setFolderPath")
     * @SerializedName("folderPath")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderPath;

    /**
     * Default type
     * @Accessor(getter="getDefaultView", setter="setDefaultView")
     * @SerializedName("view")
     * @Type("string")
     * @XmlAttribute
     */
    private $defaultView;

    /**
     * Rights
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("rights")
     * @Type("string")
     * @XmlAttribute
     */
    private $rights;

    /**
     * Grantee type
     * @Accessor(getter="getGranteeType", setter="setGranteeType")
     * @SerializedName("granteeType")
     * @Type("string")
     * @XmlAttribute
     */
    private $granteeType;

    /**
     * Grantee ID
     * @Accessor(getter="getGranteeId", setter="setGranteeId")
     * @SerializedName("granteeId")
     * @Type("string")
     * @XmlAttribute
     */
    private $granteeId;

    /**
     * Grantee name
     * @Accessor(getter="getGranteeName", setter="setGranteeName")
     * @SerializedName("granteeName")
     * @Type("string")
     * @XmlAttribute
     */
    private $granteeName;

    /**
     * Grantee display name
     * @Accessor(getter="getGranteeDisplayName", setter="setGranteeDisplayName")
     * @SerializedName("granteeDisplayName")
     * @Type("string")
     * @XmlAttribute
     */
    private $granteeDisplayName;

    /**
     * Returned if the share is already mounted.
     * Contains the folder id of the mountpoint in the local mailbox.
     * @Accessor(getter="getMountpointId", setter="setMountpointId")
     * @SerializedName("mid")
     * @Type("string")
     * @XmlAttribute
     */
    private $mountpointId;

    /**
     * Constructor method for ShareInfo
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
     * @return self
     */
    public function __construct(
        string $ownerId,
        string $ownerEmail,
        string $ownerDisplayName,
        int $folderId,
        string $folderUuid,
        string $folderPath,
        string $defaultView,
        string $rights,
        string $granteeType,
        string $granteeId,
        string $granteeName,
        string $granteeDisplayName,
        string $mountpointId = NULL
    )
    {
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
             ->setGranteeDisplayName($granteeDisplayName);

        if (NULL !== $mountpointId) {
            $this->setMountpointId($mountpointId);
        }
    }

    /**
     * Gets ownerId
     *
     * @return string
     */
    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    /**
     * Sets ownerId
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
     * Gets folderUuid
     *
     * @return int
     */
    public function getFolderUuid(): string
    {
        return $this->folderUuid;
    }

    /**
     * Sets folderUuid
     *
     * @param  int $folderUuid
     * @return self
     */
    public function setFolderUuid(string $folderUuid): self
    {
        $this->folderUuid = $folderUuid;
        return $this;
    }

    /**
     * Gets ownerEmail
     *
     * @return string
     */
    public function getOwnerEmail(): string
    {
        return $this->ownerEmail;
    }

    /**
     * Sets ownerEmail
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
     * Gets ownerDisplayName
     *
     * @return string
     */
    public function getOwnerDisplayName(): string
    {
        return $this->ownerDisplayName;
    }

    /**
     * Sets ownerDisplayName
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
     * Gets folderId
     *
     * @return int
     */
    public function getFolderId(): int
    {
        return $this->folderId;
    }

    /**
     * Sets folderId
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
     * Gets folderPath
     *
     * @return string
     */
    public function getFolderPath(): string
    {
        return $this->folderPath;
    }

    /**
     * Sets folderPath
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
     * Gets defaultView
     *
     * @return string
     */
    public function getDefaultView(): string
    {
        return $this->defaultView;
    }

    /**
     * Sets defaultView
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
     * Gets rights
     *
     * @return string
     */
    public function getRights(): string
    {
        return $this->rights;
    }

    /**
     * Sets rights
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
     * Gets granteeType
     *
     * @return string
     */
    public function getGranteeType(): string
    {
        return $this->granteeType;
    }

    /**
     * Sets granteeType
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
     * Gets granteeId
     *
     * @return string
     */
    public function getGranteeId(): string
    {
        return $this->granteeId;
    }

    /**
     * Sets granteeId
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
     * Gets granteeName
     *
     * @return string
     */
    public function getGranteeName(): string
    {
        return $this->granteeName;
    }

    /**
     * Sets granteeName
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
     * Gets granteeDisplayName
     *
     * @return string
     */
    public function getGranteeDisplayName(): string
    {
        return $this->granteeDisplayName;
    }

    /**
     * Sets granteeDisplayName
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
     * Gets mountpointId
     *
     * @return string
     */
    public function getMountpointId(): string
    {
        return $this->mountpointId;
    }

    /**
     * Sets mountpointId
     *
     * @param  string $mountpointId
     * @return self
     */
    public function setMountpointId(string $mountpointId): self
    {
        $this->mountpointId = $mountpointId;
        return $this;
    }
}
