<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

/**
 * BootstrapMobileGatewayApp request class
 * Request is used by a mobile gateway app/client to bootstrap/initialize itself.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class BootstrapMobileGatewayApp extends Base
{
    /**
     * Constructor method for BootstrapMobileGatewayApp
     * @param bool $wantAppToken Whether an "anticipatory app account" auth token is desired
     * @return self
     */
    public function __construct($wantAppToken = null)
    {
        parent::__construct();
        if(null !== $wantAppToken)
        {
            $this->setProperty('wantAppToken', (bool) $wantAppToken);
        }
    }

    /**
     * Gets the wantAppToken
     *
     * @return bool
     */
    public function getWantAppToken()
    {
        return $this->getProperty('wantAppToken');
    }

    /**
     * Sets the wantAppToken
     *
     * @param  bool $wantAppToken
     * @return self
     */
    public function setWantAppToken($wantAppToken)
    {
        return $this->setProperty('wantAppToken', (bool) $wantAppToken);
    }
}
