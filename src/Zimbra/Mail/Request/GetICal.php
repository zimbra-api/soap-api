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
     * @param  int $startTime
     * @param  int $endTime
     * @return self
     */
    public function __construct($id = null, $startTime = null, $endTime = null)
    {
        parent::__construct();
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $startTime)
        {
            $this->setProperty('s', (int) $startTime);
        }
        if(null !== $endTime)
        {
            $this->setProperty('e', (int) $endTime);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets range start in milliseconds
     *
     * @return int
     */
    public function getStartTime()
    {
        return $this->getProperty('s');
    }

    /**
     * Sets range start in milliseconds
     *
     * @param  int $startTime
     * @return self
     */
    public function setStartTime($startTime)
    {
        return $this->setProperty('s', (int) $startTime);
    }

    /**
     * Gets range end in milliseconds
     *
     * @return int
     */
    public function getEndTime()
    {
        return $this->getProperty('e');
    }

    /**
     * Sets range end in milliseconds
     *
     * @param  int $endTime
     * @return self
     */
    public function setEndTime($endTime)
    {
        return $this->setProperty('e', (int) $endTime);
    }
}
