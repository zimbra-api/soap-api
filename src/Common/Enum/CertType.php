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
 * CertType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CertType extends Enum
{
    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    private const ALL = 'all';

    /**
     * Constant for value 'mta'
     * @return string 'mta'
     */
    private const MTA = 'mta';

    /**
     * Constant for value 'ldap'
     * @return string 'ldap'
     */
    private const LDAP = 'ldap';

    /**
     * Constant for value 'mailboxd'
     * @return string 'mailboxd'
     */
    private const MAILBOXD = 'mailboxd';

    /**
     * Constant for value 'proxy'
     * @return string 'proxy'
     */
    private const PROXY = 'proxy';

    /**
     * Constant for value 'staged'
     * @return string 'staged'
     */
    private const STAGED = 'staged';
}
