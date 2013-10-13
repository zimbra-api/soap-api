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
use Zimbra\Utils\TypedSequence;

/**
 * GrantRights class
 * Grant account level rights
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GrantRights extends Request
{
    /**
     * Specify Access Control Entries
     * @var array
     */
    private  $_aces = array();
    /**
     * Constructor method for grantRights
     * @param array $aces
     * @return self
     */
    public function __construct(array $aces = array())
    {
        parent::__construct();
        $this->_aces = new TypedSequence('Zimbra\Soap\Struct\AccountACEInfo', $aces);
    }

    /**
     * Add an ace
     *
     * @param  ACE $ace
     * @return self
     */
    public function addAce(ACE $ace)
    {
        $this->_aces->add($ace);
        return $this;
    }

    /**
     * Gets ace sequence
     *
     * @return Sequence
     */
    public function aces()
    {
        return $this->_aces;
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
