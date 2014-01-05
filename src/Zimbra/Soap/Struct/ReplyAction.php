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
 * ReplyAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ReplyAction extends FilterAction
{
    /**
     * Tag name
     * @var string
     */
    private $_content;

    /**
     * Constructor method for ReplyAction
     * @param int $index
     * @param string $content
     * @return self
     */
    public function __construct($index, $content = null)
    {
        parent::__construct($index);
        $this->_content = trim($content);
    }

    /**
     * Gets or sets content
     *
     * @param  string $content
     * @return string|self
     */
    public function content($content = null)
    {
        if(null === $content)
        {
            return $this->_content;
        }
        $this->_content = trim($content);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionReply')
    {
        $name = !empty($name) ? $name : 'actionReply';
        $arr = parent::toArray($name);
        if(!empty($this->_content))
        {
            $arr[$name]['content'] = $this->_content;
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionReply')
    {
        $name = !empty($name) ? $name : 'actionReply';
        $xml = parent::toXml($name);
        if(!empty($this->_content))
        {
            $xml->addChild('content', $this->_content);
        }
        return $xml;
    }
}
