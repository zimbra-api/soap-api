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
 * AddressType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AddressType extends Enum
{
    /**
     * Constant for value FROM
     * @return string 'f'
     */
    protected const FRO = "f";

    /**
     * Constant for value TO
     * @return string 't'
     */
    protected const TO = "t";

    /**
     * Constant for value CC
     * @return string 'c'
     */
    protected const CC = "c";

    /**
     * Constant for value BCC
     * @return string 'b'
     */
    protected const BCC = "b";

    /**
     * Constant for value REPLY_TO
     * @return string 'r'
     */
    protected const REPLY_TO = "r";

    /**
     * Constant for value SENDER
     * @return string 's'
     */
    protected const SENDER = "s";

    /**
     * Constant for value NOTIFICATION
     * @return string 'n'
     */
    protected const NOTIFICATION = "n";

    /**
     * Constant for value RESENT_FROM
     * @return string 'rf'
     */
    protected const RESENT_FROM = "rf";
}
