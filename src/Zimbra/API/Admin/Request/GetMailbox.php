<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\MailboxByAccountIdSelector as Mailbox;

/**
 * GetMailbox class
 * Get a Mailbox. 
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetMailbox extends Request
{
    /**
     * Mailbox selector
     * @var Mailbox
     */
    private $_mbox;

    /**
     * Constructor method for GetMailbox
     * @param  Mailbox $mbox
     * @return self
     */
    public function __construct(Mailbox $mbox)
    {
        parent::__construct();
        $this->_mbox = $mbox;
    }

    /**
     * Gets or sets mbox
     *
     * @param  Mailbox $mbox
     * @return Mailbox|self
     */
    public function mbox(Mailbox $mbox = null)
    {
        if(null === $mbox)
        {
            return $this->_mbox;
        }
        $this->_mbox = $mbox;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_mbox->toArray('mbox');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_mbox->toXml('mbox'));
        return parent::toXml();
    }
}