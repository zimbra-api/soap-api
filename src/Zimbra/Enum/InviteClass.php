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
 * InviteClass enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class InviteClass extends Base
{
    /**
     * Constant for value 'Public'
     * @return string 'PUB'
     */
    const PUB = 'PUB';

    /**
     * Constant for value 'Private'
     * @return string 'PRI'
     */
    const PRI = 'PRI';

    /**
     * Constant for value 'Confidential'
     * @return string 'CON'
     */
    const CON = 'CON';
}
