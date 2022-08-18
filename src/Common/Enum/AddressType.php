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
 * AddressType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum AddressType: string
{
    /**
     * Constant for value FROM
     * @return string 'f'
     */
    case FRO = 'f';

    /**
     * Constant for value TO
     * @return string 't'
     */
    case TO = 't';

    /**
     * Constant for value CC
     * @return string 'c'
     */
    case CC = 'c';

    /**
     * Constant for value BCC
     * @return string 'b'
     */
    case BCC = 'b';

    /**
     * Constant for value REPLY_TO
     * @return string 'r'
     */
    case REPLY_TO = 'r';

    /**
     * Constant for value SENDER
     * @return string 's'
     */
    case SENDER = 's';

    /**
     * Constant for value NOTIFICATION
     * @return string 'n'
     */
    case NOTIFICATION = 'n';

    /**
     * Constant for value RESENT_FROM
     * @return string 'rf'
     */
    case RESENT_FROM = 'rf';
}
