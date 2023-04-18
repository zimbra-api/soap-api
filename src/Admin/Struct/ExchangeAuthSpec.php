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
use Zimbra\Common\Enum\AuthScheme;

/**
 * ExchangeAuthSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present scheme Nguyen Van Nguyen.
 */
class ExchangeAuthSpec
{
    /**
     * URL to Exchange server
     * 
     * @Accessor(getter="getUrl", setter="setUrl")
     * @SerializedName("url")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getUrl', setter: 'setUrl')]
    #[SerializedName('url')]
    #[Type('string')]
    #[XmlAttribute]
    private $url;

    /**
     * Exchange user
     * 
     * @Accessor(getter="getAuthUserName", setter="setAuthUserName")
     * @SerializedName("user")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getAuthUserName', setter: 'setAuthUserName')]
    #[SerializedName('user')]
    #[Type('string')]
    #[XmlAttribute]
    private $authUserName;

    /**
     * Exchange password
     * 
     * @Accessor(getter="getAuthPassword", setter="setAuthPassword")
     * @SerializedName("pass")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getAuthPassword', setter: 'setAuthPassword')]
    #[SerializedName('pass')]
    #[Type('string')]
    #[XmlAttribute]
    private $authPassword;

    /**
     * Auth scheme
     * 
     * @Accessor(getter="getScheme", setter="setScheme")
     * @SerializedName("scheme")
     * @Type("Enum<Zimbra\Common\Enum\AuthScheme>")
     * @XmlAttribute
     * 
     * @var AuthScheme
     */
    #[Accessor(getter: 'getScheme', setter: 'setScheme')]
    #[SerializedName('scheme')]
    #[Type('Enum<Zimbra\Common\Enum\AuthScheme>')]
    #[XmlAttribute]
    private AuthScheme $scheme;

    /**
     * Auth type
     * 
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName('type')]
    #[Type('string')]
    #[XmlAttribute]
    private $type;

    /**
     * Constructor
     * 
     * @param string $url
     * @param string $user
     * @param string $pass
     * @param AuthScheme $scheme
     * @param string $type
     * @return self
     */
    public function __construct(
        string $url = '',
        string $user = '',
        string $pass = '',
        ?AuthScheme $scheme = NULL,
        ?string $type = NULL
    )
    {
        $this->setUrl($url)
             ->setAuthUserName($user)
             ->setAuthPassword($pass)
             ->setScheme($scheme ?? new AuthScheme('basic'));
        if (NULL !== $type) {
            $this->setType($type);
        }
    }

    /**
     * Get URL to Exchange server
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set URL to Exchange server
     *
     * @param  string $url
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get exchange user
     *
     * @return string
     */
    public function getAuthUserName(): string
    {
        return $this->authUserName;
    }

    /**
     * Set exchange user
     *
     * @param  string $user
     * @return self
     */
    public function setAuthUserName(string $user): self
    {
        $this->authUserName = $user;
        return $this;
    }

    /**
     * Get exchange password
     *
     * @return string
     */
    public function getAuthPassword(): string
    {
        return $this->authPassword;
    }

    /**
     * Set exchange password
     *
     * @param  string $pass
     * @return self
     */
    public function setAuthPassword(string $pass): self
    {
        $this->authPassword = $pass;
        return $this;
    }

    /**
     * Get scheme enum
     *
     * @return AuthScheme
     */
    public function getScheme(): AuthScheme
    {
        return $this->scheme;
    }

    /**
     * Set scheme enum
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
     * Get auth type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set auth type
     *
     * @param  string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}
