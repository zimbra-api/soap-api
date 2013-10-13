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
 * RightModifierInfo class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RightModifierInfo
{
    /**
     * Value is of the form
     * @var string
     */
    private $_value;

    /**
     * Deny flag - default is 0 (false)
     * @var bool
     */
    private $_deny;

    /**
     * Flag whether can delegate - default is 0 (false)
     * @var bool
     */
    private $_canDelegate;

    /**
     * disinheritSubGroups flag - default is 0 (false)
     * @var bool
     */
    private $_disinheritSubGroups;

    /**
     * subDomain flag - default is 0 (false)
     * @var bool
     */
    private $_subDomain;

    /**
     * Constructor method for RightModifierInfo
     * @param string $value
     * @param bool $deny
     * @param bool $canDelegate
     * @param bool $disinheritSubGroups
     * @param bool $subDomain
     * @return self
     */
    public function __construct(
        $value,
        $deny = null,
        $canDelegate = null,
        $disinheritSubGroups = null,
        $subDomain = null
    )
    {
        $this->_value = trim($value);
        if($deny !== null)
        {
            $this->_deny = (bool) $deny;
        }
        if($canDelegate !== null)
        {
            $this->_canDelegate = (bool) $canDelegate;
        }
        if($disinheritSubGroups !== null)
        {
            $this->_disinheritSubGroups = (bool) $disinheritSubGroups;
        }
        if($subDomain !== null)
        {
            $this->_subDomain = (bool) $subDomain;
        }
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
     * Gets or sets pw
     *
     * @param  bool $pw
     * @return bool|self
     */
    public function deny($deny = null)
    {
        if(null === $deny)
        {
            return $this->_deny;
        }
        $this->_deny = (bool) $deny;
        return $this;
    }

    /**
     * Gets or sets canDelegate
     *
     * @param  bool $canDelegate
     * @return bool|self
     */
    public function canDelegate($canDelegate = null)
    {
        if(null === $canDelegate)
        {
            return $this->_canDelegate;
        }
        $this->_canDelegate = (bool) $canDelegate;
        return $this;
    }

    /**
     * Gets or sets disinheritSubGroups
     *
     * @param  bool $disinheritSubGroups
     * @return bool|self
     */
    public function disinheritSubGroups($disinheritSubGroups = null)
    {
        if(null === $disinheritSubGroups)
        {
            return $this->_disinheritSubGroups;
        }
        $this->_disinheritSubGroups = (bool) $disinheritSubGroups;
        return $this;
    }

    /**
     * Gets or sets subDomain
     *
     * @param  bool $subDomain
     * @return bool|self
     */
    public function subDomain($subDomain = null)
    {
        if(null === $subDomain)
        {
            return $this->_subDomain;
        }
        $this->_subDomain = (bool) $subDomain;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'right')
    {
        $name = !empty($name) ? $name : 'right';
        $arr = array(
            '_' => $this->_value,
        );
        if(is_bool($this->_deny))
        {
            $arr['deny'] = $this->_deny ? 1 : 0;
        }
        if(is_bool($this->_canDelegate))
        {
            $arr['canDelegate'] = $this->_canDelegate ? 1 : 0;
        }
        if(is_bool($this->_disinheritSubGroups))
        {
            $arr['disinheritSubGroups'] = $this->_disinheritSubGroups ? 1 : 0;
        }
        if(is_bool($this->_subDomain))
        {
            $arr['subDomain'] = $this->_subDomain ? 1 : 0;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'right')
    {
        $name = !empty($name) ? $name : 'right';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        if(is_bool($this->_deny))
        {
            $xml->addAttribute('deny', $this->_deny ? 1 : 0);
        }
        if(is_bool($this->_canDelegate))
        {
            $xml->addAttribute('canDelegate', $this->_canDelegate ? 1 : 0);
        }
        if(is_bool($this->_disinheritSubGroups))
        {
            $xml->addAttribute('disinheritSubGroups', $this->_disinheritSubGroups ? 1 : 0);
        }
        if(is_bool($this->_subDomain))
        {
            $xml->addAttribute('subDomain', $this->_subDomain ? 1 : 0);
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
