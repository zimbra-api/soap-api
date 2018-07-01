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

use Zimbra\Account\Struct\AuthAttrs;
use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Account\Struct\PreAuth;
use Zimbra\Account\Message\AuthRequest;
use Zimbra\Account\Message\AuthBody;
use Zimbra\Soap\Message;
use Zimbra\Struct\AccountSelector;

/**
 * Auth message class
 *
 * @package   Zimbra
 * @category  Account
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AuthMessage extends Message
{
    /**
     * Constructor method for auth message
     *
     * @param  AccountSelector $account
     * @return self
     */
    public function __construct(
        AccountSelector $account = NULL,
        $password = NULL,
        PreAuth $preauth = NULL,
        AuthToken $authToken = NULL,
        $virtualHost = NULL,
        AuthPrefs $prefs = NULL,
        AuthAttrs $attrs = NULL,
        $requestedSkin = NULL,
        $persistAuthTokenCookie = NULL,
        $csrfSupported = NULL,
        $twoFactorCode = NULL,
        $deviceTrusted = NULL,
        $trustedDeviceToken = NULL,
        $deviceId = NULL,
        $generateDeviceId = NULL
    )
    {
        parent::__construct();
        $this->bodyType = 'Zimbra\Account\Message\AuthBody';
        $request = new AuthRequest(
            $account,
            $password,
            $preauth,
            $authToken,
            $virtualHost,
            $prefs,
            $attrs,
            $requestedSkin,
            $persistAuthTokenCookie,
            $csrfSupported,
            $twoFactorCode,
            $deviceTrusted,
            $trustedDeviceToken,
            $deviceId,
            $generateDeviceId
        );
        $this->setBody(new AuthBody($request));
    }
}
