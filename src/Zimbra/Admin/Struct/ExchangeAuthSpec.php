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
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\AuthScheme;

/**
 * ExchangeAuthSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 scheme Nguyen Van Nguyen.
 * @XmlRoot(name="auth")
 */
class ExchangeAuthSpec
{
    /**
     * @Accessor(getter="getUrl", setter="setUrl")
     * @SerializedName("url")
     * @Type("string")
     * @XmlAttribute
     */
    private $_url;

    /**
     * @Accessor(getter="getAuthUserName", setter="setAuthUserName")
     * @SerializedName("user")
     * @Type("string")
     * @XmlAttribute
     */
    private $_authUserName;

    /**
     * @Accessor(getter="getAuthPassword", setter="setAuthPassword")
     * @SerializedName("pass")
     * @Type("string")
     * @XmlAttribute
     */
    private $_authPassword;

    /**
     * @Accessor(getter="getScheme", setter="setScheme")
     * @SerializedName("scheme")
     * @Type("string")
     * @XmlAttribute
     */
    private $_scheme;

    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $_type;

    /**
     * Constructor method for ExchangeAuthSpec
     * @param string $url URL to Exchange server
     * @param string $user Exchange user
     * @param string $pass Exchange password
     * @param string $scheme Auth scheme
     * @param string $type Auth type
     * @return self
     */
    public function __construct(
        $url,
        $user,
        $pass,
        $scheme,
        $type = NULL
    )
    {
        $this->setUrl($url)
             ->setAuthUserName($user)
             ->setAuthPassword($pass)
             ->setScheme($scheme);
        if (NULL !== $type) {
            $this->setType($type);
        }
    }

    /**
     * Gets URL to Exchange server
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * Sets URL to Exchange server
     *
     * @param  string $url
     * @return self
     */
    public function setUrl($url)
    {
        $this->_url = trim($url);
        return $this;
    }

    /**
     * Gets exchange user
     *
     * @return string
     */
    public function getAuthUserName()
    {
        return $this->_user;
    }

    /**
     * Sets exchange user
     *
     * @param  string $user
     * @return self
     */
    public function setAuthUserName($user)
    {
        $this->_user = trim($user);
        return $this;
    }

    /**
     * Gets exchange password
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->_pass;
    }

    /**
     * Sets exchange password
     *
     * @param  string $pass
     * @return self
     */
    public function setAuthPassword($pass)
    {
        $this->_pass = trim($pass);
        return $this;
    }

    /**
     * Gets scheme enum
     *
     * @return Zimbra\Enum\AuthScheme
     */
    public function getScheme()
    {
        return $this->_scheme;
    }

    /**
     * Sets scheme enum
     *
     * @param  string $scheme
     * @return self
     */
    public function setScheme($scheme)
    {
        if (AuthScheme::has(trim($scheme))) {
            $this->_scheme = $scheme;
        }
        return $this;
    }

    /**
     * Gets auth type
     *
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Sets auth type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        $this->_type = trim($type);
        return $this;
    }
}
