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
 * EntrySearchFilterSingleCond class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class EntrySearchFilterSingleCond
{
    /**
     * Attribute name
     * @var string
     */
    private $_attr;

    /**
     * Operator
     * @var string
     */
    private $_op;

    /**
     * The value
     * @var string
     */
    private $_value;

    /**
     * Negation flag
     * If set to 1 (true) then negate the compound condition
     * @var boolean
     */
    private $_not;

    /**
     * Valid values
     * @var array
     */
    private static $_validValues = array('eq', 'has', 'ge', 'le', 'gt', 'lt', 'startswith', 'endswith');

    /**
     * Constructor method for entrySearchFilterSingleCond
     * @param string $attr
     * @param string $op
     * @param string $value
     * @param bool $not
     * @return self
     */
    public function __construct($attr, $op, $value, $not = null)
    {
        $this->_attr = trim($attr);
        $this->_op = $this->_validOp(trim($op)) ? trim($op) : 'eq';
        $this->_value = trim($value);
        if(null !== $not)
        {
            $this->_not = (bool) $not;
        }
    }

    /**
     * Gets or sets attr
     *
     * @param  string $attr
     * @return string|self
     */
    public function attr($attr = null)
    {
        if(null === $attr)
        {
            return $this->_attr;
        }
        $this->_attr = trim($attr);
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
        $this->_op = $this->_validOp(trim($op)) ? trim($op) : 'eq';
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
     * Gets or sets not flag
     *
     * @param  bool $not
     * @return bool|self
     */
    public function notFlag($not = null)
    {
        if(null === $not)
        {
            return $this->_not;
        }
        $this->_not = (bool) $not;
        return $this;
    }

    /**
     * Valid operator
     *
     * @param  string $op
     * @return bool
     */
    private function _validOp($op)
    {
        return in_array($op, self::$_validValues);
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'cond')
    {
        $name = !empty($name) ? $name : 'cond';
        $arr = array(
            'attr' => $this->_attr,
            'op' => $this->_op,
            'value' => $this->_value,
        );
        if(is_bool($this->_not))
        {
            $arr['not'] = $this->_not ? 1 : 0;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'cond')
    {
        $name = !empty($name) ? $name : 'cond';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('attr', $this->_attr)
            ->addAttribute('op', $this->_op)
            ->addAttribute('value', $this->_value);
        if(is_bool($this->_not))
        {
            $xml->addAttribute('not', $this->_not ? 1 : 0);
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
