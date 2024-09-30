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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AutoCompleteGalRequest extends SoapRequest
{
    /**
     * The name to test for autocompletion
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * type of addresses to auto-complete on
     * - "account" for regular user accounts, aliases and distribution lists
     * - "resource" for calendar resources
     * - "group" for groups
     * - "all" for combination of all types
     * if omitted, defaults to "account"
     *
     * @var GalSearchType
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[XmlAttribute]
    private ?GalSearchType $type;

    /**
     * flag whether the {exp} flag is needed in the response for group entries.
     * default is 0 (false)
     *
     * @var bool
     */
    #[Accessor(getter: "getNeedCanExpand", setter: "setNeedCanExpand")]
    #[SerializedName("needExp")]
    #[Type("bool")]
    #[XmlAttribute]
    private $needCanExpand;

    /**
     * GAL Account ID
     *
     * @var string
     */
    #[Accessor(getter: "getGalAccountId", setter: "setGalAccountId")]
    #[SerializedName("galAcctId")]
    #[Type("string")]
    #[XmlAttribute]
    private $galAccountId;

    /**
     * An int specifying the maximum number of results to return
     *
     * @var int
     */
    #[Accessor(getter: "getLimit", setter: "setLimit")]
    #[SerializedName("limit")]
    #[Type("int")]
    #[XmlAttribute]
    private $limit;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  GalSearchType $type
     * @param  bool $needCanExpand
     * @param  string $galAccountId
     * @param  int $limit
     * @return self
     */
    public function __construct(
        string $name = "",
        ?GalSearchType $type = null,
        ?bool $needCanExpand = null,
        ?string $galAccountId = null,
        ?int $limit = null
    ) {
        $this->setName($name);
        $this->type = $type;
        if (null !== $needCanExpand) {
            $this->setNeedCanExpand($needCanExpand);
        }
        if (null !== $galAccountId) {
            $this->setGalAccountId($galAccountId);
        }
        if (null !== $limit) {
            $this->setLimit($limit);
        }
    }

    /**
     * Get the name to test for autocompletion
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name to test for autocompletion
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
     * Get type of addresses to auto-complete on
     *
     * @return GalSearchType
     */
    public function getType(): ?GalSearchType
    {
        return $this->type;
    }

    /**
     * Set type of addresses to auto-complete on
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
     * Get need can expand
     *
     * @return bool
     */
    public function getNeedCanExpand(): ?bool
    {
        return $this->needCanExpand;
    }

    /**
     * Set need can expand
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
     * Get the maximum number of results to return
     *
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Set the maximum number of results to return
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
        return new AutoCompleteGalEnvelope(new AutoCompleteGalBody($this));
    }
}
