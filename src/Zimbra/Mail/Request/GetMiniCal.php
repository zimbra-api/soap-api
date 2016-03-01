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
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Struct\Id;

/**
 * GetMiniCal request class
 * Get information needed for Mini Calendar. 
 * Date is returned if there is at least one appointment on that date.
 * The date computation uses the requesting (authenticated) account's time zone, not the time zone of the account that owns the calendar folder.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetMiniCal extends Base
{
    /**
     * Local and/or remote calendar folders
     * @var TypedSequence<Id>
     */
    private $_folders;

    /**
     * Constructor method for GetMiniCal
     * @param  int $startTime
     * @param  int $endTime
     * @param  array $folders
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function __construct(
        $startTime,
        $endTime,
        array $folders = [],
        CalTZInfo $timezone = null
    )
    {
        parent::__construct();
        $this->setProperty('s', (int) $startTime);
        $this->setProperty('e', (int) $endTime);
        if($timezone instanceof CalTZInfo)
        {
            $this->setChild('tz', $timezone);
        }

        $this->setFolders($folders);
        $this->on('before', function(Base $sender)
        {
            if($sender->getFolders()->count())
            {
                $sender->setChild('folder', $sender->getFolders()->all());
            }
        });
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

    /**
     * Add folder
     *
     * @param  Id $folder
     * @return self
     */
    public function addFolder(Id $folder)
    {
        $this->_folders->add($folder);
        return $this;
    }

    /**
     * Sets folder sequence
     *
     * @param  array $folders
     * @return self
     */
    public function setFolders(array $folders)
    {
        $this->_folders = new TypedSequence('Zimbra\Struct\Id', $folders);
        return $this;
    }

    /**
     * Gets folder sequence
     *
     * @return Sequence
     */
    public function getFolders()
    {
        return $this->_folders;
    }

    /**
     * Gets timezone specifier
     *
     * @return CalTZInfo
     */
    public function getTimezone()
    {
        return $this->getChild('tz');
    }

    /**
     * Sets timezone specifier
     *
     * @param  CalTZInfo $timezone
     * @return self
     */
    public function setTimezone(CalTZInfo $timezone)
    {
        return $this->setChild('tz', $timezone);
    }
}
