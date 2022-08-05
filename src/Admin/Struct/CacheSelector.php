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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * CacheSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CacheSelector
{
    /**
     * The entries
     * 
     * @Accessor(getter="getEntries", setter="setEntries")
     * @Type("array<Zimbra\Admin\Struct\CacheEntrySelector>")
     * @XmlList(inline=true, entry="entry", namespace="urn:zimbraAdmin")
     */
    private $entries = [];

    /**
     * Comma separated list of cache types.
     * e.g. from acl|locale|skin|uistrings|license|all|account|config|globalgrant|cos|domain|galgroup|group|mime|server|alwaysOnCluster|zimlet|<extension-cache-type>
     * 
     * @Accessor(getter="getTypes", setter="setTypes")
     * @SerializedName("type")
     * @Type("string")
     * @XmlAttribute
     */
    private $types;

    /**
     * The allServers flag
     * 0 (false) [default]:  flush cache only on the local server
     * 1 (true): flush cache only on all servers (can take a long time on systems
     * 
     * @Accessor(getter="isAllServers", setter="setAllServers")
     * @SerializedName("allServers")
     * @Type("bool")
     * @XmlAttribute
     */
    private $allServers;

    /**
     * The imapServers flag
     * 0 (false): don't issue X-ZIMBRA-FLUSHCACHE IMAP command to upstream IMAP servers
     * 1 (true) [default]: flush cache on servers listed in zimbraReverseProxyUpstreamImapServers for the current server via X-ZIMBRA-FLUSHCACHE
     * 
     * @Accessor(getter="isIncludeImapServers", setter="setIncludeImapServers")
     * @SerializedName("imapServers")
     * @Type("bool")
     * @XmlAttribute
     */
    private $imapServers;

    /**
     * Constructor
     * 
     * @param  string $types
     * @param  bool $allServers
     * @param  bool $imapServers 
     * @param  array $entries
     * @return self
     */
    public function __construct(
        string $types = '', ?bool $allServers = NULL, ?bool $imapServers = NULL, array $entries = []
    )
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
     * Get cache types
     *
     * @return string
     */
    public function getTypes(): string
    {
        return $this->types;
    }

    /**
     * Set cache types
     *
     * @param  string $types
     * @return self
     */
    public function setTypes(string $types): self
    {
        $this->types = $types;
        return $this;
    }

    /**
     * Get is all servers flag
     *
     * @return bool
     */
    public function isAllServers(): ?bool
    {
        return $this->allServers;
    }

    /**
     * Set is all servers flag
     *
     * @param  bool $allServers
     * @return self
     */
    public function setAllServers(bool $allServers): self
    {
        $this->allServers = $allServers;
        return $this;
    }

    /**
     * Get is imap servers flag
     *
     * @return bool
     */
    public function isIncludeImapServers(): ?bool
    {
        return $this->imapServers;
    }

    /**
     * Set is imap servers flag
     *
     * @param  bool $imapServers
     * @return self
     */
    public function setIncludeImapServers(bool $imapServers): self
    {
        $this->imapServers = $imapServers;
        return $this;
    }

    /**
     * Add a cache entry
     *
     * @param  CacheEntrySelector $entry
     * @return CacheSelector
     */
    public function addEntry(CacheEntrySelector $entry): self
    {
        $this->entries[] = $entry;
        return $this;
    }

    /**
     * Set entry sequence
     *
     * @param  array $entries The entries
     * @return self
     */
    public function setEntries(array $entries): self
    {
        $this->entries = array_filter($entries, static fn ($entry) => $entry instanceof CacheEntrySelector);
        return $this;
    }

    /**
     * Get entry sequence
     *
     * @return array
     */
    public function getEntries(): array
    {
        return $this->entries;
    }
}
