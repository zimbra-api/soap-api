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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetDistributionListResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetDistributionListResponse")
 */
class GetDistributionListResponse implements ResponseInterface
{
    /**
     * 1 (true) if more mailboxes left to return
     * Only present if the list of members is given
     * @Accessor(getter="isMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * Total number of members (not affected by limit/total)
     * Only present if the list of members is given
     * @Accessor(getter="getTotal", setter="setTotal")
     * @SerializedName("total")
     * @Type("integer")
     * @XmlAttribute
     */
    private $total;

    /**
     * Information about distribution list
     * @Accessor(getter="getDl", setter="setDl")
     * @SerializedName("dl")
     * @Type("Zimbra\Admin\Struct\DistributionListInfo")
     * @XmlElement
     */
    private $dl;

    /**
     * Constructor method for GetDistributionListResponse
     *
     * @param DistributionListInfo $dl
     * @param bool $more
     * @param int $total
     * @return self
     */
    public function __construct(?DistributionListInfo $dl = NULL, ?bool $more = NULL, ?int $total = NULL)
    {
        if ($dl instanceof DistributionListInfo) {
            $this->setDl($dl);
        }
        if (NULL !== $more) {
            $this->setMore($more);
        }
        if (NULL !== $total) {
            $this->setTotal($total);
        }
    }

    /**
     * Gets more
     *
     * @return bool
     */
    public function isMore(): ?bool
    {
        return $this->more;
    }

    /**
     * Sets more
     *
     * @param  bool $more
     * @return self
     */
    public function setMore(bool $more): self
    {
        $this->more = $more;
        return $this;
    }

    /**
     * Gets total
     *
     * @return int
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * Sets total
     *
     * @param  int $total
     * @return self
     */
    public function setTotal(int $total): self
    {
        $this->total = $total;
        return $this;
    }

    /**
     * Gets the dl.
     *
     * @return DistributionListInfo
     */
    public function getDl(): ?DistributionListInfo
    {
        return $this->dl;
    }

    /**
     * Sets the dl.
     *
     * @param  DistributionListInfo $dl
     * @return self
     */
    public function setDl(DistributionListInfo $dl): self
    {
        $this->dl = $dl;
        return $this;
    }
}
