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
    Accessor, SerializedName, Type, XmlAttribute, XmlElement
};
use Zimbra\Type\Id;

/**
 * DocumentSpec class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DocumentSpec
{
    /**
     * File name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Content Type
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("ct")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentType;

    /**
     * Absolute Folder path
     * @Accessor(getter="getDescription", setter="setDescription")
     * @SerializedName("desc")
     * @Type("string")
     * @XmlAttribute
     */
    private $description;

    /**
     * Folder ID
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * Item ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Last known version
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("ver")
     * @Type("integer")
     * @XmlAttribute
     */
    private $version;

    /**
     * Inlined document content string
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("string")
     * @XmlAttribute
     */
    private $content;

    /**
     * Active sync status
     * @Accessor(getter="getDescEnabled", setter="setDescEnabled")
     * @SerializedName("descEnabled")
     * @Type("bool")
     * @XmlAttribute
     */
    private $descEnabled;

    /**
     * Flags - Any of the flags specified in soap.txt, with the addition of <b>"t"</b>, which
     * specifies that the document is a note.
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     */
    private $flags;

    /**
     * Upload specification
     * @Accessor(getter="getUpload", setter="setUpload")
     * @SerializedName("upload")
     * @Type("Zimbra\Type\Id")
     * @XmlElement
     */
    private $upload;

    /**
     * Message part specification
     * @Accessor(getter="getMessagePart", setter="setMessagePart")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\MessagePartSpec")
     * @XmlElement
     */
    private $messagePart;

    /**
     * Information on document version to restore to
     * @Accessor(getter="getDocRevision", setter="setDocRevision")
     * @SerializedName("doc")
     * @Type("Zimbra\Mail\Struct\IdVersion")
     * @XmlElement
     */
    private $docRevision;

    /**
     * Constructor method for Folder
     *
     * @param  string $id
     * @param  string $contentType
     * @return self
     */
    public function __construct(
        ?string $name = NULL,
        ?string $contentType = NULL,
        ?string $description = NULL,
        ?string $folderId = NULL,
        ?string $id = NULL,
        ?int $version = NULL,
        ?string $content = NULL,
        ?bool $descEnabled = NULL,
        ?string $flags = NULL,
        ?Id $upload = NULL,
        ?MessagePartSpec $messagePart = NULL,
        ?IdVersion $docRevision = NULL
    )
    {
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $contentType) {
            $this->setContentType($contentType);
        }
        if (NULL !== $description) {
            $this->setDescription($description);
        }
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $version) {
            $this->setVersion($version);
        }
        if (NULL !== $content) {
            $this->setContent($content);
        }
        if (NULL !== $descEnabled) {
            $this->setDescEnabled($descEnabled);
        }
        if (NULL !== $flags) {
            $this->setFlags($flags);
        }
        if ($upload instanceof Id) {
            $this->setUpload($upload);
        }
        if ($messagePart instanceof MessagePartSpec) {
            $this->setMessagePart($messagePart);
        }
        if ($docRevision instanceof IdVersion) {
            $this->setDocRevision($docRevision);
        }
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
        $this->version = in_array($version, range(0, 127)) ? $version : 0;
        return $this;
    }

    /**
     * Gets content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Sets content
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
     * Gets upload
     *
     * @return Id
     */
    public function getUpload(): ?Id
    {
        return $this->upload;
    }

    /**
     * Sets upload
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
     * Gets messagePart
     *
     * @return MessagePart
     */
    public function getMessagePart(): ?MessagePart
    {
        return $this->messagePart;
    }

    /**
     * Sets messagePart
     *
     * @param  MessagePart $messagePart
     * @return self
     */
    public function setMessagePart(MessagePart $messagePart): self
    {
        $this->messagePart = $messagePart;
        return $this;
    }

    /**
     * Gets messagePart
     *
     * @return IdVersion
     */
    public function getDocRevision(): ?IdVersion
    {
        return $this->messagePart;
    }

    /**
     * Sets docRevision
     *
     * @param  IdVersion $docRevision
     * @return self
     */
    public function setDocRevision(IdVersion $docRevision): self
    {
        $this->docRevision = $docRevision;
        return $this;
    }
}
