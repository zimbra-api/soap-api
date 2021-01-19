<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account;

use Zimbra\Account\Struct\{
    AuthToken,
    PreAuth
};
use Zimbra\Soap\{ApiInterface, ResponseInterface};
use Zimbra\Struct\AccountSelector;

/**
 * AccountApiInterface interface
 *
 * @package   Zimbra
 * @category  Account
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface AccountApiInterface extends ApiInterface
{
    function auth(
        AccountSelector $account = NULL,
        $password = NULL,
        $recoveryCode = NULL,
        PreAuth $preauth = NULL,
        AuthToken $authToken = NULL,
        $jwtToken = NULL,
        $virtualHost = NULL,
        array $prefs = [],
        array $attrs = [],
        $requestedSkin = NULL,
        $persistAuthTokenCookie = NULL,
        $csrfSupported = NULL,
        $twoFactorCode = NULL,
        $deviceTrusted = NULL,
        $trustedDeviceToken = NULL,
        $deviceId = NULL,
        $generateDeviceId = NULL,
        $tokenType = NULL
    ): ResponseInterface;

    function authByName($name, $password = NULL): ResponseInterface;

    function authByToken($authToken): ResponseInterface;
}
