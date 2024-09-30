<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlElement,
    XmlList
};
use Zimbra\Common\Struct\{NamedValue, SoapResponse};

/**
 * GetAccountInfoResponse class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAccountInfoResponse extends SoapResponse
{
    /**
     * Account name - an email address (user@domain)
     *
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $name;

    /**
     * Account attributes.  Currently only these attributes are returned:
     * zimbraId: the unique UUID of the zimbra account
     * zimbraMailHost: the server on which this user's mail resides
     * displayName: display name for the account
     *
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @Type("array<Zimbra\Common\Struct\NamedValue>")
     * @XmlList(inline=true, entry="attr", namespace="urn:zimbraAccount")
     *
     * @var array
     */
    #[Accessor(getter: "getAttrs", setter: "setAttrs")]
    #[Type("array<Zimbra\Common\Struct\NamedValue>")]
    #[XmlList(inline: true, entry: "attr", namespace: "urn:zimbraAccount")]
    private $attrs = [];

    /**
     * URL to talk to for soap service for this account.
     *
     * @Accessor(getter="getSoapURL", setter="setSoapURL")
     * @SerializedName("soapURL")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     *
     * @var string
     */
    #[Accessor(getter: "getSoapURL", setter: "setSoapURL")]
    #[SerializedName("soapURL")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $soapURL;

    /**
     * Base public URL for the requested account
     *
     * @Accessor(getter="getPublicURL", setter="setPublicURL")
     * @SerializedName("publicURL")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     *
     * @var string
     */
    #[Accessor(getter: "getPublicURL", setter: "setPublicURL")]
    #[SerializedName("publicURL")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $publicURL;

    /**
     * URL to talk to in order to change a password.
     * Not returned if not configured via domain attribute zimbraChangePasswordURL
     *
     * @Accessor(getter="getChangePasswordURL", setter="setChangePasswordURL")
     * @SerializedName("changePasswordURL")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     *
     * @var string
     */
    #[Accessor(getter: "getChangePasswordURL", setter: "setChangePasswordURL")]
    #[SerializedName("changePasswordURL")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $changePasswordURL;

    /**
     * Zimbra Community URL to load in Community tab.
     *
     * @Accessor(getter="getCommunityURL", setter="setCommunityURL")
     * @SerializedName("communityURL")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     *
     * @var string
     */
    #[Accessor(getter: "getCommunityURL", setter: "setCommunityURL")]
    #[SerializedName("communityURL")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $communityURL;

    /**
     * base URL for accessing the admin console
     *
     * @Accessor(getter="getAdminURL", setter="setAdminURL")
     * @SerializedName("adminURL")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     *
     * @var string
     */
    #[Accessor(getter: "getAdminURL", setter: "setAdminURL")]
    #[SerializedName("adminURL")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $adminURL;

    /**
     * Proxy URL for accessing XMPP over BOSH.
     * Should be returned only when zimbraFeatureChatEnabled is set to TRUE for Account/COS
     *
     * @Accessor(getter="getBoshURL", setter="setBoshURL")
     * @SerializedName("boshURL")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     *
     * @var string
     */
    #[Accessor(getter: "getBoshURL", setter: "setBoshURL")]
    #[SerializedName("boshURL")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAccount")]
    private $boshURL;

    /**
     * Constructor
     *
     * @param string $name
     * @param array $attrs
     * @param string $soapURL
     * @param string $publicURL
     * @param string $changePasswordURL
     * @param string $communityURL
     * @param string $adminURL
     * @param string $boshURL
     * @return self
     */
    public function __construct(
        string $name = "",
        array $attrs = [],
        ?string $soapURL = null,
        ?string $publicURL = null,
        ?string $changePasswordURL = null,
        ?string $communityURL = null,
        ?string $adminURL = null,
        ?string $boshURL = null
    ) {
        $this->setName($name)->setAttrs($attrs);
        if (null !== $soapURL) {
            $this->setSoapURL($soapURL);
        }
        if (null !== $publicURL) {
            $this->setPublicURL($publicURL);
        }
        if (null !== $changePasswordURL) {
            $this->setChangePasswordURL($changePasswordURL);
        }
        if (null !== $communityURL) {
            $this->setCommunityURL($communityURL);
        }
        if (null !== $adminURL) {
            $this->setAdminURL($adminURL);
        }
        if (null !== $boshURL) {
            $this->setBoshURL($boshURL);
        }
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name.
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
     * Set attrs
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter(
            $attrs,
            static fn($attr) => $attr instanceof NamedValue
        );
        return $this;
    }

    /**
     * Get attrs
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Get the soapURL.
     *
     * @return string
     */
    public function getSoapURL(): ?string
    {
        return $this->soapURL;
    }

    /**
     * Set the soapURL.
     *
     * @param  string $soapURL
     * @return self
     */
    public function setSoapURL(string $soapURL): self
    {
        $this->soapURL = $soapURL;
        return $this;
    }

    /**
     * Get the publicURL.
     *
     * @return string
     */
    public function getPublicURL(): ?string
    {
        return $this->publicURL;
    }

    /**
     * Set the publicURL.
     *
     * @param  string $publicURL
     * @return self
     */
    public function setPublicURL(string $publicURL): self
    {
        $this->publicURL = $publicURL;
        return $this;
    }

    /**
     * Get the changePasswordURL.
     *
     * @return string
     */
    public function getChangePasswordURL(): ?string
    {
        return $this->changePasswordURL;
    }

    /**
     * Set the changePasswordURL.
     *
     * @param  string $changePasswordURL
     * @return self
     */
    public function setChangePasswordURL(string $changePasswordURL): self
    {
        $this->changePasswordURL = $changePasswordURL;
        return $this;
    }

    /**
     * Get the communityURL.
     *
     * @return string
     */
    public function getCommunityURL(): ?string
    {
        return $this->communityURL;
    }

    /**
     * Set the communityURL.
     *
     * @param  string $communityURL
     * @return self
     */
    public function setCommunityURL(string $communityURL): self
    {
        $this->communityURL = $communityURL;
        return $this;
    }

    /**
     * Get the adminURL.
     *
     * @return string
     */
    public function getAdminURL(): ?string
    {
        return $this->adminURL;
    }

    /**
     * Set the adminURL.
     *
     * @param  string $adminURL
     * @return self
     */
    public function setAdminURL(string $adminURL): self
    {
        $this->adminURL = $adminURL;
        return $this;
    }

    /**
     * Get the boshURL.
     *
     * @return string
     */
    public function getBoshURL(): ?string
    {
        return $this->boshURL;
    }

    /**
     * Set the boshURL.
     *
     * @param  string $boshURL
     * @return self
     */
    public function setBoshURL(string $boshURL): self
    {
        $this->boshURL = $boshURL;
        return $this;
    }
}
