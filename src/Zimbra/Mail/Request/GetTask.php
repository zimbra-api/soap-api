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
 * GetTask request class
 * Get Task 
 * Similar to GetAppointmentRequest/GetAppointmentResponse
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetTask extends Base
{
    /**
     * Constructor method for GetTask
     * @param  bool $sync
     * @param  bool $includeContent
     * @param  string $uid
     * @param  string $id
     * @return self
     */
    public function __construct(
        $sync = null,
        $includeContent = null,
        $uid = null,
        $id = null
    )
    {
        parent::__construct();
        if(null !== $sync)
        {
            $this->property('sync', (bool) $sync);
        }
        if(null !== $includeContent)
        {
            $this->property('includeContent', (bool) $includeContent);
        }
        if(null !== $uid)
        {
            $this->property('uid', trim($uid));
        }
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
    }

    /**
     * Get or set sync
     * Set this to return the modified date (md) on the appointment.
     *
     * @param  bool $sync
     * @return bool|self
     */
    public function sync($sync = null)
    {
        if(null === $sync)
        {
            return $this->property('sync');
        }
        return $this->property('sync', (bool) $sync);
    }

    /**
     * Get or set includeContent
     * If set, MIME parts for body content are returned; default unset
     *
     * @param  bool $includeContent
     * @return bool|self
     */
    public function includeContent($includeContent = null)
    {
        if(null === $includeContent)
        {
            return $this->property('includeContent');
        }
        return $this->property('includeContent', (bool) $includeContent);
    }

    /**
     * Gets or sets uid
     * iCalendar UID Either id or uid should be specified, but not both
     *
     * @param  string $id
     * @return string|self
     */
    public function uid($uid = null)
    {
        if(null === $uid)
        {
            return $this->property('uid');
        }
        return $this->property('uid', trim($uid));
    }

    /**
     * Gets or sets id
     * Appointment ID. Either id or uid should be specified, but not both
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
}
