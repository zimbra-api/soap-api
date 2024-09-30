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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Account\Struct\DistributionListInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetDistributionListResponse class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDistributionListResponse extends SoapResponse
{
    /**
     * Information about distribution list
     *
     * @var DistributionListInfo
     */
    #[Accessor(getter: "getDl", setter: "setDl")]
    #[SerializedName("dl")]
    #[Type(DistributionListInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private ?DistributionListInfo $dl;

    /**
     * Constructor
     *
     * @param DistributionListInfo $dl
     * @return self
     */
    public function __construct(?DistributionListInfo $dl = null)
    {
        $this->dl = $dl;
    }

    /**
     * Get the dl.
     *
     * @return DistributionListInfo
     */
    public function getDl(): ?DistributionListInfo
    {
        return $this->dl;
    }

    /**
     * Set the dl.
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
