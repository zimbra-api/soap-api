<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};

/**
 * AuthAttrs struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="attrs")
 */
class AuthAttrs
{
    /**
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attr")
     * @Type("array<Zimbra\Account\Struct\Attr>")
     * @XmlList(inline = true, entry = "attr")
     */
    private $attrs;

    /**
     * Constructor method for AuthAttrs
     * @param array $attrs
     * @return self
     */
    public function __construct(array $attrs = [])
    {
        $this->setAttrs($attrs);
    }

    /**
     * Add an attr
     *
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr)
    {
        $this->attrs[] = $attr;
        return $this;
    }

    /**
     * Sets attr sequence
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs)
    {
        $this->attrs = [];
        foreach ($attrs as $attr) {
            if ($attr instanceof Attr) {
                $this->attrs[] = $attr;
            }
        }
        return $this;
    }

    /**
     * Gets attr sequence
     *
     * @return array
     */
    public function getAttrs()
    {
        return $this->attrs;
    }
}
