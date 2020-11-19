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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Enum\GalMode;
use Zimbra\Soap\Request;
use Zimbra\Struct\AccountSelector as Account;

/**
 * AddGalSyncDataSource request class
 * Add a GalSync data source
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AddGalSyncDataSourceRequest")
 */
class AddGalSyncDataSourceRequest extends Request implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * The account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement
     */
    private $account;

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
     * @Type("Zimbra\Enum\GalMode")
     * @XmlAttribute
     */
    private $type;

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
        $name,
        $domain,
        GalMode $type,
        $folder = NULL,
        array $attrs = [])
    {
        $this->setAccount($account)
             ->setName($name)
             ->setDomain($domain)
             ->setType($type);
        if (NULL !== $folder) {
            $this->setFolder($folder);
        }
        $this->setAttrs($attrs);
    }

    /**
     * Gets the account.
     *
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * Sets the account.
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
     * Gets name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Gets domain
     *
     * @return string
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * Sets domain
     *
     * @param  string $domain
     * @return self
     */
    public function setDomain($domain): self
    {
        $this->domain = trim($domain);
        return $this;
    }

    /**
     * Gets type
     *
     * @return GalMode
     */
    public function getType(): GalMode
    {
        return $this->type;
    }

    /**
     * Sets type
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
    public function setFolder($folder): self
    {
        $this->folder = trim($folder);
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof AddGalSyncDataSourceEnvelope)) {
            $this->envelope = new AddGalSyncDataSourceEnvelope(
                new AddGalSyncDataSourceBody($this)
            );
        }
    }
}
