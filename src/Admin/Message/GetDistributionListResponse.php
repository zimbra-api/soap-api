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
use Zimbra\Admin\Struct\DistributionListInfo as DLInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetDistributionListResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDistributionListResponse extends SoapResponse
{
    /**
     * 1 (true) if more mailboxes left to return
     * Only present if the list of members is given
     * 
     * @Accessor(getter="isMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'isMore', setter: 'setMore')]
    #[SerializedName('more')]
    #[Type('bool')]
    #[XmlAttribute]
    private $more;

    /**
     * Total number of members (not affected by limit/total)
     * Only present if the list of members is given
     * 
     * @Accessor(getter="getTotal", setter="setTotal")
     * @SerializedName("total")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getTotal', setter: 'setTotal')]
    #[SerializedName('total')]
    #[Type('int')]
    #[XmlAttribute]
    private $total;

    /**
     * Information about distribution list
     * 
     * @Accessor(getter="getDl", setter="setDl")
     * @SerializedName("dl")
     * @Type("Zimbra\Admin\Struct\DistributionListInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var DLInfo
     */
    #[Accessor(getter: 'getDl', setter: 'setDl')]
    #[SerializedName('dl')]
    #[Type(DLInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?DLInfo $dl;

    /**
     * Constructor
     *
     * @param DLInfo $dl
     * @param bool $more
     * @param int $total
     * @return self
     */
    public function __construct(?DLInfo $dl = NULL, ?bool $more = NULL, ?int $total = NULL)
    {
        $this->dl = $dl;
        if (NULL !== $more) {
            $this->setMore($more);
        }
        if (NULL !== $total) {
            $this->setTotal($total);
        }
    }

    /**
     * Get more
     *
     * @return bool
     */
    public function isMore(): ?bool
    {
        return $this->more;
    }

    /**
     * Set more
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
     * Get total
     *
     * @return int
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * Set total
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
     * Get the dl.
     *
     * @return DLInfo
     */
    public function getDl(): ?DLInfo
    {
        return $this->dl;
    }

    /**
     * Set the dl.
     *
     * @param  DLInfo $dl
     * @return self
     */
    public function setDl(DLInfo $dl): self
    {
        $this->dl = $dl;
        return $this;
    }
}
