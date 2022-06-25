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
 * MimePartInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MimePartInfo
{
    /**
     * Content type
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("ct")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentType;

    /**
     * Content
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("string")
     * @XmlAttribute
     */
    private $content;

    /**
     * Content ID
     * @Accessor(getter="getContentId", setter="setContentId")
     * @SerializedName("ci")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentId;

    /**
     * MIME Parts
     * @Accessor(getter="getMimeParts", setter="setMimeParts")
     * @SerializedName("mp")
     * @Type("array<Zimbra\Mail\Struct\MimePartInfo>")
     * @XmlList(inline=true, entry="mp")
     */
    private $mimeParts = [];

    /**
     * Attachments
     * @Accessor(getter="getAttachments", setter="setAttachments")
     * @SerializedName("attach")
     * @Type("Zimbra\Mail\Struct\AttachmentsInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?AttachmentsInfo $attachments = NULL;

    /**
     * Constructor method
     *
     * @param string $contentType
     * @param string $content
     * @param string $contentId
     * @param AttachmentsInfo $attachments
     * @param array $mimeParts
     * @return self
     */
    public function __construct(
        ?string $contentType = NULL,
        ?string $content = NULL,
        ?string $contentId = NULL,
        ?AttachmentsInfo $attachments = NULL,
        array $mimeParts = []
    )
    {
        $this->setMimeParts($mimeParts);
        if (NULL !== $contentType) {
            $this->setContentType($contentType);
        }
        if (NULL !== $content) {
            $this->setContent($content);
        }
        if (NULL !== $contentId) {
            $this->setContentId($contentId);
        }
        if ($attachments instanceof AttachmentsInfo) {
            $this->setAttachments($attachments);
        }
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
     * Gets mimeParts
     *
     * @return array
     */
    public function getMimeParts(): array
    {
        return $this->mimeParts;
    }

    /**
     * Sets mimeParts
     *
     * @param  array $mimeParts
     * @return self
     */
    public function setMimeParts(array $mimeParts): self
    {
        $this->mimeParts = array_filter($mimeParts, static fn ($mimePart) => $mimePart instanceof MimePartInfo);
        return $this;
    }

    /**
     * Add mimePart
     *
     * @param  MimePartInfo $mimePart
     * @return self
     */
    public function addMimePart(MimePartInfo $mimePart): self
    {
        $this->mimeParts[] = $mimePart;
        return $this;
    }

    /**
     * Gets attachments
     *
     * @return AttachmentsInfo
     */
    public function getAttachments(): ?AttachmentsInfo
    {
        return $this->attachments;
    }

    /**
     * Sets attachments
     *
     * @param  AttachmentsInfo $attachments
     * @return self
     */
    public function setAttachments(AttachmentsInfo $attachments): self
    {
        $this->attachments = $attachments;
        return $this;
    }
}
