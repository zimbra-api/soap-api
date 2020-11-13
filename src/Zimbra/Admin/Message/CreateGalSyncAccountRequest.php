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
use Zimbra\Soap\Request;

/**
 * CreateGalSyncAccountRequest class
 * Create Global Address List (GAL) Synchronisation account
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateGalSyncAccountRequest")
 */
class CreateGalSyncAccountRequest extends Request implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Name of the data source.
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute()
     */
    private $name;

    /**
     * Domain name
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("string")
     * @XmlAttribute()
     */
    private $domain;

    /**
     * GalMode type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("GalMode")
     * @XmlAttribute()
     */
    private $type;

    /**
     * Account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("AccountSelector")
     * @XmlElement()
     */
    private $account;

    /**
     * password
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlAttribute()
     */
    private $password;

    /**
     * Contact folder name
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("folder")
     * @Type("string")
     * @XmlAttribute()
     */
    private $folder;

    /**
     * The mailhost on which this account resides
     * @Accessor(getter="getMailHost", setter="setMailHost")
     * @SerializedName("server")
     * @Type("string")
     * @XmlAttribute()
     */
    private $mailHost;

    /**
     * Constructor method for CreateGalSyncAccountRequest
     * @param string  $name
     * @param string  $domain
     * @param string  $mailHost
     * @param GalMode  $type
     * @param AccountSelector  $account
     * @param string  $password
     * @param string  $folder
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        $name,
        $domain,
        $mailHost,
        GalMode $type,
        AccountSelector $account,
        $password = NULL,
        $folder = NULL,
        array $attrs = []
    )
    {
        $this->setName($name)
             ->setAttrs($attrs);
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
    public function setDomain($domain): self
    {
        $this->domain = trim($domain);
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
    public function setMailHost($mailHost): self
    {
        $this->mailHost = trim($mailHost);
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new CreateGalSyncAccountEnvelope(
            NULL,
            new CreateGalSyncAccountBody($this)
        );
    }
}
