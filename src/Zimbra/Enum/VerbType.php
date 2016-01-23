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
 * VerbType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class VerbType extends Base
{
    /**
     * Constant for value 'ACCEPT'
     * @return string 'ACCEPT'
     */
    const ACCEPT = 'ACCEPT';

    /**
     * Constant for value 'DECLINE'
     * @return string 'DECLINE'
     */
    const DECLINE = 'DECLINE';

    /**
     * Constant for value 'TENTATIVE'
     * @return string 'TENTATIVE'
     */
    const TENTATIVE = 'TENTATIVE';

    /**
     * Constant for value 'COMPLETED'
     * @return string 'COMPLETED'
     */
    const COMPLETED = 'COMPLETED';

    /**
     * Constant for value 'DELEGATED'
     * @return string 'DELEGATED'
     */
    const DELEGATED = 'DELEGATED';
}
