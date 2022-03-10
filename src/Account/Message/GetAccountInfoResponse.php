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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Struct\NamedValue;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAccountInfoResponse class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAccountInfoResponse implements ResponseInterface
{
    /**
     * Account name - an email address (user@domain)
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $name;

    /**
     * Account attributes.  Currently only these attributes are returned:
     * zimbraId: the unique UUID of the zimbra account 
     * zimbraMailHost: the server on which this user's mail resides
     * displayName: display name for the account
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attr")
     * @Type("array<Zimbra\Struct\NamedValue>")
     * @XmlList(inline = true, entry = "attr")
     */
    private $attrs;

    /**
     * URL to talk to for soap service for this account.
     * @Accessor(getter="getSoapURL", setter="setSoapURL")
     * @SerializedName("soapURL")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $soapURL;

    /**
     * Base public URL for the requested account
     * @Accessor(getter="getPublicURL", setter="setPublicURL")
     * @SerializedName("publicURL")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $publicURL;

    /**
     * URL to talk to in order to change a password.
     * Not returned if not configured via domain attribute zimbraChangePasswordURL
     * @Accessor(getter="getChangePasswordURL", setter="setChangePasswordURL")
     * @SerializedName("changePasswordURL")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $changePasswordURL;

    /**
     * Zimbra Community URL to load in Community tab.
     * @Accessor(getter="getCommunityURL", setter="setCommunityURL")
     * @SerializedName("communityURL")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $communityURL;

    /**
     * base URL for accessing the admin console
     * @Accessor(getter="getAdminURL", setter="setAdminURL")
     * @SerializedName("adminURL")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $adminURL;

    /**
     * Proxy URL for accessing XMPP over BOSH.
     * Should be returned only when zimbraFeatureChatEnabled is set to TRUE for Account/COS
     * @Accessor(getter="getBoshURL", setter="setBoshURL")
     * @SerializedName("boshURL")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $boshURL;

    /**
     * Constructor method for GetAccountInfoResponse
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
        string $name,
        array $attrs = [],
        ?string $soapURL = NULL,
        ?string $publicURL = NULL,
        ?string $changePasswordURL = NULL,
        ?string $communityURL = NULL,
        ?string $adminURL = NULL,
        ?string $boshURL = NULL
    )
    {
        $this->setName($name)
             ->setAttrs($attrs);
        if (NULL !== $soapURL) {
            $this->setSoapURL($soapURL);
        }
        if (NULL !== $publicURL) {
            $this->setPublicURL($publicURL);
        }
        if (NULL !== $changePasswordURL) {
            $this->setChangePasswordURL($changePasswordURL);
        }
        if (NULL !== $communityURL) {
            $this->setCommunityURL($communityURL);
        }
        if (NULL !== $adminURL) {
            $this->setAdminURL($adminURL);
        }
        if (NULL !== $boshURL) {
            $this->setBoshURL($boshURL);
        }
    }

    /**
     * Gets the name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name.
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
     * Add attr
     *
     * @param  NamedValue $attr
     * @return self
     */
    public function addAttr(NamedValue $attr): self
    {
        $this->attrs[] = $attr;
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
        $this->attrs = [];
        foreach ($attrs as $attr) {
            if ($attr instanceof NamedValue) {
                $this->attrs[] = $attr;
            }
        }
        return $this;
    }

    /**
     * Gets attrs
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Gets the soapURL.
     *
     * @return string
     */
    public function getSoapURL(): ?string
    {
        return $this->soapURL;
    }

    /**
     * Sets the soapURL.
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
     * Gets the publicURL.
     *
     * @return string
     */
    public function getPublicURL(): ?string
    {
        return $this->publicURL;
    }

    /**
     * Sets the publicURL.
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
     * Gets the changePasswordURL.
     *
     * @return string
     */
    public function getChangePasswordURL(): ?string
    {
        return $this->changePasswordURL;
    }

    /**
     * Sets the changePasswordURL.
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
     * Gets the communityURL.
     *
     * @return string
     */
    public function getCommunityURL(): ?string
    {
        return $this->communityURL;
    }

    /**
     * Sets the communityURL.
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
     * Gets the adminURL.
     *
     * @return string
     */
    public function getAdminURL(): ?string
    {
        return $this->adminURL;
    }

    /**
     * Sets the adminURL.
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
     * Gets the boshURL.
     *
     * @return string
     */
    public function getBoshURL(): ?string
    {
        return $this->boshURL;
    }

    /**
     * Sets the boshURL.
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
