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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Common\Enum\GalMode;
use Zimbra\Common\Struct\{AccountSelector, SoapEnvelopeInterface, SoapRequest};

/**
 * CreateGalSyncAccountRequest class
 * Create Global Address List (GAL) Synchronisation account
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateGalSyncAccountRequest extends SoapRequest implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Name of the data source.
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * Domain name
     * 
     * @var string
     */
    #[Accessor(getter: 'getDomain', setter: 'setDomain')]
    #[SerializedName('domain')]
    #[Type('string')]
    #[XmlAttribute]
    private $domain;

    /**
     * GalMode type
     * 
     * @var GalMode
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName('type')]
    #[XmlAttribute]
    private GalMode $type;

    /**
     * Account
     * 
     * @var AccountSelector
     */
    #[Accessor(getter: 'getAccount', setter: 'setAccount')]
    #[SerializedName('account')]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private AccountSelector $account;

    /**
     * password
     * 
     * @var string
     */
    #[Accessor(getter: 'getPassword', setter: 'setPassword')]
    #[SerializedName('password')]
    #[Type('string')]
    #[XmlAttribute]
    private $password;

    /**
     * Contact folder name
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolder', setter: 'setFolder')]
    #[SerializedName('folder')]
    #[Type('string')]
    #[XmlAttribute]
    private $folder;

    /**
     * The mailhost on which this account resides
     * 
     * @var string
     */
    #[Accessor(getter: 'getMailHost', setter: 'setMailHost')]
    #[SerializedName('server')]
    #[Type('string')]
    #[XmlAttribute]
    private $mailHost;

    /**
     * Constructor
     * 
     * @param AccountSelector  $account
     * @param string  $name
     * @param string  $domain
     * @param string  $mailHost
     * @param GalMode $type
     * @param string  $password
     * @param string  $folder
     * @param array   $attrs
     * @return self
     */
    public function __construct(
        AccountSelector $account,
        string $name = '',
        string $domain = '',
        string $mailHost = '',
        ?GalMode $type = NULL,
        ?string $password = NULL,
        ?string $folder = NULL,
        array $attrs = []
    )
    {
        $this->setName($name)
             ->setDomain($domain)
             ->setAccount($account)
             ->setMailHost($mailHost)
             ->setType($type ?? GalMode::BOTH)
             ->setAttrs($attrs);
        if (NULL !== $password) {
            $this->setPassword($password);
        }
        if (NULL !== $folder) {
            $this->setFolder($folder);
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
     * Get the type.
     *
     * @return GalMode
     */
    public function getType(): GalMode
    {
        return $this->type;
    }

    /**
     * Set the type.
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
     * Get mailHost
     *
     * @return string
     */
    public function getMailHost(): string
    {
        return $this->mailHost;
    }

    /**
     * Set mailHost
     *
     * @param  string $mailHost
     * @return self
     */
    public function setMailHost(string $mailHost): self
    {
        $this->mailHost = $mailHost;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
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
        return new CreateGalSyncAccountEnvelope(
            new CreateGalSyncAccountBody($this)
        );
    }
}
