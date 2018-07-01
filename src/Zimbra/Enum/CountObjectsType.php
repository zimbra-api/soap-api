<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

/**
 * CountObjectsType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CountObjectsType extends Base
{
    /**
     * Constant for value 'userAccount'
     * @return string 'userAccount'
     */
    const USER_ACCOUNT = 'userAccount';

    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    const ACCOUNT = 'account';

    /**
     * Constant for value 'alias'
     * @return string 'alias'
     */
    const ALIAS = 'alias';

    /**
     * Constant for value 'dl'
     * @return string 'dl'
     */
    const DL = 'dl';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    const DOMAIN = 'domain';

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    const COS = 'cos';

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    const SERVER = 'server';

    /**
     * Constant for value 'calresource'
     * @return string 'calresource'
     */
    const CALRESOURCE = 'calresource';

    /**
     * Constant for value 'accountOnUCService'
     * @return string 'accountOnUCService'
     */
    const ACCOUNT_ON_UCSERVICE = 'accountOnUCService';

    /**
     * Constant for value 'cosOnUCService'
     * @return string 'cosOnUCService'
     */
    const COS_ON_UCSERVICE = 'cosOnUCService';

    /**
     * Constant for value 'domainOnUCService'
     * @return string 'domainOnUCService'
     */
    const DOMAIN_ON_UCSERVICE = 'domainOnUCService';

    /**
     * Constant for value 'internalUserAccount'
     * @return string 'internalUserAccount'
     */
    const INTERNAL_USER_ACCOUNT = 'internalUserAccount';

    /**
     * Constant for value 'internalArchivingAccount'
     * @return string 'internalArchivingAccount'
     */
    const INTERNAL_ARCHIVING_ACCOUNT = 'internalArchivingAccount';
}
