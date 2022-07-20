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
use Zimbra\Common\Struct\AccountSelector;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * CreateGalSyncAccountRequest class
 * Create Global Address List (GAL) Synchronisation account
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateGalSyncAccountRequest extends Request implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Name of the data source.
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Domain name
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("string")
     * @XmlAttribute
     */
    private $domain;

    /**
     * GalMode type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\GalMode")
     * @XmlAttribute
     */
    private GalMode $type;

    /**
     * Account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private AccountSelector $account;

    /**
     * password
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlAttribute
     */
    private $password;

    /**
     * Contact folder name
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("folder")
     * @Type("string")
     * @XmlAttribute
     */
    private $folder;

    /**
     * The mailhost on which this account resides
     * @Accessor(getter="getMailHost", setter="setMailHost")
     * @SerializedName("server")
     * @Type("string")
     * @XmlAttribute
     */
    private $mailHost;

    /**
     * Constructor method for CreateGalSyncAccountRequest
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
             ->setType($type ?? GalMode::BOTH())
             ->setAttrs($attrs);
        if (NULL !== $password) {
            $this->setPassword($password);
        }
        if (NULL !== $folder) {
            $this->setFolder($folder);
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
     * Gets domain
     *
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Sets domain
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
     * Gets the type.
     *
     * @return GalMode
     */
    public function getType(): GalMode
    {
        return $this->type;
    }

    /**
     * Sets the type.
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
     * Gets the account.
     *
     * @return AccountSelector
     */
    public function getAccount(): AccountSelector
    {
        return $this->account;
    }

    /**
     * Sets the account.
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
     * Gets mailHost
     *
     * @return string
     */
    public function getMailHost(): string
    {
        return $this->mailHost;
    }

    /**
     * Sets mailHost
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
     * Gets password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Sets password
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
     * Gets folder
     *
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * Sets folder
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new CreateGalSyncAccountEnvelope(
            new CreateGalSyncAccountBody($this)
        );
    }
}
