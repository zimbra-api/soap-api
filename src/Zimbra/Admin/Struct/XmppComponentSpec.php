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
        array $attrs = array()
    )
    {
        parent::__construct($attrs);
        $this->property('name', trim($name));
        $this->child('domain', $domain);
        $this->child('server', $server);
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
            return $this->property('name');
        }
        return $this->property('name', trim($name));
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
            return $this->child('domain');
        }
        return $this->child('domain', $domain);
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
            return $this->child('server');
        }
        return $this->child('server', $server);
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
