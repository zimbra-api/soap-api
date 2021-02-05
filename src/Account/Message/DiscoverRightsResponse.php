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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Account\Struct\DiscoverRightsInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * DiscoverRightsResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="DiscoverRightsResponse")
 */
class DiscoverRightsResponse implements ResponseInterface
{
    /**
     * Information about targets for rights
     * @Accessor(getter="getDiscoveredRights", setter="setDiscoveredRights")
     * @SerializedName("targets")
     * @Type("array<Zimbra\Account\Struct\DiscoverRightsInfo>")
     * @XmlList(inline = true, entry = "targets")
     */
    private $discoveredRights;

    /**
     * Constructor method for DiscoverRightsResponse
     * 
     * @param  array $targets
     * @return self
     */
    public function __construct(array $targets = [])
    {
        $this->setDiscoveredRights($targets);
    }

    /**
     * Add discoveredRight
     *
     * @param  DiscoverRightsInfo $discoveredRight
     * @return self
     */
    public function addDiscoveredRight(DiscoverRightsInfo $discoveredRight): self
    {
        $this->discoveredRights[] = $discoveredRight;
        return $this;
    }

    /**
     * Set discoveredRights
     *
     * @param  array $discoveredRights
     * @return self
     */
    public function setDiscoveredRights(array $discoveredRights): self
    {
        $this->discoveredRights = [];
        foreach ($discoveredRights as $discoveredRight) {
            if ($discoveredRight instanceof DiscoverRightsInfo) {
                $this->discoveredRights[] = $discoveredRight;
            }
        }
        return $this;
    }

    /**
     * Gets discoveredRights
     *
     * @return array
     */
    public function getDiscoveredRights(): array
    {
        return $this->discoveredRights;
    }
}