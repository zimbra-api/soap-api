<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Struct\NamedElement;

/**
 * StatsValueWrapper struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="values")
 */
class StatsValueWrapper
{
    /**
     * Stats specification
     * @Accessor(getter="getStats", setter="setStats")
     * @Type("array<Zimbra\Struct\NamedElement>")
     * @XmlList(inline = true, entry = "stat")
     */
    private $_stats = [];

    /**
     * Constructor method for StatsValueWrapper
     * @param  array $stats
     * @return self
     */
    public function __construct(array $stats = array())
    {
        $this->setStats($stats);
    }

    /**
     * Add a stat
     *
     * @param  NamedElement $stat
     * @return self
     */
    public function addStat(NamedElement $stat)
    {
        $this->_stats[] = $stat;
        return $this;
    }

    /**
     * Sets stat sequence
     *
     * @param  array $stats
     * @return self
     */
    public function setStats(array $stats)
    {
        $this->_stats = [];
        foreach ($stats as $stat) {
            if ($stat instanceof NamedElement) {
                $this->_stats[] = $stat;
            }
        }
        return $this;
    }

    /**
     * Gets stat sequence
     *
     * @return array
     */
    public function getStats()
    {
        return $this->_stats;
    }
}
