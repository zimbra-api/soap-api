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
 * AccountBy enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AccountBy extends Base
{
    /**
     * Constant for value 'adminName'
     * @return string 'adminName'
     */
    const ADMIN_NAME = 'adminName';

    /**
     * Constant for value 'appAdminName'
     * @return string 'appAdminName'
     */
    const APP_ADMIN_NAME = 'appAdminName';

    /**
     * Constant for value 'id'
     * @return string 'id'
     */
    const ID = 'id';

    /**
     * Constant for value 'foreignPrincipal'
     * @return string 'foreignPrincipal'
     */
    const FOREIGN_PRINCIPAL = 'foreignPrincipal';

    /**
     * Constant for value 'name'
     * @return string 'name'
     */
    const NAME = 'name';

    /**
     * Constant for value 'krb5Principal'
     * @return string 'krb5Principal'
     */
    const KRB5_PRINCIPAL = 'krb5Principal';
}
