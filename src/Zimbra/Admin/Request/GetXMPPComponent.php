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
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

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
class GetXMPPComponent extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Constructor method for GetXMPPComponent
     * @param  Xmpp $xmpp XMPP Component selector
     * @param  array $attrs An array of attributes
     * @return self
     */
    public function __construct(Xmpp $xmpp, array $attrs = [])
    {
        parent::__construct();
        $this->setChild('xmppcomponent', $xmpp);

        $this->setAttrs($attrs);
        $this->on('before', function(Base $sender)
        {
            $attrs = $sender->getAttrs();
            if(!empty($attrs))
            {
                $sender->setProperty('attrs', $attrs);
            }
        });
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
