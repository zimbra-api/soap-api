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
use Zimbra\Soap\Struct\ExchangeAuthSpec as Exchange;

/**
 * CheckExchangeAuth class
 * Check Exchange Authorisation.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckExchangeAuth extends Request
{
    /**
     * Exchange Auth details
     * @var Exchange
     */
    private $_auth;

    /**
     * Constructor method for CheckExchangeAuth
     * @param Exchange $auth
     * @return self
     */
    public function __construct(Exchange $auth)
    {
        parent::__construct();
        $this->_auth = $auth;
    }

    /**
     * Gets or sets auth
     *
     * @param  Exchange $auth
     * @return Exchange|self
     */
    public function auth(Exchange $auth = null)
    {
        if(null === $auth)
        {
            return $this->_auth;
        }
        $this->_auth = $auth;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_auth->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_auth->toXml());
        return parent::toXml();
    }
}
