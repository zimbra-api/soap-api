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
 * GetICal request class
 * Retrieve the unparsed (but XML-encoded (&quot)) iCalendar data for an Invite 
 * This is intended for interfacing with 3rd party programs
 *   - If id attribute specified, gets the iCalendar representation for one invite
 *   - If id attribute is not specified, then start/end MUST be, Calendar data is returned for entire specified range
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetICal extends Base
{
    /**
     * Constructor method for GetICal
     * @param  string $id
     * @param  int $s
     * @param  int $e
     * @return self
     */
    public function __construct($id = null, $s = null, $e = null)
    {
        parent::__construct();
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $s)
        {
            $this->property('s', (int) $s);
        }
        if(null !== $e)
        {
            $this->property('e', (int) $e);
        }
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Get or set s
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
}
