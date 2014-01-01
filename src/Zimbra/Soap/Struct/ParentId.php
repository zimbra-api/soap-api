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
 * ParentId class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ParentId
{
    /**
     * Item ID of parent
     * @var string
     */
    private $_parentId;

    /**
     * Constructor method for ParentId
     * @param  string $parentId
     * @return self
     */
    public function __construct($parentId)
    {
        $this->_parentId = trim($parentId);
    }

    /**
     * Gets or sets parentId
     *
     * @param  string $parentId
     * @return string|self
     */
    public function parentId($parentId = null)
    {
        if(null === $parentId)
        {
            return $this->_parentId;
        }
        $this->_parentId = trim($parentId);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'comment')
    {
        $name = !empty($name) ? $name : 'comment';
        $arr = array('parentId' => $this->_parentId);
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'comment')
    {
        $name = !empty($name) ? $name : 'comment';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('parentId', $this->_parentId);
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
