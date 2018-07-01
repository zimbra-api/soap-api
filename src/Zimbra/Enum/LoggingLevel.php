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
 * LoggingLevel enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class LoggingLevel extends Base
{
    /**
     * Constant for value 'error'
     * @return string 'error'
     */
    const ERROR = 'error';
    /**
     * Constant for value 'warn'
     * @return string 'warn'
     */
    const WARN = 'warn';
    /**
     * Constant for value 'info'
     * @return string 'info'
     */
    const INFO = 'info';
    /**
     * Constant for value 'debug'
     * @return string 'debug'
     */
    const DEBUG = 'debug';
    /**
     * Constant for value 'trace'
     * @return string 'trace'
     */
    const TRACE = 'trace';
}
