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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlList, XmlRoot};

/**
 * XMPPComponentInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="xmppcomponent")
 */
class XMPPComponentInfo extends AdminAttrsImpl
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * @Accessor(getter="getDomainName", setter="setDomainName")
     * @SerializedName("x-domainName")
     * @Type("string")
     * @XmlAttribute
     */
    private $domainName;

    /**
     * @Accessor(getter="getServerName", setter="setServerName")
     * @SerializedName("x-serverName")
     * @Type("string")
     * @XmlAttribute
     */
    private $serverName;

    /**
     * Constructor method for XMPPComponentInfo
     * 
     * @param  string $name
     * @param  string $id
     * @param  string $domainName
     * @param  string $serverName
     * @param  array  $attrs
     * @return self
     */
    public function __construct($name, $id, $domainName = NULL, $serverName = NULL, array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setName($name)
             ->setId($id);
        if (NULL !== $domainName) {
            $this->setDomainName($domainName);
        }
        if (NULL !== $serverName) {
            $this->setServerName($serverName);
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    /**
     * Gets domainName
     *
     * @return string
     */
    public function getDomainName(): string
    {
        return $this->domainName;
    }

    /**
     * Sets domainName
     *
     * @param  string $domainName
     * @return self
     */
    public function setDomainName($domainName): self
    {
        $this->domainName = trim($domainName);
        return $this;
    }

    /**
     * Gets serverName
     *
     * @return string
     */
    public function getServerName(): string
    {
        return $this->serverName;
    }

    /**
     * Sets serverName
     *
     * @param  string $serverName
     * @return self
     */
    public function setServerName($serverName): self
    {
        $this->serverName = trim($serverName);
        return $this;
    }
}
