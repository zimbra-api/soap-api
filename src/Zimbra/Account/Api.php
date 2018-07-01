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

use Zimbra\Enum\AccountBy;
use Zimbra\Enum\DistributionListBy as DistListBy;
use Zimbra\Enum\DistributionListSubscribeOp as SubscribeOp;
use Zimbra\Enum\GalSearchType as SearchType;
use Zimbra\Enum\MemberOfSelector as MemberOf;
use Zimbra\Enum\SortBy;

use Zimbra\Account\Struct\AuthAttrs;
use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Account\Struct\BlackList;
use Zimbra\Account\Struct\DistributionListSelector as DLSelector;
use Zimbra\Account\Struct\DistributionListAction as DLAction;
use Zimbra\Account\Struct\Identity;
use Zimbra\Account\Struct\NameId;
use Zimbra\Account\Struct\PreAuth;
use Zimbra\Account\Struct\Signature;
use Zimbra\Account\Struct\WhiteList;

use Zimbra\Account\Message\AuthRequest;

use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\CursorInfo;
use Zimbra\Struct\EntrySearchFilterInfo as SearchFilter;
use Zimbra\Struct\GranteeChooser;
use Zimbra\Soap\Api as AbstractApi;

/**
 * Account api class
 *
 * @package   Zimbra
 * @category  Account
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Api extends AbstractApi
{

    public function auth(
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
        return $request->execute($this->getClient());
    }

    public function authByName($name, $password = NULL)
    {
        $account = new AccountSelector(AccountBy::NAME()->value(), $name);
        return $this->auth($account, $password);
    }

    public function authByToken($authToken)
    {
        $token = ($authToken instanceof AuthToken) ? $authToken : new AuthToken($authToken);
        return $this->auth(NULL, NULL, NULL, $token);
    }
}
