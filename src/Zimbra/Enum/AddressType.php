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
 * AddressType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddressType extends Base
{
    /**
     * Constant for value FROM
     * @return string 'f'
     */
    const FROM = 'f';

    /**
     * Constant for value TO
     * @return string 't'
     */
    const TO = 't';

    /**
     * Constant for value CC
     * @return string 'c'
     */
    const CC = 'c';

    /**
     * Constant for value BCC
     * @return string 'b'
     */
    const BCC = 'b';

    /**
     * Constant for value REPLY_TO
     * @return string 'r'
     */
    const REPLY_TO = 'r';

    /**
     * Constant for value SENDER
     * @return string 's'
     */
    const SENDER = 's';

    /**
     * Constant for value NOTIFICATION
     * @return string 'n'
     */
    const NOTIFICATION = 'n';

    /**
     * Constant for value RESENT_FROM
     * @return string 'rf'
     */
    const RESENT_FROM = 'rf';
}
