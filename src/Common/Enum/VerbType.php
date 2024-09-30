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
 * VerbType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum VerbType: string
{
    /**
     * Constant for value 'ACCEPT'
     * @return string 'ACCEPT'
     */
    case ACCEPT = "ACCEPT";

    /**
     * Constant for value 'DECLINE'
     * @return string 'DECLINE'
     */
    case DECLINE = "DECLINE";

    /**
     * Constant for value 'TENTATIVE'
     * @return string 'TENTATIVE'
     */
    case TENTATIVE = "TENTATIVE";

    /**
     * Constant for value 'COMPLETED'
     * @return string 'COMPLETED'
     */
    case COMPLETED = "COMPLETED";

    /**
     * Constant for value 'DELEGATED'
     * @return string 'DELEGATED'
     */
    case DELEGATED = "DELEGATED";
}
