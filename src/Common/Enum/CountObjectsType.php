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

/**
 * CountObjectsType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum CountObjectsType: string
{
    /**
     * Constant for value 'userAccount'
     * @return string 'userAccount'
     */
    case USER_ACCOUNT = 'userAccount';

    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    case ACCOUNT = 'account';

    /**
     * Constant for value 'alias'
     * @return string 'alias'
     */
    case ALIAS = 'alias';

    /**
     * Constant for value 'dl'
     * @return string 'dl'
     */
    case DL = 'dl';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    case DOMAIN = 'domain';

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    case COS = 'cos';

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    case SERVER = 'server';

    /**
     * Constant for value 'calresource'
     * @return string 'calresource'
     */
    case CALRESOURCE = 'calresource';

    /**
     * Constant for value 'accountOnUCService'
     * @return string 'accountOnUCService'
     */
    case ACCOUNT_ON_UCSERVICE = 'accountOnUCService';

    /**
     * Constant for value 'cosOnUCService'
     * @return string 'cosOnUCService'
     */
    case COS_ON_UCSERVICE = 'cosOnUCService';

    /**
     * Constant for value 'domainOnUCService'
     * @return string 'domainOnUCService'
     */
    case DOMAIN_ON_UCSERVICE = 'domainOnUCService';

    /**
     * Constant for value 'internalUserAccount'
     * @return string 'internalUserAccount'
     */
    case INTERNAL_USER_ACCOUNT = 'internalUserAccount';

    /**
     * Constant for value 'internalArchivingAccount'
     * @return string 'internalArchivingAccount'
     */
    case INTERNAL_ARCHIVING_ACCOUNT = 'internalArchivingAccount';

    /**
     * Constant for value 'internalUserAccountX'
     * @return string 'internalUserAccountX'
     */
    case INTERNAL_USER_ACCOUNT_X = 'internalUserAccountX';
}
