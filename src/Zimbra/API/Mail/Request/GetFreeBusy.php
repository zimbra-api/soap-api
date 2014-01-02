<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\FreeBusyUserSpec;
use Zimbra\Utils\TypedSequence;

/**
 * GetFreeBusy request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetFreeBusy extends Request
{
    /**
     * To view free/busy for a single folders in particular accounts, use these.
     * @var TypedSequence<FreeBusyUserSpec>
     */
    private $_usr;

    /**
     * Range start in milliseconds
     * @var int
     */
    private $_s;

    /**
     * Range end in milliseconds
     * @var int
     */
    private $_e;

    /**
     * Comma-separated list of Zimbra IDs or emails. Each value can be a Ziimbra ID or an email.
     * DEPRECATED.
     * @var string
     */
    private $_uid;

    /**
     * Comma separated list of Zimbra IDs
     * @var string
     */
    private $_id;

    /**
     * Comma separated list of Emails
     * @var string
     */
    private $_name;

    /**
     * UID of appointment to exclude from free/busy search
     * @var string
     */
    private $_excludeUid;

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
        $this->_s = (int) $s;
        $this->_e = (int) $e;
        $this->_uid = trim($uid);
        $this->_id = trim($id);
        $this->_name = trim($name);
        $this->_excludeUid = trim($excludeUid);
        $this->_usr = new TypedSequence('Zimbra\Soap\Struct\FreeBusyUserSpec', $usr);
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
            return $this->_s;
        }
        $this->_s = (int) $s;
        return $this;
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
            return $this->_e;
        }
        $this->_e = (int) $e;
        return $this;
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
            return $this->_uid;
        }
        $this->_uid = trim($uid);
        return $this;
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
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
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
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
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
            return $this->_excludeUid;
        }
        $this->_excludeUid = trim($excludeUid);
        return $this;
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

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            's' => $this->_s,
            'e' => $this->_e,
        );
        if(!empty($this->_uid))
        {
            $this->array['uid'] = $this->_uid;
        }
        if(!empty($this->_id))
        {
            $this->array['id'] = $this->_id;
        }
        if(!empty($this->_name))
        {
            $this->array['name'] = $this->_name;
        }
        if(!empty($this->_excludeUid))
        {
            $this->array['excludeUid'] = $this->_excludeUid;
        }
        if(count($this->_usr))
        {
            $this->array['usr'] = array();
            foreach ($this->_usr as $usr)
            {
                $usrArr = $usr->toArray('usr');
                $this->array['usr'][] = $usrArr['usr'];
            }
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('s', $this->_s)
                  ->addAttribute('e', $this->_e);
        if(!empty($this->_uid))
        {
            $this->xml->addAttribute('uid', $this->_uid);
        }
        if(!empty($this->_id))
        {
            $this->xml->addAttribute('id', $this->_id);
        }
        if(!empty($this->_name))
        {
            $this->xml->addAttribute('name', $this->_name);
        }
        if(!empty($this->_excludeUid))
        {
            $this->xml->addAttribute('excludeUid', $this->_excludeUid);
        }
        foreach ($this->_usr as $usr)
        {
            $this->xml->append($usr->toXml('usr'));
        }
        return parent::toXml();
    }
}
