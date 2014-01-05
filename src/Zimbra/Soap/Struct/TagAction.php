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
 * TagAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TagAction extends FilterAction
{
    /**
     * Tag name
     * @var string
     */
    private $_tagName;

    /**
     * Constructor method for TagAction
     * @param int $index
     * @param string $tagName
     * @return self
     */
    public function __construct($index, $tagName = null)
    {
        parent::__construct($index);
        $this->_tagName = trim($tagName);
    }

    /**
     * Gets or sets tagName
     *
     * @param  string $tagName
     * @return string|self
     */
    public function tagName($tagName = null)
    {
        if(null === $tagName)
        {
            return $this->_tagName;
        }
        $this->_tagName = trim($tagName);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionTag')
    {
        $name = !empty($name) ? $name : 'actionTag';
        $arr = parent::toArray($name);
        if(!empty($this->_tagName))
        {
            $arr[$name]['tagName'] = $this->_tagName;
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionTag')
    {
        $name = !empty($name) ? $name : 'actionTag';
        $xml = parent::toXml($name);
        if(!empty($this->_tagName))
        {
            $xml->addAttribute('tagName', $this->_tagName);
        }
        return $xml;
    }
}
