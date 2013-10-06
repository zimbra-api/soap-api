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
 * OpValue class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class OpValue
{
    /**
     * Operation to apply to an address 
     * @var string
     */
    private $_op;

    /**
     * Email address
     * @var string
     */
    private $_value;

    /**
     * Constructor method for OpValue
     * @param  string $op
     * @param  string $value
     * @return self
     */
    public function __construct($op, $value = null)
    {
        if($op !== null and in_array(trim($op), array('+', '-')))
        {
            $this->_op = trim($op);
        }
        $this->_value = trim($value);
    }

    /**
     * Gets or sets op
     *
     * @param  string $op
     * @return string|self
     */
    public function op($op = null)
    {
        if(null === $op)
        {
            return $this->_op;
        }
        if(in_array(trim($op), array('+', '-')))
        {
            $this->_op = trim($op);
        }
        return $this;
    }

    /**
     * Gets or sets value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->_value;
        }
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'addr')
    {
        $name = !empty($name) ? $name : 'addr';
        $arr = array(
            '_' => $this->_value,
        );
        if(!empty($this->_op))
        {
            $arr['op'] = $this->_op;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'addr')
    {
        $name = !empty($name) ? $name : 'addr';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        if(!empty($this->_op))
        {
            $xml->addAttribute('op', $this->_op);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
