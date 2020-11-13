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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Struct\NamedElement;

/**
 * StatsValueWrapper struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="values")
 */
class StatsValueWrapper
{
    /**
     * Stats specification
     * 
     * @Accessor(getter="getStats", setter="setStats")
     * @SerializedName("stat")
     * @Type("array<Zimbra\Struct\NamedElement>")
     * @XmlList(inline = true, entry = "stat")
     */
    private $stats = [];

    /**
     * Constructor method for StatsValueWrapper
     * @param  array $stats
     * @return self
     */
    public function __construct(array $stats = [])
    {
        $this->setStats($stats);
    }

    /**
     * Add a stat
     *
     * @param  NamedElement $stat
     * @return self
     */
    public function addStat(NamedElement $stat): self
    {
        $this->stats[] = $stat;
        return $this;
    }

    /**
     * Sets stat sequence
     *
     * @param  array $stats
     * @return self
     */
    public function setStats(array $stats): self
    {
        $this->stats = [];
        foreach ($stats as $stat) {
            if ($stat instanceof NamedElement) {
                $this->stats[] = $stat;
            }
        }
        return $this;
    }

    /**
     * Gets stat sequence
     *
     * @return array
     */
    public function getStats(): array
    {
        return $this->stats;
    }
}
