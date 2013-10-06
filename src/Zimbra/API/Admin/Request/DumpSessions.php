<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;

/**
 * DumpSessions class
 * Dump sessions.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DumpSessions extends Request
{
    /**
     * Flag whether to flush the cache
     * @var boolean
     */
    private $_listSessions;

    /**
     * Synchronous flag
     * @var boolean
     */
    private $_groupByAccount;

    /**
     * Constructor method for DumpSessions
     * @param bool $listSessions
     * @param bool $groupByAccount
     * @return self
     */
    public function __construct($listSessions = null, $groupByAccount = null)
    {
        parent::__construct();
        if(null !== $listSessions)
        {
            $this->_listSessions = (bool) $listSessions;
        }
        if(null !== $groupByAccount)
        {
            $this->_groupByAccount = (bool) $groupByAccount;
        }
    }

    /**
     * Gets or sets listSessions
     *
     * @param  bool $listSessions
     * @return bool|self
     */
    public function listSessions($listSessions = null)
    {
        if(null === $listSessions)
        {
            return $this->_listSessions;
        }
        $this->_listSessions = (bool) $listSessions;
        return $this;
    }

    /**
     * Gets or sets groupByAccount
     *
     * @param  bool $groupByAccount
     * @return bool|self
     */
    public function groupByAccount($groupByAccount = null)
    {
        if(null === $groupByAccount)
        {
            return $this->_groupByAccount;
        }
        $this->_groupByAccount = (bool) $groupByAccount;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_listSessions))
        {
            $this->array['listSessions'] = $this->_listSessions ? 1 : 0;
        }
        if(is_bool($this->_groupByAccount))
        {
            $this->array['groupByAccount'] = $this->_groupByAccount ? 1 : 0;
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
        if(is_bool($this->_listSessions))
        {
            $this->xml->addAttribute('listSessions', $this->_listSessions ? 1 : 0);
        }
        if(is_bool($this->_groupByAccount))
        {
            $this->xml->addAttribute('groupByAccount', $this->_groupByAccount ? 1 : 0);
        }
        return parent::toXml();
    }
}
