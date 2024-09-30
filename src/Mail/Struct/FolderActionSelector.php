<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};

use Zimbra\Common\Enum\GranteeType;

/**
 * FolderActionSelector class
 * Input for folder actions
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FolderActionSelector extends ActionSelector
{
    /**
     * For op=empty - hard-delete all items in the folder (and all the folder's
     * subfolders if "recursive" is set)
     *
     * @Accessor(getter="getRecursive", setter="setRecursive")
     * @SerializedName("recursive")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getRecursive", setter: "setRecursive")]
    #[SerializedName("recursive")]
    #[Type("bool")]
    #[XmlAttribute]
    private $recursive;

    /**
     * Target URL
     *
     * @Accessor(getter="getUrl", setter="setUrl")
     * @SerializedName("url")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getUrl", setter: "setUrl")]
    #[SerializedName("url")]
    #[Type("string")]
    #[XmlAttribute]
    private $url;

    /**
     * For fb operation - set the excludeFreeBusy bool for this folder (must specify for fb operation)
     *
     * @Accessor(getter="getExcludeFreebusy", setter="setExcludeFreebusy")
     * @SerializedName("excludeFreeBusy")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getExcludeFreebusy", setter: "setExcludeFreebusy")]
    #[SerializedName("excludeFreeBusy")]
    #[Type("bool")]
    #[XmlAttribute]
    private $excludeFreeBusy;

    /**
     * Grantee Zimbra ID
     *
     * @Accessor(getter="getZimbraId", setter="setZimbraId")
     * @SerializedName("zid")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getZimbraId", setter: "setZimbraId")]
    #[SerializedName("zid")]
    #[Type("string")]
    #[XmlAttribute]
    private $zimbraId;

    /**
     * Grantee type
     *
     * @Accessor(getter="getGrantType", setter="setGrantType")
     * @SerializedName("gt")
     * @Type("Enum<Zimbra\Common\Enum\GranteeType>")
     * @XmlAttribute
     *
     * @var GranteeType
     */
    #[Accessor(getter: "getGrantType", setter: "setGrantType")]
    #[SerializedName("gt")]
    #[Type("Enum<Zimbra\Common\Enum\GranteeType>")]
    #[XmlAttribute]
    private ?GranteeType $grantType;

    /**
     * User with op=update to change folder's default view (usefor for migration)
     *
     * @Accessor(getter="getView", setter="setView")
     * @SerializedName("view")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getView", setter: "setView")]
    #[SerializedName("view")]
    #[Type("string")]
    #[XmlAttribute]
    private $view;

    /**
     * Grant
     *
     * @Accessor(getter="getGrant", setter="setGrant")
     * @SerializedName("grant")
     * @Type("Zimbra\Mail\Struct\ActionGrantSelector")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var ActionGrantSelector
     */
    #[Accessor(getter: "getGrant", setter: "setGrant")]
    #[SerializedName("grant")]
    #[Type(ActionGrantSelector::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?ActionGrantSelector $grant;

    /**
     * List of grants used with op=grant and op=!grant
     *
     * @Accessor(getter="getGrants", setter="setGrants")
     * @SerializedName("acl")
     * @Type("array<Zimbra\Mail\Struct\ActionGrantSelector>")
     * @XmlElement(namespace="urn:zimbraMail")
     * @XmlList(inline=false, entry="grant", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getGrants", setter: "setGrants")]
    #[SerializedName("acl")]
    #[Type("array<Zimbra\Mail\Struct\ActionGrantSelector>")]
    #[XmlElement(namespace: "urn:zimbraMail")]
    #[XmlList(inline: false, entry: "grant", namespace: "urn:zimbraMail")]
    private $grants = [];

    /**
     * Retention policy
     *
     * @Accessor(getter="getRetentionPolicy", setter="setRetentionPolicy")
     * @SerializedName("retentionPolicy")
     * @Type("Zimbra\Mail\Struct\RetentionPolicy")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var RetentionPolicy
     */
    #[Accessor(getter: "getRetentionPolicy", setter: "setRetentionPolicy")]
    #[SerializedName("retentionPolicy")]
    #[Type(RetentionPolicy::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?RetentionPolicy $retentionPolicy;

    /**
     * Number of days for which web client would sync folder data for offline use
     *
     * @Accessor(getter="getNumDays", setter="setNumDays")
     * @SerializedName("numDays")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getNumDays", setter: "setNumDays")]
    #[SerializedName("numDays")]
    #[Type("int")]
    #[XmlAttribute]
    private $numDays;

    /**
     * Constructor
     *
     * @param  string $operation
     * @param  string $ids
     * @param  bool $recursive
     * @param  string $url
     * @param  bool $excludeFreeBusy
     * @param  string $zimbraId
     * @param  GranteeType $grantType
     * @param  string $view
     * @param  ActionGrantSelector $grant
     * @param  array $grants
     * @param  RetentionPolicy $retentionPolicy
     * @param  int $numDays
     * @return self
     */
    public function __construct(
        string $operation = "",
        ?string $ids = null,
        ?bool $recursive = null,
        ?string $url = null,
        ?bool $excludeFreeBusy = null,
        ?string $zimbraId = null,
        ?GranteeType $grantType = null,
        ?string $view = null,
        ?ActionGrantSelector $grant = null,
        ?array $grants = [],
        ?RetentionPolicy $retentionPolicy = null,
        ?int $numDays = null
    ) {
        parent::__construct($operation, $ids);
        $this->setGrants($grants);
        $this->grantType = $grantType;
        $this->grant = $grant;
        $this->retentionPolicy = $retentionPolicy;
        if (null !== $recursive) {
            $this->setRecursive($recursive);
        }
        if (null !== $url) {
            $this->setUrl($url);
        }
        if (null !== $excludeFreeBusy) {
            $this->setExcludeFreebusy($excludeFreeBusy);
        }
        if (null !== $zimbraId) {
            $this->setZimbraId($zimbraId);
        }
        if (null !== $view) {
            $this->setView($view);
        }
        if (null !== $numDays) {
            $this->setNumDays($numDays);
        }
    }

    /**
     * Get recursive
     *
     * @return bool
     */
    public function getRecursive(): ?bool
    {
        return $this->recursive;
    }

    /**
     * Set recursive
     *
     * @param  bool $recursive
     * @return self
     */
    public function setRecursive(bool $recursive): self
    {
        $this->recursive = $recursive;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param  string $url
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get excludeFreeBusy
     *
     * @return bool
     */
    public function getExcludeFreebusy(): ?bool
    {
        return $this->excludeFreeBusy;
    }

    /**
     * Set excludeFreeBusy
     *
     * @param  bool $excludeFreeBusy
     * @return self
     */
    public function setExcludeFreebusy(bool $excludeFreeBusy): self
    {
        $this->excludeFreeBusy = $excludeFreeBusy;
        return $this;
    }

    /**
     * Get zimbraId
     *
     * @return string
     */
    public function getZimbraId(): ?string
    {
        return $this->zimbraId;
    }

    /**
     * Set zimbraId
     *
     * @param  string $zimbraId
     * @return self
     */
    public function setZimbraId(string $zimbraId): self
    {
        $this->zimbraId = $zimbraId;
        return $this;
    }

    /**
     * Get grantType
     *
     * @return GranteeType
     */
    public function getGrantType(): ?GranteeType
    {
        return $this->grantType;
    }

    /**
     * Set grantType
     *
     * @param  GranteeType $grantType
     * @return self
     */
    public function setGrantType(GranteeType $grantType): self
    {
        $this->grantType = $grantType;
        return $this;
    }

    /**
     * Get view
     *
     * @return string
     */
    public function getView(): ?string
    {
        return $this->view;
    }

    /**
     * Set view
     *
     * @param  string $view
     * @return self
     */
    public function setView(string $view): self
    {
        $this->view = $view;
        return $this;
    }

    /**
     * Get grant
     *
     * @return ActionGrantSelector
     */
    public function getGrant(): ?ActionGrantSelector
    {
        return $this->grant;
    }

    /**
     * Set grant
     *
     * @param  ActionGrantSelector $grant
     * @return self
     */
    public function setGrant(ActionGrantSelector $grant): self
    {
        $this->grant = $grant;
        return $this;
    }

    /**
     * Get grants.
     *
     * @return array
     */
    public function getGrants(): array
    {
        return $this->grants;
    }

    /**
     * Set grants.
     *
     * @param  array $grants
     * @return self
     */
    public function setGrants(array $grants): self
    {
        $this->grants = array_filter(
            $grants,
            static fn($grant) => $grant instanceof ActionGrantSelector
        );
        return $this;
    }

    /**
     * Add grant
     *
     * @param  ActionGrantSelector $grant
     * @return self
     */
    public function addGrant(ActionGrantSelector $grant): self
    {
        $this->grants[] = $grant;
        return $this;
    }

    /**
     * Get retention policy
     *
     * @return RetentionPolicy
     */
    public function getRetentionPolicy(): ?RetentionPolicy
    {
        return $this->retentionPolicy;
    }

    /**
     * Set retention policy
     *
     * @param  RetentionPolicy $retentionPolicy
     * @return self
     */
    public function setRetentionPolicy(RetentionPolicy $retentionPolicy): self
    {
        $this->retentionPolicy = $retentionPolicy;
        return $this;
    }

    /**
     * Get num days
     *
     * @return int
     */
    public function getNumDays(): ?int
    {
        return $this->numDays;
    }

    /**
     * Set num days
     *
     * @param  int $numDays
     * @return self
     */
    public function setNumDays(int $numDays): self
    {
        $this->numDays = $numDays;
        return $this;
    }
}
