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
 * XProp struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class XProp
{
    /**
     * xParam Name
     * @var string
     */
    private $_name;

    /**
     * xParam value
     * @var string
     */
    private $_value;

    /**
     * XPARAMs
     * @var Sequence
     */
    private $_xparam;

    /**
     * Constructor method for XProp
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function __construct($name, $value, array $xparams = array())
    {
        $this->_name = trim($name);
        $this->_value = trim($value);
        $this->_xparam = new TypedSequence('Zimbra\Soap\Struct\XParam', $xparams);
    }

    /**
     * Gets or sets xParam name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets or sets xParam value
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
     * Add xparam
     *
     * @param  XParam $xparam
     * @return self
     */
    public function addXParam(XParam $xparam)
    {
        $this->_xparam->add($xparam);
        return $this;
    }

    /**
     * Gets xparam sequence
     *
     * @return Sequence
     */
    public function xparam()
    {
        return $this->_xparam;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'xprop')
    {
        $name = !empty($name) ? $name : 'xprop';
        $arr = array(
            'name' => $this->_name,
            'value' => $this->_value,
        );
        if(count($this->_xparam))
        {
            $arr['xparam'] = array();
            foreach ($this->_xparam as $xparam)
            {
                $xparamArr = $xparam->toArray();
                $arr['xparam'][] = $xparamArr['xparam'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'xprop')
    {
        $name = !empty($name) ? $name : 'xprop';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('name', $this->_name)
            ->addAttribute('value', $this->_value);
        foreach ($this->_xparam as $xparam)
        {
            $xml->append($xparam->toXml());
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
