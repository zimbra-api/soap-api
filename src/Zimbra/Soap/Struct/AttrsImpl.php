<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;
use Zimbra\Utils\TypedSequence;

/**
 * AttrsImpl class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class AttrsImpl
{
    /**
     * Attributes
     * KeyValuePair array
     * @var array
     */
    private $_attrs = array();

    /**
     * The array representation of this class 
     * @var array
     */
    protected $array = array();

    /**
     * Constructor method for AttrsImpl
     * @param array $attrs
     * @return self
     */
    public function __construct(array $attrs = array())
    {
        $this->_attrs = new TypedSequence('Zimbra\Soap\Struct\KeyValuePair', $attrs);
    }

    /**
     * Add an attr
     *
     * @param  KeyValuePair $attr
     * @return self
     */
    public function addAttr(KeyValuePair $attr)
    {
        $this->_attrs->add($attr);
        return $this;
    }

    /**
     * Gets attr sequence
     *
     * @return Sequence
     */
    public function attrs()
    {
        return $this->_attrs;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_attrs))
        {
            $this->array['a'] = array();
            foreach ($this->_attrs as $attr)
            {
                $attrArr = $attr->toArray('a');
                $this->array['a'][] = $attrArr['a'];
            }
        }
        return $this->array;
    }

    /**
     * Add attrubutes to xml
     *
     * @return SimpleXML
     */
    public function appendAttrs(SimpleXML $xml)
    {
        foreach ($this->_attrs as $attr)
        {
            $xml->append($attr->toXml('a'));
        }
        return $xml;
    }
}
