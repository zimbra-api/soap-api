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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Account\Struct\DiscoverRightsInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * DiscoverRightsResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DiscoverRightsResponse extends SoapResponse
{
    /**
     * Information about targets for rights
     * @Accessor(getter="getDiscoveredRights", setter="setDiscoveredRights")
     * @Type("array<Zimbra\Account\Struct\DiscoverRightsInfo>")
     * @XmlList(inline=true, entry="targets", namespace="urn:zimbraAccount")
     */
    private $discoveredRights = [];

    /**
     * Constructor
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
     * @param  array $rights
     * @return self
     */
    public function setDiscoveredRights(array $rights): self
    {
        $this->discoveredRights = array_filter($rights, static fn ($right) => $right instanceof DiscoverRightsInfo);
        return $this;
    }

    /**
     * Get discoveredRights
     *
     * @return array
     */
    public function getDiscoveredRights(): array
    {
        return $this->discoveredRights;
    }
}
