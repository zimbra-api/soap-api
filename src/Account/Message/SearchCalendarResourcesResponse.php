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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Account\Struct\CalendarResourceInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * SearchCalendarResourcesResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SearchCalendarResourcesResponse implements ResponseInterface
{
    /**
     * Name of attribute sorted on. If not present then sorted by the calendar resource name.
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("string")
     * @XmlAttribute
     */
    private $sortBy;

    /**
     * The 0-based offset into the results list to return as the first result for this search operation.
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("integer")
     * @XmlAttribute
     */
    private $offset;

    /**
     * Flags whether there are more results
     * @Accessor(getter="getMore", setter="setMore")
     * @SerializedName("more")
     * @Type("bool")
     * @XmlAttribute
     */
    private $more;

    /**
     * Flag whether the underlying search supported pagination.
     * 1 (true) - limit and offset in the request was honored
     * 0 (false) - the underlying search does not support pagination. limit and offset in the request was not honored
     * @Accessor(getter="getPagingSupported", setter="setPagingSupported")
     * @SerializedName("paginationSupported")
     * @Type("bool")
     * @XmlAttribute
     */
    private $pagingSupported;

    /**
     * Matching calendar resources
     * 
     * @Accessor(getter="getCalendarResources", setter="setCalendarResources")
     * @SerializedName("calresource")
     * @Type("array<Zimbra\Account\Struct\CalendarResourceInfo>")
     * @XmlList(inline = true, entry = "calresource")
     */
    private $calendarResources = [];

    /**
     * Constructor method for SearchCalendarResourcesResponse
     *
     * @param string $sortBy
     * @param int $offset
     * @param bool $more
     * @param bool $pagingSupported
     * @param array $calendarResources
     * @return self
     */
    public function __construct(
        ?string $sortBy = NULL,
        ?int $offset = NULL,
        ?bool $more = NULL,
        ?bool $pagingSupported = NULL,
        array $calendarResources = []
    )
    {
        if (NULL !== $sortBy) {
            $this->setSortBy($sortBy);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
        if (NULL !== $more) {
            $this->setMore($more);
        }
        if (NULL !== $pagingSupported) {
            $this->setPagingSupported($pagingSupported);
        }
        $this->setCalendarResources($calendarResources);
    }

    /**
     * Gets sortBy
     *
     * @return string
     */
    public function getSortBy(): ?string
    {
        return $this->sortBy;
    }

    /**
     * Sets sortBy
     *
     * @param  string $sortBy
     * @return self
     */
    public function setSortBy(string $sortBy): self
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * Gets offset
     *
     * @return int
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * Sets offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Gets more
     *
     * @return bool
     */
    public function getMore(): ?bool
    {
        return $this->more;
    }

    /**
     * Sets more
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
     * Gets pagingSupported
     *
     * @return bool
     */
    public function getPagingSupported(): ?bool
    {
        return $this->pagingSupported;
    }

    /**
     * Sets pagingSupported
     *
     * @param  bool $pagingSupported
     * @return self
     */
    public function setPagingSupported(bool $pagingSupported): self
    {
        $this->pagingSupported = $pagingSupported;
        return $this;
    }

    /**
     * Add calendarResource
     *
     * @param  CalendarResourceInfo $calendarResource
     * @return self
     */
    public function addCalendarResource(CalendarResourceInfo $calendarResource): self
    {
        $this->calendarResources[] = $calendarResource;
        return $this;
    }

    /**
     * Sets calendarResources
     *
     * @param  array $resources
     * @return self
     */
    public function setCalendarResources(array $resources): self
    {
        $this->calendarResources = array_filter($resources, static fn($resource) => $resource instanceof CalendarResourceInfo);
        return $this;
    }

    /**
     * Gets calendarResources
     *
     * @return array
     */
    public function getCalendarResources(): array
    {
        return $this->calendarResources;
    }
}
