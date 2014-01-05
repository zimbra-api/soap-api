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

/**
 * InviteTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class InviteTest extends FilterTest
{
    /**
     * Method
     * @var array
     */
    private $_method;

    /**
     * Constructor method for InviteTest
     * @param int $index
     * @param string $method
     * @param bool $negative
     * @return self
     */
    public function __construct(
        $index, array $method = array(), $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->_method = array();
        foreach ($method as $value)
        {
            $value = trim($value);
            if(!in_array($value, $this->_method))
            {
                $this->_method[] = $value;
            }
        }
    }

    /**
     * Gets or sets method
     *
     * @param  string $method
     * @return string|self
     */
    public function method($method = null)
    {
        if(null === $method)
        {
            return $this->_method;
        }
        $this->_method = array();
        foreach ($method as $value)
        {
            $value = trim($value);
            if(!in_array($value, $this->_method))
            {
                $this->_method[] = $value;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'inviteTest')
    {
        $name = !empty($name) ? $name : 'inviteTest';
        $arr = parent::toArray($name);
        if(count($this->_method))
        {
            $arr[$name]['method'] = array();
            foreach ($this->_method as $method)
            {
                $arr[$name]['method'][] = $method;
            }
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'inviteTest')
    {
        $name = !empty($name) ? $name : 'inviteTest';
        $xml = parent::toXml($name);
        foreach ($this->_method as $method)
        {
            $xml->addChild('method', $method);
        }
        return $xml;
    }
}
