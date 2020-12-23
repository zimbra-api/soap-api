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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\GalSearchType;
use Zimbra\Soap\Request;

/**
 * SearchGalRequest class
 * Search Accounts 
 * Note: SearchGalRequest is deprecated. See SearchDirectoryRequest.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="SearchGalRequest")
 */
class SearchGalRequest extends Request
{
    /**
     * Domain name
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("string")
     * @XmlAttribute
     */
    private $domain;

    /**
     * Name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * The maximum number of entries to return (0 is default and means all)
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $limit;

    /**
     * Type of addresses to search.
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\GalSearchType")
     * @XmlAttribute
     */
    private $type;

    /**
     * GAL account ID
     * @Accessor(getter="getGalAccountId", setter="setGalAccountId")
     * @SerializedName("galAcctId")
     * @Type("string")
     * @XmlAttribute
     */
    private $galAccountId;

    /**
     * Constructor method for SearchGalRequest
     * 
     * @param  string $domain
     * @param  string $name
     * @param  int $limit
     * @param  GalSearchType $type
     * @param  string $galAccountId
     * @return self
     */
    public function __construct(
        ?string $domain,
        ?string $name = NULL,
        ?int $limit = NULL,
        ?GalSearchType $type = NULL,
        ?string $galAccountId = NULL
    )
    {
        $this->setDomain($domain);
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
        if ($type instanceof GalSearchType) {
            $this->setType($type);
        }
        if (NULL !== $galAccountId) {
            $this->setGalAccountId($galAccountId);
        }
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
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets limit
     *
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Sets limit
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType(): ?GalSearchType
    {
        return $this->type;
    }

    /**
     * Sets type
     *
     * @param  GalSearchType $type
     * @return self
     */
    public function setType(GalSearchType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets galAccountId
     *
     * @return string
     */
    public function getGalAccountId(): ?string
    {
        return $this->galAccountId;
    }

    /**
     * Sets galAccountId
     *
     * @param  string $galAccountId
     * @return self
     */
    public function setGalAccountId(string $galAccountId): self
    {
        $this->galAccountId = $galAccountId;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof SearchGalEnvelope)) {
            $this->envelope = new SearchGalEnvelope(
                new SearchGalBody($this)
            );
        }
    }
}
