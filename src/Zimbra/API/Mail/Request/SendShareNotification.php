<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Enum\Action;
use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\Id;
use Zimbra\Soap\Struct\EmailAddrInfo;
use Zimbra\Utils\TypedSequence;

/**
 * SendShareNotification request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SendShareNotification extends Request
{
    /**
     * Item ID
     * @var Id
     */
    private $_item;

    /**
     * Email addresses
     * @var TypedSequence<EmailAddrInfo>
     */
    private $_e;

    /**
     * Notes
     * @var string
     */
    private $_notes;

    /**
     * Set to "revoke" if it is a grant revoke notification. It is set to "expire" by the system to send notification for a grant expiry.
     * @var Action
     */
    private $_action;

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
            $this->_item = $item;
        }
        $this->_e = new TypedSequence('Zimbra\Soap\Struct\EmailAddrInfo', $e);
        $this->_notes = trim($notes);
        if($action instanceof Action)
        {
            $this->_action = $action;
        }
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
            return $this->_item;
        }
        $this->_item = $item;
        return $this;
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
            return $this->_notes;
        }
        $this->_notes = trim($notes);
        return $this;
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
            return $this->_action;
        }
        $this->_action = $action;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_item instanceof Id)
        {
            $this->array += $this->_item->toArray('item');
        }
        if(count($this->_e))
        {
            $this->array['e'] = array();
            foreach ($this->_e as $e)
            {
                $eArr = $e->toArray('e');
                $this->array['e'][] = $eArr['e'];
            }
        }
        if(!empty($this->_notes))
        {
            $this->array['notes'] = $this->_notes;
        }
        if($this->_action instanceof Action)
        {
            $this->array['action'] = (string) $this->_action;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if($this->_item instanceof Id)
        {
            $this->xml->append($this->_item->toXml('item'));
        }
        foreach ($this->_e as $e)
        {
            $this->xml->append($e->toXml('e'));
        }
        if(!empty($this->_notes))
        {
            $this->xml->addChild('notes', $this->_notes);
        }
        if($this->_action instanceof Action)
        {
            $this->xml->addAttribute('action', (string) $this->_action);
        }
        return parent::toXml();
    }
}