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

use Zimbra\Admin\Struct\XmppComponentSpec as Xmpp;

/**
 * CreateXMPPComponent request class
 * Create an XMPP component.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateXMPPComponent extends Base
{
    /**
     * Constructor method for CreateXMPPComponent
     * @param Xmpp $xmpp XMPP component details
     * @return self
     */
    public function __construct(Xmpp $xmpp)
    {
        parent::__construct();
        $this->setChild('xmppcomponent', $xmpp);
    }

    /**
     * Gets the xmpp component.
     *
     * @return Xmpp
     */
    public function getComponent()
    {
        return $this->getChild('xmppcomponent');
    }

    /**
     * Sets the xmpp component.
     *
     * @param  Xmpp $xmpp
     * @return self
     */
    public function setComponent(Xmpp $xmpp)
    {
        return $this->setChild('xmppcomponent', $xmpp);
    }
}
