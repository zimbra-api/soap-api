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
use Zimbra\Soap\Struct\AccountACEInfo as ACE;

/**
 * RevokeRights class
 * Revoke account level rights
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RevokeRights extends Request
{
    /**
     * Specify Access Control Entries
     * @var array
     */
    private  $_aces = array();

    /**
     * Constructor method for RevokeRights
     * @param array $aces
     * @return self
     */
    public function __construct(array $aces = array())
    {
        parent::__construct();
        $this->aces($aces);
    }

    /**
     * Add an ace
     *
     * @param  ACE $ace
     * @return self
     */
    public function addAce(ACE $ace)
    {
        $this->_aces[] = $ace;
        return $this;
    }

    /**
     * Gets or sets aces
     *
     * @param  array $aces
     * @return array|self
     */
    public function aces(array $aces = null)
    {
        if(null === $aces)
        {
            return $this->_aces;
        }
        $this->_aces = array();
        foreach ($aces as $ace)
        {
            if($ace instanceof ACE)
            {
                $this->_aces[] = $ace;
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
        if(count($this->_aces))
        {
            $this->array['ace'] = array();
            foreach ($this->_aces as $ace)
            {
                $aceArr = $ace->toArray();
                $this->array['ace'][] = $aceArr['ace'];
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
        foreach ($this->_aces as $ace)
        {
            $this->xml->append($ace->toXml());
        }
        return parent::toXml();
    }
}
