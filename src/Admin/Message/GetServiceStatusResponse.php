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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Admin\Struct\{ServiceStatus, TimeZoneInfo};
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetServiceStatusResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetServiceStatusResponse implements SoapResponseInterface
{
    /**
     * TimeZone information
     * 
     * @Accessor(getter="getTimezone", setter="setTimezone")
     * @SerializedName("timezone")
     * @Type("Zimbra\Admin\Struct\TimeZoneInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?TimeZoneInfo $timezone = NULL;

    /**
     * Service status information
     * 
     * @Accessor(getter="getServiceStatuses", setter="setServiceStatuses")
     * @Type("array<Zimbra\Admin\Struct\ServiceStatus>")
     * @XmlList(inline=true, entry="status", namespace="urn:zimbraAdmin")
     */
    private $serviceStatuses = [];

    /**
     * Constructor method for GetServiceStatusResponse
     *
     * @param TimeZoneInfo $timezone
     * @param array $serviceStatuses
     * @return self
     */
    public function __construct(
        ?TimeZoneInfo $timezone = NULL, array $serviceStatuses = []
    )
    {
        $this->setServiceStatuses($serviceStatuses);
        if ($timezone instanceof TimeZoneInfo) {
            $this->setTimezone($timezone);
        }
    }

    /**
     * Gets the timezone.
     *
     * @return TimeZoneInfo
     */
    public function getTimezone(): ?TimeZoneInfo
    {
        return $this->timezone;
    }

    /**
     * Sets the timezone.
     *
     * @param  TimeZoneInfo $timezone
     * @return self
     */
    public function setTimezone(TimeZoneInfo $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * Add status
     *
     * @param  ServiceStatus $status
     * @return self
     */
    public function addServiceStatus(ServiceStatus $status): self
    {
        $this->serviceStatuses[] = $status;
        return $this;
    }

    /**
     * Sets status
     *
     * @param  array $statuses
     * @return self
     */
    public function setServiceStatuses(array $statuses): self
    {
        $this->serviceStatuses = array_filter($statuses, static fn ($status) => $status instanceof ServiceStatus);
        return $this;
    }

    /**
     * Gets status
     *
     * @return array
     */
    public function getServiceStatuses(): array
    {
        return $this->serviceStatuses;
    }
}
