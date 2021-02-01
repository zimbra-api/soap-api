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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * AddedComment class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="comment")
 */
class AddedComment
{
    /**
     * Item ID of parent
     * @Accessor(getter="getParentId", setter="setParentId")
     * @SerializedName("parentId")
     * @Type("string")
     * @XmlAttribute
     */
    private $parentId;

    /**
     * Comment text
     * @Accessor(getter="getText", setter="setText")
     * @SerializedName("text")
     * @Type("string")
     * @XmlAttribute
     */
    private $text;

    /**
     * Constructor method for AddedComment
     *
     * @param  string $parentId
     * @param  string $text
     * @return self
     */
    public function __construct(string $parentId, string $text)
    {
        $this->setParentId($parentId)
             ->setText($text);
    }

    /**
     * Gets parentId
     *
     * @return string
     */
    public function getParentId(): string
    {
        return $this->parentId;
    }

    /**
     * Sets parentId
     *
     * @param  string $parentId
     * @return self
     */
    public function setParentId(string $parentId): self
    {
        $this->parentId = $parentId;
        return $this;
    }

    /**
     * Gets text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Sets text
     *
     * @param  string $text
     * @return self
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }
}
