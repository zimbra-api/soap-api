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
 * RecoveryAccountOperation enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RecoveryAccountOperation extends Enum
{
    /**
     * Constant for value 'sendCode'
     * @return string 'sendCode'
     */
    protected const SEND_CODE = "sendCode";

    /**
     * Constant for value 'validateCode'
     * @return string 'validateCode'
     */
    protected const VALIDATE_CODE = "validateCode";

    /**
     * Constant for value 'resendCode'
     * @return string 'resendCode'
     */
    protected const RESEND_CODE = "resendCode";

    /**
     * Constant for value 'reset'
     * @return string 'reset'
     */
    protected const RESET = "reset";
}
