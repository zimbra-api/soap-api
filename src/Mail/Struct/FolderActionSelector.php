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

/**
 * FolderActionSelector class
 * Input for folder actions
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FolderActionSelector extends ActionSelector
{
    /**
     * For op=empty - hard-delete all items in the folder (and all the folder's
     * @Accessor(getter="getRecursive", setter="setRecursive")
     * @SerializedName("recursive")
     * @Type("bool")
     * @XmlAttribute
     */
    private $recursive;

    /**
     * Target URL
     * @Accessor(getter="getUrl", setter="setUrl")
     * @SerializedName("url")
     * @Type("string")
     * @XmlAttribute
     */
    private $url;

    /**
     * For fb operation - set the excludeFreeBusy boolean for this folder (must specify for fb operation)
     * @Accessor(getter="getExcludeFreebusy", setter="setExcludeFreebusy")
     * @SerializedName("excludeFreeBusy")
     * @Type("bool")
     * @XmlAttribute
     */
    private $excludeFreebusy;

    /**
     * Grantee Zimbra ID
     * @Accessor(getter="getZimbraId", setter="setZimbraId")
     * @SerializedName("zid")
     * @Type("string")
     * @XmlAttribute
     */
    private $zimbraId;

    /**
     * Grantee type
     * @Accessor(getter="getGrantType", setter="setGrantType")
     * @SerializedName("gt")
     * @Type("string")
     * @XmlAttribute
     */
    private $grantType;

    /**
     * User with op=update to change folder's default view (usefor for migration)
     * @Accessor(getter="getView", setter="setView")
     * @SerializedName("view")
     * @Type("string")
     * @XmlAttribute
     */
    private $view;

    /**
     * Grant
     * @Accessor(getter="getGrant", setter="setGrant")
     * @SerializedName("grant")
     * @Type("Zimbra\Mail\Struct\ActionGrantSelector")
     * @XmlElement
     */
    private ?ActionGrantSelector $grant = NULL;

    /**
     * List of grants used with op=grant and op=!grant
     * 
     * @Accessor(getter="getGrants", setter="setGrants")
     * @SerializedName("acl")
     * @Type("array<Zimbra\Mail\Struct\ActionGrantSelector>")
     * @XmlList(inline = false, entry = "grant")
     */
    private $grants = [];

    /**
     * Retention policy
     * @Accessor(getter="getRetentionPolicy", setter="setRetentionPolicy")
     * @SerializedName("retentionPolicy")
     * @Type("Zimbra\Mail\Struct\RetentionPolicy")
     * @XmlElement
     */
    private ?RetentionPolicy $retentionPolicy = NULL;

    /**
     * Number of days for which web client would sync folder data for offline use
     * @Accessor(getter="getNumDays", setter="setNumDays")
     * @SerializedName("numDays")
     * @Type("integer")
     * @XmlAttribute
     */
    private $numDays;

    /**
     * Constructor method for FolderActionSelector
     *
     * @param  string $operation
     * @param  string $ids
     * @param  bool $recursive
     * @param  string $url
     * @param  bool $excludeFreebusy
     * @param  string $zimbraId
     * @param  string $grantType
     * @param  string $view
     * @param  ActionGrantSelector $grant
     * @param  array $grants
     * @param  RetentionPolicy $retentionPolicy
     * @param  int $numDays
     * @return self
     */
    public function __construct(
        string $operation,
        ?string $ids = NULL,
        ?bool $recursive = NULL,
        ?string $url = NULL,
        ?bool $excludeFreebusy = NULL,
        ?string $zimbraId = NULL,
        ?string $grantType = NULL,
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
        if (NULL !== $excludeFreebusy) {
            $this->setExcludeFreebusy($excludeFreebusy);
        }
        if (NULL !== $zimbraId) {
            $this->setZimbraId($zimbraId);
        }
        if (NULL !== $grantType) {
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
     * Gets recursive
     *
     * @return bool
     */
    public function getRecursive(): ?bool
    {
        return $this->recursive;
    }

    /**
     * Sets recursive
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
     * Gets url
     *
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Sets url
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
     * Gets excludeFreebusy
     *
     * @return bool
     */
    public function getExcludeFreebusy(): ?bool
    {
        return $this->excludeFreebusy;
    }

    /**
     * Sets excludeFreebusy
     *
     * @param  bool $excludeFreebusy
     * @return self
     */
    public function setExcludeFreebusy(bool $excludeFreebusy): self
    {
        $this->excludeFreebusy = $excludeFreebusy;
        return $this;
    }

    /**
     * Gets zimbraId
     *
     * @return string
     */
    public function getZimbraId(): ?string
    {
        return $this->zimbraId;
    }

    /**
     * Sets zimbraId
     *
     * @param  string $id
     * @return self
     */
    public function setZimbraId(string $zimbraId): self
    {
        $this->zimbraId = $zimbraId;
        return $this;
    }

    /**
     * Gets grantType
     *
     * @return string
     */
    public function getGrantType(): ?string
    {
        return $this->grantType;
    }

    /**
     * Sets grantType
     *
     * @param  string $grantType
     * @return self
     */
    public function setGrantType(string $grantType): self
    {
        $this->grantType = $grantType;
        return $this;
    }

    /**
     * Gets view
     *
     * @return string
     */
    public function getView(): ?string
    {
        return $this->view;
    }

    /**
     * Sets view
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
     * Gets grant
     *
     * @return ActionGrantSelector
     */
    public function getGrant(): ?ActionGrantSelector
    {
        return $this->grant;
    }

    /**
     * Sets grant
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
     * Gets grants.
     *
     * @return array
     */
    public function getGrants(): array
    {
        return $this->grants;
    }

    /**
     * Sets grants.
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
     * Gets retention policy
     *
     * @return RetentionPolicy
     */
    public function getRetentionPolicy(): ?RetentionPolicy
    {
        return $this->retentionPolicy;
    }

    /**
     * Sets retention policy
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
     * Gets num days
     *
     * @return int
     */
    public function getNumDays(): ?int
    {
        return $this->numDays;
    }

    /**
     * Sets num days
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
