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
        parent::__construct(
            $query,
            $headers,
            $tz,
            $locale,
            $cursor,
            $includeTagDeleted,
            $includeTagMuted,
            $allowableTaskStatus,
            $calExpandInstStart,
            $calExpandInstEnd,
            $inDumpster,
            $types,
            $groupBy,
            $quick,
            $sortBy,
            $fetch,
            $read,
            $max,
            $html,
            $needExp,
            $neuter,
            $recip,
            $prefetch,
            $resultMode,
            $fullConversation,
            $field,
            $limit,
            $offset
        );
        $this->setProperty('cid', trim($cid));
        if(null !== $nest)
        {
            $this->setProperty('nest', (bool) $nest);
        }
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
