<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

/**
 * AttrsImpl struct class
 * 
 * @package    Zimbra
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
trait AttrsImplTrait
{
    /**
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @Type("array<Zimbra\Struct\KeyValuePair>")
     * @XmlList(inline = true, entry = "a")
     */
    private $_attrs;

    /**
     * Add an attr
     *
     * @param  KeyValuePair $attr
     * @return self
     */
    public function addAttr(KeyValuePair $attr)
    {
        $this->_attrs[] = $attr;
        return $this;
    }

    /**
     * Sets attribute sequence
     *
     * @param array $attrs
     * @return self
     */
    public function setAttrs(array $attrs)
    {
        $this->_attrs = [];
        foreach ($attrs as $attr) {
            if ($attr instanceof KeyValuePair) {
                $this->_attrs[] = $attr;
            }
        }
        return $this;
    }

    /**
     * Gets attribute sequence
     *
     * @return array
     */
    public function getAttrs()
    {
        return $this->_attrs;
    }
}
