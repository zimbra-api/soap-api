<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\OpValue;

/**
 * ModifyWhiteBlackList class
 * Modify the anti-spam WhiteList and BlackList addresses 
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyWhiteBlackList extends Request
{
    /**
     * White list
     * @var array
     */
    private $_whiteList = array();

    /**
     * Black list
     * @var array
     */
    private $_blackList = array();

    /**
     * Constructor method for ModifyWhiteBlackList
     * @param array $whiteList
     * @param array $blackList
     * @return self
     */
    public function __construct(array $whiteList = array(), array $blackList = array())
    {
        parent::__construct();
        $this->whiteList($whiteList);
        $this->blackList($blackList);
    }

    /**
     * Add an address to whiteList
     *
     * @param  OpValue $addr
     * @return self
     */
    public function addToWhiteList(OpValue $addr)
    {
        $this->_whiteList[] = $addr;
        return $this;
    }

    /**
     * Gets or sets whiteList
     *
     * @param  array $whiteList
     * @return array|self
     */
    public function whiteList(array $whiteList = null)
    {
        if(null === $whiteList)
        {
            return $this->_whiteList;
        }
        $this->_whiteList = array();
        foreach ($whiteList as $addr)
        {
            if($addr instanceof OpValue)
            {
                $this->_whiteList[] = $addr;
            }
        }
        return $this;
    }

    /**
     * Add an address to blackList
     *
     * @param  OpValue $addr
     * @return self
     */
    public function addToBlackList(OpValue $addr)
    {
        $this->_blackList[] = $addr;
        return $this;
    }

    /**
     * Gets or sets blackList
     *
     * @param  array $blackList
     * @return array|self
     */
    public function blackList(array $blackList = null)
    {
        if(null === $blackList)
        {
            return $this->_blackList;
        }
        $this->_blackList = array();
        foreach ($blackList as $addr)
        {
            if($addr instanceof OpValue)
            {
                $this->_blackList[] = $addr;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'whiteList' => array(),
            'blackList' => array(),
        );
        if(count($this->_whiteList))
        {
            $arr['addr'] = array();
            foreach ($this->_whiteList as $addr)
            {
                $arrAddr = $addr->toArray();
                $arr['addr'][] = $arrAddr['addr'];
            }
            $this->array['whiteList'] = $arr;
        }
        if(count($this->_blackList))
        {
            $arr['addr'] = array();
            foreach ($this->_blackList as $addr)
            {
                $arrAddr = $addr->toArray();
                $arr['addr'][] = $arrAddr['addr'];
            }
            $this->array['blackList'] = $arr;
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
        $whiteList = $this->xml->addChild('whiteList', null);
        $blackList = $this->xml->addChild('blackList', null);
        foreach ($this->_whiteList as $addr)
        {
            $whiteList->append($addr->toXml());
        }
        foreach ($this->_blackList as $addr)
        {
            $blackList->append($addr->toXml());
        }
        return parent::toXml();
    }
}
