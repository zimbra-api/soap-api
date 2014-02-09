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
 * GetXMPPComponent request class
 * Get XMPP Component.
 * XMPP stands for Extensible Messaging and Presence Protocol.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetXMPPComponent extends Base
{
    /**
     * Constructor method for GetXMPPComponent
     * @param  Xmpp $xmpp XMPP Component selector
     * @param  string $attrs Comma separated list of attributes
     * @return self
     */
    public function __construct(Xmpp $xmpp, $attrs = null)
    {
        parent::__construct();
        $this->child('xmppcomponent', $xmpp);
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
        }
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

    /**
     * Gets or sets attrs
     *
     * @param  string $attrs
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->property('attrs');
        }
        return $this->property('attrs', trim($attrs));
    }
}
