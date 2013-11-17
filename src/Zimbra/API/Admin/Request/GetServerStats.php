<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\Stat;
use Zimbra\Utils\TypedSequence;

/**
 * GetServerStats class
 * Returns server monitoring stats.
 * These are the same stats that are logged to mailboxd.csv.
 * If no <stat> element is specified, all server stats are returned.
 * If the stat name is invalid, returns a SOAP fault..
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetServerStats extends Request
{
    /**
     * Stats
     * @var Stat
     */
    private $_stats = array();

    /**
     * Constructor method for GetServerStats
     * @param  array $stats
     * @return self
     */
    public function __construct(array $stats = array())
    {
        parent::__construct();
        $this->_stats = new TypedSequence('Zimbra\Soap\Struct\Stat', $stats);
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
     * Gets stat Sequence
     *
     * @return Sequence
     */
    public function stats()
    {
        return $this->_stats;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_stats))
        {
            $this->array['stat'] = array();
            foreach ($this->_stats as $stat)
            {
                $statArr = $stat->toArray('stat');
                $this->array['stat'][] = $statArr['stat'];
            }
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        foreach ($this->_stats as $stat)
        {
            $this->xml->append($stat->toXml('stat'));
        }
        return parent::toXml();
    }
}
