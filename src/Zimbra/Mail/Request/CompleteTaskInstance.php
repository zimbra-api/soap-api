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

use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DtTimeInfo;

/**
 * CompleteTaskInstance request class
 * Complete a task instance
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CompleteTaskInstance extends Base
{
    /**
     * Constructor method for CompleteTaskInstance
     * @param  string $id
     * @param  DtTimeInfo $exceptId
     * @param  CalTZInfo $tz
     * @return self
     */
    public function __construct(
        $id,
        DtTimeInfo $exceptId,
        CalTZInfo $tz = null
    )
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setChild('exceptId', $exceptId);
        if($tz instanceof CalTZInfo)
        {
            $this->setChild('tz', $tz);
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
     * Gets exception ID
     *
     * @return DtTimeInfo
     */
    public function getExceptionId()
    {
        return $this->getChild('exceptId');
    }

    /**
     * Sets exception ID
     *
     * @param  DtTimeInfo $exceptId
     * @return self
     */
    public function setExceptionId(DtTimeInfo $exceptId)
    {
        return $this->setChild('exceptId', $exceptId);
    }

    /**
     * Gets timezone information
     *
     * @return CalTZInfo
     */
    public function getTimezone()
    {
        return $this->getChild('tz');
    }

    /**
     * Sets timezone information
     *
     * @param  CalTZInfo $tz
     * @return self
     */
    public function setTimezone(CalTZInfo $tz)
    {
        return $this->setChild('tz', $tz);
    }
}
