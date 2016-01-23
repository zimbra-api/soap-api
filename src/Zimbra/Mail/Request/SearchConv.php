<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Enum\SortBy;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Struct\CursorInfo;

/**
 * SearchConv request class
 * Search a conversation
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchConv extends Base
{
    use MailSearchParams;

    /**
     * Constructor method for SearchConv
     * @param  string $cid
     * @param  string $nest
     * @param  string $query
     * @param  array $headers
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
     * @param  SortBy $sortBy
     * @param  string $fetch
     * @param  bool $read
     * @param  int $max
     * @param  bool $html
     * @param  bool $needExp
     * @param  bool $neuter
     * @param  bool $recip
     * @param  bool $prefetch
     * @param  string $resultMode
     * @param  bool $fullConversation
     * @param  string $field
     * @param  int $limit
     * @param  int $offset
     * @return self
     */
    public function __construct(
        $cid,
        $nest = null,
        $query = null,
        array $headers = [],
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
        SortBy $sortBy = null,
        $fetch = null,
        $read = null,
        $max = null,
        $html = null,
        $needExp = null,
        $neuter = null,
        $recip = null,
        $prefetch = null,
        $resultMode = null,
        $fullConversation = null,
        $field = null,
        $limit = null,
        $offset = null
    )
    {
        parent::__construct();
        $this->setProperty('cid', trim($cid));
        if(null !== $nest)
        {
            $this->setProperty('nest', (bool) $nest);
        }
        if(null !== $query)
        {
            $this->setChild('query', trim($query));
        }
        $this->setHeaders($headers);
        if($tz instanceof CalTZInfo)
        {
            $this->setChild('tz', $tz);
        }
        if(null !== $locale)
        {
            $this->setChild('locale', trim($locale));
        }
        if($cursor instanceof CursorInfo)
        {
            $this->setChild('cursor', $cursor);
        }
        if(null !== $includeTagDeleted)
        {
            $this->setProperty('includeTagDeleted', (bool) $includeTagDeleted);
        }
        if(null !== $includeTagMuted)
        {
            $this->setProperty('includeTagMuted', (bool) $includeTagMuted);
        }
        if(null !== $allowableTaskStatus)
        {
            $this->setProperty('allowableTaskStatus', trim($allowableTaskStatus));
        }
        if(null !== $calExpandInstStart)
        {
            $this->setProperty('calExpandInstStart', (int) $calExpandInstStart);
        }
        if(null !== $calExpandInstEnd)
        {
            $this->setProperty('calExpandInstEnd', (int) $calExpandInstEnd);
        }
        if(null !== $inDumpster)
        {
            $this->setProperty('inDumpster', (bool) $inDumpster);
        }
        if(null !== $types)
        {
            $this->setProperty('types', trim($types));
        }
        if(null !== $groupBy)
        {
            $this->setProperty('groupBy', trim($groupBy));
        }
        if(null !== $quick)
        {
            $this->setProperty('quick', (bool) $quick);
        }
        if($sortBy instanceof SortBy)
        {
            $this->setProperty('sortBy', $sortBy);
        }
        if(null !== $fetch)
        {
            $this->setProperty('fetch', trim($fetch));
        }
        if(null !== $read)
        {
            $this->setProperty('read', (bool) $read);
        }
        if(null !== $max)
        {
            $this->setProperty('max', (int) $max);
        }
        if(null !== $html)
        {
            $this->setProperty('html', (bool) $html);
        }
        if(null !== $needExp)
        {
            $this->setProperty('needExp', (bool) $needExp);
        }
        if(null !== $neuter)
        {
            $this->setProperty('neuter', (bool) $neuter);
        }
        if(null !== $recip)
        {
            $this->setProperty('recip', (bool) $recip);
        }
        if(null !== $prefetch)
        {
            $this->setProperty('prefetch', (bool) $prefetch);
        }
        if(null !== $resultMode)
        {
            $this->setProperty('resultMode', trim($resultMode));
        }
        if(null !== $fullConversation)
        {
            $this->setProperty('fullConversation', (bool) $fullConversation);
        }
        if(null !== $field)
        {
            $this->setProperty('field', trim($field));
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->setProperty('offset', (int) $offset);
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->getHeaders()->count())
            {
                $sender->setChild('header', $sender->getHeaders()->all());
            }
        });
    }

    /**
     * Gets conversation Id
     *
     * @return string
     */
    public function getConversationId()
    {
        return $this->getProperty('cid');
    }

    /**
     * Sets conversation Id
     *
     * @param  string $conversationId
     * @return self
     */
    public function setConversationId($conversationId)
    {
        return $this->setProperty('cid', trim($conversationId));
    }

    /**
     * Gets nest messages
     *
     * @return bool
     */
    public function getNestMessages()
    {
        return $this->getProperty('nest');
    }

    /**
     * Sets nest messages
     *
     * @param  bool $nestMessages
     * @return self
     */
    public function setNestMessages($nestMessages)
    {
        return $this->setProperty('nest', (bool) $nestMessages);
    }
}
