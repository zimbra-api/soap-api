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
use Zimbra\Soap\Enum\CacheType;
use Zimbra\Utils\TypedSequence;

/**
 * CacheSelector class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CacheSelector
{
    /**
     * Comma separated list of cache types. e.g. from skin|locale|account|cos|domain|server|zimlet
     * @var string
     */
    private $_type;

    /**
     * The entry
     * Array of CacheEntrySelector
     * @var Sequence
     */
    private $_entries = array();

    /**
     * The allServers flag
     * 0 (false) [default]     flush cache only on the local server
     * 1 (true)     flush cache only on all servers (can take a long time on systems with lots of servers)
     * @var bool
     */
    private $_allServers;

    /**
     * Constructor method for CacheSelector
     * @param  string $type
     * @param  bool $allServers
     * @param  array $entries
     * @return self
     */
    public function __construct($type, $allServers = null, array $entries = array())
    {
        $types = explode(',', $type);
        foreach ($types as $type)
        {
            if(CacheType::has(trim($type)))
            {
                if(empty($this->_type))
                    $this->_type = trim($type);
                else
                    $this->_type .= ',' . trim($type);
            }
        }
        if(null !== $allServers)
        {
            $this->_allServers = (bool) $allServers;
        }
        $this->_entries = new TypedSequence('Zimbra\Soap\Struct\CacheEntrySelector', $entries);
    }

    /**
     * Gets or sets type
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $types = explode(',', $type);
        $this->_type = '';
        foreach ($types as $type)
        {
            if(CacheType::has(trim($type)))
            {
                if(empty($this->_type))
                    $this->_type = trim($type);
                else
                    $this->_type .= ',' . trim($type);
            }
        }
        return $this;
    }

    /**
     * Gets or sets allServers
     *
     * @param  bool $allServers
     * @return bool|self
     */
    public function allServers($allServers = null)
    {
        if(null === $allServers)
        {
            return $this->_allServers;
        }
        $this->_allServers = (bool) $allServers;
        return $this;
    }

    /**
     * Add a cache entry
     *
     * @param  CacheEntrySelector $entry
     * @return CacheSelector
     */
    public function addEntry(CacheEntrySelector $entry)
    {
        $this->_entries->add($entry);
        return $this;
    }


    /**
     * Gets entries Sequence
     *
     * @return Sequence
     */
    public function entries()
    {
        return $this->_entries;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'cache')
    {
        $name = !empty($name) ? $name : 'cache';
        $arr = array(
            'type' => $this->_type,
        );
        if(is_bool($this->_allServers))
        {
            $arr['allServers'] = $this->_allServers ? 1 : 0;
        }
        if(count($this->_entries))
        {
            $arr['entry'] = array();
            foreach ($this->_entries as $entry)
            {
                $entryArr = $entry->toArray('entry');
                $arr['entry'][] = $entryArr['entry'];
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
    public function toXml($name = 'cache')
    {
        $name = !empty($name) ? $name : 'cache';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('type', $this->_type);
        if(is_bool($this->_allServers))
        {
            $xml->addAttribute('allServers', $this->_allServers ? 1 : 0);
        }
        foreach ($this->_entries as $entry)
        {
            $xml->append($entry->toXml('entry'));
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
