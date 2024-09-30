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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\DistributionListMembershipInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetDistributionListMembershipResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDistributionListMembershipResponse extends SoapResponse
{
    /**
     * Information on distribution lists
     *
     * @var array
     */
    #[Accessor(getter: "getDls", setter: "setDls")]
    #[Type("array<Zimbra\Admin\Struct\DistributionListMembershipInfo>")]
    #[XmlList(inline: true, entry: "dl", namespace: "urn:zimbraAdmin")]
    private $dls = [];

    /**
     * Constructor
     *
     * @param array $dls
     * @return self
     */
    public function __construct(array $dls = [])
    {
        $this->setDls($dls);
    }

    /**
     * Set dls
     *
     * @param  array $dls
     * @return self
     */
    public function setDls(array $dls): self
    {
        $this->dls = array_filter(
            $dls,
            static fn($dl) => $dl instanceof DistributionListMembershipInfo
        );
        return $this;
    }

    /**
     * Get dls
     *
     * @return array
     */
    public function getDls(): array
    {
        return $this->dls;
    }
}
