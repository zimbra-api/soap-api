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
 * ICalReply request class
 * Do an iCalendar Reply
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ICalReply extends Base
{
    /**
     * Constructor method for ICalReply
     * @param  string $ical
     * @return self
     */
    public function __construct($ical)
    {
        parent::__construct();
        $this->setChild('ical', trim($ical));
    }

    /**
     * Gets ical
     *
     * @return string
     */
    public function getIcal()
    {
        return $this->getChild('ical');
    }

    /**
     * Sets ical
     *
     * @param  string $ical
     * @return self
     */
    public function setIcal($ical)
    {
        return $this->setChild('ical', trim($ical));
    }
}
