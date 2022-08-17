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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * AddMsgSpec class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AddMsgSpec
{
    /**
     * Flags - (u)nread, (f)lagged, has (a)ttachment, (r)eplied, (s)ent by me, for(w)arded,
     * (d)raft, deleted (x), (n)otification sent
     * 
     * @var string
     */
    #[Accessor(getter: 'getFlags', setter: 'setFlags')]
    #[SerializedName(name: 'f')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $flags;

    /**
     * Tags - Comma separated list of ints.  DEPRECATED - use "tn" instead
     * 
     * @var string
     */
    #[Accessor(getter: 'getTags', setter: 'setTags')]
    #[SerializedName(name: 't')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $tags;

    /**
     * Comma-separated list of tag names
     * 
     * @var string
     */
    #[Accessor(getter: 'getTagNames', setter: 'setTagNames')]
    #[SerializedName(name: 'tn')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $tagNames;

    /**
     * Folder pathname (starts with '/') or folder ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolder', setter: 'setFolder')]
    #[SerializedName(name: 'l')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $folder;

    /**
     * If set, then don't process iCal attachments.  Default is unset.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getNoICal', setter: 'setNoICal')]
    #[SerializedName(name: 'noICal')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $noICal;

    /**
     * (optional) Time the message was originally received, in MILLISECONDS since the epoch
     * 
     * @var int
     */
    #[Accessor(getter: 'getDateReceived', setter: 'setDateReceived')]
    #[SerializedName(name: 'd')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $dateReceived;

    /**
     * Uploaded MIME body ID - ID of message uploaded via FileUploadServlet
     * 
     * @var string
     */
    #[Accessor(getter: 'getAttachmentId', setter: 'setAttachmentId')]
    #[SerializedName(name: 'aid')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $attachmentId;

    /**
     * The entire message's content.  (Omit if you specify an "aid" attribute.)
     * No <mp> elements should be provided within <m>.
     * 
     * @var string
     */
    #[Accessor(getter: "getContent", setter: "setContent")]
    #[SerializedName(name: 'content')]
    #[Type(name: 'string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $content;

    /**
     * Constructor
     *
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  string $folder
     * @param  bool $noICal
     * @param  int $dateReceived
     * @param  string $attachmentId
     * @param  string $content
     * @return self
     */
    public function __construct(
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?string $folder = NULL,
        ?bool $noICal = NULL,
        ?int $dateReceived = NULL,
        ?string $attachmentId = NULL,
        ?string $content = NULL
    )
    {
        if (NULL !== $flags) {
            $this->setFlags($flags);
        }
        if (NULL !== $tags) {
            $this->setTags($tags);
        }
        if (NULL !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (NULL !== $folder) {
            $this->setFolder($folder);
        }
        if (NULL !== $noICal) {
            $this->setNoICal($noICal);
        }
        if (NULL !== $dateReceived) {
            $this->setDateReceived($dateReceived);
        }
        if (NULL !== $attachmentId) {
            $this->setAttachmentId($attachmentId);
        }
        if (NULL !== $content) {
            $this->setContent($content);
        }
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
     * Get folder
     *
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder(string $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * Get noICal
     *
     * @return bool
     */
    public function getNoICal(): ?bool
    {
        return $this->noICal;
    }

    /**
     * Set noICal
     *
     * @param  bool $noICal
     * @return self
     */
    public function setNoICal(bool $noICal): self
    {
        $this->noICal = $noICal;
        return $this;
    }

    /**
     * Get dateReceived
     *
     * @return int
     */
    public function getDateReceived(): ?int
    {
        return $this->dateReceived;
    }

    /**
     * Set dateReceived
     *
     * @param  int $dateReceived
     * @return self
     */
    public function setDateReceived(int $dateReceived): self
    {
        $this->dateReceived = $dateReceived;
        return $this;
    }

    /**
     * Get attachmentId
     *
     * @return string
     */
    public function getAttachmentId(): ?string
    {
        return $this->attachmentId;
    }

    /**
     * Set attachmentId
     *
     * @param  string $attachmentId
     * @return self
     */
    public function setAttachmentId(string $attachmentId): self
    {
        $this->attachmentId = $attachmentId;
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
}
