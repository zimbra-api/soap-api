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

use Zimbra\Mail\Struct\BounceMsgSpec;
use Zimbra\Soap\Request;

/**
 * BounceMsg request class
 * Resend a message
 * Supports (f)rom, (t)o, (c)c, (b)cc, (s)ender "type" on <e> elements 
 * (these get mapped to Resent-From, Resent-To, Resent-CC, Resent-Bcc, Resent-Sender headers, which are prepended to copy of existing message)
 * Aside from these prepended headers, message is reinjected verbatim
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class BounceMsg extends Request
{
    /**
     * Constructor method for BounceMsg
     * @param  BounceMsgSpec $m
     * @return self
     */
    public function __construct(BounceMsgSpec $m)
    {
        parent::__construct();
        $this->child('m', $m);
    }

    /**
     * Get or set m
     * Specification of message to be resent
     *
     * @param  BounceMsgSpec $m
     * @return BounceMsgSpec|self
     */
    public function m(BounceMsgSpec $m = null)
    {
        if(null === $m)
        {
            return $this->child('m');
        }
        return $this->child('m', $m);
    }
}
