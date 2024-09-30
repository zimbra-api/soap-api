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
 * NoteActionSelector class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NoteActionSelector extends ActionSelector
{
    /**
     * Content
     *
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getContent", setter: "setContent")]
    #[SerializedName("content")]
    #[Type("string")]
    #[XmlAttribute]
    private $content;

    /**
     * Bounds - x,y[width,height] where x,y,width and height are all ints
     *
     * @Accessor(getter="getBounds", setter="setBounds")
     * @SerializedName("pos")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getBounds", setter: "setBounds")]
    #[SerializedName("pos")]
    #[Type("string")]
    #[XmlAttribute]
    private $bounds;

    /**
     * Constructor
     *
     * @param  string $operation
     * @param  string $ids
     * @param  string $content
     * @param  string $bounds
     * @param  string $constraint
     * @param  int $tag
     * @param  string $folder
     * @param  string $rgb
     * @param  int $color
     * @param  string $name
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  bool $nonExistentIds
     * @param  bool $newlyCreatedIds
     * @return self
     */
    public function __construct(
        string $operation = "",
        ?string $ids = null,
        ?string $content = null,
        ?string $bounds = null,
        ?string $constraint = null,
        ?int $tag = null,
        ?string $folder = null,
        ?string $rgb = null,
        ?int $color = null,
        ?string $name = null,
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?bool $nonExistentIds = null,
        ?bool $newlyCreatedIds = null
    ) {
        parent::__construct(
            $operation,
            $ids,
            $constraint,
            $tag,
            $folder,
            $rgb,
            $color,
            $name,
            $flags,
            $tags,
            $tagNames,
            $nonExistentIds,
            $newlyCreatedIds
        );
        if (null !== $content) {
            $this->setContent($content);
        }
        if (null !== $bounds) {
            $this->setBounds($bounds);
        }
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
     * Get bounds
     *
     * @return string
     */
    public function getBounds(): ?string
    {
        return $this->bounds;
    }

    /**
     * Set bounds
     *
     * @param  string $bounds
     * @return self
     */
    public function setBounds(string $bounds): self
    {
        $this->bounds = $bounds;
        return $this;
    }
}
