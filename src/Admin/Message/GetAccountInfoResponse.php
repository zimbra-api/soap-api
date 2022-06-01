<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList, XmlElement};
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAccountInfoResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAccountInfoResponse implements ResponseInterface
{
    /**
     * Account name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $name;

    /**
     * Currently only these attributes are returned: zimbraId, zimbraMailHost
     * @Accessor(getter="getAttrList", setter="setAttrList")
     * @SerializedName("a")
     * @Type("array<Zimbra\Admin\Struct\Attr>")
     * @XmlList(inline = true, entry = "a")
     */
    private $attrList = [];

    /**
     * Class of Service (COS) information for account
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosInfo")
     * @XmlElement
     */
    private $cos;

    /**
     * URL to talk to for SOAP service for this account.
     * 
     * @Accessor(getter="getSoapURLList", setter="setSoapURLList")
     * @SerializedName("soapURL")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "soapURL")
     */
    private $soapURLList = [];

    /**
     * URL for the Admin SOAP service
     * @Accessor(getter="getAdminSoapURL", setter="setAdminSoapURL")
     * @SerializedName("adminSoapURL")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $adminSoapURL;

    /**
     * URL for Web Mail application
     * @Accessor(getter="getPublicMailURL", setter="setPublicMailURL")
     * @SerializedName("publicMailURL")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $publicMailURL;

    /**
     * Constructor method for GetAccountInfoResponse
     *
     * @param string $name
     * @param array $attrList
     * @param CosInfo $cos
     * @param array $soapURLList
     * @param string $adminSoapURL
     * @param string $publicMailURL
     * @return self
     */
    public function __construct(
        string $name,
        array $attrList = [],
        ?CosInfo $cos = NULL,
        array $soapURLList = [],
        string $adminSoapURL = NULL,
        string $publicMailURL = NULL
    )
    {
        $this->setName($name)
             ->setAttrList($attrList)
             ->setSoapURLList($soapURLList);
        if ($cos instanceof CosInfo) {
            $this->setCos($cos);
        }
        if (NULL !== $adminSoapURL) {
            $this->setAdminSoapURL($adminSoapURL);
        }
        if (NULL !== $publicMailURL) {
            $this->setPublicMailURL($publicMailURL);
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
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Add an attribute
     *
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr): self
    {
        $this->attrList[] = $attr;
        return $this;
    }

    /**
     * Sets attributes
     *
     * @param array $attrs
     * @return self
     */
    public function setAttrList(array $attrList): self
    {
        $this->attrList = [];
        foreach ($attrList as $attr) {
            if ($attr instanceof Attr) {
                $this->attrList[] = $attr;
            }
        }
        return $this;
    }

    /**
     * Gets attributes
     *
     * @return array
     */
    public function getAttrList(): array
    {
        return $this->attrList;
    }

    /**
     * Gets the cos.
     *
     * @return CosInfo
     */
    public function getCos(): ?CosInfo
    {
        return $this->cos;
    }

    /**
     * Sets the cos.
     *
     * @param  CosInfo $cos
     * @return self
     */
    public function setCos(CosInfo $cos): self
    {
        $this->cos = $cos;
        return $this;
    }

    /**
     * Add a soap URL list
     *
     * @param  string $member
     * @return self
     */
    public function addSoapURL($soapUrl): self
    {
        $soapUrl = trim($soapUrl);
        if (!empty($soapUrl) && !in_array($soapUrl, $this->soapURLList)) {
            $this->soapURLList[] = $soapUrl;
        }
        return $this;
    }

    /**
     * Sets soap URL list
     *
     * @param  array $soapURLList
     * @return self
     */
    public function setSoapURLList(array $soapURLList): self
    {
        $this->soapURLList = [];
        foreach ($soapURLList as $soapUrl) {
            $this->addSoapURL($soapUrl);
        }
        return $this;
    }

    /**
     * Gets soap URL list
     *
     * @return array
     */
    public function getSoapURLList(): array
    {
        return $this->soapURLList;
    }

    /**
     * Gets admin soap URL
     *
     * @return string
     */
    public function getAdminSoapURL(): ?string
    {
        return $this->adminSoapURL;
    }

    /**
     * Sets admin soap URL
     *
     * @param  string $adminSoapURL
     * @return self
     */
    public function setAdminSoapURL(string $adminSoapURL): self
    {
        $this->adminSoapURL = $adminSoapURL;
        return $this;
    }

    /**
     * Gets public mail URL
     *
     * @return string
     */
    public function getPublicMailURL(): ?string
    {
        return $this->publicMailURL;
    }

    /**
     * Sets public mail URL
     *
     * @param  string $publicMailURL
     * @return self
     */
    public function setPublicMailURL(string $publicMailURL): self
    {
        $this->publicMailURL = $publicMailURL;
        return $this;
    }
}
