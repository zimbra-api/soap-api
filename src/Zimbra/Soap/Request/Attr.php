<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\KeyValuePair;
use Zimbra\Utils\TypedSequence;

/**
 * Attr class in Zimbra API PHP, not to be instantiated.
 * 
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Attr extends Request
{
    /**
     * Attributes specified as key value pairs
     * @var Sequence
     */
    private $_attr;

    /**
     * AttrRequest constructor
     * @param array  $attrs
     */
    public function __construct(array $attrs = array())
    {
        parent::__construct();
        $this->_attr = new TypedSequence('Zimbra\Soap\Struct\KeyValuePair', $attrs);
    }

    /**
     * Add an attr
     *
     * @param  KeyValuePair $attr
     * @return self
     */
    public function addAttr(KeyValuePair $attr)
    {
        $this->_attr->add($attr);
        return $this;
    }

    /**
     * Gets attr sequence
     *
     * @return Sequence
     */
    public function attr()
    {
        return $this->_attr;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_attr))
        {
            $this->array['a'] = array();
            foreach ($this->_attr as $attr)
            {
                $attrArr = $attr->toArray('a');
                $this->array['a'][] = $attrArr['a'];
            }
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        foreach ($this->_attr as $attr)
        {
            $this->xml->append($attr->toXml('a'));
        }
        return parent::toXml();
    }
}
