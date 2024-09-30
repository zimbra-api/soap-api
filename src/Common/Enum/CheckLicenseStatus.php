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
 * CheckLicenseStatus enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckLicenseStatus extends Enum
{
    /**
     * Constant for value 'ok'
     * @return string 'ok'
     */
    protected const OK = "ok";

    /**
     * Constant for value 'no'
     * @return string 'no'
     */
    protected const NO = "no";

    /**
     * Constant for value 'inGracePeriod'
     * @return string 'inGracePeriod'
     */
    protected const IN_GRACE_PERIOD = "inGracePeriod";
}
