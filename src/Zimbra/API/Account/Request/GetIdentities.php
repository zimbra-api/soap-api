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
use Zimbra\Soap\Struct\Identity;

/**
 * GetIdentities class
 * Get the identities for the authed account.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetIdentities extends Request
{
    /**
     * Identities
     * @var array
     */
    private $_identities = array();

    /**
     * Constructor method for GetIdentities
     * @param array $identities
     * @return self
     */
    public function __construct(array $identities = array())
    {
        parent::__construct();
        $this->identities($identities);
    }

    /**
     * Gets or sets identity
     *
     * @param  Identity $identity
     * @return self
     */
    public function addIdentity(Identity $identity)
    {
        $this->_identities[] = $identity;
        return $this;
    }

    /**
     * Gets or sets identity
     *
     * @param  array $identities
     * @return array|self
     */
    public function identities(array $identities = null)
    {
        if(null === $identities)
        {
            return $this->_identities;
        }
        $this->_identities = array();
        foreach ($identities as $identity)
        {
            if($identity instanceof Identity)
            {
                $this->_identities[] = $identity;
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
        if(count($this->_identities))
        {
            $this->array['identity'] = array();
            foreach ($this->_identities as $identity)
            {
                $identityArr = $identity->toArray();
                $this->array['identity'][] = $identityArr['identity'];
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
        foreach ($this->_identities as $identity)
        {
            $this->xml->append($identity->toXml());
        }
        return parent::toXml();
    }
}
