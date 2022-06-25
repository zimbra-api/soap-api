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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};

/**
 * CommonDocumentInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CommonDocumentInfo
{
    /**
     * ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Item's UUID - a globally unique identifier
     * @Accessor(getter="getUuid", setter="setUuid")
     * @SerializedName("uuid")
     * @Type("string")
     * @XmlAttribute
     */
    private $uuid;

    /**
     * Name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Size
     * @Accessor(getter="getSize", setter="setSize")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $size;

    /**
     * Date the item's content was last modified in milliseconds since 1970-01-01 00:00:00 UTC.
     * For immutable objects (e.g. received messages), this will be the same as the date the item was created.
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("integer")
     * @XmlAttribute
     */
    private $date;

    /**
     * Folder ID
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * Folder UUID
     * @Accessor(getter="getFolderUuid", setter="setFolderUuid")
     * @SerializedName("luuid")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderUuid;

    /**
     * Modified sequence
     * @Accessor(getter="getModifiedSequence", setter="setModifiedSequence")
     * @SerializedName("ms")
     * @Type("integer")
     * @XmlAttribute
     */
    private $modifiedSequence;

    /**
     * Metadata version
     * @Accessor(getter="getMetadataVersion", setter="setMetadataVersion")
     * @SerializedName("mdver")
     * @Type("integer")
     * @XmlAttribute
     */
    private $metadataVersion;

    /**
     * The date the item's metadata and/or content was last modified in seconds since
     * 1970-01-01 00:00:00 UTC.
     * @Accessor(getter="getChangeDate", setter="setChangeDate")
     * @SerializedName("md")
     * @Type("integer")
     * @XmlAttribute
     */
    private $changeDate;

    /**
     * Revision
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("integer")
     * @XmlAttribute
     */
    private $revision;

    /**
     * Flags
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     */
    private $flags;

    /**
     * Tags - Comma separated list of integers.  DEPRECATED - use "tn" instead
     * @Accessor(getter="getTags", setter="setTags")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     */
    private $tags;

    /**
     * Comma-separated list of tag names
     * @Accessor(getter="getTagNames", setter="setTagNames")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     */
    private $tagNames;

    /**
     * Optional description
     * @Accessor(getter="getDescription", setter="setDescription")
     * @SerializedName("desc")
     * @Type("string")
     * @XmlAttribute
     */
    private $description;

    /**
     * Content type
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("ct")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentType;

    /**
     * Flags whether description is enabled or not
     * @Accessor(getter="getDescEnabled", setter="setDescEnabled")
     * @SerializedName("descEnabled")
     * @Type("bool")
     * @XmlAttribute
     */
    private $descEnabled;

    /**
     * Version
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("ver")
     * @Type("integer")
     * @XmlAttribute
     */
    private $version;

    /**
     * Last edited by
     * @Accessor(getter="getLastEditedBy", setter="setLastEditedBy")
     * @SerializedName("leb")
     * @Type("string")
     * @XmlAttribute
     */
    private $lastEditedBy;

    /**
     * Revision creator
     * @Accessor(getter="getCreator", setter="setCreator")
     * @SerializedName("cr")
     * @Type("string")
     * @XmlAttribute
     */
    private $creator;

    /**
     * Revision creation date in milliseconds since 1970-01-01 00:00:00 UTC.
     * @Accessor(getter="getCreatedDate", setter="setCreatedDate")
     * @SerializedName("cd")
     * @Type("integer")
     * @XmlAttribute
     */
    private $createdDate;

    /**
     * Custom metadata information
     * @Accessor(getter="getMetadatas", setter="setMetadatas")
     * @SerializedName("meta")
     * @Type("array<Zimbra\Mail\Struct\MailCustomMetadata>")
     * @XmlList(inline=true, entry="meta")
     */
    private $metadatas = [];

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $fragment;

    /**
     * ACL for sharing
     * @Accessor(getter="getAcl", setter="setAcl")
     * @SerializedName("acl")
     * @Type("Zimbra\Mail\Struct\Acl")
     * @XmlElement
     */
    private ?Acl $acl = NULL;

    /**
     * Constructor method
     *
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
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
        $this->setMetadatas($metadatas);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $uuid) {
            $this->setUuid($uuid);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $size) {
            $this->setSize($size);
        }
        if (NULL !== $date) {
            $this->setDate($date);
        }
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (NULL !== $folderUuid) {
            $this->setFolderUuid($folderUuid);
        }
        if (NULL !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (NULL !== $metadataVersion) {
            $this->setMetadataVersion($metadataVersion);
        }
        if (NULL !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (NULL !== $revision) {
            $this->setRevision($revision);
        }
        if (NULL !== $flags) {
            $this->setFlags($flags);
        }
        if (NULL !== $tags) {
            $this->setTags($tags);
        }
        if (NULL !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (NULL !== $description) {
            $this->setDescription($description);
        }
        if (NULL !== $contentType) {
            $this->setContentType($contentType);
        }
        if (NULL !== $descEnabled) {
            $this->setDescEnabled($descEnabled);
        }
        if (NULL !== $version) {
            $this->setVersion($version);
        }
        if (NULL !== $lastEditedBy) {
            $this->setLastEditedBy($lastEditedBy);
        }
        if (NULL !== $creator) {
            $this->setCreator($creator);
        }
        if (NULL !== $createdDate) {
            $this->setCreatedDate($createdDate);
        }
        if (NULL !== $fragment) {
            $this->setFragment($fragment);
        }
        if ($acl instanceof Acl) {
            $this->setAcl($acl);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets uuid
     *
     * @return string
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * Sets uuid
     *
     * @param  string $uuid
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets size
     *
     * @return int
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Sets size
     *
     * @param  int $size
     * @return self
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Gets date
     *
     * @return int
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Sets date
     *
     * @param  int $date
     * @return self
     */
    public function setDate(int $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Gets folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Sets folderId
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId(string $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Gets folderUuid
     *
     * @return string
     */
    public function getFolderUuid(): ?string
    {
        return $this->folderUuid;
    }

    /**
     * Sets folderUuid
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
     * Gets modifiedSequence
     *
     * @return int
     */
    public function getModifiedSequence(): ?int
    {
        return $this->modifiedSequence;
    }

    /**
     * Sets modifiedSequence
     *
     * @param  int $modifiedSequence
     * @return self
     */
    public function setModifiedSequence(int $modifiedSequence): self
    {
        $this->modifiedSequence = $modifiedSequence;
        return $this;
    }

    /**
     * Gets metadataVersion
     *
     * @return int
     */
    public function getMetadataVersion(): ?int
    {
        return $this->metadataVersion;
    }

    /**
     * Sets metadataVersion
     *
     * @param  int $metadataVersion
     * @return self
     */
    public function setMetadataVersion(int $metadataVersion): self
    {
        $this->metadataVersion = $metadataVersion;
        return $this;
    }

    /**
     * Gets changeDate
     *
     * @return int
     */
    public function getChangeDate(): ?int
    {
        return $this->changeDate;
    }

    /**
     * Sets changeDate
     *
     * @param  int $changeDate
     * @return self
     */
    public function setChangeDate(int $changeDate): self
    {
        $this->changeDate = $changeDate;
        return $this;
    }

    /**
     * Gets revision
     *
     * @return int
     */
    public function getRevision(): ?int
    {
        return $this->revision;
    }

    /**
     * Sets revision
     *
     * @param  int $revision
     * @return self
     */
    public function setRevision(int $revision): self
    {
        $this->revision = $revision;
        return $this;
    }

    /**
     * Gets flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Sets flags
     *
     * @param  string $flags
     * @return self
     */
    public function setFlags(string $flags): self
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * Gets tags
     *
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * Sets tags
     *
     * @param  string $tags
     * @return self
     */
    public function setTags(string $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Gets tagNames
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Sets tagNames
     *
     * @param  string $tagNames
     * @return self
     */
    public function setTagNames(string $tagNames): self
    {
        $this->tagNames = $tagNames;
        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Sets description
     *
     * @param  string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets contentType
     *
     * @return string
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * Sets contentType
     *
     * @param  string $contentType
     * @return self
     */
    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * Gets descEnabled
     *
     * @return bool
     */
    public function getDescEnabled(): ?bool
    {
        return $this->descEnabled;
    }

    /**
     * Sets descEnabled
     *
     * @param  bool $descEnabled
     * @return self
     */
    public function setDescEnabled(bool $descEnabled): self
    {
        $this->descEnabled = $descEnabled;
        return $this;
    }

    /**
     * Gets version
     *
     * @return int
     */
    public function getVersion(): ?int
    {
        return $this->version;
    }

    /**
     * Sets version
     *
     * @param  int $version
     * @return self
     */
    public function setVersion(int $version): self
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Gets lastEditedBy
     *
     * @return string
     */
    public function getLastEditedBy(): ?string
    {
        return $this->lastEditedBy;
    }

    /**
     * Sets lastEditedBy
     *
     * @param  string $lastEditedBy
     * @return self
     */
    public function setLastEditedBy(string $lastEditedBy): self
    {
        $this->lastEditedBy = $lastEditedBy;
        return $this;
    }

    /**
     * Gets creator
     *
     * @return string
     */
    public function getCreator(): ?string
    {
        return $this->creator;
    }

    /**
     * Sets creator
     *
     * @param  string $creator
     * @return self
     */
    public function setCreator(string $creator): self
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * Gets createdDate
     *
     * @return int
     */
    public function getCreatedDate(): ?int
    {
        return $this->createdDate;
    }

    /**
     * Sets createdDate
     *
     * @param  int $createdDate
     * @return self
     */
    public function setCreatedDate(int $createdDate): self
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * Gets metadatas
     *
     * @return array
     */
    public function getMetadatas(): array
    {
        return $this->metadatas;
    }

    /**
     * Sets metadatas
     *
     * @param  array $metadatas
     * @return self
     */
    public function setMetadatas(array $metadatas): self
    {
        $this->metadatas = array_filter($metadatas, static fn($metadata) => $metadata instanceof MailCustomMetadata);
        return $this;
    }

    /**
     * Add metadata
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function addMetadata(MailCustomMetadata $metadata): self
    {
        $this->metadatas[] = $metadata;
        return $this;
    }

    /**
     * Gets fragment
     *
     * @return string
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * Sets fragment
     *
     * @param  string $fragment
     * @return self
     */
    public function setFragment(string $fragment): self
    {
        $this->fragment = $fragment;
        return $this;
    }

    /**
     * Gets acl
     *
     * @return Acl
     */
    public function getAcl(): ?Acl
    {
        return $this->acl;
    }

    /**
     * Sets acl
     *
     * @param  Acl $acl
     * @return self
     */
    public function setAcl(Acl $acl): self
    {
        $this->acl = $acl;
        return $this;
    }
}
