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
use Zimbra\Mail\Struct\FreeBusyUserSpec;

/**
 * GetFreeBusy request class
 * Get Free/Busy information. 
 * For accounts listed using uid,id or name attributes, f/b search will be done for all calendar name.
 * To view free/busy for a single folder in a particular account, use <usr>
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetFreeBusy extends Base
{
    /**
     * To view free/busy for a single name in particular accounts, use these.
     * @var TypedSequence<FreeBusyUserSpec>
     */
    private $_freebusyUsers;

    /**
     * Constructor method for GetFolder
     * @param  int $startTime
     * @param  int $endTime
     * @param  string $uid
     * @param  string $id
     * @param  string $name
     * @param  string $excludeUid
     * @param  array  $usr
     * @return self
     */
    public function __construct(
        $startTime,
        $endTime,
        $uid = null,
        $id = null,
        $name = null,
        $excludeUid = null,
        array $users = array()
    )
    {
        parent::__construct();
        $this->setProperty('s', (int) $startTime);
        $this->setProperty('e', (int) $endTime);
        if(null !== $uid)
        {
            $this->setProperty('uid', trim($uid));
        }
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $excludeUid)
        {
            $this->setProperty('excludeUid', trim($excludeUid));
        }
        $this->setFreebusyUsers($users);

        $this->on('before', function(Base $sender)
        {
            if($sender->getFreebusyUsers()->count())
            {
                $sender->setChild('usr', $sender->getFreebusyUsers()->all());
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
     * Gets uid
     *
     * @return string
     */
    public function getUid()
    {
        return $this->getProperty('uid');
    }

    /**
     * Sets uid
     *
     * @param  string $uid
     * @return self
     */
    public function setUid($uid)
    {
        return $this->setProperty('uid', trim($uid));
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
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets exclude uid
     *
     * @return string
     */
    public function getExcludeUid()
    {
        return $this->getProperty('excludeUid');
    }

    /**
     * Sets exclude uid
     *
     * @param  string $excludeUid
     * @return self
     */
    public function setExcludeUid($excludeUid)
    {
        return $this->setProperty('excludeUid', trim($excludeUid));
    }

    /**
     * Add user spec
     *
     * @param  FreeBusyUserSpec $user
     * @return self
     */
    public function addFreebusyUser(FreeBusyUserSpec $user)
    {
        $this->_freebusyUsers->add($user);
        return $this;
    }

    /**
     * Sets user spec sequence
     *
     * @param  array $users
     * @return self
     */
    public function setFreebusyUsers(array $users)
    {
        $this->_freebusyUsers = new TypedSequence('Zimbra\Mail\Struct\FreeBusyUserSpec', $users);
        return $this;
    }

    /**
     * Gets user spec sequence
     *
     * @return Sequence
     */
    public function getFreebusyUsers()
    {
        return $this->_freebusyUsers;
    }
}
