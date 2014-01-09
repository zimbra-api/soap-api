<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\AttributeName;
use Zimbra\Soap\Struct\CalTZInfo;
use Zimbra\Soap\Struct\CursorInfo;
use Zimbra\Utils\TypedSequence;

/**
 * MailSearchParams request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailSearchParams extends Request
{
    /**
     * Query string
     * @var string
     */
    private $_query;

    /**
     * if <header>s are requested, any matching headers are included in inlined message hits
     * @var TypedSequence<AttributeName>
     */
    private $_header;

    /**
     * Timezone specification
     * @var CalTZInfo
     */
    private $_tz;

    /**
     * Client locale identification.
     * Value is of the form LL-CC[-V+] where: 
     * LL is two character language code 
     * CC is two character country code 
     * V+ is optional variant identifier string 
     *
     * See: 
     * ISO Language Codes: http://www.ics.uci.edu/pub/ietf/http/related/iso639.txt 
     * ISO Country Codes: http://www.chemie.fu-berlin.de/diverse/doc/ISO_3166.html
     * @var string
     */
    private $_locale;

    /**
     * Cursor specification
     * @var CursorInfo
     */
    private $_cursor;

    /**
     * Set to 1 (true) to include items with the \Deleted calExpandInstStart set in results
     * @var bool
     */
    private $_includeTagDeleted;

    /**
     * Set to 1 (true) to include items with the Muted calExpandInstStart set in results
     * @var bool
     */
    private $_includeTagMuted;

    /**
     * Comma separated list of allowable Task statuses.
     * Valid values : NEED, INPR, WAITING, DEFERRED, COMP
     * @var string
     */
    private $_allowableTaskStatus;

    /**
     * Start time in milliseconds for the range to include instances for calendar items from. 
     * If calExpandInstStart and calExpandInstEnd are specified, and the search types include calendar item types (e.g. appointment),
     * then the search results include the instances for calendar items within that range in the form described in the description of the response. 
     * @var int
     */
    private $_calExpandInstStart;

    /**
     * End time in milliseconds for the range to include instances for calendar items from.
     * @var int
     */
    private $_calExpandInstEnd;

    /**
     * Set this flat to 1 (true) to search dumpster data instead of live data.
     * @var bool
     */
    private $_inDumpster;

    /**
     * Comma separated list of search types 
     * Legal values are: conversation|message|contact|appointment|task|wiki|document 
     * Default is "conversation". 
     * NOTE: only ONE of message, conversation may be set. If both are set, the first is used.
     * @var string
     */
    private $_types;

    /**
     * Deprecated. Use {comma-sep-search-types} instead
     * @var string
     */
    private $_groupBy;

    /**
     * "Quick" flag.
     * For performance reasons, the index system accumulates messages with not-indexed-yet state until a certain threshold and indexes them as a batch.
     * To return up-to-date search results, the index system also indexes those pending messages right before a search.
     * To lower latencies, this option gives a hint to the index system not to trigger this catch-up index prior to the search by giving up the freshness of the search results,
     * i.e. recent messages may not be included in the search results.
     * @var bool
     */
    private $_quick;

    /**
     * SortBy setting.
     * Default value is "dateDesc" 
     * Possible values:
     * none|dateAsc|dateDesc|subjAsc|subjDesc|nameAsc|nameDesc|rcptAsc|rcptDesc|attachAsc|attachDesc|flagAsc|flagDesc| priorityAsc|priorityDesc
     * If {sort-by} is "none" then cursors MUST NOT be used, and some searches are impossible (searches that require intersection of complex sub-ops).
     * Server will throw an IllegalArgumentException if the search is invalid. 
     * ADDITIONAL SORT MODES FOR TASKS: valid only if types="task" (and task alone): 
     * taskDueAsc|taskDueDesc|taskStatusAsc|taskStatusDesc|taskPercCompletedAsc|taskPercCompletedDesc
     * @var string
     */
    private $_sortBy;

    /**
     * Select setting for hit expansion.
     * if fetch="1" (or fetch="first") is specified, the first hit will be expanded inline (messages only at present)
     * if fetch="{item-id}", only the message with the given {item-id} is expanded inline 
     * if fetch="all", all hits are expanded inline
     * + if html="1" is also specified, inlined hits will return HTML parts if available 
     * + if read="1" is also specified, inlined hits will be marked as read 
     * + if neuter="0" is also specified, images in inlined HTML parts will not be "neutered" 
     * + if <header>s are requested, any matching headers are included in inlined message hits 
     * + if max="{max-inlined-length}" is specified, inlined body content in limited to the given length; 
     * if the part is truncated, truncated="1" is specified on the <mp> in question
     * @var string
     */
    private $_fetch;

    /**
     * Inlined hits will be marked as read
     * @var bool
     */
    private $_read;

    /**
     * If specified, inlined body content in limited to the given length;
     * if the part is truncated, truncated="1" is specified on the <mp> in question
     * @var int
     */
    private $_max;

    /**
     * Set to 1 (true) to cause inlined hits to return HTML parts if available
     * @var bool
     */
    private $_html;

    /**
     * If 'includeTagDeleted' is set in the request, two additional flags may be included in <e> elements for messages returned inline.
     *    isGroup - set if the email address is a group
     *    exp - present only when isGroup="1". 
     * Set if the authed user can (has groupByission to) expand members in this group 
     * Unset if the authed user does not have groupByission to expand group members
     * @var bool
     */
    private $_needExp;

    /**
     * Set to 0 (false) to stop images in inlined HTML parts from being "neutered"
     * @var bool
     */
    private $_neuter;

    /**
     * Want recipients setting. 
     * If set to 1 (true):
     *    returned sent messages will contain the set of "To:" recipients instead of the sender
     *    returned conversations whose first hit was sent by the user will contain that hit's "To:" recipients instead of the conversation's sender list
     * @var bool
     */
    private $_recip;

    /**
     * Prefetch
     * @var bool
     */
    private $_prefetch;

    /**
     * Specifies the type of result.
     * - NORMAL [default]    Everything
     * - IDS    Only IDs
     * @var string
     */
    private $_resultMode;

    /**
     * By default, text without an operator searches the CONTENT field. By setting the {default-field} value, you can control the default operator.
     * Specify any of the text operators that are available in query.txt, e.g. 'content:' [the default] or 'subject:', etc.
     * The date operators (date, after, before) and the "item:" operator should not be specified as default fields because of quirks in the search grammar.
     * @var string
     */
    private $_field;

    /**
     * The maximum number of results to return.
     * It defaults to 10 if not specified, and is capped by 1000
     * @var int
     */
    private $_limit;

    /**
     * Specifies the 0-based offset into the results list to return as the first result for this search operation.
     * For example, limit=10 offset=30 will return the 31st through 40th results inclusive.
     * @var int
     */
    private $_offset;

    /**
     * Constructor method for MailSearchParams
     * @param  string $query
     * @param  array $header
     * @param  CalTZInfo $tz
     * @param  string $locale
     * @param  CursorInfo $cursor
     * @param  bool $includeTagDeleted
     * @param  bool $includeTagMuted
     * @param  string $allowableTaskStatus
     * @param  int $calExpandInstStart
     * @param  int $calExpandInstEnd
     * @param  bool $inDumpster
     * @param  string $types
     * @param  string $groupBy
     * @param  bool $quick
     * @param  string $sortBy
     * @param  string $fetch
     * @param  bool $read
     * @param  int $max
     * @param  bool $html
     * @param  bool $needExp
     * @param  bool $neuter
     * @param  bool $recip
     * @param  bool $prefetch
     * @param  string $resultMode
     * @param  string $field
     * @param  int $limit
     * @param  int $offset
     * @return self
     */
    public function __construct(
        $query = null,
        array $header = array(),
        CalTZInfo $tz = null,
        $locale = null,
        CursorInfo $cursor = null,
        $includeTagDeleted = null,
        $includeTagMuted = null,
        $allowableTaskStatus = null,
        $calExpandInstStart = null,
        $calExpandInstEnd = null,
        $inDumpster = null,
        $types = null,
        $groupBy = null,
        $quick = null,
        $sortBy = null,
        $fetch = null,
        $read = null,
        $max = null,
        $html = null,
        $needExp = null,
        $neuter = null,
        $recip = null,
        $prefetch = null,
        $resultMode = null,
        $field = null,
        $limit = null,
        $offset = null
    )
    {
        parent::__construct();
        $this->_query = trim($query);
        $this->_header = new TypedSequence('Zimbra\Soap\Struct\AttributeName', $header);
        if($tz instanceof CalTZInfo)
        {
            $this->_tz = $tz;
        }
        $this->_locale = trim($locale);
        if($cursor instanceof CursorInfo)
        {
            $this->_cursor = $cursor;
        }
        if(null !== $includeTagDeleted)
        {
            $this->_includeTagDeleted = (bool) $includeTagDeleted;
        }
        if(null !== $includeTagMuted)
        {
            $this->_includeTagMuted = (bool) $includeTagMuted;
        }
        $this->_allowableTaskStatus = trim($allowableTaskStatus);
        if(null !== $calExpandInstStart)
        {
            $this->_calExpandInstStart = (int) $calExpandInstStart;
        }
        if(null !== $calExpandInstEnd)
        {
            $this->_calExpandInstEnd = (int) $calExpandInstEnd;
        }
        if(null !== $inDumpster)
        {
            $this->_inDumpster = (bool) $inDumpster;
        }
        $this->_types = trim($types);
        $this->_groupBy = trim($groupBy);
        if(null !== $quick)
        {
            $this->_quick = (bool) $quick;
        }
        $this->_sortBy = trim($sortBy);
        $this->_fetch = trim($fetch);
        if(null !== $read)
        {
            $this->_read = (bool) $read;
        }
        if(null !== $max)
        {
            $this->_max = (int) $max;
        }
        if(null !== $html)
        {
            $this->_html = (bool) $html;
        }
        if(null !== $needExp)
        {
            $this->_needExp = (bool) $needExp;
        }
        if(null !== $neuter)
        {
            $this->_neuter = (bool) $neuter;
        }
        if(null !== $recip)
        {
            $this->_recip = (bool) $recip;
        }
        if(null !== $prefetch)
        {
            $this->_prefetch = (bool) $prefetch;
        }
        $this->_resultMode = trim($resultMode);
        $this->_field = trim($field);
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
        if(null !== $offset)
        {
            $this->_offset = (int) $offset;
        }
    }

    /**
     * Get or set query
     *
     * @param  string $query
     * @return string|self
     */
    public function query($query = null)
    {
        if(null === $query)
        {
            return $this->_query;
        }
        $this->_query = trim($query);
        return $this;
    }

    /**
     * Add a header
     *
     * @param  AttributeName $header
     * @return self
     */
    public function addHeader(AttributeName $header)
    {
        $this->_header->add($header);
        return $this;
    }

    /**
     * Gets header sequence
     *
     * @return Sequence
     */
    public function header()
    {
        return $this->_header;
    }

    /**
     * Get or set tz
     *
     * @param  CalTZInfo $tz
     * @return CalTZInfo|self
     */
    public function tz(CalTZInfo $tz = null)
    {
        if(null === $tz)
        {
            return $this->_tz;
        }
        $this->_tz = $tz;
        return $this;
    }

    /**
     * Get or set locale
     *
     * @param  string $locale
     * @return string|self
     */
    public function locale($locale = null)
    {
        if(null === $locale)
        {
            return $this->_locale;
        }
        $this->_locale = trim($locale);
        return $this;
    }

    /**
     * Get or set cursor
     *
     * @param  CursorInfo $cursor
     * @return CursorInfo|self
     */
    public function cursor(CursorInfo $cursor = null)
    {
        if(null === $cursor)
        {
            return $this->_cursor;
        }
        $this->_cursor = $cursor;
        return $this;
    }

    /**
     * Get or set includeTagDeleted
     *
     * @param  bool $includeTagDeleted
     * @return bool|self
     */
    public function includeTagDeleted($includeTagDeleted = null)
    {
        if(null === $includeTagDeleted)
        {
            return $this->_includeTagDeleted;
        }
        $this->_includeTagDeleted = (bool) $includeTagDeleted;
        return $this;
    }

    /**
     * Get or set includeTagMuted
     *
     * @param  bool $includeTagMuted
     * @return bool|self
     */
    public function includeTagMuted($includeTagMuted = null)
    {
        if(null === $includeTagMuted)
        {
            return $this->_includeTagMuted;
        }
        $this->_includeTagMuted = (bool) $includeTagMuted;
        return $this;
    }

    /**
     * Get or set allowableTaskStatus
     *
     * @param  string $allowableTaskStatus
     * @return string|self
     */
    public function allowableTaskStatus($allowableTaskStatus = null)
    {
        if(null === $allowableTaskStatus)
        {
            return $this->_allowableTaskStatus;
        }
        $this->_allowableTaskStatus = trim($allowableTaskStatus);
        return $this;
    }

    /**
     * Gets or sets calExpandInstStart
     *
     * @param  int $calExpandInstStart
     * @return int|self
     */
    public function calExpandInstStart($calExpandInstStart = null)
    {
        if(null === $calExpandInstStart)
        {
            return $this->_calExpandInstStart;
        }
        $this->_calExpandInstStart = (int) $calExpandInstStart;
        return $this;
    }

    /**
     * Gets or sets calExpandInstEnd
     *
     * @param  int $calExpandInstEnd
     * @return int|self
     */
    public function calExpandInstEnd($calExpandInstEnd = null)
    {
        if(null === $calExpandInstEnd)
        {
            return $this->_calExpandInstEnd;
        }
        $this->_calExpandInstEnd = (int) $calExpandInstEnd;
        return $this;
    }

    /**
     * Get or set inDumpster
     *
     * @param  bool $inDumpster
     * @return bool|self
     */
    public function inDumpster($inDumpster = null)
    {
        if(null === $inDumpster)
        {
            return $this->_inDumpster;
        }
        $this->_inDumpster = (bool) $inDumpster;
        return $this;
    }

    /**
     * Get or set types
     *
     * @param  string $types
     * @return string|self
     */
    public function types($types = null)
    {
        if(null === $types)
        {
            return $this->_types;
        }
        $this->_types = trim($types);
        return $this;
    }

    /**
     * Gets or sets groupBy
     *
     * @param  string $groupBy
     * @return string|self
     */
    public function groupBy($groupBy = null)
    {
        if(null === $groupBy)
        {
            return $this->_groupBy;
        }
        $this->_groupBy = trim($groupBy);
        return $this;
    }

    /**
     * Get or set quick
     *
     * @param  bool $quick
     * @return bool|self
     */
    public function quick($quick = null)
    {
        if(null === $quick)
        {
            return $this->_quick;
        }
        $this->_quick = (bool) $quick;
        return $this;
    }

    /**
     * Gets or sets sortBy
     *
     * @param  string $sortBy
     * @return string|self
     */
    public function sortBy($sortBy = null)
    {
        if(null === $sortBy)
        {
            return $this->_sortBy;
        }
        $this->_sortBy = trim($sortBy);
        return $this;
    }

    /**
     * Gets or sets fetch
     *
     * @param  string $fetch
     * @return string|self
     */
    public function fetch($fetch = null)
    {
        if(null === $fetch)
        {
            return $this->_fetch;
        }
        $this->_fetch = trim($fetch);
        return $this;
    }

    /**
     * Get or set read
     *
     * @param  bool $read
     * @return bool|self
     */
    public function read($read = null)
    {
        if(null === $read)
        {
            return $this->_read;
        }
        $this->_read = (bool) $read;
        return $this;
    }

    /**
     * Gets or sets max
     *
     * @param  int $max
     * @return int|self
     */
    public function max($max = null)
    {
        if(null === $max)
        {
            return $this->_max;
        }
        $this->_max = (int) $max;
        return $this;
    }

    /**
     * Get or set html
     *
     * @param  bool $html
     * @return bool|self
     */
    public function html($html = null)
    {
        if(null === $html)
        {
            return $this->_html;
        }
        $this->_html = (bool) $html;
        return $this;
    }

    /**
     * Get or set needExp
     *
     * @param  bool $needExp
     * @return bool|self
     */
    public function needExp($needExp = null)
    {
        if(null === $needExp)
        {
            return $this->_needExp;
        }
        $this->_needExp = (bool) $needExp;
        return $this;
    }

    /**
     * Get or set neuter
     *
     * @param  bool $neuter
     * @return bool|self
     */
    public function neuter($neuter = null)
    {
        if(null === $neuter)
        {
            return $this->_neuter;
        }
        $this->_neuter = (bool) $neuter;
        return $this;
    }

    /**
     * Get or set recip
     *
     * @param  bool $recip
     * @return bool|self
     */
    public function recip($recip = null)
    {
        if(null === $recip)
        {
            return $this->_recip;
        }
        $this->_recip = (bool) $recip;
        return $this;
    }

    /**
     * Get or set prefetch
     *
     * @param  bool $prefetch
     * @return bool|self
     */
    public function prefetch($prefetch = null)
    {
        if(null === $prefetch)
        {
            return $this->_prefetch;
        }
        $this->_prefetch = (bool) $prefetch;
        return $this;
    }

    /**
     * Gets or sets resultMode
     *
     * @param  string $resultMode
     * @return string|self
     */
    public function resultMode($resultMode = null)
    {
        if(null === $resultMode)
        {
            return $this->_resultMode;
        }
        $this->_resultMode = trim($resultMode);
        return $this;
    }

    /**
     * Gets or sets field
     *
     * @param  string $field
     * @return string|self
     */
    public function field($field = null)
    {
        if(null === $field)
        {
            return $this->_field;
        }
        $this->_field = trim($field);
        return $this;
    }

    /**
     * Gets or sets limit
     *
     * @param  int $limit
     * @return int|self
     */
    public function limit($limit = null)
    {
        if(null === $limit)
        {
            return $this->_limit;
        }
        $this->_limit = (int) $limit;
        return $this;
    }

    /**
     * Gets or sets offset
     *
     * @param  int $offset
     * @return int|self
     */
    public function offset($offset = null)
    {
        if(null === $offset)
        {
            return $this->_offset;
        }
        $this->_offset = (int) $offset;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_query))
        {
            $this->array['query'] = $this->_query;
        }
        if(count($this->_header))
        {
            $this->array['header'] = array();
            foreach ($this->_header as $header)
            {
                $headerArr = $header->toArray('header');
                $this->array['header'][] = $headerArr['header'];
            }
        }
        if($this->_tz instanceof CalTZInfo)
        {
            $this->array += $this->_tz->toArray('tz');
        }
        if(!empty($this->_locale))
        {
            $this->array['locale'] = $this->_locale;
        }
        if($this->_cursor instanceof CursorInfo)
        {
            $this->array += $this->_cursor->toArray('cursor');
        }
        if(is_bool($this->_includeTagDeleted))
        {
            $this->array['includeTagDeleted'] = $this->_includeTagDeleted ? 1 : 0;
        }
        if(is_bool($this->_includeTagMuted))
        {
            $this->array['includeTagMuted'] = $this->_includeTagMuted ? 1 : 0;
        }
        if(!empty($this->_allowableTaskStatus))
        {
            $this->array['allowableTaskStatus'] = $this->_allowableTaskStatus;
        }
        if(is_int($this->_calExpandInstStart))
        {
            $this->array['calExpandInstStart'] = $this->_calExpandInstStart;
        }
        if(is_int($this->_calExpandInstEnd))
        {
            $this->array['calExpandInstEnd'] = $this->_calExpandInstEnd;
        }
        if(is_bool($this->_inDumpster))
        {
            $this->array['inDumpster'] = $this->_inDumpster ? 1 : 0;
        }
        if(!empty($this->_types))
        {
            $this->array['types'] = $this->_types;
        }
        if(!empty($this->_groupBy))
        {
            $this->array['groupBy'] = $this->_groupBy;
        }
        if(is_bool($this->_quick))
        {
            $this->array['quick'] = $this->_quick ? 1 : 0;
        }
        if(!empty($this->_sortBy))
        {
            $this->array['sortBy'] = $this->_sortBy;
        }
        if(!empty($this->_fetch))
        {
            $this->array['fetch'] = $this->_fetch;
        }
        if(is_bool($this->_read))
        {
            $this->array['read'] = $this->_read ? 1 : 0;
        }
        if(is_int($this->_max))
        {
            $this->array['max'] = $this->_max;
        }
        if(is_bool($this->_html))
        {
            $this->array['html'] = $this->_html ? 1 : 0;
        }
        if(is_bool($this->_needExp))
        {
            $this->array['needExp'] = $this->_needExp ? 1 : 0;
        }
        if(is_bool($this->_neuter))
        {
            $this->array['neuter'] = $this->_neuter ? 1 : 0;
        }
        if(is_bool($this->_recip))
        {
            $this->array['recip'] = $this->_recip ? 1 : 0;
        }
        if(is_bool($this->_prefetch))
        {
            $this->array['prefetch'] = $this->_prefetch ? 1 : 0;
        }
        if(!empty($this->_resultMode))
        {
            $this->array['resultMode'] = $this->_resultMode;
        }
        if(!empty($this->_field))
        {
            $this->array['field'] = $this->_field;
        }
        if(is_int($this->_limit))
        {
            $this->array['limit'] = $this->_limit;
        }
        if(is_int($this->_offset))
        {
            $this->array['offset'] = $this->_offset;
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
        if(!empty($this->_query))
        {
            $this->xml->addChild('query', $this->_query);
        }
        if(count($this->_header))
        {
            foreach ($this->_header as $header)
            {
                $this->xml->append($header->toXml('header'));
            }
        }
        if($this->_tz instanceof CalTZInfo)
        {
            $this->xml->append($this->_tz->toXml('tz'));
        }
        if(!empty($this->_locale))
        {
            $this->xml->addChild('locale', $this->_locale);
        }
        if($this->_cursor instanceof CursorInfo)
        {
            $this->xml->append($this->_cursor->toXml('cursor'));
        }
        if(is_bool($this->_includeTagDeleted))
        {
            $this->xml->addAttribute('includeTagDeleted', $this->_includeTagDeleted ? 1 : 0);
        }
        if(is_bool($this->_includeTagMuted))
        {
            $this->xml->addAttribute('includeTagMuted', $this->_includeTagMuted ? 1 : 0);
        }
        if(!empty($this->_allowableTaskStatus))
        {
            $this->xml->addAttribute('allowableTaskStatus', $this->_allowableTaskStatus);
        }
        if(is_int($this->_calExpandInstStart))
        {
            $this->xml->addAttribute('calExpandInstStart', $this->_calExpandInstStart);
        }
        if(is_int($this->_calExpandInstEnd))
        {
            $this->xml->addAttribute('calExpandInstEnd', $this->_calExpandInstEnd);
        }
        if(is_bool($this->_inDumpster))
        {
            $this->xml->addAttribute('inDumpster', $this->_inDumpster ? 1 : 0);
        }
        if(!empty($this->_types))
        {
            $this->xml->addAttribute('types', $this->_types);
        }
        if(!empty($this->_groupBy))
        {
            $this->xml->addAttribute('groupBy', $this->_groupBy);
        }
        if(is_bool($this->_quick))
        {
            $this->xml->addAttribute('quick', $this->_quick ? 1 : 0);
        }
        if(!empty($this->_sortBy))
        {
            $this->xml->addAttribute('sortBy', $this->_sortBy);
        }
        if(!empty($this->_fetch))
        {
            $this->xml->addAttribute('fetch', $this->_fetch);
        }
        if(is_bool($this->_read))
        {
            $this->xml->addAttribute('read', $this->_read ? 1 : 0);
        }
        if(is_int($this->_max))
        {
            $this->xml->addAttribute('max', $this->_max);
        }
        if(is_bool($this->_html))
        {
            $this->xml->addAttribute('html', $this->_html ? 1 : 0);
        }
        if(is_bool($this->_needExp))
        {
            $this->xml->addAttribute('needExp', $this->_needExp ? 1 : 0);
        }
        if(is_bool($this->_neuter))
        {
            $this->xml->addAttribute('neuter', $this->_neuter ? 1 : 0);
        }
        if(is_bool($this->_recip))
        {
            $this->xml->addAttribute('recip', $this->_recip ? 1 : 0);
        }
        if(is_bool($this->_prefetch))
        {
            $this->xml->addAttribute('prefetch', $this->_prefetch ? 1 : 0);
        }
        if(!empty($this->_resultMode))
        {
            $this->xml->addAttribute('resultMode', $this->_resultMode);
        }
        if(!empty($this->_field))
        {
            $this->xml->addAttribute('field', $this->_field);
        }
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        if(is_int($this->_offset))
        {
            $this->xml->addAttribute('offset', $this->_offset);
        }
        return parent::toXml();
    }
}
