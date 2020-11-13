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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\AuthScheme;

/**
 * ExchangeAuthSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present scheme Nguyen Van Nguyen.
 * @AccessType("public_method")
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
    private $url;

    /**
     * @Accessor(getter="getAuthUserName", setter="setAuthUserName")
     * @SerializedName("user")
     * @Type("string")
     * @XmlAttribute
     */
    private $authUserName;

    /**
     * @Accessor(getter="getAuthPassword", setter="setAuthPassword")
     * @SerializedName("pass")
     * @Type("string")
     * @XmlAttribute
     */
    private $authPassword;

    /**
     * @Accessor(getter="getScheme", setter="setScheme")
     * @SerializedName("scheme")
     * @Type("Zimbra\Enum\AuthScheme")
     * @XmlAttribute
     */
    private $scheme;

    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $type;

    /**
     * Constructor method for ExchangeAuthSpec
     * @param string $url URL to Exchange server
     * @param string $user Exchange user
     * @param string $pass Exchange password
     * @param AuthScheme $scheme Auth scheme
     * @param string $type Auth type
     * @return self
     */
    public function __construct(
        $url,
        $user,
        $pass,
        AuthScheme $scheme,
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
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Sets URL to Exchange server
     *
     * @param  string $url
     * @return self
     */
    public function setUrl($url): self
    {
        $this->url = trim($url);
        return $this;
    }

    /**
     * Gets exchange user
     *
     * @return string
     */
    public function getAuthUserName(): string
    {
        return $this->_user;
    }

    /**
     * Sets exchange user
     *
     * @param  string $user
     * @return self
     */
    public function setAuthUserName($user): self
    {
        $this->_user = trim($user);
        return $this;
    }

    /**
     * Gets exchange password
     *
     * @return string
     */
    public function getAuthPassword(): string
    {
        return $this->_pass;
    }

    /**
     * Sets exchange password
     *
     * @param  string $pass
     * @return self
     */
    public function setAuthPassword($pass): self
    {
        $this->_pass = trim($pass);
        return $this;
    }

    /**
     * Gets scheme enum
     *
     * @return AuthScheme
     */
    public function getScheme(): AuthScheme
    {
        return $this->scheme;
    }

    /**
     * Sets scheme enum
     *
     * @param  AuthScheme $scheme
     * @return self
     */
    public function setScheme(AuthScheme $scheme): self
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * Gets auth type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets auth type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type): self
    {
        $this->type = trim($type);
        return $this;
    }
}
