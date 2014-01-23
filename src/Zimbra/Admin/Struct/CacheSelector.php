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
    private $_entry = array();

    /**
     * Constructor method for CacheSelector
     * @param  string $type Comma separated list of cache types. e.g. from skin|locale|account|cos|domain|server|zimlet
     * @param  bool $allServers The allServers flag
     * @param  array $entries The entries
     * @return self
     */
    public function __construct($type, $allServers = null, array $entries = array())
    {
        parent::__construct();
        $arrTypes = explode(',', $type);
        $types = array();
        foreach ($arrTypes as $type)
        {
            $type = trim($type);
            if(CacheType::has($type) && !in_array($type, $types))
            {
                $types[] = $type;
            }
        }
        $this->property('type', implode(',', $types));
        if(null !== $allServers)
        {
            $this->property('allServers', (bool) $allServers);
        }
        $this->_entry = new TypedSequence('Zimbra\Admin\Struct\CacheEntrySelector', $entries);

        $this->addHook(function($sender)
        {
            $sender->child('entry', $sender->entry()->all());
        });
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
            return $this->property('type');
        }
        $arrTypes = explode(',', $type);
        $types = array();
        foreach ($arrTypes as $type)
        {
            $type = trim($type);
            if(CacheType::has($type) && !in_array($type, $types))
            {
                $types[] = $type;
            }
        }
        return $this->property('type', implode(',', $types));
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
            return $this->property('allServers');
        }
        return $this->property('allServers', (bool) $allServers);
    }

    /**
     * Add a cache entry
     *
     * @param  CacheEntrySelector $entry
     * @return CacheSelector
     */
    public function addEntry(CacheEntrySelector $entry)
    {
        $this->_entry->add($entry);
        return $this;
    }


    /**
     * Gets entry sequence
     *
     * @return Sequence
     */
    public function entry()
    {
        return $this->_entry;
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
