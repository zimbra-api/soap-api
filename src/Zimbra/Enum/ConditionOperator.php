<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

use MyCLabs\Enum\Enum;

/**
 * Operation enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ConditionOperator extends Enum
{
    /**
     * Constant for value 'eq'
     * @return string 'eq'
     */
    private const EQ = 'eq';

    /**
     * Constant for value 'has'
     * @return string 'has'
     */
    private const HAVE = 'has';

    /**
     * Constant for value 'ge'
     * @return string 'ge'
     */
    private const GE = 'ge';

    /**
     * Constant for value 'le'
     * @return string 'le'
     */
    private const LE = 'le';

    /**
     * Constant for value 'gt'
     * @return string 'gt'
     */
    private const GT = 'gt';

    /**
     * Constant for value 'lt'
     * @return string 'lt'
     */
    private const LT = 'lt';

    /**
     * Constant for value 'startswith'
     * @return string 'startswith'
     */
    private const STARTS_WITH = 'startswith';

    /**
     * Constant for value 'endswith'
     * @return string 'endswith'
     */
    private const ENDS_WITH = 'endswith';
}
