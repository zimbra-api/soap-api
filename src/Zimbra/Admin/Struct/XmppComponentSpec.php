<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

/**
 * XmppComponentSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class XmppComponentSpec extends AdminAttrsImpl
{
    /**
     * Constructor method for XmppComponentSpec
     * @param string $name The name
     * @param DomainSelector $domain Domain selector
     * @param ServerSelector $server Server selector
     * @param array $attrs Attributes
     * @return self
     */
    public function __construct(
        $name,
        DomainSelector $domain,
        ServerSelector $server,
        array $attrs = []
    )
    {
        parent::__construct($attrs);
        $this->setProperty('name', trim($name));
        $this->setChild('domain', $domain);
        $this->setChild('server', $server);
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets the domain.
     *
     * @return DomainSelector
     */
    public function getDomain()
    {
        return $this->getChild('domain');
    }

    /**
     * Sets the domain.
     *
     * @param  DomainSelector $domain
     * @return self
     */
    public function setDomain(DomainSelector $domain)
    {
        return $this->setChild('domain', $domain);
    }

    /**
     * Sets the server.
     *
     * @return ServerSelector
     */
    public function getServer()
    {
        return $this->getChild('server');
    }

    /**
     * Sets the server.
     *
     * @param  ServerSelector $server
     * @return self
     */
    public function setServer(ServerSelector $server)
    {
        return $this->setChild('server', $server);
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'xmppcomponent')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'xmppcomponent')
    {
        return parent::toXml($name);
    }
}
