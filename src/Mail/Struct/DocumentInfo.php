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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DocumentInfo extends CommonDocumentInfo
{
    /**
     * Lock owner account ID
     * @Accessor(getter="getLockOwnerId", setter="setLockOwnerId")
     * @SerializedName("loid")
     * @Type("string")
     * @XmlAttribute
     */
    private $lockOwnerId;

    /**
     * Lock owner account email address
     * @Accessor(getter="getLockOwnerEmail", setter="setLockOwnerEmail")
     * @SerializedName("loe")
     * @Type("string")
     * @XmlAttribute
     */
    private $lockOwnerEmail;

    /**
     * Lock timestamp
     * @Accessor(getter="getLockOwnerTimestamp", setter="setLockOwnerTimestamp")
     * @SerializedName("lt")
     * @Type("string")
     * @XmlAttribute
     */
    private $lockOwnerTimestamp;

    /**
     * Constructor method
     *
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?string $lockOwnerId = NULL,
        ?string $lockOwnerEmail = NULL,
        ?string $lockOwnerTimestamp = NULL,
        ?string $uuid = NULL,
        ?string $name = NULL,
        ?int $size = NULL,
        ?int $date = NULL,
        ?string $folderId = NULL,
        ?string $folderUuid = NULL,
        ?int $modifiedSequence = NULL,
        ?int $metadataVersion = NULL,
        ?int $changeDate = NULL,
        ?int $revision = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?string $description = NULL,
        ?string $contentType = NULL,
        ?bool $descEnabled = NULL,
        ?int $version = NULL,
        ?string $lastEditedBy = NULL,
        ?string $creator = NULL,
        ?int $createdDate = NULL,
        array $metadatas = [],
        ?string $fragment = NULL,
        ?Acl $acl = NULL
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
        if (NULL !== $lockOwnerId) {
            $this->setLockOwnerId($lockOwnerId);
        }
        if (NULL !== $lockOwnerEmail) {
            $this->setLockOwnerEmail($lockOwnerEmail);
        }
        if (NULL !== $lockOwnerTimestamp) {
            $this->setLockOwnerTimestamp($lockOwnerTimestamp);
        }
    }

    /**
     * Gets lockOwnerId
     *
     * @return string
     */
    public function getLockOwnerId(): ?string
    {
        return $this->lockOwnerId;
    }

    /**
     * Sets lockOwnerId
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
     * Gets lockOwnerEmail
     *
     * @return string
     */
    public function getLockOwnerEmail(): ?string
    {
        return $this->lockOwnerEmail;
    }

    /**
     * Sets lockOwnerEmail
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
     * Gets lockOwnerTimestamp
     *
     * @return string
     */
    public function getLockOwnerTimestamp(): ?string
    {
        return $this->lockOwnerTimestamp;
    }

    /**
     * Sets lockOwnerTimestamp
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