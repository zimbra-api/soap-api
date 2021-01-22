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
use Zimbra\Enum\GalSearchType;
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
    /**
     * Authenticate for an account
     * when specifying an account, one of <password> or <preauth> or <recoveryCode> must be specified. See preauth.txt for a discussion of preauth.
     * An authToken can be passed instead of account/password/preauth to validate an existing auth token.
     * If {verifyAccount}="1", <account> is required and the account in the auth token is compared to the named account.
     * Mismatch results in auth failure.
     * An external app that relies on ZCS for user identification can use this to test if the auth token provided by the user belongs to that user.
     * If {verifyAccount}="0" (default), only the auth token is verified and any <account> element specified is ignored. 
     *
     * @param  AccountSelector   $account
     * @param  string    $password
     * @param  string    $recoveryCode
     * @param  PreAuth   $preauth
     * @param  AuthToken $authToken
     * @param  string    $jwtToken
     * @param  string    $virtualHost
     * @param  array $prefs
     * @param  array $attrs
     * @param  string    $requestedSkin
     * @param  bool      $persistAuthTokenCookie
     * @param  bool      $csrfSupported
     * @param  string    $twoFactorCode
     * @param  bool      $deviceTrusted
     * @param  string    $trustedDeviceToken
     * @param  string    $deviceId
     * @param  bool      $generateDeviceId
     * @param  string    $tokenType
     * @return ResponseInterface
     */
    function auth(
        ?AccountSelector $account = NULL,
        ?string $password = NULL,
        ?string $recoveryCode = NULL,
        ?PreAuth $preauth = NULL,
        ?AuthToken $authToken = NULL,
        ?string $jwtToken = NULL,
        ?string $virtualHost = NULL,
        array $prefs = [],
        array $attrs = [],
        ?string $requestedSkin = NULL,
        ?bool $persistAuthTokenCookie = NULL,
        ?bool $csrfSupported = NULL,
        ?string $twoFactorCode = NULL,
        ?bool $deviceTrusted = NULL,
        ?string $trustedDeviceToken = NULL,
        ?string $deviceId = NULL,
        ?bool $generateDeviceId = NULL,
        ?string $tokenType = NULL
    ): ResponseInterface;

    /**
     * Authenticate for an account
     *
     * @param  string $name
     * @param  string $password
     * @return ResponseInterface
     */
    function authByName(string $name, string $password): ResponseInterface;

    /**
     * Authenticate for an account
     *
     * @param  string $authToken
     * @return ResponseInterface
     */
    function authByToken(string $authToken): ResponseInterface;

    /**
     * Perform an autocomplete for a name against the Global Address List
     *
     * @param  string $name
     * @param  GalSearchType $type
     * @param  bool $needCanExpand
     * @param  string $galAccountId
     * @param  int $limit
     * @return ResponseInterface
     */
    function autoComplete(
        string $name,
        ?GalSearchType $type = NULL,
        ?bool $needCanExpand = NULL,
        ?string $galAccountId = NULL,
        ?int $limit = NULL
    ): ResponseInterface;

    /**
     * Change Password
     *
     * @param  AccountSelector $account
     * @param  string $oldPassword
     * @param  string $newPassword
     * @param  string $virtualHost
     * @param  bool   $dryRun
     * @return ResponseInterface
     */
    function changePassword(
        AccountSelector $account,
        string $oldPassword,
        string $newPassword,
        ?string $virtualHost = NULL,
        ?bool $dryRun = NULL
    ): ResponseInterface;

    /**
     * Check if the authed user has the specified right(s) on a target.
     *
     * @param  array $targets
     * @return ResponseInterface
     */
    function checkRights(array $targets = []): ResponseInterface;

    /**
     * clientInfo
     *
     * @param  DomainSelector $domain
     * @return ResponseInterface
     */
    function clientInfo(DomainSelector $domain): ResponseInterface;
}
