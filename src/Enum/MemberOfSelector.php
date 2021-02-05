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
 * MemberOfSelector enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MemberOfSelector extends Enum
{
    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    private const ALL = 'all';
    /**
     * Constant for value 'directOnly'
     * @return string 'directOnly'
     */
    private const DIRECT_ONLY = 'directOnly';
    /**
     * Constant for value 'none'
     * @return string 'none'
     */
    private const NONE = 'none';
}