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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * SearchCalendarResourcesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchCalendarResourcesResponse extends SoapResponse
{
    /**
     * 1 (true) if more calendar resources to return
     * @Accessor(getter="getMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * Total number of calendar resources that matched search (not affected by limit/offset)
     * @Accessor(getter="getSearchTotal", setter="setSearchTotal")
     * @SerializedName("searchTotal")
     * @Type("integer")
     * @XmlAttribute
     */
    private $searchTotal;

    /**
     * Information about calendar resources
     * 
     * @Accessor(getter="getCalResources", setter="setCalResources")
     * @Type("array<Zimbra\Admin\Struct\CalendarResourceInfo>")
     * @XmlList(inline=true, entry="calresource", namespace="urn:zimbraAdmin")
     */
    private $calResources = [];

    /**
     * Constructor method for SearchCalendarResourcesResponse
     *
     * @param bool $more
     * @param int $searchTotal
     * @param array $calResources
     * @return self
     */
    public function __construct(
        bool $more = FALSE,
        int $searchTotal = 0,
        array $calResources = []
    )
    {
        $this->setMore($more)
             ->setSearchTotal($searchTotal)
             ->setCalResources($calResources);
    }

    /**
     * Get more
     *
     * @return bool
     */
    public function getMore(): bool
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
     * Get searchTotal
     *
     * @return int
     */
    public function getSearchTotal(): int
    {
        return $this->searchTotal;
    }

    /**
     * Set searchTotal
     *
     * @param  int $searchTotal
     * @return self
     */
    public function setSearchTotal(int $searchTotal): self
    {
        $this->searchTotal = $searchTotal;
        return $this;
    }

    /**
     * Add calResource
     *
     * @param  CalendarResourceInfo $calResource
     * @return self
     */
    public function addCalendarResource(CalendarResourceInfo $calResource): self
    {
        $this->calResources[] = $calResource;
        return $this;
    }

    /**
     * Set calResources
     *
     * @param  array $resources
     * @return self
     */
    public function setCalResources(array $resources): self
    {
        $this->calResources = array_filter($resources, static fn ($resource) => $resource instanceof CalendarResourceInfo);
        return $this;
    }

    /**
     * Get calResources
     *
     * @return array
     */
    public function getCalResources(): array
    {
        return $this->calResources;
    }
}
