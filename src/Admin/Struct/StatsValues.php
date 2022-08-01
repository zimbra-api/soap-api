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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * StatsValues class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020-present by Nguyen Van Nguyen.
 */
class StatsValues
{
    /**
     * t
     * @Accessor(getter="getT", setter="setT")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     */
    private $t;

    /**
     * Stats
     * @Accessor(getter="getStats", setter="setStats")
     * @Type("array<Zimbra\Admin\Struct\NameAndValue>")
     * @XmlList(inline=true, entry="stat", namespace="urn:zimbraAdmin")
     */
    private $stats = [];

    /**
     * Constructor method for StatsValues
     *
     * @param  string $t
     * @param  array $stats
     * @return self
     */
    public function __construct(string $t = '', array $stats = [])
    {
        $this->setT($t)
             ->setStats($stats);
    }

    /**
     * Get t
     *
     * @return string
     */
    public function getT(): string
    {
        return $this->t;
    }

    /**
     * Set t
     *
     * @param  string $t
     * @return self
     */
    public function setT(string $t): self
    {
        $this->t = $t;
        return $this;
    }

    /**
     * Add a stat
     *
     * @param  NameAndValue $stat
     * @return self
     */
    public function addStat(NameAndValue $stat): self
    {
        $this->stats[] = $stat;
        return $this;
    }

    /**
     * Set stats
     *
     * @param  array $stats
     * @return self
     */
    public function setStats(array $stats): self
    {
        $this->stats = array_filter($stats, static fn ($stat) => $stat instanceof NameAndValue);
        return $this;
    }

    /**
     * Get stats
     *
     * @return array
     */
    public function getStats(): array
    {
        return $this->stats;
    }
}
