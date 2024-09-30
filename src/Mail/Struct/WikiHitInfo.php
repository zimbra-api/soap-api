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
 * WikiHitInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class WikiHitInfo extends CommonDocumentInfo implements SearchHit
{
    /**
     * Sort field value
     *
     * @Accessor(getter="getSortField", setter="setSortField")
     * @SerializedName("sf")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getSortField", setter: "setSortField")]
    #[SerializedName("sf")]
    #[Type("string")]
    #[XmlAttribute]
    private $sortField;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $sortField
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
        ?string $sortField = null,
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
    ) {
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
        if (null !== $sortField) {
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
