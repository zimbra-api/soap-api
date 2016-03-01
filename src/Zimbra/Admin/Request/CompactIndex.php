<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\MailboxByAccountIdSelector as Mailbox;
use Zimbra\Enum\CompactIndexAction as Action;

/**
 * CompactIndex request class
 * Clear cookie.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CompactIndex extends Base
{
    /**
     * Constructor method for CompactIndex
     * @param Mailbox $mbox Mailbox
     * @param Action $action Action to perform
     * @return self
     */
    public function __construct(Mailbox $mbox, Action $action = null)
    {
        parent::__construct();
        $this->setChild('mbox', $mbox);
        if($action instanceof Action)
        {
            $this->setProperty('action', $action);
        }
    }

    /**
     * Gets the mbox.
     *
     * @return Mailbox
     */
    public function getMailbox()
    {
        return $this->getChild('mbox');
    }

    /**
     * Sets the mbox.
     *
     * @param  Mailbox $mbox
     * @return self
     */
    public function setMailbox(Mailbox $mbox)
    {
        return $this->setChild('mbox', $mbox);
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
