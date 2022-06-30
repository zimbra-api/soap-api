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
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllAlwaysOnClustersResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllAlwaysOnClustersResponse implements ResponseInterface
{
    /**
     * Information about alwaysOnClusters
     * 
     * @Accessor(getter="getAlwaysOnClusterList", setter="setAlwaysOnClusterList")
     * @Type("array<Zimbra\Admin\Struct\AlwaysOnClusterInfo>")
     * @XmlList(inline=true, entry="alwaysOnCluster", namespace="urn:zimbraAdmin")
     */
    private $clusterList = [];

    /**
     * Constructor method for GetAllAlwaysOnClustersResponse
     *
     * @param array $clusterList
     * @return self
     */
    public function __construct(array $clusterList = [])
    {
        $this->setAlwaysOnClusterList($clusterList);
    }

    /**
     * Add alwaysOnCluster
     *
     * @param  AlwaysOnClusterInfo $alwaysOnCluster
     * @return self
     */
    public function addAlwaysOnCluster(AlwaysOnClusterInfo $alwaysOnCluster): self
    {
        $this->clusterList[] = $alwaysOnCluster;
        return $this;
    }

    /**
     * Sets alwaysOnClusters
     *
     * @param  array $list
     * @return self
     */
    public function setAlwaysOnClusterList(array $list): self
    {
        $this->clusterList = array_filter($list, static fn ($item) => $item instanceof AlwaysOnClusterInfo);
        return $this;
    }

    /**
     * Gets alwaysOnClusters
     *
     * @return array
     */
    public function getAlwaysOnClusterList(): array
    {
        return $this->clusterList;
    }
}
