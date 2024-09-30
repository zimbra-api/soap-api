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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * XMPPComponentInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class XMPPComponentInfo extends AdminAttrsImpl
{
    /**
     * Name
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * Id
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * Domain name
     *
     * @var string
     */
    #[Accessor(getter: "getDomainName", setter: "setDomainName")]
    #[SerializedName("x-domainName")]
    #[Type("string")]
    #[XmlAttribute]
    private $domainName;

    /**
     * Server name
     *
     * @var string
     */
    #[Accessor(getter: "getServerName", setter: "setServerName")]
    #[SerializedName("x-serverName")]
    #[Type("string")]
    #[XmlAttribute]
    private $serverName;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  string $id
     * @param  string $domainName
     * @param  string $serverName
     * @param  array  $attrs
     * @return self
     */
    public function __construct(
        string $name = "",
        string $id = "",
        ?string $domainName = null,
        ?string $serverName = null,
        array $attrs = []
    ) {
        parent::__construct($attrs);
        $this->setName($name)->setId($id);
        if (null !== $domainName) {
            $this->setDomainName($domainName);
        }
        if (null !== $serverName) {
            $this->setServerName($serverName);
        }
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set ID
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get domainName
     *
     * @return string
     */
    public function getDomainName(): ?string
    {
        return $this->domainName;
    }

    /**
     * Set domainName
     *
     * @param  string $domainName
     * @return self
     */
    public function setDomainName(string $domainName): self
    {
        $this->domainName = $domainName;
        return $this;
    }

    /**
     * Get serverName
     *
     * @return string
     */
    public function getServerName(): ?string
    {
        return $this->serverName;
    }

    /**
     * Set serverName
     *
     * @param  string $serverName
     * @return self
     */
    public function setServerName(string $serverName): self
    {
        $this->serverName = $serverName;
        return $this;
    }
}
