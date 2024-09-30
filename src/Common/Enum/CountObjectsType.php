<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Enum;

use MyCLabs\Enum\Enum;

/**
 * CountObjectsType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CountObjectsType extends Enum
{
    /**
     * Constant for value 'userAccount'
     * @return string 'userAccount'
     */
    protected const USER_ACCOUNT = "userAccount";

    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    protected const ACCOUNT = "account";

    /**
     * Constant for value 'alias'
     * @return string 'alias'
     */
    protected const ALIAS = "alias";

    /**
     * Constant for value 'dl'
     * @return string 'dl'
     */
    protected const DL = "dl";

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    protected const DOMAIN = "domain";

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    protected const COS = "cos";

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    protected const SERVER = "server";

    /**
     * Constant for value 'calresource'
     * @return string 'calresource'
     */
    protected const CALRESOURCE = "calresource";

    /**
     * Constant for value 'accountOnUCService'
     * @return string 'accountOnUCService'
     */
    protected const ACCOUNT_ON_UCSERVICE = "accountOnUCService";

    /**
     * Constant for value 'cosOnUCService'
     * @return string 'cosOnUCService'
     */
    protected const COS_ON_UCSERVICE = "cosOnUCService";

    /**
     * Constant for value 'domainOnUCService'
     * @return string 'domainOnUCService'
     */
    protected const DOMAIN_ON_UCSERVICE = "domainOnUCService";

    /**
     * Constant for value 'internalUserAccount'
     * @return string 'internalUserAccount'
     */
    protected const INTERNAL_USER_ACCOUNT = "internalUserAccount";

    /**
     * Constant for value 'internalArchivingAccount'
     * @return string 'internalArchivingAccount'
     */
    protected const INTERNAL_ARCHIVING_ACCOUNT = "internalArchivingAccount";

    /**
     * Constant for value 'internalUserAccountX'
     * @return string 'internalUserAccountX'
     */
    protected const INTERNAL_USER_ACCOUNT_X = "internalUserAccountX";
}
