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

use Zimbra\Soap\Enum\TargetType;
use Zimbra\Soap\Enum\TargetBy;
use Zimbra\Utils\SimpleXML;

/**
 * EffectiveRightsTargetSelector class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class EffectiveRightsTargetSelector
{
    /**
     * The type
     * @var TargetType
     */
    private $_type;

    /**
     * The value
     * @var string
     */
    private $_value;

    /**
     * The by
     * @var TargetBy
     */
    private $_by;

    /**
     * Constructor method for effectiveRightsTargetSelector
     * @see parent::__construct()
     * @param string $type
     * @param string $value
     * @param string $by
     * @return self
     */
    public function __construct($type, $value = null, $by = null)
    {
        if(TargetType::isValid(trim($type)))
        {
            $this->_type = trim($type);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid target type');
        }
        if(TargetBy::isValid(trim($by)))
        {
            $this->_by = trim($by);
        }
        $this->_value = trim($value);
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
        if(TargetType::isValid(trim($type)))
        {
            $this->_type = trim($type);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid target type');
        }
        return $this;
    }

    /**
     * Gets or sets by
     *
     * @param  string $by
     * @return string|self
     */
    public function by($by = null)
    {
        if(null === $by)
        {
            return $this->_by;
        }
        if(TargetBy::isValid(trim($by)))
        {
            $this->_by = trim($by);
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
    public function toArray($name = 'target')
    {
        $name = !empty($name) ? $name : 'target';
        $arr = array(
            'type' => $this->_type,
            '_' => $this->_value,
        );
        if(!empty($this->_by))
        {
            $arr['by'] = $this->_by;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'target')
    {
        $name = !empty($name) ? $name : 'target';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        $xml->addAttribute('type', $this->_type);
        if(!empty($this->_by))
        {
            $xml->addAttribute('by', $this->_by);
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
