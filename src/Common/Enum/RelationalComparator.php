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
 * RelationalComparator enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RelationalComparator extends Enum
{
    /**
     * Constant for value 'gt'
     * @return string 'gt'
     */
    private const GREATER_THAN = 'gt';

    /**
     * Constant for value 'ge'
     * @return string 'ge'
     */
    private const GREATER_EQUAL = 'ge';

    /**
     * Constant for value 'lt'
     * @return string 'lt'
     */
    private const LESS_THAN = 'lt';

    /**
     * Constant for value 'le'
     * @return string 'le'
     */
    private const LESS_EQUAL = 'le';

    /**
     * Constant for value 'eq'
     * @return string 'eq'
     */
    private const EQUAL = 'eq';

    /**
     * Constant for value 'ne'
     * @return string 'ne'
     */
    private const NOT_EQUAL = 'ne';
}
