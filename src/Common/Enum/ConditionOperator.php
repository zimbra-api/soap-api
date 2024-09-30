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
 * Operation enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConditionOperator extends Enum
{
    /**
     * Constant for value 'eq'
     * @return string 'eq'
     */
    protected const EQUAL = "eq";

    /**
     * Constant for value 'has'
     * @return string 'has'
     */
    protected const HAS = "has";

    /**
     * Constant for value 'ge'
     * @return string 'ge'
     */
    protected const GREATER_EQUAL = "ge";

    /**
     * Constant for value 'le'
     * @return string 'le'
     */
    protected const LESS_EQUAL = "le";

    /**
     * Constant for value 'gt'
     * @return string 'gt'
     */
    protected const GREATER_THAN = "gt";

    /**
     * Constant for value 'lt'
     * @return string 'lt'
     */
    protected const LESS_THAN = "lt";

    /**
     * Constant for value 'startswith'
     * @return string 'startswith'
     */
    protected const STARTS_WITH = "startswith";

    /**
     * Constant for value 'endswith'
     * @return string 'endswith'
     */
    protected const ENDS_WITH = "endswith";
}
