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
 * RuntimeSwitchStatus enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RuntimeSwitchStatus extends Enum
{
    /**
     * Constant for value 'SUCCESS'
     * @return string 'SUCCESS'
     */
    protected const SUCCESS = "SUCCESS";

    /**
     * Constant for value 'FAIL'
     * @return string 'FAIL'
     */
    protected const FAIL = "FAIL";

    /**
     * Constant for value 'NO_OPERATION'
     * @return string 'NO_OPERATION'
     */
    protected const NO_OPERATION = "NO_OPERATION";
}
