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
 * Operation enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConditionOperator extends Base
{
    /**
     * Constant for value 'eq'
     * @return string 'eq'
     */
    const EQ = 'eq';

    /**
     * Constant for value 'has'
     * @return string 'has'
     */
    const HAVE = 'has';

    /**
     * Constant for value 'ge'
     * @return string 'ge'
     */
    const GE = 'ge';

    /**
     * Constant for value 'le'
     * @return string 'le'
     */
    const LE = 'le';

    /**
     * Constant for value 'gt'
     * @return string 'gt'
     */
    const GT = 'gt';

    /**
     * Constant for value 'lt'
     * @return string 'lt'
     */
    const LT = 'lt';

    /**
     * Constant for value 'startswith'
     * @return string 'startswith'
     */
    const STARTS_WITH = 'startswith';

    /**
     * Constant for value 'endswith'
     * @return string 'endswith'
     */
    const ENDS_WITH = 'endswith';
}
