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
 * MemberOfSelector enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MemberOfSelector extends Base
{
    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    const ALL = 'all';
    /**
     * Constant for value 'directOnly'
     * @return string 'directOnly'
     */
    const DIRECT_ONLY = 'directOnly';
    /**
     * Constant for value 'none'
     * @return string 'none'
     */
    const NONE = 'none';
}
