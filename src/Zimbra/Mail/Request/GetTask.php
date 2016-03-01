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
     * @param  bool $includeInvites
     * @param  string $uid
     * @param  string $id
     * @return self
     */
    public function __construct(
        $sync = null,
        $includeContent = null,
        $includeInvites = null,
        $uid = null,
        $id = null
    )
    {
        parent::__construct();
        if(null !== $sync)
        {
            $this->setProperty('sync', (bool) $sync);
        }
        if(null !== $includeContent)
        {
            $this->setProperty('includeContent', (bool) $includeContent);
        }
        if(null !== $includeInvites)
        {
            $this->setProperty('includeInvites', (bool) $includeInvites);
        }
        if(null !== $uid)
        {
            $this->setProperty('uid', trim($uid));
        }
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
    }

    /**
     * Gets sync
     *
     * @return bool
     */
    public function getSync()
    {
        return $this->getProperty('sync');
    }

    /**
     * Sets sync
     *
     * @param  bool $sync
     * @return self
     */
    public function setSync($sync)
    {
        return $this->setProperty('sync', (bool) $sync);
    }

    /**
     * Gets include content
     *
     * @return bool
     */
    public function getIncludeContent()
    {
        return $this->getProperty('includeContent');
    }

    /**
     * Sets include content
     *
     * @param  bool $includeContent
     * @return self
     */
    public function setIncludeContent($includeContent)
    {
        return $this->setProperty('includeContent', (bool) $includeContent);
    }

    /**
     * Gets include invites
     *
     * @return bool
     */
    public function getIncludeInvites()
    {
        return $this->getProperty('includeInvites');
    }

    /**
     * Sets include invites
     *
     * @param  bool $includeInvites
     * @return self
     */
    public function setIncludeInvites($includeInvites)
    {
        return $this->setProperty('includeInvites', (bool) $includeInvites);
    }

    /**
     * Gets iCalendar UID
     *
     * @return string
     */
    public function getUid()
    {
        return $this->getProperty('uid');
    }

    /**
     * Sets iCalendar UID
     *
     * @param  string $uid
     * @return self
     */
    public function setUid($uid)
    {
        return $this->setProperty('uid', trim($uid));
    }

    /**
     * Gets appointment ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets appointment ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }
}
