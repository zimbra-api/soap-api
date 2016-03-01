<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\Stat;
use Zimbra\Common\TypedSequence;

/**
 * GetServerStats request class
 * Returns server monitoring stat.
 * These are the same stat that are logged to mailboxd.csv.
 * If no <stat> element is specified, all server stat are returned.
 * If the stat name is invalid, returns a SOAP fault..
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetServerStats extends Base
{
    /**
     * Stats
     * @var Stat
     */
    private $_stats;

    /**
     * Constructor method for GetServerStats
     * @param  array $stats
     * @return self
     */
    public function __construct(array $stats = [])
    {
        parent::__construct();
        $this->setStats($stats);

        $this->on('before', function(Base $sender)
        {
            if($sender->getStats()->count())
            {
                $sender->setChild('stat', $sender->getStats()->all());
            }
        });
    }

    /**
     * Add an attr
     *
     * @param  Stat $stat
     * @return self
     */
    public function addStat(Stat $stat)
    {
        $this->_stats->add($stat);
        return $this;
    }

    /**
     * Sets stat Sequence
     *
     * @param  array $stats
     * @return self
     */
    public function setStats(array $stats)
    {
        $this->_stats = new TypedSequence('Zimbra\Admin\Struct\Stat', $stats);
        return $this;
    }

    /**
     * Gets stat Sequence
     *
     * @return Sequence
     */
    public function getStats()
    {
        return $this->_stats;
    }
}
