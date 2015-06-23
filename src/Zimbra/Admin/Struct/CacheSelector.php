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
use Zimbra\Enum\CacheType;
use Zimbra\Struct\Base;

/**
 * CacheSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CacheSelector extends Base
{
    /**
     * The entry
     * @var TypedSequence<CacheEntrySelector>
     */
    private $_entries;

    /**
     * Constructor method for CacheSelector
     * @param  string $types Comma separated list of cache types. e.g. from skin|locale|account|cos|domain|server|zimlet
     * @param  bool $allServers The allServers flag
     * @param  array $entries The entries
     * @return self
     */
    public function __construct($types, $allServers = null, array $entries = [])
    {
        parent::__construct();
        $this->setTypes($types);
        if(null !== $allServers)
        {
            $this->setProperty('allServers', (bool) $allServers);
        }
        $this->setEntries($entries);

        $this->on('before', function(Base $sender)
        {
            if($sender->getEntries()->count())
            {
                $sender->setChild('entry', $sender->getEntries()->all());
            }
        });
    }

    /**
     * Gets cache types
     *
     * @return string
     */
    public function getTypes()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets cache types
     *
     * @param  string $type
     * @return self
     */
    public function setTypes($type)
    {
        $arrTypes = explode(',', $type);
        $types = [];
        foreach ($arrTypes as $type)
        {
            $type = trim($type);
            if(CacheType::has($type) && !in_array($type, $types))
            {
                $types[] = $type;
            }
        }
        return $this->setProperty('type', implode(',', $types));
    }

    /**
     * Gets is all servers flag
     *
     * @return bool
     */
    public function isAllServers()
    {
        return $this->getProperty('allServers');
    }

    /**
     * Sets is all servers flag
     *
     * @param  bool $allServers
     * @return self
     */
    public function setAllServers($allServers = null)
    {
        return $this->setProperty('allServers', (bool) $allServers);
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
     * Sets entry sequence
     *
     * @param  array $entries The entries
     * @return Sequence
     */
    public function setEntries(array $entries)
    {
        $this->_entries = new TypedSequence('Zimbra\Admin\Struct\CacheEntrySelector', $entries);
        return $this;
    }

    /**
     * Gets entry sequence
     *
     * @return Sequence
     */
    public function getEntries()
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
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'cache')
    {
        return parent::toXml($name);
    }
}
