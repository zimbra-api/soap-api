<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlValue, XmlRoot};
use Zimbra\Enum\ZeroOrOne;

/**
 * ServiceStatus struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="status")
 */
class ServiceStatus
{
    /**
     * Server
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("string")
     * @XmlAttribute
     */
    private $server;

    /**
     * Service
     * @Accessor(getter="getService", setter="setService")
     * @SerializedName("service")
     * @Type("string")
     * @XmlAttribute
     */
    private $service;

    /**
     * Number of seconds since the epoch (1970), UTC time
     * @Accessor(getter="getTime", setter="setTime")
     * @SerializedName("t")
     * @Type("integer")
     * @XmlAttribute
     */
    private $time;

    /**
     * Status
     * @Accessor(getter="getStatus", setter="setStatus")
     * @SerializedName("_content")
     * @Type("Zimbra\Enum\ZeroOrOne")
     * @XmlValue(cdata = false)
     */
    private $status;

    /**
     * Constructor method for ServiceStatus
     * 
     * @param  string $server
     * @param  string $service
     * @param  int $time
     * @param  ZeroOrOne $status
     * @return self
     */
    public function __construct(
        string $server, string $service, int $time, ZeroOrOne $status
    )
    {
        $this->setServer($server)
             ->setService($service)
             ->setTime($time)
             ->setStatus($status);
    }

    /**
     * Gets Zimbra ID
     *
     * @return string
     */
    public function getServer(): string
    {
        return $this->server;
    }

    /**
     * Sets Zimbra ID
     *
     * @param  string $server
     * @return self
     */
    public function setServer(string $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * Gets service
     *
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * Sets service
     *
     * @param  string $service
     * @return self
     */
    public function setService(string $service): self
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Gets time
     *
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * Sets time
     *
     * @param  int $time
     * @return self
     */
    public function setTime(int $time): self
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Gets status
     *
     * @return ZeroOrOne
     */
    public function getStatus(): ZeroOrOne
    {
        return $this->status;
    }

    /**
     * Sets status
     *
     * @param  ZeroOrOne $status
     * @return self
     */
    public function setStatus(ZeroOrOne $status): self
    {
        $this->status = $status;
        return $this;
    }
}
