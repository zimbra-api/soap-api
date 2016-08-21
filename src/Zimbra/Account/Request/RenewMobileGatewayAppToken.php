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
 * RenewMobileGatewayAppToken request class
 * When the app auth token expires, the app can request a new auth token.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RenewMobileGatewayAppToken extends Base
{
    /**
     * Constructor method for RenewMobileGatewayAppToken
     * @param  string $appId App ID
     * @param  string $appKey App secret key
     * @return self
     */
    public function __construct($appId, $appKey)
    {
        parent::__construct();
        $this->setChild('appId', trim($appId));
        $this->setChild('appKey', trim($appKey));
    }

    /**
     * Gets app Id
     *
     * @return string
     */
    public function getAppId()
    {
        return $this->getChild('appId');
    }

    /**
     * Sets app Id
     *
     * @param  string $appId
     * @return self
     */
    public function setAppId($appId)
    {
        return $this->setChild('appId', trim($appId));
    }

    /**
     * Gets app key
     *
     * @return string
     */
    public function getAppKey()
    {
        return $this->getChild('appKey');
    }

    /**
     * Sets app key
     *
     * @param  string $appKey
     * @return self
     */
    public function setAppKey($appKey)
    {
        return $this->setChild('appKey', trim($appKey));
    }
}
