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
 * ZimletDeployStatus enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum ZimletDeployStatus: string
{
    /**
     * Constant for value 'succeeded'
     * @return string 'succeeded'
     */
    case SUCCEEDED = "succeeded";

    /**
     * Constant for value 'failed'
     * @return string 'failed'
     */
    case FAILED = "failed";

    /**
     * Constant for value 'pending'
     * @return string 'pending'
     */
    case PENDING = "pending";
}
