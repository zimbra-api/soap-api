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
 * MdsConnectionType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MdsConnectionType extends Enum
{
    /**
     * Constant for value 'cleartext'
     * @return string 'cleartext'
     */
    protected const CLEAR_TEXT = 'cleartext';

    /**
     * Constant for value 'ssl'
     * @return string 'ssl'
     */
    protected const SSL = 'ssl';

    /**
     * Constant for value 'tls'
     * @return string 'tls'
     */
    protected const TLS = 'tls';

    /**
     * Constant for value 'tls_is_available'
     * @return string 'tls_is_available'
     */
    protected const TLS_IS_AVAILABLE = 'tls_is_available';
}