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

use Zimbra\Admin\Struct\XmppComponentSelector as Xmpp;

/**
 * DeleteXMPPComponent request class
 * Delete an XMPP Component.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteXMPPComponent extends Base
{
    /**
     * Constructor method for DeleteXMPPComponent
     * @param Xmpp $policy XMPP component details
     * @return self
     */
    public function __construct(Xmpp $xmpp)
    {
        parent::__construct();
        $this->child('xmppcomponent', $xmpp);
    }

    /**
     * Gets or sets xmpp
     *
     * @param  Xmpp $xmpp
     * @return Xmpp|self
     */
    public function xmpp(Xmpp $xmpp = null)
    {
        if(null === $xmpp)
        {
            return $this->child('xmppcomponent');
        }
        return $this->child('xmppcomponent', $xmpp);
    }
}
