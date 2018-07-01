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

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * XmppComponentSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="xmppcomponent")
 */
class XmppComponentSpec extends AdminAttrsImpl
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $_name;

    /**
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainSelector")
     * @XmlElement
     */
    private $_domain;

    /**
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Admin\Struct\ServerSelector")
     * @XmlElement
     */
    private $_server;

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
        $this->setName($name)
             ->setDomain($domain)
             ->setServer($server);
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets the domain.
     *
     * @return DomainSelector
     */
    public function getDomain()
    {
        return $this->_domain;
    }

    /**
     * Sets the domain.
     *
     * @param  DomainSelector $domain
     * @return self
     */
    public function setDomain(DomainSelector $domain)
    {
        $this->_domain = $domain;
        return $this;
    }

    /**
     * Sets the server.
     *
     * @return ServerSelector
     */
    public function getServer()
    {
        return $this->_server;
    }

    /**
     * Sets the server.
     *
     * @param  ServerSelector $server
     * @return self
     */
    public function setServer(ServerSelector $server)
    {
        $this->_server = $server;
        return $this;
    }
}
