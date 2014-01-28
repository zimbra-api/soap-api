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
use Zimbra\Soap\Request;

/**
 * MailSearchParams request class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MailSearchParams extends Request
{
    /**
     * if <header>s are requested, any matching headers are included in inlined message hits
     * @var TypedSequence<AttributeName>
     */
    private $_header;

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
        $field = null,
        $limit = null,
        $offset = null
    )
    {
        parent::__construct();
        if(null !== $query)
        {
            $this->child('query', trim($query));
        }
        $this->_header = new TypedSequence('Zimbra\Struct\AttributeName', $header);
        if($tz instanceof CalTZInfo)
        {
            $this->child('tz', $tz);
        }
        if(null !== $locale)
        {
            $this->child('locale', trim($locale));
        }
        if($cursor instanceof CursorInfo)
        {
            $this->child('cursor', $cursor);
        }
        if(null !== $includeTagDeleted)
        {
            $this->property('includeTagDeleted', (bool) $includeTagDeleted);
        }
        if(null !== $includeTagMuted)
        {
            $this->property('includeTagMuted', (bool) $includeTagMuted);
        }
        if(null !== $allowableTaskStatus)
        {
            $this->property('allowableTaskStatus', trim($allowableTaskStatus));
        }
        if(null !== $calExpandInstStart)
        {
            $this->property('calExpandInstStart', (int) $calExpandInstStart);
        }
        if(null !== $calExpandInstEnd)
        {
            $this->property('calExpandInstEnd', (int) $calExpandInstEnd);
        }
        if(null !== $inDumpster)
        {
            $this->property('inDumpster', (bool) $inDumpster);
        }
        if(null !== $types)
        {
            $this->property('types', trim($types));
        }
        if(null !== $groupBy)
        {
            $this->property('groupBy', trim($groupBy));
        }
        if(null !== $quick)
        {
            $this->property('quick', (bool) $quick);
        }
        if($sortBy instanceof SortBy)
        {
            $this->property('sortBy', $sortBy);
        }
        if(null !== $fetch)
        {
            $this->property('fetch', trim($fetch));
        }
        if(null !== $read)
        {
            $this->property('read', (bool) $read);
        }
        if(null !== $max)
        {
            $this->property('max', (int) $max);
        }
        if(null !== $html)
        {
            $this->property('html', (bool) $html);
        }
        if(null !== $needExp)
        {
            $this->property('needExp', (bool) $needExp);
        }
        if(null !== $neuter)
        {
            $this->property('neuter', (bool) $neuter);
        }
        if(null !== $recip)
        {
            $this->property('recip', (bool) $recip);
        }
        if(null !== $prefetch)
        {
            $this->property('prefetch', (bool) $prefetch);
        }
        if(null !== $resultMode)
        {
            $this->property('resultMode', trim($resultMode));
        }
        if(null !== $field)
        {
            $this->property('field', trim($field));
        }
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
        }

        $this->addHook(function($sender)
        {
            if(count($sender->header()))
            {
                $sender->child('header', $sender->header()->all());
            }
        });
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
            return $this->child('query');
        }
        return $this->child('query', trim($query));
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
            return $this->child('tz');
        }
        return $this->child('tz', $tz);
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
            return $this->child('locale');
        }
        return $this->child('locale', trim($locale));
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
            return $this->child('cursor');
        }
        return $this->child('cursor', $cursor);
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
            return $this->property('includeTagDeleted');
        }
        return $this->property('includeTagDeleted', (bool) $includeTagDeleted);
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
            return $this->property('includeTagMuted');
        }
        return $this->property('includeTagMuted', (bool) $includeTagMuted);
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
            return $this->property('allowableTaskStatus');
        }
        return $this->property('allowableTaskStatus', trim($allowableTaskStatus));
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
            return $this->property('calExpandInstStart');
        }
        return $this->property('calExpandInstStart', (int) $calExpandInstStart);
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
            return $this->property('calExpandInstEnd');
        }
        return $this->property('calExpandInstEnd', (int) $calExpandInstEnd);
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
            return $this->property('inDumpster');
        }
        return $this->property('inDumpster', (bool) $inDumpster);
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
            return $this->property('types');
        }
        return $this->property('types', trim($types));
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
            return $this->property('groupBy');
        }
        return $this->property('groupBy', trim($groupBy));
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
            return $this->property('quick');
        }
        return $this->property('quick', (bool) $quick);
    }

    /**
     * Gets or sets sortBy
     *
     * @param  SortBy $sortBy
     * @return SortBy|self
     */
    public function sortBy(SortBy $sortBy = null)
    {
        if(null === $sortBy)
        {
            return $this->property('sortBy');
        }
        return $this->property('sortBy', $sortBy);
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
            return $this->property('fetch');
        }
        return $this->property('fetch', trim($fetch));
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
            return $this->property('read');
        }
        return $this->property('read', (bool) $read);
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
            return $this->property('max');
        }
        return $this->property('max', (int) $max);
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
            return $this->property('html');
        }
        return $this->property('html', (bool) $html);
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
            return $this->property('needExp');
        }
        return $this->property('needExp', (bool) $needExp);
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
            return $this->property('neuter');
        }
        return $this->property('neuter', (bool) $neuter);
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
            return $this->property('recip');
        }
        return $this->property('recip', (bool) $recip);
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
            return $this->property('prefetch');
        }
        return $this->property('prefetch', (bool) $prefetch);
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
            return $this->property('resultMode');
        }
        return $this->property('resultMode', trim($resultMode));
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
            return $this->property('field');
        }
        return $this->property('field', trim($field));
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
            return $this->property('limit');
        }
        return $this->property('limit', (int) $limit);
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
            return $this->property('offset');
        }
        return $this->property('offset', (int) $offset);
    }
}
