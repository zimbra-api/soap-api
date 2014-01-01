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

/**
 * GetAppointment request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAppointment extends Request
{
    /**
     * FlagSet this to return the modified date (md) on the appointment.
     * @var boolean
     */
    private $_sync;

    /**
     * SetIf set, MIME parts for body content are returned; default unset
     * @var boolean
     */
    private $_includeContent;

    /**
     * CommaiCalendar UID.
     * Either id or uid should be specified, but not both
     * @var string
     */
    private $_uid;

    /**
     * Appointment ID.
     * Either id or uid should be specified, but not both
     * @var string
     */
    private $_id;

    /**
     * Constructor method for GetAppointment
     * @param  bool   $sync
     * @param  bool   $includeContent
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
            $this->_sync = (bool) $sync;
        }
        if(null !== $includeContent)
        {
            $this->_includeContent = (bool) $includeContent;
        }
        $this->_uid = trim($uid);
        $this->_id = trim($id);
    }

    /**
     * Get or set sync
     *
     * @param  bool $sync
     * @return bool|self
     */
    public function sync($sync = null)
    {
        if(null === $sync)
        {
            return $this->_sync;
        }
        $this->_sync = (bool) $sync;
        return $this;
    }

    /**
     * Get or set includeContent
     *
     * @param  bool $includeContent
     * @return bool|self
     */
    public function includeContent($includeContent = null)
    {
        if(null === $includeContent)
        {
            return $this->_includeContent;
        }
        $this->_includeContent = (bool) $includeContent;
        return $this;
    }

    /**
     * Get or set uid
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
     * Get or set id
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_sync))
        {
            $this->array['sync'] = $this->_sync ? 1 : 0;
        }
        if(is_bool($this->_includeContent))
        {
            $this->array['includeContent'] = $this->_includeContent ? 1 : 0;
        }
        if(!empty($this->_uid))
        {
            $this->array['uid'] = $this->_uid;
        }
        if(!empty($this->_id))
        {
            $this->array['id'] = $this->_id;
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
        if(is_bool($this->_sync))
        {
            $this->xml->addAttribute('sync', $this->_sync ? 1 : 0);
        }
        if(is_bool($this->_includeContent))
        {
            $this->xml->addAttribute('includeContent', $this->_includeContent ? 1 : 0);
        }
        if(!empty($this->_uid))
        {
            $this->xml->addAttribute('uid', $this->_uid);
        }
        if(!empty($this->_id))
        {
            $this->xml->addAttribute('id', $this->_id);
        }
        return parent::toXml();
    }
}
