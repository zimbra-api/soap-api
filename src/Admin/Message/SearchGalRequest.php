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
 * SearchGalRequest class
 * Search Global Address Book (GAL)
 * Notes: admin verison of mail equiv. Used for testing via zmprov.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchGalRequest extends SoapRequest
{
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
     * Name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * The maximum number of entries to return (0 is default and means all)
     * 
     * @var int
     */
    #[Accessor(getter: 'getLimit', setter: 'setLimit')]
    #[SerializedName('limit')]
    #[Type('int')]
    #[XmlAttribute]
    private $limit;

    /**
     * Type of addresses to search.
     * 
     * @var GalSearchType
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName('type')]
    #[XmlAttribute]
    private ?GalSearchType $type;

    /**
     * GAL account ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getGalAccountId', setter: 'setGalAccountId')]
    #[SerializedName('galAcctId')]
    #[Type('string')]
    #[XmlAttribute]
    private $galAccountId;

    /**
     * Constructor
     * 
     * @param  string $domain
     * @param  string $name
     * @param  int $limit
     * @param  GalSearchType $type
     * @param  string $galAccountId
     * @return self
     */
    public function __construct(
        string $domain = '',
        ?string $name = null,
        ?int $limit = null,
        ?GalSearchType $type = null,
        ?string $galAccountId = null
    )
    {
        $this->setDomain($domain);
        $this->type = $type;
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $limit) {
            $this->setLimit($limit);
        }
        if (null !== $galAccountId) {
            $this->setGalAccountId($galAccountId);
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
    public function getName(): ?string
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
     * Get galAccountId
     *
     * @return string
     */
    public function getGalAccountId(): ?string
    {
        return $this->galAccountId;
    }

    /**
     * Set galAccountId
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SearchGalEnvelope(
            new SearchGalBody($this)
        );
    }
}
