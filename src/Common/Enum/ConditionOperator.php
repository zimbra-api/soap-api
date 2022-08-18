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
 * Operation enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum ConditionOperator: string
{
    /**
     * Constant for value 'eq'
     * @return string 'eq'
     */
    case EQ = 'eq';

    /**
     * Constant for value 'has'
     * @return string 'has'
     */
    case HAVE = 'has';

    /**
     * Constant for value 'ge'
     * @return string 'ge'
     */
    case GE = 'ge';

    /**
     * Constant for value 'le'
     * @return string 'le'
     */
    case LE = 'le';

    /**
     * Constant for value 'gt'
     * @return string 'gt'
     */
    case GT = 'gt';

    /**
     * Constant for value 'lt'
     * @return string 'lt'
     */
    case LT = 'lt';

    /**
     * Constant for value 'startswith'
     * @return string 'startswith'
     */
    case STARTS_WITH = 'startswith';

    /**
     * Constant for value 'endswith'
     * @return string 'endswith'
     */
    case ENDS_WITH = 'endswith';
}
