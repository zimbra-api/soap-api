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
class BounceMsg extends Base
{
    /**
     * Constructor method for BounceMsg
     * @param  BounceMsgSpec $m
     * @return self
     */
    public function __construct(BounceMsgSpec $m)
    {
        parent::__construct();
        $this->setChild('m', $m);
    }

    /**
     * Gets message
     *
     * @return BounceMsgSpec
     */
    public function getMsg()
    {
        return $this->getChild('m');
    }

    /**
     * Sets message
     *
     * @param  BounceMsgSpec $m
     *     Specification of message to be resent
     * @return self
     */
    public function setMsg(BounceMsgSpec $m)
    {
        return $this->setChild('m', $m);
    }
}
