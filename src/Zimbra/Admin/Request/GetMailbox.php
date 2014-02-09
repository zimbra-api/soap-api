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

/**
 * GetMailbox request class
 * Get a Mailbox. 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetMailbox extends Base
{
    /**
     * Constructor method for GetMailbox
     * @param  Mailbox $mbox Mailbox selector
     * @return self
     */
    public function __construct(Mailbox $mbox)
    {
        parent::__construct();
        $this->child('mbox', $mbox);
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
            return $this->child('mbox');
        }
        return $this->child('mbox', $mbox);
    }
}