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
use Zimbra\Soap\Request;

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
class GetFreeBusy extends Request
{
    /**
     * To view free/busy for a single name in particular accounts, use these.
     * @var TypedSequence<FreeBusyUserSpec>
     */
    private $_usr;

    /**
     * Constructor method for GetFolder
     * @param  int $s
     * @param  int $e
     * @param  string $uid
     * @param  string $id
     * @param  string $name
     * @param  string $excludeUid
     * @param  array  $usr
     * @return self
     */
    public function __construct(
        $s,
        $e,
        $uid = null,
        $id = null,
        $name = null,
        $excludeUid = null,
        array $usr = array()
    )
    {
        parent::__construct();
        $this->property('s', (int) $s);
        $this->property('e', (int) $e);
        if(null !== $uid)
        {
            $this->property('uid', trim($uid));
        }
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $excludeUid)
        {
            $this->property('excludeUid', trim($excludeUid));
        }
        $this->_usr = new TypedSequence('Zimbra\Mail\Struct\FreeBusyUserSpec', $usr);

        $this->addHook(function($sender)
        {
            if(count($sender->usr()))
            {
                $sender->child('usr', $sender->usr()->all());
            }
        });
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

    /**
     * Gets or sets uid
     *
     * @param  string $uid
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
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets excludeUid
     *
     * @param  string $excludeUid
     * @return string|self
     */
    public function excludeUid($excludeUid = null)
    {
        if(null === $excludeUid)
        {
            return $this->property('excludeUid');
        }
        return $this->property('excludeUid', trim($excludeUid));
    }

    /**
     * Add usr
     *
     * @param  FreeBusyUserSpec $usr
     * @return self
     */
    public function addUsr(FreeBusyUserSpec $usr)
    {
        $this->_usr->add($usr);
        return $this;
    }

    /**
     * Gets filter rule sequence
     *
     * @return Sequence
     */
    public function usr()
    {
        return $this->_usr;
    }
}
