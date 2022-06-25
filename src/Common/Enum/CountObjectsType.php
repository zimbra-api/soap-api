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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CountObjectsType extends Enum
{
    /**
     * Constant for value 'userAccount'
     * @return string 'userAccount'
     */
    private const USER_ACCOUNT = 'userAccount';

    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    private const ACCOUNT = 'account';

    /**
     * Constant for value 'alias'
     * @return string 'alias'
     */
    private const ALIAS = 'alias';

    /**
     * Constant for value 'dl'
     * @return string 'dl'
     */
    private const DL = 'dl';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    private const DOMAIN = 'domain';

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    private const COS = 'cos';

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    private const SERVER = 'server';

    /**
     * Constant for value 'calresource'
     * @return string 'calresource'
     */
    private const CALRESOURCE = 'calresource';

    /**
     * Constant for value 'accountOnUCService'
     * @return string 'accountOnUCService'
     */
    private const ACCOUNT_ON_UCSERVICE = 'accountOnUCService';

    /**
     * Constant for value 'cosOnUCService'
     * @return string 'cosOnUCService'
     */
    private const COS_ON_UCSERVICE = 'cosOnUCService';

    /**
     * Constant for value 'domainOnUCService'
     * @return string 'domainOnUCService'
     */
    private const DOMAIN_ON_UCSERVICE = 'domainOnUCService';

    /**
     * Constant for value 'internalUserAccount'
     * @return string 'internalUserAccount'
     */
    private const INTERNAL_USER_ACCOUNT = 'internalUserAccount';

    /**
     * Constant for value 'internalArchivingAccount'
     * @return string 'internalArchivingAccount'
     */
    private const INTERNAL_ARCHIVING_ACCOUNT = 'internalArchivingAccount';

    /**
     * Constant for value 'internalUserAccountX'
     * @return string 'internalUserAccountX'
     */
    private const INTERNAL_USER_ACCOUNT_X = 'internalUserAccountX';
}
