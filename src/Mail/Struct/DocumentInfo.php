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
 * DocumentInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DocumentInfo extends CommonDocumentInfo
{
    /**
     * Lock owner account ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getLockOwnerId', setter: 'setLockOwnerId')]
    #[SerializedName('loid')]
    #[Type('string')]
    #[XmlAttribute]
    private $lockOwnerId;

    /**
     * Lock owner account email address
     * 
     * @var string
     */
    #[Accessor(getter: 'getLockOwnerEmail', setter: 'setLockOwnerEmail')]
    #[SerializedName('loe')]
    #[Type('string')]
    #[XmlAttribute]
    private $lockOwnerEmail;

    /**
     * Lock timestamp
     * 
     * @var string
     */
    #[Accessor(getter: 'getLockOwnerTimestamp', setter: 'setLockOwnerTimestamp')]
    #[SerializedName('lt')]
    #[Type('string')]
    #[XmlAttribute]
    private $lockOwnerTimestamp;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $lockOwnerId
     * @param  string $lockOwnerEmail
     * @param  string $lockOwnerTimestamp
     * @param  string $uuid
     * @param  string $name
     * @param  int $size
     * @param  int $date
     * @param  string $folderId
     * @param  string $folderUuid
     * @param  int $modifiedSequence
     * @param  int $metadataVersion
     * @param  int $changeDate
     * @param  int $revision
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  string $description
     * @param  string $contentType
     * @param  bool $descEnabled
     * @param  int $version
     * @param  string $lastEditedBy
     * @param  string $creator
     * @param  int $createdDate
     * @param  array $metadatas
     * @param  string $fragment
     * @param  Acl $acl
     * @return self
     */
    public function __construct(
        ?string $id = null,
        ?string $lockOwnerId = null,
        ?string $lockOwnerEmail = null,
        ?string $lockOwnerTimestamp = null,
        ?string $uuid = null,
        ?string $name = null,
        ?int $size = null,
        ?int $date = null,
        ?string $folderId = null,
        ?string $folderUuid = null,
        ?int $modifiedSequence = null,
        ?int $metadataVersion = null,
        ?int $changeDate = null,
        ?int $revision = null,
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?string $description = null,
        ?string $contentType = null,
        ?bool $descEnabled = null,
        ?int $version = null,
        ?string $lastEditedBy = null,
        ?string $creator = null,
        ?int $createdDate = null,
        array $metadatas = [],
        ?string $fragment = null,
        ?Acl $acl = null
    )
    {
        parent::__construct(
            $id,
            $uuid,
            $name,
            $size,
            $date,
            $folderId,
            $folderUuid,
            $modifiedSequence,
            $metadataVersion,
            $changeDate,
            $revision,
            $flags,
            $tags,
            $tagNames,
            $description,
            $contentType,
            $descEnabled,
            $version,
            $lastEditedBy,
            $creator,
            $createdDate,
            $metadatas = [],
            $fragment,
            $acl
        );
        if (null !== $lockOwnerId) {
            $this->setLockOwnerId($lockOwnerId);
        }
        if (null !== $lockOwnerEmail) {
            $this->setLockOwnerEmail($lockOwnerEmail);
        }
        if (null !== $lockOwnerTimestamp) {
            $this->setLockOwnerTimestamp($lockOwnerTimestamp);
        }
    }

    /**
     * Get lockOwnerId
     *
     * @return string
     */
    public function getLockOwnerId(): ?string
    {
        return $this->lockOwnerId;
    }

    /**
     * Set lockOwnerId
     *
     * @param  string $lockOwnerId
     * @return self
     */
    public function setLockOwnerId(string $lockOwnerId): self
    {
        $this->lockOwnerId = $lockOwnerId;
        return $this;
    }

    /**
     * Get lockOwnerEmail
     *
     * @return string
     */
    public function getLockOwnerEmail(): ?string
    {
        return $this->lockOwnerEmail;
    }

    /**
     * Set lockOwnerEmail
     *
     * @param  string $lockOwnerEmail
     * @return self
     */
    public function setLockOwnerEmail(string $lockOwnerEmail): self
    {
        $this->lockOwnerEmail = $lockOwnerEmail;
        return $this;
    }

    /**
     * Get lockOwnerTimestamp
     *
     * @return string
     */
    public function getLockOwnerTimestamp(): ?string
    {
        return $this->lockOwnerTimestamp;
    }

    /**
     * Set lockOwnerTimestamp
     *
     * @param  string $lockOwnerTimestamp
     * @return self
     */
    public function setLockOwnerTimestamp(string $lockOwnerTimestamp): self
    {
        $this->lockOwnerTimestamp = $lockOwnerTimestamp;
        return $this;
    }
}