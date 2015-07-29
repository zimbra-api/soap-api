<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

/**
 * ReplyAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ReplyAction extends FilterAction
{
    /**
     * Constructor method for ReplyAction
     * @param int $index
     * @param string $content
     * @return self
     */
    public function __construct($index, $content = null)
    {
        parent::__construct($index);
        if(null !== $content)
        {
            $this->setChild('content', trim($content));
        }
    }

    /**
     * Gets content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getChild('content');
    }

    /**
     * Sets content
     *
     * @param  string $content
     * @return self
     */
    public function setContent($content)
    {
        return $this->setChild('content', trim($content));
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionReply')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionReply')
    {
        return parent::toXml($name);
    }
}
