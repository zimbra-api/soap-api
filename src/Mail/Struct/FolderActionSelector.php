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
    Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList
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
     * @var bool
     */
    #[Accessor(getter: 'getRecursive', setter: 'setRecursive')]
    #[SerializedName(name: 'recursive')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $recursive;

    /**
     * Target URL
     * 
     * @var string
     */
    #[Accessor(getter: 'getUrl', setter: 'setUrl')]
    #[SerializedName(name: 'url')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $url;

    /**
     * For fb operation - set the excludeFreeBusy bool for this folder (must specify for fb operation)
     * 
     * @var bool
     */
    #[Accessor(getter: 'getExcludeFreebusy', setter: 'setExcludeFreebusy')]
    #[SerializedName(name: 'excludeFreeBusy')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $excludeFreeBusy;

    /**
     * Grantee Zimbra ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getZimbraId', setter: 'setZimbraId')]
    #[SerializedName(name: 'zid')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $zimbraId;

    /**
     * Grantee type
     * 
     * @var GranteeType
     */
    #[Accessor(getter: 'getGrantType', setter: 'setGrantType')]
    #[SerializedName(name: 'gt')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\GranteeType>')]
    #[XmlAttribute]
    private $grantType;

    /**
     * User with op=update to change folder's default view (usefor for migration)
     * 
     * @var string
     */
    #[Accessor(getter: 'getView', setter: 'setView')]
    #[SerializedName(name: 'view')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $view;

    /**
     * Grant
     * 
     * @var ActionGrantSelector
     */
    #[Accessor(getter: "getGrant", setter: "setGrant")]
    #[SerializedName(name: 'grant')]
    #[Type(name: ActionGrantSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $grant;

    /**
     * List of grants used with op=grant and op=!grant
     * 
     * @var array
     */
    #[Accessor(getter: 'getGrants', setter: 'setGrants')]
    #[SerializedName(name: 'acl')]
    #[Type(name: 'array<Zimbra\Mail\Struct\ActionGrantSelector>')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    #[XmlList(inline: false, entry: 'grant', namespace: 'urn:zimbraMail')]
    private $grants = [];

    /**
     * Retention policy
     * 
     * @var RetentionPolicy
     */
    #[Accessor(getter: "getRetentionPolicy", setter: "setRetentionPolicy")]
    #[SerializedName(name: 'retentionPolicy')]
    #[Type(name: RetentionPolicy::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $retentionPolicy;

    /**
     * Number of days for which web client would sync folder data for offline use
     * 
     * @var int
     */
    #[Accessor(getter: 'getNumDays', setter: 'setNumDays')]
    #[SerializedName(name: 'numDays')]
    #[Type(name: 'int')]
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
        string $operation = '',
        ?string $ids = NULL,
        ?bool $recursive = NULL,
        ?string $url = NULL,
        ?bool $excludeFreeBusy = NULL,
        ?string $zimbraId = NULL,
        ?GranteeType $grantType = NULL,
        ?string $view = NULL,
        ?ActionGrantSelector $grant = NULL,
        ?array $grants = [],
        ?RetentionPolicy $retentionPolicy = NULL,
        ?int $numDays = NULL
    )
    {
        parent::__construct($operation, $ids);
        $this->setGrants($grants);
        if (NULL !== $recursive) {
            $this->setRecursive($recursive);
        }
        if (NULL !== $url) {
            $this->setUrl($url);
        }
        if (NULL !== $excludeFreeBusy) {
            $this->setExcludeFreebusy($excludeFreeBusy);
        }
        if (NULL !== $zimbraId) {
            $this->setZimbraId($zimbraId);
        }
        if ($grantType instanceof GranteeType) {
            $this->setGrantType($grantType);
        }
        if (NULL !== $view) {
            $this->setView($view);
        }
        if ($grant instanceof ActionGrantSelector) {
            $this->setGrant($grant);
        }
        if ($retentionPolicy instanceof RetentionPolicy) {
            $this->setRetentionPolicy($retentionPolicy);
        }
        if (NULL !== $numDays) {
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
        $this->grants = array_filter($grants, static fn ($grant) => $grant instanceof ActionGrantSelector);
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
