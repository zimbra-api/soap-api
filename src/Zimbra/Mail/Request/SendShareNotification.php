<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\Action;
use Zimbra\Mail\Struct\EmailAddrInfo;
use Zimbra\Struct\Id;

/**
 * SendShareNotification request class
 * Send share notification 
 * The client can list the recipient email addresses for the share, along with the itemId of the item being shared.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SendShareNotification extends Base
{
    /**
     * Constructor method for SendShareNotification
     * @param  Id $m
     * @param  array $e
     * @param  string $notes
     * @param  Action $action
     * @return self
     */
    public function __construct(
        Id $item = null,
        array $e = array(),
        $notes = null,
        Action $action = null
    )
    {
        parent::__construct();
        if($item instanceof Id)
        {
            $this->child('item', $item);
        }
        $this->_e = new TypedSequence('Zimbra\Mail\Struct\EmailAddrInfo', $e);
        if(null !== $notes)
        {
            $this->child('notes', trim($notes));
        }
        if($action instanceof Action)
        {
            $this->property('action', $action);
        }

        $this->addHook(function($sender)
        {
            if(count($sender->e()))
            {
                $sender->child('e', $sender->e()->all());
            }
        });
    }

    /**
     * Get or set item
     *
     * @param  Id $item
     * @return Id|self
     */
    public function item(Id $item = null)
    {
        if(null === $item)
        {
            return $this->child('item');
        }
        return $this->child('item', $item);
    }

    /**
     * Add an email address
     *
     * @param  EmailAddrInfo $e
     * @return self
     */
    public function addE(EmailAddrInfo $e)
    {
        $this->_e->add($e);
        return $this;
    }

    /**
     * Gets email address sequence
     *
     * @return Sequence
     */
    public function e()
    {
        return $this->_e;
    }

    /**
     * Get or set notes
     *
     * @param  string $notes
     * @return string|self
     */
    public function notes($notes = null)
    {
        if(null === $notes)
        {
            return $this->child('notes');
        }
        return $this->child('notes', trim($notes));
    }

    /**
     * Get or set action
     *
     * @param  Action $action
     * @return Action|self
     */
    public function action(Action $action = null)
    {
        if(null === $action)
        {
            return $this->property('action');
        }
        return $this->property('action', $action);
    }
}