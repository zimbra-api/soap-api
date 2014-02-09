<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account;

use Zimbra\Soap\Client\Wsdl as ClientWsdl;

/**
 * Wsdl is a class which allows to connect Zimbra API account functions via PHP soap extension
 *
 * @package   Zimbra
 * @category  Account
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Wsdl extends Base
{
    /**
     * Wsdl constructor.
     *
     * @param string $location The Zimbra api soap location.
     */
    public function __construct($location)
    {
        parent::__construct($location);
        $this->_client = ClientWsdl::instance($this->_location);
    }
}
