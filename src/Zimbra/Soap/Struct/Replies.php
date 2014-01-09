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
 * Replies struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Replies
{
    /**
     * Attributes
     * @var TypedSequence<CalReply>
     */
    private $_reply;

    /**
     * Constructor method for Replies
     * @param array $reply
     * @return self
     */
    public function __construct(array $reply = array())
    {
        $this->_reply = new TypedSequence('Zimbra\Soap\Struct\CalReply', $reply);
    }

    /**
     * Add a reply
     *
     * @param  CalReply $reply
     * @return self
     */
    public function addReply(CalReply $reply)
    {
        $this->_reply->add($reply);
        return $this;
    }

    /**
     * Gets reply sequence
     *
     * @return Sequence
     */
    public function reply()
    {
        return $this->_reply;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'replies')
    {
        $name = !empty($name) ? $name : 'replies';
        $arr = array();
        if(count($this->_reply))
        {
            $arr['reply'] = array();
            foreach ($this->_reply as $reply)
            {
                $replyArr = $reply->toArray('reply');
                $arr['reply'][] = $replyArr['reply'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'replies')
    {
        $name = !empty($name) ? $name : 'replies';
        $xml = new SimpleXML('<'.$name.' />');
        foreach ($this->_reply as $reply)
        {
            $xml->append($reply->toXml('reply'));
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
