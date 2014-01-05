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

/**
 * RedirectAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RedirectAction extends FilterAction
{
    /**
     * @var string
     */
    private $_a;

    /**
     * Constructor method for RedirectAction
     * @param int $index
     * @param string $a
     * @return self
     */
    public function __construct($index, $a = null)
    {
    	parent::__construct($index);
        $this->_a = trim($a);
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionRedirect')
    {
        $name = !empty($name) ? $name : 'actionRedirect';
        $arr = parent::toArray($name);
        if(!empty($this->_a))
        {
            $arr[$name]['a'] = $this->_a;
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionRedirect')
    {
        $name = !empty($name) ? $name : 'actionRedirect';
        $xml = parent::toXml($name);
        if(!empty($this->_a))
        {
            $xml->addAttribute('a', $this->_a);
        }
        return $xml;
    }
}
