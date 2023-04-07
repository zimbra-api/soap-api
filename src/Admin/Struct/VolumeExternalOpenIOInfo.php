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

/**
 * VolumeExternalOpenIOInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class VolumeExternalOpenIOInfo extends BaseExternalVolume
{
    /**
     * Specifies the standard HTTP URL for OpenIO
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
     * Specifies OpenIO account name
     * 
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getAccount', setter: 'setAccount')]
    #[SerializedName('account')]
    #[Type('string')]
    #[XmlAttribute]
    private $account;

    /**
     * Specifies OpenIO namespace
     * 
     * @Accessor(getter="getNameSpace", setter="setNameSpace")
     * @SerializedName("namespace")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getNameSpace', setter: 'setNameSpace')]
    #[SerializedName('namespace')]
    #[Type('string')]
    #[XmlAttribute]
    private $nameSpace;

    /**
     * Specifies OpenIO proxy port
     * 
     * @Accessor(getter="getProxyPort", setter="setProxyPort")
     * @SerializedName("proxyPort")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getProxyPort', setter: 'setProxyPort')]
    #[SerializedName('proxyPort')]
    #[Type('int')]
    #[XmlAttribute]
    private $proxyPort;

    /**
     * Specifies OpenIO account port
     * 
     * @Accessor(getter="getAccountPort", setter="setAccountPort")
     * @SerializedName("accountPort")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getAccountPort', setter: 'setAccountPort')]
    #[SerializedName('accountPort')]
    #[Type('int')]
    #[XmlAttribute]
    private $accountPort;

    /**
     * Constructor
     * 
     * @param string $storageType
     * @param string $url
     * @param string $account
     * @param string $nameSpace
     * @param int    $proxyPort
     * @param int    $accountPort
     * @return self
     */
    public function __construct(
        ?string $storageType = NULL,
        ?string $url = NULL,
        ?string $account = NULL,
        ?string $nameSpace = NULL,
        ?int $proxyPort = NULL,
        ?int $accountPort = NULL
    )
    {
        parent::__construct($storageType);
        if (NULL !== $url) {
            $this->setUrl($url);
        }
        if (NULL !== $account) {
            $this->setAccount($account);
        }
        if (NULL !== $nameSpace) {
            $this->setNameSpace($nameSpace);
        }
        if (NULL !== $proxyPort) {
            $this->setProxyPort($proxyPort);
        }
        if (NULL !== $accountPort) {
            $this->setAccountPort($accountPort);
        }
    }

    /**
     * Get the url
     *
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Set the url
     *
     * @param  string $volumePrefix
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get the account
     *
     * @return string
     */
    public function getAccount(): ?string
    {
        return $this->account;
    }

    /**
     * Set the account
     *
     * @param  string $account
     * @return self
     */
    public function setAccount(string $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Get the nameSpace
     *
     * @return string
     */
    public function getNameSpace(): ?string
    {
        return $this->nameSpace;
    }

    /**
     * Set the nameSpace
     *
     * @param  string $nameSpace
     * @return self
     */
    public function setNameSpace(string $nameSpace): self
    {
        $this->nameSpace = $nameSpace;
        return $this;
    }

    /**
     * Get the proxyPort
     *
     * @return int
     */
    public function getProxyPort(): ?int
    {
        return $this->proxyPort;
    }

    /**
     * Set the proxyPort
     *
     * @param  int $proxyPort
     * @return self
     */
    public function setProxyPort(int $proxyPort): self
    {
        $this->proxyPort = $proxyPort;
        return $this;
    }

    /**
     * Get the accountPort
     *
     * @return int
     */
    public function getAccountPort(): ?int
    {
        return $this->accountPort;
    }

    /**
     * Set the accountPort
     *
     * @param  int $accountPort
     * @return self
     */
    public function setAccountPort(int $accountPort): self
    {
        $this->accountPort = $accountPort;
        return $this;
    }
}
