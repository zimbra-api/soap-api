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
use Zimbra\Soap\Struct\Right;

/**
 * GetRights class
 * Get account level rights.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetRights extends Request
{
    /**
     * Preference value
     * @var array Array of Pref
     */
    private $_rights = array();

    /**
     * Constructor method for GetRights
     * @param array $rights
     * @return self
     */
    public function __construct(array $rights = array())
    {
        parent::__construct();
        $this->rights($rights);
    }

    /**
     * Add a right
     *
     * @param  Right $pref
     * @return self
     */
    public function addRight(Right $right)
    {
        $this->_rights[] = $right;
        return $this;
    }

    /**
     * Gets or sets prefs
     *
     * @param  array $rights
     * @return array|self
     */
    public function rights(array $rights = null)
    {
        if(null === $rights)
        {
            return $this->_rights;
        }
        $this->_rights = array();
        foreach ($rights as $right)
        {
            if($right instanceof Right)
            {
                $this->_rights[] = $right;
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
        if(count($this->_prefs))
        {
            $this->array['ace'] = array();
            foreach ($this->_rights as $right)
            {
                $rightArr = $right->toArray();
                $this->array['ace'][] = $rightArr['ace'];
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
        foreach ($this->_rights as $right)
        {
            $this->xml->append($right->toXml());
        }
        return parent::toXml();
    }
}
