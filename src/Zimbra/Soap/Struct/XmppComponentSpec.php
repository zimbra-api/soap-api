<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * XmppComponentSpec class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class XmppComponentSpec extends AttrsImpl
{
    /**
     * The name
     * @var string
     */
    private $_name;

    /**
     * Domain selector
     * @var DomainSelector
     */
    private $_domain;

    /**
     * Server selector
     * @var ServerSelector
     */
    private $_server;

    /**
     * Constructor method for xmppComponentSpec
     * @param string $name
     * @param DomainSelector $domain
     * @param ServerSelector $server
     * @param array $attrs
     * @return self
     */
    public function __construct(
        $name,
        DomainSelector $domain,
        ServerSelector $server,
        array $attrs = array()
    )
    {
        parent::__construct($attrs);
        $this->_name = trim($name);
        $this->_domain = $domain;
        $this->_server = $server;
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets or sets domain
     *
     * @param  DomainSelector $domain
     * @return DomainSelector|self
     */
    public function domain(DomainSelector $domain = null)
    {
        if(null === $domain)
        {
            return $this->_domain;
        }
        $this->_domain = $domain;
        return $this;
    }

    /**
     * Gets or sets server
     *
     * @param  ServerSelector $server
     * @return ServerSelector|self
     */
    public function server(ServerSelector $server = null)
    {
        if(null === $server)
        {
            return $this->_server;
        }
        $this->_server = $server;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'name' => $this->_name,
        );
        $domainArr = $this->_domain->toArray();
        $this->array['domain'] = $domainArr['domain'];
        $serverArr = $this->_server->toArray();
        $this->array['server'] = $serverArr['server'];
        return array('xmppcomponent' => parent::toArray());
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<xmppcomponent />');
        $xml->addAttribute('name', $this->_name)
            ->append($this->_domain->toXml())
            ->append($this->_server->toXml());
        parent::appendAttrs($xml);
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
