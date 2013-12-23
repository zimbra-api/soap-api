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
 * EmailAddrInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class EmailAddrInfo
{
    /**
     * Email address
     * @var string
     */
    private $_a;

    /**
     * Optional Address type - (f)rom, (t)o, (c)c, (b)cc, (r)eply-to, (s)ender, read-receipt (n)otification, (rf) resent-from
     * @var string
     */
    private $_t;

    /**
     * The comment/name part of an address
     * @var string
     */
    private $_p;

    /**
     * Constructor method for EmailAddrInfo
     * @param  string $a
     * @param  string $t
     * @param  string $p
     * @return self
     */
    public function __construct($a, $t = null, $p = null)
    {
        $this->_a = trim($a);
        $this->_t = trim($t);
        $this->_p = trim($p);
    }

    /**
     * Gets or sets a
     *
     * @param  string $a
     * @return string|self
     */
    public function a($a = null)
    {
        if(null === $a)
        {
            return $this->_a;
        }
        $this->_a = trim($a);
        return $this;
    }

    /**
     * Gets or sets t
     *
     * @param  string $t
     * @return string|self
     */
    public function t($t = null)
    {
        if(null === $t)
        {
            return $this->_t;
        }
        $this->_t = trim($t);
        return $this;
    }

    /**
     * Gets or sets p
     *
     * @param  string $p
     * @return string|self
     */
    public function p($p = null)
    {
        if(null === $p)
        {
            return $this->_p;
        }
        $this->_p = trim($p);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'e')
    {
        $name = !empty($name) ? $name : 'e';
        $arr = array(
            'a' => $this->_a,
        );
        if(!empty($this->_t))
        {
            $arr['t'] = $this->_t;
        }
        if(!empty($this->_p))
        {
            $arr['p'] = $this->_p;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'e')
    {
        $name = !empty($name) ? $name : 'e';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('a', $this->_a);
        if(!empty($this->_t))
        {
            $xml->addAttribute('t', $this->_t);
        }
        if(!empty($this->_p))
        {
            $xml->addAttribute('p', $this->_p);
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
