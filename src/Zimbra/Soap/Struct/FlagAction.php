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
 * FlagAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FlagAction extends FilterAction
{
    /**
     * Flag name
     * @var string
     */
    private $_flagName;

    /**
     * Constructor method for FlagAction
     * @param int $index
     * @param string $flagName
     * @return self
     */
    public function __construct($index, $flagName = null)
    {
    	parent::__construct($index);
        $this->_flagName = trim($flagName);
    }

    /**
     * Gets or sets flagName
     *
     * @param  string $flagName
     * @return string|self
     */
    public function flagName($flagName = null)
    {
        if(null === $flagName)
        {
            return $this->_flagName;
        }
        $this->_flagName = trim($flagName);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionFlag')
    {
        $name = !empty($name) ? $name : 'actionFlag';
        $arr = parent::toArray($name);
        if(!empty($this->_flagName))
        {
            $arr[$name]['flagName'] = $this->_flagName;
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionFlag')
    {
        $name = !empty($name) ? $name : 'actionFlag';
        $xml = parent::toXml($name);
        if(!empty($this->_flagName))
        {
            $xml->addAttribute('flagName', $this->_flagName);
        }
        return $xml;
    }
}
