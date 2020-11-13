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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * CreateAlwaysOnClusterResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateAlwaysOnClusterResponse")
 */
class CreateAlwaysOnClusterResponse implements ResponseInterface
{
    /**
     * Information about the newly created cluster
     * @Accessor(getter="getAlwaysOnCluster", setter="setAlwaysOnCluster")
     * @SerializedName("alwaysOnCluster")
     * @Type("Zimbra\Admin\Struct\AlwaysOnClusterInfo")
     * @XmlElement()
     */
    private $cluster;

    /**
     * Constructor method for CreateAlwaysOnClusterResponse
     * @param AlwaysOnClusterInfo $cluster
     * @return self
     */
    public function __construct(AlwaysOnClusterInfo $cluster = NULL)
    {
        if ($cluster instanceof AlwaysOnClusterInfo) {
            $this->setAlwaysOnCluster($cluster);
        }
    }

    /**
     * Gets the alwaysOnCluster.
     *
     * @return AlwaysOnClusterInfo
     */
    public function getAlwaysOnCluster()
    {
        return $this->alwaysOnCluster;
    }

    /**
     * Sets the alwaysOnCluster.
     *
     * @param  AlwaysOnClusterInfo $alwaysOnCluster
     * @return self
     */
    public function setAlwaysOnCluster(AlwaysOnClusterInfo $alwaysOnCluster): self
    {
        $this->alwaysOnCluster = $alwaysOnCluster;
        return $this;
    }
}
