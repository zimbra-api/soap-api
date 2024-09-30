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
use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllAlwaysOnClustersResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllAlwaysOnClustersResponse extends SoapResponse
{
    /**
     * Information about alwaysOnClusters
     *
     * @Accessor(getter="getAlwaysOnClusterList", setter="setAlwaysOnClusterList")
     * @Type("array<Zimbra\Admin\Struct\AlwaysOnClusterInfo>")
     * @XmlList(inline=true, entry="alwaysOnCluster", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[
        Accessor(
            getter: "getAlwaysOnClusterList",
            setter: "setAlwaysOnClusterList"
        )
    ]
    #[Type("array<Zimbra\Admin\Struct\AlwaysOnClusterInfo>")]
    #[
        XmlList(
            inline: true,
            entry: "alwaysOnCluster",
            namespace: "urn:zimbraAdmin"
        )
    ]
    private $clusterList = [];

    /**
     * Constructor
     *
     * @param array $clusterList
     * @return self
     */
    public function __construct(array $clusterList = [])
    {
        $this->setAlwaysOnClusterList($clusterList);
    }

    /**
     * Set alwaysOnClusters
     *
     * @param  array $list
     * @return self
     */
    public function setAlwaysOnClusterList(array $list): self
    {
        $this->clusterList = array_filter(
            $list,
            static fn($item) => $item instanceof AlwaysOnClusterInfo
        );
        return $this;
    }

    /**
     * Get alwaysOnClusters
     *
     * @return array
     */
    public function getAlwaysOnClusterList(): array
    {
        return $this->clusterList;
    }
}
