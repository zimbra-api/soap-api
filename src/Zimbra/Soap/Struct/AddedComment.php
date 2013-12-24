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
 * AddedComment struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddedComment
{
    /**
     * Item ID of parent
     * @var string
     */
    private $_parentId;

    /**
     * Comment text
     * @var string
     */
    private $_text;

    /**
     * Constructor method for AddedComment
     *
     * @param string $parentId
     * @param string $text
     * @return self
     */
    public function __construct($parentId, $text)
    {
        $this->_parentId = trim($parentId);
        $this->_text = trim($text);
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
     * Gets or sets text
     *
     * @param  string $text
     * @return string|self
     */
    public function text($text = null)
    {
        if(null === $text)
        {
            return $this->_text;
        }
        $this->_text = trim($text);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($parentId = 'comment')
    {
        $parentId = !empty($parentId) ? $parentId : 'comment';
        return array($parentId => array(
            'parentId' => $this->_parentId,
            'text' => $this->_text,
        ));
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($parentId = 'comment')
    {
        $parentId = !empty($parentId) ? $parentId : 'comment';
        $xml = new SimpleXML('<'.$parentId.' />');
        $xml->addAttribute('parentId', $this->_parentId)
            ->addAttribute('text', $this->_text);
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
