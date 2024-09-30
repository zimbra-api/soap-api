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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Admin\Struct\DistributionListSelector as DistributionList;
use Zimbra\Common\Struct\{
    AttributeSelector,
    AttributeSelectorTrait,
    SoapEnvelopeInterface,
    SoapRequest
};

/**
 * GetDistributionListRequest class
 * Get a Distribution List
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDistributionListRequest extends SoapRequest implements
    AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * The maximum number of accounts to return (0 is default and means all)
     *
     * @var int
     */
    #[Accessor(getter: "getLimit", setter: "setLimit")]
    #[SerializedName("limit")]
    #[Type("int")]
    #[XmlAttribute]
    private $limit;

    /**
     * The starting offset (0, 25 etc)
     *
     * @var int
     */
    #[Accessor(getter: "getOffset", setter: "setOffset")]
    #[SerializedName("offset")]
    #[Type("int")]
    #[XmlAttribute]
    private $offset;

    /**
     * Flag whether to sort in ascending order 1 (true) is the default
     *
     * @var bool
     */
    #[Accessor(getter: "isSortAscending", setter: "setSortAscending")]
    #[SerializedName("sortAscending")]
    #[Type("bool")]
    #[XmlAttribute]
    private $sortAscending;

    /**
     * Distribution List
     *
     * @var DistributionList
     */
    #[Accessor(getter: "getDl", setter: "setDl")]
    #[SerializedName("dl")]
    #[Type(DistributionList::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?DistributionList $dl;

    /**
     * Constructor
     *
     * @param  DistributionList $dl
     * @param  int $limit
     * @param  int $offset
     * @param  bool $sortAscending
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        ?DistributionList $dl = null,
        ?int $limit = null,
        ?int $offset = null,
        ?bool $sortAscending = null,
        ?string $attrs = null
    ) {
        $this->dl = $dl;
        if (null !== $limit) {
            $this->setLimit($limit);
        }
        if (null !== $offset) {
            $this->setOffset($offset);
        }
        if (null !== $sortAscending) {
            $this->setSortAscending($sortAscending);
        }
        if (null !== $attrs) {
            $this->setAttrs($attrs);
        }
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
     * Get offset
     *
     * @return int
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * Set offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Get sortAscending
     *
     * @return bool
     */
    public function isSortAscending(): ?bool
    {
        return $this->sortAscending;
    }

    /**
     * Set sortAscending
     *
     * @param  bool $sortAscending
     * @return self
     */
    public function setSortAscending(bool $sortAscending): self
    {
        $this->sortAscending = $sortAscending;
        return $this;
    }

    /**
     * Get the dl.
     *
     * @return DistributionList
     */
    public function getDl(): ?DistributionList
    {
        return $this->dl;
    }

    /**
     * Set the dl.
     *
     * @param  DistributionList $dl
     * @return self
     */
    public function setDl(DistributionList $dl): self
    {
        $this->dl = $dl;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetDistributionListEnvelope(
            new GetDistributionListBody($this)
        );
    }
}
