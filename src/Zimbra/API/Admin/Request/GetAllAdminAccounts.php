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
use Zimbra\Soap\Struct\AccountSelector as Account;

/**
 * GetAllAdminAccounts class
 * Get all Admin accounts.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllAdminAccounts extends Request
{
    /**
     * Flag whether or not to apply class of service (COS) rules
     * @var bool
     */
    private $_applyCos;

    /**
     * Constructor method for GetAllAdminAccounts
     * @param  bool $applyCos
     * @return self
     */
    public function __construct($applyCos = null)
    {
        parent::__construct();
        if(null !== $applyCos)
        {
            $this->_applyCos = (bool) $applyCos;
        }
    }

    /**
     * Gets or sets applyCos
     *
     * @param  bool $applyCos
     * @return bool|self
     */
    public function applyCos($applyCos = null)
    {
        if(null === $applyCos)
        {
            return $this->_applyCos;
        }
        $this->_applyCos = (bool) $applyCos;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_applyCos))
        {
            $this->array['applyCos'] = $this->_applyCos ? 1 : 0;
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
        if(is_bool($this->_applyCos))
        {
            $this->xml->addAttribute('applyCos', $this->_applyCos ? 1 : 0);
        }
        return parent::toXml();
    }
}
