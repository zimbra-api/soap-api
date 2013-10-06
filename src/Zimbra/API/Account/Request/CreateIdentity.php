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
 * CreateIdentity class
 * Create an Identity
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateIdentity extends Request
{
    /**
     * Details of the new identity to create
     * @var Identity
     */
    private $_identity;

    /**
     * Constructor method for CreateIdentity
     * @param Identity $identity
     * @return self
     */
    public function __construct(Identity $identity)
    {
        parent::__construct();
        $this->_identity = $identity;
    }

    /**
     * Gets or sets identity
     *
     * @param  Identity $identity
     * @return Identity|self
     */
    public function identity(Identity $identity = null)
    {
        if(null === $identity)
        {
            return $this->_identity;
        }
        $this->_identity = $identity;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_identity->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_identity->toXml());
        return parent::toXml();
    }
}
