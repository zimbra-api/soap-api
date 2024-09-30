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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};

/**
 * HostStats class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020-present by Nguyen Van Nguyen.
 */
class HostStats
{
    /**
     * Hostname
     *
     * @Accessor(getter="getHostName", setter="setHostName")
     * @SerializedName("hn")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getHostName", setter: "setHostName")]
    #[SerializedName("hn")]
    #[Type("string")]
    #[XmlAttribute]
    private $hostName;

    /**
     * Stats information
     *
     * @Accessor(getter="getStats", setter="setStats")
     * @SerializedName("stats")
     * @Type("Zimbra\Admin\Struct\StatsInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var StatsInfo
     */
    #[Accessor(getter: "getStats", setter: "setStats")]
    #[SerializedName("stats")]
    #[Type(StatsInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?StatsInfo $stats;

    /**
     * Constructor
     *
     * @param  string $hostName
     * @param  StatsInfo $stats
     * @return self
     */
    public function __construct(string $hostName = "", ?StatsInfo $stats = null)
    {
        $this->setHostName($hostName);
        $this->stats = $stats;
    }

    /**
     * Get hostName
     *
     * @return string
     */
    public function getHostName(): string
    {
        return $this->hostName;
    }

    /**
     * Set hostName
     *
     * @param  string $hostName
     * @return self
     */
    public function setHostName(string $hostName): self
    {
        $this->hostName = $hostName;
        return $this;
    }

    /**
     * Set stats
     *
     * @param  StatsInfo $stats
     * @return self
     */
    public function setStats(StatsInfo $stats): self
    {
        $this->stats = $stats;
        return $this;
    }

    /**
     * Get stats
     *
     * @return StatsInfo
     */
    public function getStats(): ?StatsInfo
    {
        return $this->stats;
    }
}
