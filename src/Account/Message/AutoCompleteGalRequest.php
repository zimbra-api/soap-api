<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\GalSearchType;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * AutoCompleteGalRequest class
 * Perform an autocomplete for a name against the Global Address List
 * The number of entries in the response is limited by Account/COS attribute zimbraContactAutoCompleteMaxResults with
 * default value of 20.
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AutoCompleteGalRequest extends Request
{
    /**
     * The name to test for autocompletion
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * type of addresses to auto-complete on
     * - "account" for regular user accounts, aliases and distribution lists 
     * - "resource" for calendar resources 
     * - "group" for groups 
     * - "all" for combination of all types 
     * if omitted, defaults to "account"
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\GalSearchType")
     * @XmlAttribute
     */
    private ?GalSearchType $type = NULL;

    /**
     * flag whether the {exp} flag is needed in the response for group entries.
     * default is 0 (false)
     * @Accessor(getter="getNeedCanExpand", setter="setNeedCanExpand")
     * @SerializedName("needExp")
     * @Type("bool")
     * @XmlAttribute
     */
    private $needCanExpand;

    /**
     * GAL Account ID
     * @Accessor(getter="getGalAccountId", setter="setGalAccountId")
     * @SerializedName("galAcctId")
     * @Type("string")
     * @XmlAttribute
     */
    private $galAccountId;

    /**
     * An integer specifying the maximum number of results to return
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $limit;

    /**
     * Constructor method for AutoCompleteGal
     *
     * @param  string $name
     * @param  GalSearchType $type
     * @param  bool $needCanExpand
     * @param  string $galAccountId
     * @param  int $limit
     * @return self
     */
    public function __construct(
        string $name = '',
        ?GalSearchType $type = NULL,
        ?bool $needCanExpand = NULL,
        ?string $galAccountId = NULL,
        ?int $limit = NULL
    )
    {
        $this->setName($name);
        if(NULL !== $type) {
            $this->setType($type);
        }
        if(NULL !== $needCanExpand) {
            $this->setNeedCanExpand($needCanExpand);
        }
        if(NULL !== $galAccountId) {
            $this->setGalAccountId($galAccountId);
        }
        if(NULL !== $limit) {
            $this->setLimit($limit);
        }
    }

    /**
     * Gets the name to test for autocompletion
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name to test for autocompletion
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
     * Gets type of addresses to auto-complete on
     *
     * @return GalSearchType
     */
    public function getType(): ?GalSearchType
    {
        return $this->type;
    }

    /**
     * Sets type of addresses to auto-complete on
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
     * Gets need can expand
     *
     * @return bool
     */
    public function getNeedCanExpand(): ?bool
    {
        return $this->needCanExpand;
    }

    /**
     * Sets need can expand
     *
     * @param  bool $needCanExpand
     * @return self
     */
    public function setNeedCanExpand(bool $needCanExpand): self
    {
        $this->needCanExpand = $needCanExpand;
        return $this;
    }

    /**
     * Gets GAL Account ID
     *
     * @return string
     */
    public function getGalAccountId(): ?string
    {
        return $this->galAccountId;
    }

    /**
     * Sets GAL Account ID
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
     * Gets the maximum number of results to return
     *
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Sets the maximum number of results to return
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new AutoCompleteGalEnvelope(
            new AutoCompleteGalBody($this)
        );
    }
}
