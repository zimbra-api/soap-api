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
     * Email addresses.
     * @var TypedSequence<EmailAddrInfo>
     */
    private $_emailAddresses;

    /**
     * Constructor method for SendShareNotification
     * @param  Id $m
     * @param  array $addresses
     * @param  string $notes
     * @param  Action $action
     * @return self
     */
    public function __construct(
        Id $item = null,
        array $addresses = array(),
        $notes = null,
        Action $action = null
    )
    {
        parent::__construct();
        if($item instanceof Id)
        {
            $this->setChild('item', $item);
        }
        if(null !== $notes)
        {
            $this->setChild('notes', trim($notes));
        }
        if($action instanceof Action)
        {
            $this->setProperty('action', $action);
        }

        $this->setEmailAddresses($addresses);
        $this->on('before', function(Base $sender)
        {
            if($sender->getEmailAddresses()->count())
            {
                $sender->setChild('e', $sender->getEmailAddresses()->all());
            }
        });
    }

    /**
     * Gets item ID
     *
     * @return Id
     */
    public function getItem()
    {
        return $this->getChild('item');
    }

    /**
     * Sets item ID
     *
     * @param  Id $item
     * @return self
     */
    public function setItem(Id $item)
    {
        return $this->setChild('item', $item);
    }

    /**
     * Add an email address
     *
     * @param  EmailAddrInfo $address
     * @return self
     */
    public function addEmailAddress(EmailAddrInfo $address)
    {
        $this->_emailAddresses->add($address);
        return $this;
    }

    /**
     * Sets email address sequence
     *
     * @param  array $addresses
     * @return self
     */
    public function setEmailAddresses(array $addresses)
    {
        $this->_emailAddresses = new TypedSequence('Zimbra\Mail\Struct\EmailAddrInfo', $addresses);
        return $this;
    }

    /**
     * Gets email address sequence
     *
     * @return Sequence
     */
    public function getEmailAddresses()
    {
        return $this->_emailAddresses;
    }

    /**
     * Gets notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->getChild('notes');
    }

    /**
     * Sets notes
     *
     * @param  string $notes
     * @return self
     */
    public function setNotes($notes)
    {
        return $this->setChild('notes', trim($notes));
    }

    /**
     * Gets action
     *
     * @return Action
     */
    public function getAction()
    {
        return $this->getProperty('action');
    }

    /**
     * Sets action
     *
     * @param  Action $action
     * @return self
     */
    public function setAction(Action $action)
    {
        return $this->setProperty('action', $action);
    }
}