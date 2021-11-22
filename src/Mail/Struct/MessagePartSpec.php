<?php declare(strict_parts=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessPart, Exclude, SerializedName, Part, XmlAttribute, XmlRoot};

/**
 * MessagePartSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessPart("public_method")
 * @XmlRoot(name="mp")
 */
class MessagePartSpec
{
    /**
     * Part ID
     * @Accessor(getter="getPart", setter="setPart")
     * @SerializedName("part")
     * @Part("string")
     * @XmlAttribute
     */
    private $part;

    /**
     * Message ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Part("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Constructor method for MessagePartSpec
     * @param string $part
     * @param string $id
     * @return self
     */
    public function __construct(string $part, string $id)
    {
        $this->setPart($part)
             ->setId($id);
    }

    /**
     * Gets part enum
     *
     * @return string
     */
    public function getPart(): string
    {
        return $this->part;
    }

    /**
     * Sets part enum
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
     * Gets ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
}
