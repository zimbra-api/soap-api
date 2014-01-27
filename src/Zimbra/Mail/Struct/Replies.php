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
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class Replies extends Base
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
        parent::__construct();
        $this->_reply = new TypedSequence('Zimbra\Mail\Struct\CalReply', $reply);

        $this->addHook(function($sender)
        {
            if(count($sender->reply()))
            {
                $sender->child('reply', $sender->reply()->all());
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
