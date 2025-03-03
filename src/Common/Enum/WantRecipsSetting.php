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
 * WantRecipsSetting enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum WantRecipsSetting: string
{
    /**
     * Constant for value '0'
     * @return string '0'
     */
    case PUT_SENDERS = "0";

    /**
     * Constant for value '1'
     * @return string '1'
     */
    case PUT_RECIPIENTS = "1";

    /**
     * Constant for value '2'
     * @return string '2'
     */
    case PUT_BOTH = "2";

    /**
     * Constant for value '3'
     * @return string '3'
     */
    case PUT_ALL = "3";
}
