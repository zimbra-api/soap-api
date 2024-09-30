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
 * RestoreResolve enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum RestoreResolve: string
{
    /**
     * Constant for value 'ignore'
     * @return string 'ignore'
     */
    case IGNORE = "ignore";

    /**
     * Constant for value 'modify'
     * @return string 'modify'
     */
    case MODIFY = "modify";

    /**
     * Constant for value 'replace'
     * @return string 'replace'
     */
    case REPLACE = "replace";

    /**
     * Constant for value 'reset'
     * @return string 'reset'
     */
    case RESET = "reset";
}
