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
 * ActionGrantRight enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum ActionGrantRight: string
{
    /**
     * Constant for value 'r'
     * @return string 'r'
     */
    case READ = "r";

    /**
     * Constant for value 'w'
     * @return string 'w'
     */
    case WRITE = "w";

    /**
     * Constant for value 'i'
     * @return string 'i'
     */
    case INSERT = "i";

    /**
     * Constant for value 'd'
     * @return string 'd'
     */
    case DELETE = "d";

    /**
     * Constant for value 'a'
     * @return string 'a'
     */
    case ADMINISTER = "a";

    /**
     * Constant for value 'x'
     * @return string 'x'
     */
    case WORKFLOW_ACTION = "x";

    /**
     * Constant for value 'p'
     * @return string 'p'
     */
    case VIEW_PRIVATE = "p";

    /**
     * Constant for value 'f'
     * @return string 'f'
     */
    case VIEW_FREEBUSY = "f";

    /**
     * Constant for value 'c'
     * @return string 'c'
     */
    case CREATE_SUBFOLDER = "c";
}
