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
use Zimbra\Utils\TypedSequence;

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
     * @var TypedSequence
     */
    private $_whiteList = array();

    /**
     * Black list
     * @var TypedSequence
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
        $this->_whiteList = new TypedSequence('Zimbra\Soap\Struct\OpValue', $whiteList);
        $this->_blackList = new TypedSequence('Zimbra\Soap\Struct\OpValue', $blackList);
    }

    /**
     * Add an address to whiteList
     *
     * @param  OpValue $addr
     * @return self
     */
    public function addToWhiteList(OpValue $addr)
    {
        $this->_whiteList->add($addr);
        return $this;
    }

    /**
     * Gets white list sequence
     *
     * @return Sequence
     */
    public function whiteList()
    {
        return $this->_whiteList;
    }

    /**
     * Add an address to blackList
     *
     * @param  OpValue $addr
     * @return self
     */
    public function addToBlackList(OpValue $addr)
    {
        $this->_blackList->add($addr);
        return $this;
    }

    /**
     * Gets black list Sequence
     *
     * @return Sequence
     */
    public function blackList()
    {
        return $this->_blackList;
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
