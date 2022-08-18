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
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetServiceStatusResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetServiceStatusResponse extends SoapResponse
{
    /**
     * TimeZone information
     * 
     * @var TimeZoneInfo
     */
    #[Accessor(getter: 'getTimezone', setter: 'setTimezone')]
    #[SerializedName('timezone')]
    #[Type(TimeZoneInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $timezone;

    /**
     * Service status information
     * 
     * @var array
     */
    #[Accessor(getter: 'getServiceStatuses', setter: 'setServiceStatuses')]
    #[Type('array<Zimbra\Admin\Struct\ServiceStatus>')]
    #[XmlList(inline: true, entry: 'status', namespace: 'urn:zimbraAdmin')]
    private $serviceStatuses = [];

    /**
     * Constructor
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
     * Get the timezone.
     *
     * @return TimeZoneInfo
     */
    public function getTimezone(): ?TimeZoneInfo
    {
        return $this->timezone;
    }

    /**
     * Set the timezone.
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
     * Set status
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
     * Get status
     *
     * @return array
     */
    public function getServiceStatuses(): array
    {
        return $this->serviceStatuses;
    }
}
