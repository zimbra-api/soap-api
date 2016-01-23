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

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\SortBy;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Struct\AttributeName;
use Zimbra\Struct\CursorInfo;

/**
 * MailSearchParams request class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
trait MailSearchParams
{
    /**
     * if <header>s are requested, any matching headers are included in inlined message hits
     * @var TypedSequence<AttributeName>
     */
    private $_headers;

    /**
     * Gets query
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->getChild('query');
    }

    /**
     * Sets query
     *
     * @param  string $query
     * @return self
     */
    public function setQuery($query)
    {
        return $this->setChild('query', trim($query));
    }

    /**
     * Add a header
     *
     * @param  AttributeName $header
     * @return self
     */
    public function addHeader(AttributeName $header)
    {
        $this->_headers->add($header);
        return $this;
    }

    /**
     * Sets header sequence
     *
     * @param  array $headers
     * @return self
     */
    public function setHeaders(array $headers)
    {
        $this->_headers = new TypedSequence('Zimbra\Struct\AttributeName', $headers);
        return $this;
    }

    /**
     * Gets header sequence
     *
     * @return Sequence
     */
    public function getHeaders()
    {
        return $this->_headers;
    }

    /**
     * Gets timezone specification
     *
     * @return CalTZInfo
     */
    public function getCalTz()
    {
        return $this->getChild('tz');
    }

    /**
     * Sets timezone specification
     *
     * @param  CalTZInfo $tz
     * @return self
     */
    public function setCalTz(CalTZInfo $tz)
    {
        return $this->setChild('tz', $tz);
    }

    /**
     * Gets locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->getChild('locale');
    }

    /**
     * Sets locale
     *
     * @param  string $locale
     * @return self
     */
    public function setLocale($locale)
    {
        return $this->setChild('locale', trim($locale));
    }

    /**
     * Gets cursor
     *
     * @return CursorInfo
     */
    public function getCursor()
    {
        return $this->getChild('cursor');
    }

    /**
     * Sets cursor
     *
     * @param  CursorInfo $cursor
     * @return self
     */
    public function setCursor(CursorInfo $cursor)
    {
        return $this->setChild('cursor', $cursor);
    }

    /**
     * Gets include tag deleted
     *
     * @return bool
     */
    public function getIncludeTagDeleted()
    {
        return $this->getProperty('includeTagDeleted');
    }

    /**
     * Sets include tag deleted
     *
     * @param  bool $includeTagDeleted
     * @return self
     */
    public function setIncludeTagDeleted($includeTagDeleted)
    {
        return $this->setProperty('includeTagDeleted', (bool) $includeTagDeleted);
    }

    /**
     * Gets include tag muted
     *
     * @return bool
     */
    public function getIncludeTagMuted()
    {
        return $this->getProperty('includeTagMuted');
    }

    /**
     * Sets include tag muted
     *
     * @param  bool $includeTagMuted
     * @return self
     */
    public function setIncludeTagMuted($includeTagMuted)
    {
        return $this->setProperty('includeTagMuted', (bool) $includeTagMuted);
    }

    /**
     * Gets allowable task status
     *
     * @return string
     */
    public function getAllowableTaskStatus()
    {
        return $this->getProperty('allowableTaskStatus');
    }

    /**
     * Sets allowable task status
     *
     * @param  string $allowableTaskStatus
     * @return self
     */
    public function setAllowableTaskStatus($allowableTaskStatus)
    {
        return $this->setProperty('allowableTaskStatus', trim($allowableTaskStatus));
    }

    /**
     * Gets cal expand inst start
     *
     * @return int
     */
    public function getCalExpandInstStart()
    {
        return $this->getProperty('calExpandInstStart');
    }

    /**
     * Sets cal expand inst start
     *
     * @param  int $calExpandInstStart
     * @return self
     */
    public function setCalExpandInstStart($calExpandInstStart)
    {
        return $this->setProperty('calExpandInstStart', (int) $calExpandInstStart);
    }

    /**
     * Gets cal expand inst end
     *
     * @return int
     */
    public function getCalExpandInstEnd()
    {
        return $this->getProperty('calExpandInstEnd');
    }

    /**
     * Sets cal expand inst end
     *
     * @param  int $calExpandInstEnd
     * @return self
     */
    public function setCalExpandInstEnd($calExpandInstEnd)
    {
        return $this->setProperty('calExpandInstEnd', (int) $calExpandInstEnd);
    }

    /**
     * Gets in dumpster
     *
     * @return bool
     */
    public function getInDumpster()
    {
        return $this->getProperty('inDumpster');
    }

    /**
     * Sets in dumpster
     *
     * @param  bool $inDumpster
     * @return self
     */
    public function setInDumpster($inDumpster)
    {
        return $this->setProperty('inDumpster', (bool) $inDumpster);
    }

    /**
     * Gets search types
     *
     * @return string
     */
    public function getSearchTypes()
    {
        return $this->getProperty('types');
    }

    /**
     * Sets search types
     *
     * @param  string $searchTypes
     * @return self
     */
    public function setSearchTypes($searchTypes)
    {
        return $this->setProperty('types', trim($searchTypes));
    }

    /**
     * Gets group by
     *
     * @return string
     */
    public function getGroupBy()
    {
        return $this->getProperty('groupBy');
    }

    /**
     * Sets group by
     *
     * @param  string $groupBy
     * @return self
     */
    public function setGroupBy($groupBy)
    {
        return $this->setProperty('groupBy', trim($groupBy));
    }

    /**
     * Gets quick
     *
     * @return bool
     */
    public function getQuick()
    {
        return $this->getProperty('quick');
    }

    /**
     * Sets quick
     *
     * @param  bool $quick
     * @return self
     */
    public function setQuick($quick)
    {
        return $this->setProperty('quick', (bool) $quick);
    }

    /**
     * Gets sort by
     *
     * @return SortBy
     */
    public function getSortBy()
    {
        return $this->getProperty('sortBy');
    }

    /**
     * Sets sort by
     *
     * @param  SortBy $sortBy
     * @return self
     */
    public function setSortBy(SortBy $sortBy)
    {
        return $this->setProperty('sortBy', $sortBy);
    }

    /**
     * Gets select setting for hit expansion
     *
     * @return string
     */
    public function getFetch()
    {
        return $this->getProperty('fetch');
    }

    /**
     * Sets select setting for hit expansion
     *
     * @param  string $fetch
     * @return self
     */
    public function setFetch($fetch)
    {
        return $this->setProperty('fetch', trim($fetch));
    }

    /**
     * Gets mark as read
     *
     * @return bool
     */
    public function getMarkRead()
    {
        return $this->getProperty('read');
    }

    /**
     * Sets mark as read
     *
     * @param  bool $markRead
     * @return self
     */
    public function setMarkRead($markRead)
    {
        return $this->setProperty('read', (bool) $markRead);
    }

    /**
     * Gets max inlined length
     *
     * @return int
     */
    public function getMaxInlinedLength()
    {
        return $this->getProperty('max');
    }

    /**
     * Sets max inlined length
     *
     * @param  int $maxInlinedLength
     * @return self
     */
    public function setMaxInlinedLength($maxInlinedLength)
    {
        return $this->setProperty('max', (int) $maxInlinedLength);
    }

    /**
     * Gets want html
     *
     * @return bool
     */
    public function getWantHtml()
    {
        return $this->getProperty('html');
    }

    /**
     * Sets want html
     *
     * @param  bool $wantHtml
     * @return self
     */
    public function setWantHtml($wantHtml)
    {
        return $this->setProperty('html', (bool) $wantHtml);
    }

    /**
     * Gets need can expand
     *
     * @return bool
     */
    public function getNeedCanExpand()
    {
        return $this->getProperty('needExp');
    }

    /**
     * Sets need can expand
     *
     * @param  bool $needCanExpand
     * @return self
     */
    public function setNeedCanExpand($needCanExpand)
    {
        return $this->setProperty('needExp', (bool) $needCanExpand);
    }

    /**
     * Gets neuter images
     *
     * @return bool
     */
    public function getNeuterImages()
    {
        return $this->getProperty('neuter');
    }

    /**
     * Sets neuter images
     *
     * @param  bool $neuterImages
     * @return self
     */
    public function setNeuterImages($neuterImages)
    {
        return $this->setProperty('neuter', (bool) $neuterImages);
    }

    /**
     * Gets want recipients
     *
     * @return bool
     */
    public function getWantRecipients()
    {
        return $this->getProperty('recip');
    }

    /**
     * Sets want recipients
     *
     * @param  bool $wantRecipients
     * @return self
     */
    public function setWantRecipients($wantRecipients)
    {
        return $this->setProperty('recip', (bool) $wantRecipients);
    }

    /**
     * Gets prefetch
     *
     * @return bool
     */
    public function getPrefetch()
    {
        return $this->getProperty('prefetch');
    }

    /**
     * Sets prefetch
     *
     * @param  bool $prefetch
     * @return self
     */
    public function setPrefetch($prefetch)
    {
        return $this->setProperty('prefetch', (bool) $prefetch);
    }

    /**
     * Gets result mode
     *
     * @return string
     */
    public function getResultMode()
    {
        return $this->getProperty('resultMode');
    }

    /**
     * Sets result mode
     *
     * @param  string $resultMode
     * @return self
     */
    public function setResultMode($resultMode)
    {
        return $this->setProperty('resultMode', trim($resultMode));
    }

    /**
     * Gets full conversation
     *
     * @return bool
     */
    public function getFullConversation()
    {
        return $this->getProperty('fullConversation');
    }

    /**
     * Sets full conversation
     *
     * @param  bool $fullConversation
     * @return self
     */
    public function setFullConversation($fullConversation)
    {
        return $this->setProperty('fullConversation', (bool) $fullConversation);
    }

    /**
     * Gets field
     *
     * @return string
     */
    public function getField()
    {
        return $this->getProperty('field');
    }

    /**
     * Sets field
     *
     * @param  string $field
     * @return self
     */
    public function setField($field)
    {
        return $this->setProperty('field', trim($field));
    }

    /**
     * Gets limit
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->getProperty('limit');
    }

    /**
     * Sets limit
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit($limit)
    {
        return $this->setProperty('limit', (int) $limit);
    }

    /**
     * Gets offset
     *
     * @return int
     */
    public function getOffset()
    {
        return $this->getProperty('offset');
    }

    /**
     * Sets offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset($offset)
    {
        return $this->setProperty('offset', (int) $offset);
    }
}
