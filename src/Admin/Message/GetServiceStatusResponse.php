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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlList, XmlRoot};
use Zimbra\Admin\Struct\ServiceStatus;
use Zimbra\Admin\Struct\TimeZoneInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetServiceStatusResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetServiceStatusResponse")
 */
class GetServiceStatusResponse implements ResponseInterface
{
    /**
     * TimeZone information
     * 
     * @Accessor(getter="getTimezone", setter="setTimezone")
     * @SerializedName("timezone")
     * @Type("Zimbra\Admin\Struct\TimeZoneInfo")
     * @XmlElement
     */
    private $timezone;

    /**
     * Service status information
     * 
     * @Accessor(getter="getServiceStatuses", setter="setServiceStatuses")
     * @SerializedName("status")
     * @Type("array<Zimbra\Admin\Struct\ServiceStatus>")
     * @XmlList(inline = true, entry = "status")
     */
    private $serviceStatuses;

    /**
     * Constructor method for GetServiceStatusResponse
     *
     * @param TimeZoneInfo $timezone
     * @param array $serviceStatuses
     * @return self
     */
    public function __construct(TimeZoneInfo $timezone, array $serviceStatuses = [])
    {
        $this->setTimezone($timezone)
             ->setServiceStatuses($serviceStatuses);
    }

    /**
     * Gets the timezone.
     *
     * @return TimeZoneInfo
     */
    public function getTimezone(): TimeZoneInfo
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
     * @param  array $serviceStatuses
     * @return self
     */
    public function setServiceStatuses(array $serviceStatuses): self
    {
        $this->serviceStatuses = [];
        foreach ($serviceStatuses as $status) {
            if ($status instanceof ServiceStatus) {
                $this->serviceStatuses[] = $status;
            }
        }
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