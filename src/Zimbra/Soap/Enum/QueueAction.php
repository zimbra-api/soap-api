<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Enum;

/**
 * QueueAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class QueueAction
{
    /**
     * Constant for value 'hold'
     * @return string 'hold'
     */
    const HOLD = 'hold';

    /**
     * Constant for value 'release'
     * @return string 'release'
     */
    const RELEASE = 'release';

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    const DELETE = 'delete';

    /**
     * Constant for value 'requeue'
     * @return string 'requeue'
     */
    const REQUEUE = 'requeue';

    /**
     * Return true if value is allowed
     * @param  string $action
     * @return bool true|false
     */
    public static function isValid($action)
    {
        $validValues = array(
            self::HOLD,
            self::RELEASE,
            self::DELETE,
            self::REQUEUE,
        );
        return in_array($action, $validValues);
    }
}
