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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Admin\Struct\{Attr, CosInfo};
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAccountInfoResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAccountInfoResponse extends SoapResponse
{
    /**
     * Account name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAdmin')]
    private $name;

    /**
     * Currently only these attributes are returned: zimbraId, zimbraMailHost
     * 
     * @var array
     */
    #[Accessor(getter: 'getAttrList', setter: 'setAttrList')]
    #[Type('array<Zimbra\Admin\Struct\Attr>')]
    #[XmlList(inline: true, entry: 'a', namespace: 'urn:zimbraAdmin')]
    private $attrList = [];

    /**
     * Class of Service (COS) information for account
     * 
     * @var CosInfo
     */
    #[Accessor(getter: 'getCos', setter: 'setCos')]
    #[SerializedName('cos')]
    #[Type(CosInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?CosInfo $cos;

    /**
     * URL to talk to for SOAP service for this account.
     * 
     * @var array
     */
    #[Accessor(getter: 'getSoapURLList', setter: 'setSoapURLList')]
    #[Type('array<string>')]
    #[XmlList(inline: true, entry: 'soapURL', namespace: 'urn:zimbraAdmin')]
    private $soapURLList = [];

    /**
     * URL for the Admin SOAP service
     * 
     * @var string
     */
    #[Accessor(getter: 'getAdminSoapURL', setter: 'setAdminSoapURL')]
    #[SerializedName('adminSoapURL')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAdmin')]
    private $adminSoapURL;

    /**
     * URL for Web Mail application
     * 
     * @var string
     */
    #[Accessor(getter: 'getPublicMailURL', setter: 'setPublicMailURL')]
    #[SerializedName('publicMailURL')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAdmin')]
    private $publicMailURL;

    /**
     * Constructor
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
        string $name = '',
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
        $this->cos = $cos;
        if (NULL !== $adminSoapURL) {
            $this->setAdminSoapURL($adminSoapURL);
        }
        if (NULL !== $publicMailURL) {
            $this->setPublicMailURL($publicMailURL);
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
     * Set attributes
     *
     * @param array $attrs
     * @return self
     */
    public function setAttrList(array $attrs): self
    {
        $this->attrList = array_filter($attrs, static fn ($attr) => $attr instanceof Attr);
        return $this;
    }

    /**
     * Get attributes
     *
     * @return array
     */
    public function getAttrList(): array
    {
        return $this->attrList;
    }

    /**
     * Get the cos.
     *
     * @return CosInfo
     */
    public function getCos(): ?CosInfo
    {
        return $this->cos;
    }

    /**
     * Set the cos.
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
     * Set soap URL list
     *
     * @param  array $soapURLList
     * @return self
     */
    public function setSoapURLList(array $soapURLList): self
    {
        $this->soapURLList = array_unique(array_map(static fn ($soapUrl) => trim($soapUrl), $soapURLList));
        return $this;
    }

    /**
     * Get soap URL list
     *
     * @return array
     */
    public function getSoapURLList(): array
    {
        return $this->soapURLList;
    }

    /**
     * Get admin soap URL
     *
     * @return string
     */
    public function getAdminSoapURL(): ?string
    {
        return $this->adminSoapURL;
    }

    /**
     * Set admin soap URL
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
     * Get public mail URL
     *
     * @return string
     */
    public function getPublicMailURL(): ?string
    {
        return $this->publicMailURL;
    }

    /**
     * Set public mail URL
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
