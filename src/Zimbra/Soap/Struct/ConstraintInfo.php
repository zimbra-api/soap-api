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
use PhpCollection\Sequence;

/**
 * ConstraintInfo class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConstraintInfo
{
    /**
     * Minimum value
     * @var string
     */
    private $_min;

    /**
     * Maximum value
     * @var string
     */
    private $_max;

    /**
     * Values
     * @var Sequence
     */
    private $_value = array();

    /**
     * Constructor method for ConstraintInfo
     * @param  string $min
     * @param  string $max
     * @param  array $values
     * @return self
     */
    public function __construct($min = null, $max = null, array $values = array())
    {
        $this->_min = trim($min);
        $this->_max = trim($max);
        $this->_value = new Sequence;
        foreach ($values as $value)
        {
            if(!empty($value))
            {
                $this->_value->add($value);
            }
        }
    }

    /**
     * Gets or sets min
     *
     * @param  string $min
     * @return string|self
     */
    public function min($min = null)
    {
        if(null === $min)
        {
            return $this->_min;
        }
        $this->_min = trim($min);
        return $this;
    }

    /**
     * Gets or sets max
     *
     * @param  string $max
     * @return string|self
     */
    public function max($max = null)
    {
        if(null === $max)
        {
            return $this->_max;
        }
        $this->_max = trim($max);
        return $this;
    }

    /**
     * Adds a value
     *
     * @param  string $value
     * @return self
     */
    public function addValue($value)
    {
        if(!empty($value))
        {
            $this->_value->add($value);
        }
        return $this;
    }

    /**
     * Gets value sequence
     *
     * @return Sequence
     */
    public function value()
    {
        return $this->_value;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'constraint')
    {
        $name = !empty($name) ? $name : 'constraint';
        $arr = array(
            'values' => array()
        );
        if(!empty($this->_min))
        {
            $arr['min'] = $this->_min;
        }
        if(!empty($this->_max))
        {
            $arr['max'] = $this->_max;
        }
        if(count($this->_value))
        {
            $values['v'] = array();
            foreach ($this->_value as $value)
            {
                $values['v'][] = $value;
            }
            $arr['values'] = $values;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'constraint')
    {
        $name = !empty($name) ? $name : 'constraint';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_min))
        {
            $xml->addChild('min', $this->_min);
        }
        if(!empty($this->_max))
        {
            $xml->addChild('max', $this->_max);
        }
        $values = $xml->addChild('values');
        foreach ($this->_value as $value)
        {
            $values->addChild('v', $value);
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