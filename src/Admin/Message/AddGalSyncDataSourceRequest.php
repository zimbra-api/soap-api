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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Common\Enum\GalMode;
use Zimbra\Common\Struct\{AccountSelector, SoapEnvelopeInterface, SoapRequest};

/**
 * AddGalSyncDataSource request class
 * Add a GalSync data source
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AddGalSyncDataSourceRequest extends SoapRequest implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * The account
     *
     * @var AccountSelector
     */
    #[Accessor(getter: "getAccount", setter: "setAccount")]
    #[SerializedName("account")]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private AccountSelector $account;

    /**
     * Name of the data source
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private string $name;

    /**
     * Name of pre-existing domain
     *
     * @var string
     */
    #[Accessor(getter: "getDomain", setter: "setDomain")]
    #[SerializedName("domain")]
    #[Type("string")]
    #[XmlAttribute]
    private string $domain;

    /**
     * GalMode type
     *
     * @var GalMode
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[XmlAttribute]
    private GalMode $type;

    /**
     * Contact folder name
     *
     * @var string
     */
    #[Accessor(getter: "getFolder", setter: "setFolder")]
    #[SerializedName("folder")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $folder = null;

    /**
     * Constructor
     *
     * @param AccountSelector $account
     * @param string  $name
     * @param string  $domain
     * @param GalMode  $type
     * @param string  $folder
     * @return self
     */
    public function __construct(
        AccountSelector $account,
        string $name = "",
        string $domain = "",
        ?GalMode $type = null,
        ?string $folder = null,
        array $attrs = []
    ) {
        $this->setAccount($account)
            ->setName($name)
            ->setDomain($domain)
            ->setType($type ?? GalMode::BOTH);
        if (null !== $folder) {
            $this->setFolder($folder);
        }
        $this->setAttrs($attrs);
    }

    /**
     * Get the account.
     *
     * @return AccountSelector
     */
    public function getAccount(): AccountSelector
    {
        return $this->account;
    }

    /**
     * Set the account.
     *
     * @param  AccountSelector $account
     * @return self
     */
    public function setAccount(AccountSelector $account): self
    {
        $this->account = $account;
        return $this;
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
     * Get domain
     *
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Set domain
     *
     * @param  string $domain
     * @return self
     */
    public function setDomain(string $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Get type
     *
     * @return GalMode
     */
    public function getType(): GalMode
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param  GalMode $type
     * @return self
     */
    public function setType(GalMode $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get folder
     *
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder(string $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AddGalSyncDataSourceEnvelope(
            new AddGalSyncDataSourceBody($this)
        );
    }
}
