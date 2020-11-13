<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Header;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * UserAgentInfo struct class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="userAgent")
 */
class UserAgentInfo
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("version")
     * @Type("string")
     * @XmlAttribute
     */
    private $version;

    /**
     * Constructor method for UserAgentInfo
     * @param string $name
     * @param string $version
     * @return self
     */
    public function __construct(
        $name = null,
        $version = null
    )
    {
        if(null !== $name)
        {
            $this->setName($name);
        }
        if(null !== $version)
        {
            $this->setVersion($version);
        }
    }

    /**
     * Gets user agent name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets user agent name
     *
     * @param  string $id
     * @return self
     */
    public function setName($id): self
    {
        $this->name = trim($id);
        return $this;
    }

    /**
     * Gets user agent version
     *
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Sets user agent version
     *
     * @param  string $version
     * @return self
     */
    public function setVersion($version): self
    {
        $this->version = trim($version);
        return $this;
    }
}
