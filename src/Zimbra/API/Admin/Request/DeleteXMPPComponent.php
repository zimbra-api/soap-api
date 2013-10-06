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
use Zimbra\Soap\Struct\XmppComponentSelector as Xmpp;

/**
 * DeleteXMPPComponent class
 * Delete an XMPP Component.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteXMPPComponent extends Request
{
    /**
     * XMPP Component details
     * @var XmppComponentSelector
     */
    private $_xmpp;

    /**
     * Constructor method for DeleteXMPPComponent
     * @param Xmpp $policy
     * @return self
     */
    public function __construct(Xmpp $xmpp)
    {
        parent::__construct();
        $this->_xmpp = $xmpp;
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
            return $this->_xmpp;
        }
        $this->_xmpp = $xmpp;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_xmpp->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_xmpp->toXml());
        return parent::toXml();
    }
}
