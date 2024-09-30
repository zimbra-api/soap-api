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
 * AccountBy enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum AccountBy: string
{
    /**
     * Constant for value 'id'
     * @return string 'id'
     */
    case ID = "id";

    /**
     * Constant for value 'name'
     * @return string 'name'
     */
    case NAME = "name";

    /**
     * Constant for value 'adminName'
     * @return string 'adminName'
     */
    case ADMIN_NAME = "adminName";

    /**
     * Constant for value 'appAdminName'
     * @return string 'appAdminName'
     */
    case APP_ADMIN_NAME = "appAdminName";

    /**
     * Constant for value 'foreignPrincipal'
     * @return string 'foreignPrincipal'
     */
    case FOREIGN_PRINCIPAL = "foreignPrincipal";

    /**
     * Constant for value 'krb5Principal'
     * @return string 'krb5Principal'
     */
    case KRB5_PRINCIPAL = "krb5Principal";
}
