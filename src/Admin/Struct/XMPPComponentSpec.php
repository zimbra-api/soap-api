<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * XMPPComponentSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class XMPPComponentSpec extends AdminAttrsImpl
{
    /**
     * The name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Domain selector
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainSelector")
     * @XmlElement
     */
    private $domain;

    /**
     * Server selector
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Admin\Struct\ServerSelector")
     * @XmlElement
     */
    private $server;

    /**
     * Constructor method for XmppComponentSpec
     * @param string $name
     * @param DomainSelector $domain
     * @param ServerSelector $server
     * @param array $attrs
     * @return self
     */
    public function __construct(
        string $name,
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets the domain.
     *
     * @return DomainSelector
     */
    public function getDomain(): DomainSelector
    {
        return $this->domain;
    }

    /**
     * Sets the domain.
     *
     * @param  DomainSelector $domain
     * @return self
     */
    public function setDomain(DomainSelector $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Sets the server.
     *
     * @return ServerSelector
     */
    public function getServer(): ServerSelector
    {
        return $this->server;
    }

    /**
     * Sets the server.
     *
     * @param  ServerSelector $server
     * @return self
     */
    public function setServer(ServerSelector $server): self
    {
        $this->server = $server;
        return $this;
    }
}
