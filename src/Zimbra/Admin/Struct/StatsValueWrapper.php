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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;
use Zimbra\Struct\NamedElement;

/**
 * StatsValueWrapper struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class StatsValueWrapper extends Base
{
    /**
     * Stats specification
     * @var TypedSequence
     */
    private $_stats = [];

    /**
     * Constructor method for StatsValueWrapper
     * @param  array $stats
     * @return self
     */
    public function __construct(array $stats = array())
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
     * Add a stat
     *
     * @param  NamedElement $stat
     * @return self
     */
    public function addStat(NamedElement $stat)
    {
        $this->_stats->add($stat);
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
        $this->_stats = new TypedSequence('Zimbra\Struct\NamedElement', $stats);
        return $this;
    }

    /**
     * Gets stat sequence
     *
     * @return Sequence
     */
    public function getStats()
    {
        return $this->_stats;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'values')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'values')
    {
        return parent::toXml($name);
    }
}
