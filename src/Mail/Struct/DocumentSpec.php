<?php declare(strict_types=1);
/**
 * This file is name of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Common\Enum\NewFileCreationTypes;
use Zimbra\Common\Struct\Id;

/**
 * DocumentSpec class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DocumentSpec
{
    /**
     * File name
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $name = null;

    /**
     * Content Type
     *
     * @var string
     */
    #[Accessor(getter: "getContentType", setter: "setContentType")]
    #[SerializedName("ct")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $contentType = null;

    /**
     * Absolute Folder path
     *
     * @var string
     */
    #[Accessor(getter: "getDescription", setter: "setDescription")]
    #[SerializedName("desc")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $description = null;

    /**
     * Folder ID
     *
     * @var string
     */
    #[Accessor(getter: "getFolderId", setter: "setFolderId")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $folderId = null;

    /**
     * Item ID
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $id = null;

    /**
     * Last known version
     *
     * @var int
     */
    #[Accessor(getter: "getVersion", setter: "setVersion")]
    #[SerializedName("ver")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $version = null;

    /**
     * Inlined document content string
     *
     * @var string
     */
    #[Accessor(getter: "getContent", setter: "setContent")]
    #[SerializedName("content")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $content = null;

    /**
     * Active sync status
     *
     * @var bool
     */
    #[Accessor(getter: "getDescEnabled", setter: "setDescEnabled")]
    #[SerializedName("descEnabled")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $descEnabled = null;

    /**
     * Flags - Any of the flags specified in soap.txt, with the addition of "t",
     * which specifies that the document is a note.
     *
     * @var string
     */
    #[Accessor(getter: "getFlags", setter: "setFlags")]
    #[SerializedName("f")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $flags = null;

    /**
     * Action on the Document
     *
     * @var string
     */
    #[Accessor(getter: "getAction", setter: "setAction")]
    #[SerializedName("action")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $action = null;

    /**
     * Type of document that can be created
     *
     * @var NewFileCreationTypes
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[XmlAttribute]
    private ?NewFileCreationTypes $type;

    /**
     * Upload specification
     *
     * @var Id
     */
    #[Accessor(getter: "getUpload", setter: "setUpload")]
    #[SerializedName("upload")]
    #[Type(Id::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?Id $upload;

    /**
     * Message part specification
     *
     * @var MessagePartSpec
     */
    #[Accessor(getter: "getMessagePart", setter: "setMessagePart")]
    #[SerializedName("m")]
    #[Type(MessagePartSpec::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?MessagePartSpec $messagePart;

    /**
     * Information on document version to restore to
     *
     * @var IdVersion
     */
    #[Accessor(getter: "getDocRevision", setter: "setDocRevision")]
    #[SerializedName("doc")]
    #[Type(IdVersion::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?IdVersion $docRevision;

    /**
     * Node ID for zExtras drive migration
     *
     * @var string
     */
    #[Accessor(getter: "getNodeId", setter: "setNodeId")]
    #[SerializedName("nodeId")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $nodeId = null;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  string $contentType
     * @param  string $description
     * @param  string $folderId
     * @param  string $id
     * @param  int $version
     * @param  string $content
     * @param  bool $descEnabled
     * @param  string $flags
     * @param  string $action
     * @param  NewFileCreationTypes $type
     * @param  Id $upload
     * @param  MessagePartSpec $messagePart
     * @param  IdVersion $docRevision
     * @param  string $nodeId
     * @return self
     */
    public function __construct(
        ?string $name = null,
        ?string $contentType = null,
        ?string $description = null,
        ?string $folderId = null,
        ?string $id = null,
        ?int $version = null,
        ?string $content = null,
        ?bool $descEnabled = null,
        ?string $flags = null,
        ?string $action = null,
        ?NewFileCreationTypes $type = null,
        ?Id $upload = null,
        ?MessagePartSpec $messagePart = null,
        ?IdVersion $docRevision = null,
        ?string $nodeId = null,
    ) {
        $this->upload = $upload;
        $this->messagePart = $messagePart;
        $this->docRevision = $docRevision;
        $this->type = $type;
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $contentType) {
            $this->setContentType($contentType);
        }
        if (null !== $description) {
            $this->setDescription($description);
        }
        if (null !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $version) {
            $this->setVersion($version);
        }
        if (null !== $content) {
            $this->setContent($content);
        }
        if (null !== $descEnabled) {
            $this->setDescEnabled($descEnabled);
        }
        if (null !== $flags) {
            $this->setFlags($flags);
        }
        if (null !== $action) {
            $this->setAction($action);
        }
        if (null !== $nodeId) {
            $this->setNodeId($nodeId);
        }
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
     * Get content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
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
     * Get action
     *
     * @return string
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  string $action
     * @return self
     */
    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Get type
     *
     * @return NewFileCreationTypes
     */
    public function getType(): ?NewFileCreationTypes
    {
        return $this->type;
    }

    /**
     * Set type enum
     *
     * @param  NewFileCreationTypes $type
     * @return self
     */
    public function setType(NewFileCreationTypes $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get upload
     *
     * @return Id
     */
    public function getUpload(): ?Id
    {
        return $this->upload;
    }

    /**
     * Set upload
     *
     * @param  Id $upload
     * @return self
     */
    public function setUpload(Id $upload): self
    {
        $this->upload = $upload;
        return $this;
    }

    /**
     * Get messagePart
     *
     * @return MessagePartSpec
     */
    public function getMessagePart(): ?MessagePartSpec
    {
        return $this->messagePart;
    }

    /**
     * Set messagePart
     *
     * @param  MessagePartSpec $messagePart
     * @return self
     */
    public function setMessagePart(MessagePartSpec $messagePart): self
    {
        $this->messagePart = $messagePart;
        return $this;
    }

    /**
     * Get docRevision
     *
     * @return IdVersion
     */
    public function getDocRevision(): ?IdVersion
    {
        return $this->docRevision;
    }

    /**
     * Set docRevision
     *
     * @param  IdVersion $docRevision
     * @return self
     */
    public function setDocRevision(IdVersion $docRevision): self
    {
        $this->docRevision = $docRevision;
        return $this;
    }

    /**
     * Get nodeId
     *
     * @return string
     */
    public function getNodeId(): ?string
    {
        return $this->nodeId;
    }

    /**
     * Set nodeId
     *
     * @param  string $nodeId
     * @return self
     */
    public function setNodeId(string $nodeId): self
    {
        $this->nodeId = $nodeId;
        return $this;
    }
}
