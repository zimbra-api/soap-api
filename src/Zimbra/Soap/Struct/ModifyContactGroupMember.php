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
 * ModifyContactGroupMember struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyContactGroupMember
{
    /**
     * Member type
     * @var string
     */
    private $_type;

    /**
     * Member value
     * @var string
     */
    private $_value;

    /**
     * Operation - +|-|reset
     * @var string
     */
    private $_op;

    /**
     * Constructor method for ModifyContactGroupMember
     * @param string $type
     * @param string $value
     * @param string $op
     * @return self
     */
    public function __construct(
        $type,
        $value,
        $op = null
    )
    {
        $this->_type = in_array(trim($type), array('C', 'G', 'I')) ? trim($type) : '';
        $this->_value = trim($value);
        $this->_op = in_array(trim($op), array('+', '-', 'reset')) ? trim($op) : '';
    }

    /**
     * Gets or sets type
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $this->_type = in_array(trim($type), array('C', 'G', 'I')) ? trim($type) : '';
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
        $this->_op = in_array(trim($op), array('+', '-', 'reset')) ? trim($op) : '';
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'm')
    {
        $name = !empty($name) ? $name : 'm';
        $arr = array(
            'type' => $this->_type,
            'value' => $this->_value,
        );
        if(!empty($this->_op))
        {
            $arr['op'] = $this->_op;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        $name = !empty($name) ? $name : 'm';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('type', $this->_type)
            ->addAttribute('value', $this->_value);
        if(!empty($this->_op))
        {
            $xml->addAttribute('op', $this->_op);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
