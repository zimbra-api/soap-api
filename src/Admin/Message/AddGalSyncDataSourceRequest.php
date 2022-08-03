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
use Zimbra\Common\Struct\AccountSelector as Account;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private Account $account;

    /**
     * Name of the data source
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Name of pre-existing domain
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
     * @Type("Enum<Zimbra\Common\Enum\GalMode>")
     * @XmlAttribute
     */
    private GalMode $type;

    /**
     * Contact folder name
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("folder")
     * @Type("string")
     * @XmlAttribute
     */
    private $folder;

    /**
     * Constructor method for AddGalSyncDataSourceRequest
     * 
     * @param Account $account
     * @param string  $name
     * @param string  $domain
     * @param GalMode  $type
     * @param string  $folder
     * @return self
     */
    public function __construct(
        Account $account,
        string $name = '',
        string $domain = '',
        ?GalMode $type = NULL,
        ?string $folder = NULL,
        array $attrs = []
    )
    {
        $this->setAccount($account)
             ->setName($name)
             ->setDomain($domain)
             ->setType($type ?? GalMode::BOTH());
        if (NULL !== $folder) {
            $this->setFolder($folder);
        }
        $this->setAttrs($attrs);
    }

    /**
     * Get the account.
     *
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * Set the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account): self
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
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AddGalSyncDataSourceEnvelope(
            new AddGalSyncDataSourceBody($this)
        );
    }
}
