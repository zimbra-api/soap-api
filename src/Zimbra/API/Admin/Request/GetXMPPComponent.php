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
use Zimbra\Soap\Struct\XMPPComponentSelector as XMPP;

/**
 * GetXMPPComponent class
 * Get XMPP Component.
 * XMPP stands for Extensible Messaging and Presence Protocol.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetXMPPComponent extends Request
{
    /**
     * XMPP Component selector
     * @var XMPP
     */
    private $_xmpp;

    /**
     * Comma separated list of attributes
     * @var string
     */
    private $_attrs;

    /**
     * Constructor method for GetXMPPComponent
     * @param  XMPP $xmpp
     * @param  string $attrs
     * @return self
     */
    public function __construct(XMPP $xmpp, $attrs = null)
    {
        parent::__construct();
        $this->_xmpp = $xmpp;
		$this->_attrs = trim($attrs);
    }

    /**
     * Gets or sets xmpp
     *
     * @param  XMPP $xmpp
     * @return XMPP|self
     */
    public function xmpp(XMPP $xmpp = null)
    {
        if(null === $xmpp)
        {
            return $this->_xmpp;
        }
        $this->_xmpp = $xmpp;
        return $this;
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
            return $this->_attrs;
        }
        $this->_attrs = trim($attrs);
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
        if(!empty($this->_attrs))
        {
            $this->array['attrs'] = $this->_attrs;
        }
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
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        return parent::toXml();
    }
}
