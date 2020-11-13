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
 * AddressType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AddressType extends Enum
{
    /**
     * Constant for value FROM
     * @return string 'f'
     */
    private const FROM = 'f';

    /**
     * Constant for value TO
     * @return string 't'
     */
    private const TO = 't';

    /**
     * Constant for value CC
     * @return string 'c'
     */
    private const CC = 'c';

    /**
     * Constant for value BCC
     * @return string 'b'
     */
    private const BCC = 'b';

    /**
     * Constant for value REPLY_TO
     * @return string 'r'
     */
    private const REPLY_TO = 'r';

    /**
     * Constant for value SENDER
     * @return string 's'
     */
    private const SENDER = 's';

    /**
     * Constant for value NOTIFICATION
     * @return string 'n'
     */
    private const NOTIFICATION = 'n';

    /**
     * Constant for value RESENT_FROM
     * @return string 'rf'
     */
    private const RESENT_FROM = 'rf';
}
