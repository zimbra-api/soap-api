<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail;

use Zimbra\Soap\Client\Wsdl as ClientWsdl;

/**
 * Wsdl is a class which allows to connect Zimbra API mail functions via PHP soap extension
 * @package   Zimbra
 * @category  API
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
        $this->_client = new ClientWsdl($this->_location);
    }
}
