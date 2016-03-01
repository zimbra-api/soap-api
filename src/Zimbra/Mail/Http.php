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

use Zimbra\Enum\RequestFormat;
use Zimbra\Soap\Client\Http as ClientHttp;

/**
 * Http is a class which allows to connect Zimbra API mail functions via SOAP using pecl_http extension
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Http extends Base
{
    /**
     * Http constructor.
     *
     * @param string $location The Zimbra api soap location.
     * @param RequestFormat $format The request format.
     */
    public function __construct($location, RequestFormat $format = null)
    {
        parent::__construct($location);
        $this->setClient(ClientHttp::instance($this->getLocation()));
        if($format instanceof RequestFormat)
        {
            $this->getClient()->setFormat($format);
        }
    }
}
