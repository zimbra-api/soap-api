<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * StatsValueWrapper class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class StatsValueWrapper
{
    /**
     * Stats specification
     * @var array
     */
    private $_stats = array();

    /**
     * Constructor method for StatsValueWrapper
     * @param  string $name
     * @return self
     */
    public function __construct(array $stats = array())
    {
        $this->stats($stats);
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
     * Gets or sets stats array
     *
     * @param  array $stats
     * @return array|self
     */
    public function stats(array $stats = null)
    {
        if(null === $stats)
        {
            return $this->_stats;
        }
        $this->_stats = array();
        foreach ($stats as $stat)
        {
            if($stat instanceof NamedElement)
            {
                $this->_stats[] = $stat;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'values')
    {
        $name = !empty($name) ? $name : 'values';
        $arr = array();
        if(count($this->_stats))
        {
            $arr['stat'] = array();
            foreach ($this->_stats as $stat)
            {
                $statArr = $stat->toArray('stat');
                $arr['stat'][] = $statArr['stat'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'values')
    {
        $name = !empty($name) ? $name : 'values';
        $xml = new SimpleXML('<'.$name.' />');
        foreach ($this->_stats as $stat)
        {
            $xml->append($stat->toXml('stat'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
