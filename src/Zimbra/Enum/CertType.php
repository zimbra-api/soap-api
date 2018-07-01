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
 * CertType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CertType extends Base
{
    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    const ALL = 'all';

    /**
     * Constant for value 'mta'
     * @return string 'mta'
     */
    const MTA = 'mta';

    /**
     * Constant for value 'ldap'
     * @return string 'ldap'
     */
    const LDAP = 'ldap';

    /**
     * Constant for value 'mailboxd'
     * @return string 'mailboxd'
     */
    const MAILBOXD = 'mailboxd';

    /**
     * Constant for value 'proxy'
     * @return string 'proxy'
     */
    const PROXY = 'proxy';

    /**
     * Constant for value 'staged'
     * @return string 'staged'
     */
    const STAGED = 'staged';
}
