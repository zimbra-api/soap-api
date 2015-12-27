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
 * MdsConnectionType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MdsConnectionType extends Base
{
    /**
     * Constant for value 'cleartext'
     * @return string 'cleartext'
     */
    const CLEAR_TEXT = 'cleartext';

    /**
     * Constant for value 'ssl'
     * @return string 'ssl'
     */
    const SSL = 'ssl';

    /**
     * Constant for value 'tls'
     * @return string 'tls'
     */
    const TLS = 'tls';

    /**
     * Constant for value 'tls_is_available'
     * @return string 'tls_is_available'
     */
    const TLS_IS_AVAILABLE = 'tls_is_available';
}