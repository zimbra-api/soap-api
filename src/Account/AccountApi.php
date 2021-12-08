<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Zimbra\Account;

use Zimbra\Enum\{
    AccountBy,
    DistributionListBy,
    DistributionListSubscribeOp,
    GalSearchType,
    MemberOfSelector,
    SortBy
};

use Zimbra\Account\Struct\{
    AuthAttrs,
    AuthPrefs,
    AuthToken,
    BlackList,
    DistributionListSelector,
    DistributionListAction,
    Identity,
    NameId,
    PreAuth,
    Signature,
    WhiteList
};

use Zimbra\Account\Message\AuthRequest;

use Zimbra\Struct\{
    AccountSelector,
    CursorInfo,
    EntrySearchFilterInfo,
    GranteeChooser
};

use Zimbra\Soap\AbstractApi;

/**
 * Account api class
 *
 * @package   Zimbra
 * @category  Account
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
class AccountApi extends AbstractApi implements AccountApiInterface
{
    public function auth(
        AccountSelector $account = NULL,
        $password = NULL,
        $recoveryCode = NULL,
        PreAuth $preauth = NULL,
        AuthToken $authToken = NULL,
        $jwtToken = NULL,
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
        $generateDeviceId = NULL,
        $tokenType = NULL
    )
    {
        $request = new AuthRequest(
            $account,
            $password,
            $recoveryCode,
            $preauth,
            $authToken,
            $jwtToken,
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
            $generateDeviceId,
            $tokenType
        );
        return $this->invoke($request);
    }

    public function authByName($name, $password = NULL)
    {
        $account = new AccountSelector(AccountBy::NAME()->getValue(), $name);
        return $this->auth($account, $password);
    }

    public function authByToken($authToken)
    {
        $token = ($authToken instanceof AuthToken) ? $authToken : new AuthToken($authToken);
        return $this->auth(NULL, NULL, NULL, $token);
    }
}
