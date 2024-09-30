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
 * LoggingLevel enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum LoggingLevel: string
{
    /**
     * Constant for value 'error'
     * @return string 'error'
     */
    case ERROR = "error";
    /**
     * Constant for value 'warn'
     * @return string 'warn'
     */
    case WARN = "warn";
    /**
     * Constant for value 'info'
     * @return string 'info'
     */
    case INFO = "info";
    /**
     * Constant for value 'debug'
     * @return string 'debug'
     */
    case DEBUG = "debug";
    /**
     * Constant for value 'trace'
     * @return string 'trace'
     */
    case TRACE = "trace";
}
