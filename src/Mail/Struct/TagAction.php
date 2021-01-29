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
 * TagAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="actionTag")
 */
class TagAction extends FilterAction
{
    /**
     * Tag name
     * @Accessor(getter="getTag", setter="setTag")
     * @SerializedName("tagName")
     * @Type("string")
     * @XmlAttribute
     */
    private $tag;

    /**
     * Constructor method for TagAction
     * 
     * @param int $index
     * @param string $tag
     * @return self
     */
    public function __construct(?int $index = NULL, ?string $tag = NULL)
    {
    	parent::__construct($index);
        if (NULL !== $tag) {
            $this->setTag($tag);
        }
    }

    /**
     * Gets tag
     *
     * @return string
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * Sets tag
     *
     * @param  string $tag
     * @return self
     */
    public function setTag(string $tag)
    {
        $this->tag = $tag;
        return $this;
    }
}
