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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\GalSearchType;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * AutoCompleteGalRequest class
 * Perform an autocomplete for a name against the Global Address List
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AutoCompleteGalRequest extends SoapRequest
{
    /**
     * domain
     * 
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("string")
     * @XmlAttribute()
     */
    private $domain;

    /**
     * The name to test for autocompletion
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute()
     */
    private $name;

    /**
     * Type of addresses to auto-complete on
     * 
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\GalSearchType>")
     * @XmlAttribute()
     */
    private ?GalSearchType $type = NULL;

    /**
     * GAL Account ID
     * 
     * @Accessor(getter="getGalAccountId", setter="setGalAccountId")
     * @SerializedName("galAcctId")
     * @Type("string")
     * @XmlAttribute()
     */
    private $galAccountId;

    /**
     * An integer specifying the maximum number of results to return
     * 
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("int")
     * @XmlAttribute()
     */
    private $limit;

    /**
     * Constructor
     * 
     * @param string  $domain
     * @param string  $name
     * @param GalSearchType  $type
     * @param string  $galAccountId
     * @param int     $limit
     * @return self
     */
    public function __construct(
        string $domain = '',
        string $name = '',
        ?GalSearchType $type = NULL,
        ?string $galAccountId = NULL,
        ?int $limit = NULL
    )
    {
        $this->setDomain($domain)
             ->setName($name);
        if (NULL !== $type) {
            $this->setType($type);
        }
        if (NULL !== $galAccountId) {
            $this->setGalAccountId($galAccountId);
        }
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
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
     * Get type
     *
     * @return GalSearchType
     */
    public function getType(): ?GalSearchType
    {
        return $this->type;
    }

    /**
     * Set type
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
     * Get GAL Account ID
     *
     * @return string
     */
    public function getGalAccountId(): ?string
    {
        return $this->galAccountId;
    }

    /**
     * Set GAL Account ID
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
     * Get limit
     *
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Set limit
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AutoCompleteGalEnvelope(
            new AutoCompleteGalBody($this)
        );
    }
}
