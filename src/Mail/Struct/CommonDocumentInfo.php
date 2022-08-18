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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CommonDocumentInfo
{
    /**
     * ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Item's UUID - a globally unique identifier
     * 
     * @Accessor(getter="getUuid", setter="setUuid")
     * @SerializedName("uuid")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getUuid', setter: 'setUuid')]
    #[SerializedName('uuid')]
    #[Type('string')]
    #[XmlAttribute]
    private $uuid;

    /**
     * Name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * Size
     * 
     * @Accessor(getter="getSize", setter="setSize")
     * @SerializedName("s")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getSize', setter: 'setSize')]
    #[SerializedName('s')]
    #[Type('int')]
    #[XmlAttribute]
    private $size;

    /**
     * Date the item's content was last modified in milliseconds since 1970-01-01 00:00:00 UTC.
     * For immutable objects (e.g. received messages), this will be the same as the date the item was created.
     * 
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getDate', setter: 'setDate')]
    #[SerializedName('d')]
    #[Type('int')]
    #[XmlAttribute]
    private $date;

    /**
     * Folder ID
     * 
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolderId', setter: 'setFolderId')]
    #[SerializedName('l')]
    #[Type('string')]
    #[XmlAttribute]
    private $folderId;

    /**
     * Folder UUID
     * 
     * @Accessor(getter="getFolderUuid", setter="setFolderUuid")
     * @SerializedName("luuid")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolderUuid', setter: 'setFolderUuid')]
    #[SerializedName('luuid')]
    #[Type('string')]
    #[XmlAttribute]
    private $folderUuid;

    /**
     * Modified sequence
     * 
     * @Accessor(getter="getModifiedSequence", setter="setModifiedSequence")
     * @SerializedName("ms")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getModifiedSequence', setter: 'setModifiedSequence')]
    #[SerializedName('ms')]
    #[Type('int')]
    #[XmlAttribute]
    private $modifiedSequence;

    /**
     * Metadata version
     * 
     * @Accessor(getter="getMetadataVersion", setter="setMetadataVersion")
     * @SerializedName("mdver")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getMetadataVersion', setter: 'setMetadataVersion')]
    #[SerializedName('mdver')]
    #[Type('int')]
    #[XmlAttribute]
    private $metadataVersion;

    /**
     * The date the item's metadata and/or content was last modified in seconds since
     * 1970-01-01 00:00:00 UTC.
     * 
     * @Accessor(getter="getChangeDate", setter="setChangeDate")
     * @SerializedName("md")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getChangeDate', setter: 'setChangeDate')]
    #[SerializedName('md')]
    #[Type('int')]
    #[XmlAttribute]
    private $changeDate;

    /**
     * Revision
     * 
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getRevision', setter: 'setRevision')]
    #[SerializedName('rev')]
    #[Type('int')]
    #[XmlAttribute]
    private $revision;

    /**
     * Flags
     * 
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getFlags', setter: 'setFlags')]
    #[SerializedName('f')]
    #[Type('string')]
    #[XmlAttribute]
    private $flags;

    /**
     * Tags - Comma separated list of ints.  DEPRECATED - use "tn" instead
     * 
     * @Accessor(getter="getTags", setter="setTags")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getTags', setter: 'setTags')]
    #[SerializedName('t')]
    #[Type('string')]
    #[XmlAttribute]
    private $tags;

    /**
     * Comma-separated list of tag names
     * 
     * @Accessor(getter="getTagNames", setter="setTagNames")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getTagNames', setter: 'setTagNames')]
    #[SerializedName('tn')]
    #[Type('string')]
    #[XmlAttribute]
    private $tagNames;

    /**
     * Optional description
     * 
     * @Accessor(getter="getDescription", setter="setDescription")
     * @SerializedName("desc")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getDescription', setter: 'setDescription')]
    #[SerializedName('desc')]
    #[Type('string')]
    #[XmlAttribute]
    private $description;

    /**
     * Content type
     * 
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("ct")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getContentType', setter: 'setContentType')]
    #[SerializedName('ct')]
    #[Type('string')]
    #[XmlAttribute]
    private $contentType;

    /**
     * Flags whether description is enabled or not
     * 
     * @Accessor(getter="getDescEnabled", setter="setDescEnabled")
     * @SerializedName("descEnabled")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getDescEnabled', setter: 'setDescEnabled')]
    #[SerializedName('descEnabled')]
    #[Type('bool')]
    #[XmlAttribute]
    private $descEnabled;

    /**
     * Version
     * 
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("ver")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getVersion', setter: 'setVersion')]
    #[SerializedName('ver')]
    #[Type('int')]
    #[XmlAttribute]
    private $version;

    /**
     * Last edited by
     * 
     * @Accessor(getter="getLastEditedBy", setter="setLastEditedBy")
     * @SerializedName("leb")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getLastEditedBy', setter: 'setLastEditedBy')]
    #[SerializedName('leb')]
    #[Type('string')]
    #[XmlAttribute]
    private $lastEditedBy;

    /**
     * Revision creator
     * 
     * @Accessor(getter="getCreator", setter="setCreator")
     * @SerializedName("cr")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getCreator', setter: 'setCreator')]
    #[SerializedName('cr')]
    #[Type('string')]
    #[XmlAttribute]
    private $creator;

    /**
     * Revision creation date in milliseconds since 1970-01-01 00:00:00 UTC.
     * 
     * @Accessor(getter="getCreatedDate", setter="setCreatedDate")
     * @SerializedName("cd")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getCreatedDate', setter: 'setCreatedDate')]
    #[SerializedName('cd')]
    #[Type('int')]
    #[XmlAttribute]
    private $createdDate;

    /**
     * Custom metadata information
     * 
     * @Accessor(getter="getMetadatas", setter="setMetadatas")
     * @Type("array<Zimbra\Mail\Struct\MailCustomMetadata>")
     * @XmlList(inline=true, entry="meta", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getMetadatas', setter: 'setMetadatas')]
    #[Type('array<Zimbra\Mail\Struct\MailCustomMetadata>')]
    #[XmlList(inline: true, entry: 'meta', namespace: 'urn:zimbraMail')]
    private $metadatas = [];

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * 
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     * 
     * @var string
     */
    #[Accessor(getter: "getFragment", setter: "setFragment")]
    #[SerializedName('fr')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $fragment;

    /**
     * ACL for sharing
     * 
     * @Accessor(getter="getAcl", setter="setAcl")
     * @SerializedName("acl")
     * @Type("Zimbra\Mail\Struct\Acl")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var Acl
     */
    #[Accessor(getter: "getAcl", setter: "setAcl")]
    #[SerializedName('acl')]
    #[Type(Acl::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $acl;

    /**
     * Constructor
     *
     * @param  string $id
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
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get uuid
     *
     * @return string
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * Set uuid
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
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get size
     *
     * @return int
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Set size
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
     * Get date
     *
     * @return int
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Set date
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
     * Get folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Set folderId
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
     * Get folderUuid
     *
     * @return string
     */
    public function getFolderUuid(): ?string
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
     * Get modifiedSequence
     *
     * @return int
     */
    public function getModifiedSequence(): ?int
    {
        return $this->modifiedSequence;
    }

    /**
     * Set modifiedSequence
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
     * Get metadataVersion
     *
     * @return int
     */
    public function getMetadataVersion(): ?int
    {
        return $this->metadataVersion;
    }

    /**
     * Set metadataVersion
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
     * Get changeDate
     *
     * @return int
     */
    public function getChangeDate(): ?int
    {
        return $this->changeDate;
    }

    /**
     * Set changeDate
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
     * Get revision
     *
     * @return int
     */
    public function getRevision(): ?int
    {
        return $this->revision;
    }

    /**
     * Set revision
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
     * Get flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Set flags
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
     * Get tags
     *
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * Set tags
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
     * Get tagNames
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Set tagNames
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
     * Get description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set description
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
     * Get contentType
     *
     * @return string
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * Set contentType
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
     * Get descEnabled
     *
     * @return bool
     */
    public function getDescEnabled(): ?bool
    {
        return $this->descEnabled;
    }

    /**
     * Set descEnabled
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
     * Get version
     *
     * @return int
     */
    public function getVersion(): ?int
    {
        return $this->version;
    }

    /**
     * Set version
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
     * Get lastEditedBy
     *
     * @return string
     */
    public function getLastEditedBy(): ?string
    {
        return $this->lastEditedBy;
    }

    /**
     * Set lastEditedBy
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
     * Get creator
     *
     * @return string
     */
    public function getCreator(): ?string
    {
        return $this->creator;
    }

    /**
     * Set creator
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
     * Get createdDate
     *
     * @return int
     */
    public function getCreatedDate(): ?int
    {
        return $this->createdDate;
    }

    /**
     * Set createdDate
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
     * Get metadatas
     *
     * @return array
     */
    public function getMetadatas(): array
    {
        return $this->metadatas;
    }

    /**
     * Set metadatas
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
     * Get fragment
     *
     * @return string
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * Set fragment
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
     * Get acl
     *
     * @return Acl
     */
    public function getAcl(): ?Acl
    {
        return $this->acl;
    }

    /**
     * Set acl
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
