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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * HostStats class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class HostStats
{
    /**
     * Hostname
     * @Accessor(getter="getHostName", setter="setHostName")
     * @SerializedName("hn")
     * @Type("string")
     * @XmlAttribute
     */
    private $hostName;

    /**
     * Stats information
     * @Accessor(getter="getStats", setter="setStats")
     * @SerializedName("stats")
     * @Type("Zimbra\Admin\Struct\StatsInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?StatsInfo $stats = NULL;

    /**
     * Constructor method for HostStats
     *
     * @param  string $hostName
     * @param  StatsInfo $stats
     * @return self
     */
    public function __construct(string $hostName = '', ?StatsInfo $stats = NULL)
    {
        $this->setHostName($hostName);
        if ($stats instanceof StatsInfo) {
            $this->setStats($stats);
        }
    }

    /**
     * Gets hostName
     *
     * @return hostName
     */
    public function getHostName(): string
    {
        return $this->hostName;
    }

    /**
     * Sets hostName
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
     * Sets stats
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
     * Gets stats
     *
     * @return StatsInfo
     */
    public function getStats(): ?StatsInfo
    {
        return $this->stats;
    }
}
