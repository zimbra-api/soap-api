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
use Zimbra\Struct\PartInfoInterface;

/**
 * PartInfo class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class PartInfo implements PartInfoInterface
{
    /**
     * MIME part name. "" means top-level part, 1 first part, 1.1 first part of a multipart
     * inside of 1.
     * @Accessor(getter="getPart", setter="setPart")
     * @SerializedName("part")
     * @Type("string")
     * @XmlAttribute
     */
    private $part;

    /**
     * MIME Content-Type. The mime type is the content of the element.
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("ct")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentType;

    /**
     * Size in bytes
     * @Accessor(getter="getSize", setter="setSize")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $size;

    /**
     * MIME Content-Disposition
     * @Accessor(getter="getContentDisposition", setter="setContentDisposition")
     * @SerializedName("cd")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentDisposition;

    /**
     * Filename attribute from the Content-Disposition param list
     * @Accessor(getter="getContentFilename", setter="setContentFilename")
     * @SerializedName("filename")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentFilename;

    /**
     * MIME Content-ID (for display of embedded images)
     * @Accessor(getter="getContentId", setter="setContentId")
     * @SerializedName("ci")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentId;

    /**
     * MIME/Microsoft Content-Location (for display of embedded images)
     * @Accessor(getter="getLocation", setter="setLocation")
     * @SerializedName("cl")
     * @Type("string")
     * @XmlAttribute
     */
    private $location;

    /**
     * Set if this part is considered to be the "body" of the message for display purposes.
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("body")
     * @Type("bool")
     * @XmlAttribute
     */
    private $body;

    /**
     * Set if the content for the part is truncated
     * @Accessor(getter="getTruncatedContent", setter="setTruncatedContent")
     * @SerializedName("truncated")
     * @Type("bool")
     * @XmlAttribute
     */
    private $truncatedContent;

    /**
     * The content of the part, if requested
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $content;

    /**
     * Mime parts
     * @Accessor(getter="getMimeParts", setter="setMimeParts")
     * @SerializedName("mp")
     * @Type("array<Zimbra\Mail\Struct\PartInfo>")
     * @XmlList(inline = true, entry = "mp")
     */
    private $mimeParts = [];

    /**
     * Constructor method for PartInfo
     *
     * @param  string $part
     * @param  string $contentType
     * @param  int $size
     * @param  string $contentDisposition
     * @param  string $contentFilename
     * @param  string $contentId
     * @param  string $location
     * @param  bool $body
     * @param  bool $truncatedContent
     * @param  string $content
     * @param  array $mimeParts
     * @return self
     */
    public function __construct(
        string $part,
        string $contentType,
        ?int $size = NULL,
        ?string $contentDisposition = NULL,
        ?string $contentFilename = NULL,
        ?string $contentId = NULL,
        ?string $location = NULL,
        ?bool $body = NULL,
        ?bool $truncatedContent = NULL,
        ?string $content = NULL,
        array $mimeParts = []
    )
    {
        $this->setPart($part)
             ->setContentType($contentType)
             ->setMimeParts($mimeParts);
        if (NULL !== $size) {
            $this->setSize($size);
        }
        if (NULL !== $contentDisposition) {
            $this->setContentDisposition($contentDisposition);
        }
        if (NULL !== $contentFilename) {
            $this->setContentFilename($contentFilename);
        }
        if (NULL !== $contentId) {
            $this->setContentId($contentId);
        }
        if (NULL !== $location) {
            $this->setLocation($location);
        }
        if (NULL !== $body) {
            $this->setBody($body);
        }
        if (NULL !== $truncatedContent) {
            $this->setTruncatedContent($truncatedContent);
        }
        if (NULL !== $content) {
            $this->setContent($content);
        }
    }

    /**
     * Gets part
     *
     * @return string
     */
    public function getPart(): string
    {
        return $this->part;
    }

    /**
     * Sets part
     *
     * @param  string $part
     * @return self
     */
    public function setPart(string $part): self
    {
        $this->part = $part;
        return $this;
    }

    /**
     * Gets contentType
     *
     * @return string
     */
    public function getContentType(): string
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
     * Gets contentDisposition
     *
     * @return string
     */
    public function getContentDisposition(): ?string
    {
        return $this->contentDisposition;
    }

    /**
     * Sets contentDisposition
     *
     * @param  string $contentDisposition
     * @return self
     */
    public function setContentDisposition(string $contentDisposition): self
    {
        $this->contentDisposition = $contentDisposition;
        return $this;
    }

    /**
     * Gets contentFilename
     *
     * @return string
     */
    public function getContentFilename(): ?string
    {
        return $this->contentFilename;
    }

    /**
     * Sets contentFilename
     *
     * @param  string $contentFilename
     * @return self
     */
    public function setContentFilename(string $contentFilename): self
    {
        $this->contentFilename = $contentFilename;
        return $this;
    }

    /**
     * Gets contentId
     *
     * @return string
     */
    public function getContentId(): ?string
    {
        return $this->contentId;
    }

    /**
     * Sets contentId
     *
     * @param  string $contentId
     * @return self
     */
    public function setContentId(string $contentId): self
    {
        $this->contentId = $contentId;
        return $this;
    }

    /**
     * Gets location
     *
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * Sets location
     *
     * @param  string $location
     * @return self
     */
    public function setLocation(string $location): self
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Gets body
     *
     * @return bool
     */
    public function getBody(): ?bool
    {
        return $this->body;
    }

    /**
     * Sets body
     *
     * @param  bool $body
     * @return self
     */
    public function setBody(bool $body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Gets truncatedContent
     *
     * @return bool
     */
    public function getTruncatedContent(): ?bool
    {
        return $this->truncatedContent;
    }

    /**
     * Sets truncatedContent
     *
     * @param  bool $truncatedContent
     * @return self
     */
    public function setTruncatedContent(bool $truncatedContent): self
    {
        $this->truncatedContent = $truncatedContent;
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
     * Sets mimeParts
     *
     * @param  array $mimeParts
     * @return self
     */
    public function setMimeParts(array $mimeParts): self
    {
        $this->mimeParts = [];
        foreach ($mimeParts as $mimePart) {
            if ($mimePart instanceof PartInfoInterface) {
                $this->mimeParts[] = $mimePart;
            }
        }
        return $this;
    }

    /**
     * Gets mimeParts
     *
     * @return array
     */
    public function getMimeParts(): array
    {
        return $this->mimeParts;
    }

    /**
     * Add mimePart
     *
     * @param  PartInfoInterface $mimePart
     * @return self
     */
    public function addMimePart(PartInfoInterface $mimePart): self
    {
        $this->mimeParts[] = $mimePart;
        return $this;
    }
}
