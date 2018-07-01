<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Header;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * UserAgentInfo struct class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
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
    private $_name;

    /**
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("version")
     * @Type("string")
     * @XmlAttribute
     */
    private $_version;

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
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets user agent name
     *
     * @param  string $id
     * @return string|self
     */
    public function setName($id)
    {
        $this->_name = trim($id);
        return $this;
    }

    /**
     * Gets user agent version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->_version;
    }

    /**
     * Sets user agent version
     *
     * @param  string $version
     * @return self
     */
    public function setVersion($version)
    {
        $this->_version = trim($version);
        return $this;
    }
}
