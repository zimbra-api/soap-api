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
 * CertType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum CertType: string
{
    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    case ALL = 'all';

    /**
     * Constant for value 'mta'
     * @return string 'mta'
     */
    case MTA = 'mta';

    /**
     * Constant for value 'ldap'
     * @return string 'ldap'
     */
    case LDAP = 'ldap';

    /**
     * Constant for value 'mailboxd'
     * @return string 'mailboxd'
     */
    case MAILBOXD = 'mailboxd';

    /**
     * Constant for value 'proxy'
     * @return string 'proxy'
     */
    case PROXY = 'proxy';

    /**
     * Constant for value 'staged'
     * @return string 'staged'
     */
    case STAGED = 'staged';
}
