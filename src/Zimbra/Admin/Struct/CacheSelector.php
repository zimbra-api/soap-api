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
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Enum\CacheType;

/**
 * CacheSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="cache")
 */
class CacheSelector
{
    /**
     * @Accessor(getter="getEntries", setter="setEntries")
     * @Type("array<Zimbra\Admin\Struct\CacheEntrySelector>")
     * @XmlList(inline = true, entry = "entry")
     */
    private $_entries;

    /**
     * @Accessor(getter="getTypes", setter="setTypes")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $_types;

    /**
     * @Accessor(getter="isAllServers", setter="setAllServers")
     * @SerializedName("allServers")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_allServers;

    /**
     * @Accessor(getter="isIncludeImapServers", setter="setIncludeImapServers")
     * @SerializedName("imapServers")
     * @Type("bool")
     * @XmlAttribute
     */
    private $_imapServers;

    /**
     * Constructor method for CacheSelector
     * @param  string $types Comma separated list of cache types. e.g. from skin|locale|account|cos|domain|server|zimlet
     * @param  bool $allServers The allServers flag
     * @param  bool $imapServers The imapServers flag
     * @param  array $entries The entries
     * @return self
     */
    public function __construct($types, $allServers = NULL, $imapServers = NULL, array $entries = [])
    {
        $this->setTypes($types);
        if (NULL !== $allServers) {
            $this->setAllServers($allServers);
        }
        if (NULL !== $imapServers) {
            $this->setIncludeImapServers($imapServers);
        }
        $this->setEntries($entries);
    }

    /**
     * Gets cache types
     *
     * @return string
     */
    public function getTypes()
    {
        return $this->_types;
    }

    /**
     * Sets cache types
     *
     * @param  string $types
     * @return self
     */
    public function setTypes($types)
    {
        $arrTypes = explode(',', $types);
        $types = [];
        foreach ($arrTypes as $type) {
            $type = trim($type);
            if (CacheType::has($type) && !in_array($type, $types)) {
                $types[] = $type;
            }
        }
        $this->_types = implode(',', $types);
        return $this;
    }

    /**
     * Gets is all servers flag
     *
     * @return bool
     */
    public function isAllServers()
    {
        return $this->_allServers;
    }

    /**
     * Sets is all servers flag
     *
     * @param  bool $allServers
     * @return self
     */
    public function setAllServers($allServers)
    {
        $this->_allServers = (bool) $allServers;
        return $this;
    }

    /**
     * Gets is imap servers flag
     *
     * @return bool
     */
    public function isIncludeImapServers()
    {
        return $this->_imapServers;
    }

    /**
     * Sets is imap servers flag
     *
     * @param  bool $imapServers
     * @return self
     */
    public function setIncludeImapServers($imapServers)
    {
        $this->_imapServers = (bool) $imapServers;
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
        $this->_entries[] = $entry;
        return $this;
    }

    /**
     * Sets entry sequence
     *
     * @param  array $entries The entries
     * @return self
     */
    public function setEntries(array $entries)
    {
        $this->_entries = [];
        foreach ($entries as $entry) {
            if ($entry instanceof CacheEntrySelector) {
                $this->_entries[] = $entry;
            }
        }
        return $this;
    }

    /**
     * Gets entry sequence
     *
     * @return array
     */
    public function getEntries()
    {
        return $this->_entries;
    }
}
