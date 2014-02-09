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

/**
 * GetCalendarItemSummaries request class
 * Get Calendar item summaries
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetCalendarItemSummaries extends Base
{
    /**
     * Constructor method for GetCalendarItemSummaries
     * @param  int    $s
     * @param  int    $e
     * @param  string $l
     * @return self
     */
    public function __construct($s, $e, $l = null)
    {
        parent::__construct();
        $this->property('s', (int) $s);
        $this->property('e', (int) $e);
        if(null !== $l)
        {
            $this->property('l', trim($l));
        }
    }

    /**
     * Get or set s
     * Range start in milliseconds since the epoch GMT
     *
     * @param  int $s
     * @return int|self
     */
    public function s($s = null)
    {
        if(null === $s)
        {
            return $this->property('s');
        }
        return $this->property('s', (int) $s);
    }

    /**
     * Get or set e
     * Range end in milliseconds since the epoch GMT
     *
     * @param  int $e
     * @return int|self
     */
    public function e($e = null)
    {
        if(null === $e)
        {
            return $this->property('e');
        }
        return $this->property('e', (int) $e);
    }

    /**
     * Get or set l
     * Folder ID.
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->property('l');
        }
        return $this->property('l', trim($l));
    }
}
