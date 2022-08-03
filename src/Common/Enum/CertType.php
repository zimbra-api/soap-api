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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CertType extends Enum
{
    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    protected const ALL = 'all';

    /**
     * Constant for value 'mta'
     * @return string 'mta'
     */
    protected const MTA = 'mta';

    /**
     * Constant for value 'ldap'
     * @return string 'ldap'
     */
    protected const LDAP = 'ldap';

    /**
     * Constant for value 'mailboxd'
     * @return string 'mailboxd'
     */
    protected const MAILBOXD = 'mailboxd';

    /**
     * Constant for value 'proxy'
     * @return string 'proxy'
     */
    protected const PROXY = 'proxy';

    /**
     * Constant for value 'staged'
     * @return string 'staged'
     */
    protected const STAGED = 'staged';
}
