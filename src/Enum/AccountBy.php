<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

use MyCLabs\Enum\Enum;

/**
 * AccountBy enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AccountBy extends NameIdBy
{
    /**
     * Constant for value 'adminName'
     * @return string 'adminName'
     */
    private const ADMIN_NAME = 'adminName';

    /**
     * Constant for value 'appAdminName'
     * @return string 'appAdminName'
     */
    private const APP_ADMIN_NAME = 'appAdminName';

    /**
     * Constant for value 'foreignPrincipal'
     * @return string 'foreignPrincipal'
     */
    private const FOREIGN_PRINCIPAL = 'foreignPrincipal';

    /**
     * Constant for value 'krb5Principal'
     * @return string 'krb5Principal'
     */
    private const KRB5_PRINCIPAL = 'krb5Principal';
}
