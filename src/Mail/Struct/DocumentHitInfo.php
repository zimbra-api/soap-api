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
use Zimbra\Common\Struct\SearchHit;

/**
 * DocumentHitInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DocumentHitInfo extends DocumentInfo implements SearchHit
{
    /**
     * Sort field value
     * @Accessor(getter="getSortField", setter="setSortField")
     * @SerializedName("sf")
     * @Type("string")
     * @XmlAttribute
     */
    private $sortField;

    /**
     * Constructor method
     *
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?string $sortField = NULL,
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
            $lockOwnerId,
            $lockOwnerEmail,
            $lockOwnerTimestamp,
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
        if (NULL !== $sortField) {
            $this->setSortField($sortField);
        }
    }

    public function setId(string $id): self
    {
        parent::setId($id);
        return $this;
    }

    /**
     * Get sortField
     *
     * @return string
     */
    public function getSortField(): ?string
    {
        return $this->sortField;
    }

    /**
     * Set sortField
     *
     * @param  string $sortField
     * @return self
     */
    public function setSortField(string $sortField): self
    {
        $this->sortField = $sortField;
        return $this;
    }
}
