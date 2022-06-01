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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\DistributionListMembershipInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetDistributionListMembershipResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetDistributionListMembershipResponse implements ResponseInterface
{
    /**
     * Information on distribution lists
     * 
     * @Accessor(getter="getDls", setter="setDls")
     * @SerializedName("dl")
     * @Type("array<Zimbra\Admin\Struct\DistributionListMembershipInfo>")
     * @XmlList(inline = true, entry = "dl")
     */
    private $dls = [];

    /**
     * Constructor method for GetDistributionListMembershipResponse
     *
     * @param array $dls
     * @return self
     */
    public function __construct(array $dls = [])
    {
        $this->setDls($dls);
    }

    /**
     * Add dl
     *
     * @param  DistributionListMembershipInfo $dl
     * @return self
     */
    public function addDl(DistributionListMembershipInfo $dl): self
    {
        $this->dls[] = $dl;
        return $this;
    }

    /**
     * Sets dls
     *
     * @param  array $dls
     * @return self
     */
    public function setDls(array $dls): self
    {
        $this->dls = [];
        foreach ($dls as $dl) {
            if ($dl instanceof DistributionListMembershipInfo) {
                $this->dls[] = $dl;
            }
        }
        return $this;
    }

    /**
     * Gets dls
     *
     * @return array
     */
    public function getDls(): array
    {
        return $this->dls;
    }
}
