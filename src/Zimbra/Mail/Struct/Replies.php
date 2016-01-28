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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * Replies struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Replies extends Base
{
    /**
     * Attributes
     * @var TypedSequence<CalReply>
     */
    private $_replies;

    /**
     * Constructor method for Replies
     * @param array $replies
     * @return self
     */
    public function __construct(array $replies = [])
    {
        parent::__construct();
        $this->_replies = new TypedSequence('Zimbra\Mail\Struct\CalReply', $replies);
        $this->on('before', function(Base $sender)
        {
            if($sender->getReplies()->count())
            {
                $sender->setChild('reply', $sender->getReplies()->all());
            }
        });
    }

    /**
     * Add a reply
     *
     * @param  CalReply $reply
     * @return self
     */
    public function addReply(CalReply $reply)
    {
        $this->_replies->add($reply);
        return $this;
    }

    /**
     * Gets reply sequence
     *
     * @return Sequence
     */
    public function getReplies()
    {
        return $this->_replies;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'replies')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'replies')
    {
        return parent::toXml($name);
    }
}
