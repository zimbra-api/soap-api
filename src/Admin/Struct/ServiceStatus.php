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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\ZeroOrOne;

/**
 * ServiceStatus struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ServiceStatus
{
    /**
     * Server
     * 
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getServer', setter: 'setServer')]
    #[SerializedName(name: 'server')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $server;

    /**
     * Service
     * 
     * @Accessor(getter="getService", setter="setService")
     * @SerializedName("service")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getService', setter: 'setService')]
    #[SerializedName(name: 'service')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $service;

    /**
     * Number of seconds since the epoch (1970), UTC time
     * 
     * @Accessor(getter="getTime", setter="setTime")
     * @SerializedName("t")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getTime', setter: 'setTime')]
    #[SerializedName(name: 't')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $time;

    /**
     * Status
     * 
     * @Accessor(getter="getStatus", setter="setStatus")
     * @Type("Enum<Zimbra\Common\Enum\ZeroOrOne>")
     * @XmlValue(cdata=false)
     * 
     * @var ZeroOrOne
     */
    #[Accessor(getter: 'getStatus', setter: 'setStatus')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\ZeroOrOne>')]
    #[XmlValue(cdata: false)]
    private $status;

    /**
     * Constructor
     * 
     * @param  string $server
     * @param  string $service
     * @param  int $time
     * @param  ZeroOrOne $status
     * @return self
     */
    public function __construct(
        string $server = '', string $service = '', int $time = 0, ?ZeroOrOne $status = NULL
    )
    {
        $this->setServer($server)
             ->setService($service)
             ->setTime($time)
             ->setStatus($status ?? new ZeroOrOne('0'));
    }

    /**
     * Get Zimbra ID
     *
     * @return string
     */
    public function getServer(): string
    {
        return $this->server;
    }

    /**
     * Set Zimbra ID
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
     * Get service
     *
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * Set service
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
     * Get time
     *
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * Set time
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
     * Get status
     *
     * @return ZeroOrOne
     */
    public function getStatus(): ZeroOrOne
    {
        return $this->status;
    }

    /**
     * Set status
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
