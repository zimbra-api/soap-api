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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\DistributionListSelector as DistributionList;
use Zimbra\Struct\{AttributeSelector, AttributeSelectorTrait};
use Zimbra\Soap\Request;

/**
 * GetDistributionListRequest class
 * Get a Distribution List
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetDistributionListRequest extends Request implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * The maximum number of accounts to return (0 is default and means all)
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $limit;

    /**
     * The starting offset (0, 25 etc)
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("integer")
     * @XmlAttribute
     */
    private $offset;

    /**
     * Flag whether to sort in ascending order 1 (true) is the default
     * @Accessor(getter="isSortAscending", setter="setSortAscending")
     * @SerializedName("sortAscending")
     * @Type("bool")
     * @XmlAttribute
     */
    private $sortAscending;

    /**
     * Distribution List
     * @Accessor(getter="getDl", setter="setDl")
     * @SerializedName("dl")
     * @Type("Zimbra\Admin\Struct\DistributionListSelector")
     * @XmlElement
     */
    private $dl;

    /**
     * Constructor method for GetDistributionListRequest
     * 
     * @param  DistributionList $dl
     * @param  int $limit
     * @param  int $offset
     * @param  bool $sortAscending
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        ?DistributionList $dl = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?bool $sortAscending = NULL,
        ?string $attrs = NULL
    )
    {
        if ($dl instanceof DistributionList) {
            $this->setDl($dl);
        }
        if (NULL !== $limit) {
            $this->setLimit($limit);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
        if (NULL !== $sortAscending) {
            $this->setSortAscending($sortAscending);
        }
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
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
     * Gets offset
     *
     * @return int
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * Sets offset
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
     * Gets sortAscending
     *
     * @return bool
     */
    public function isSortAscending(): ?bool
    {
        return $this->sortAscending;
    }

    /**
     * Sets sortAscending
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
     * Gets the dl.
     *
     * @return DistributionListSelector
     */
    public function getDl(): ?DistributionList
    {
        return $this->dl;
    }

    /**
     * Sets the dl.
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetDistributionListEnvelope)) {
            $this->envelope = new GetDistributionListEnvelope(
                new GetDistributionListBody($this)
            );
        }
    }
}
