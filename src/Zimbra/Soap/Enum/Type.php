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
 * Type class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Type
{
    /**
     * Constant for value 'user'
     * @return string 'user'
     */
    const USER = 'user';
    /**
     * Constant for value 'system'
     * @return string 'system'
     */
    const SYSTEM = 'system';

    /**
     * Return true if value is allowed
     * @param  string $type
     * @return bool true|false
     */
    public static function isValid($type)
    {
        $validValues = array(
            self::USER,
            self::SYSTEM,
        );
        return in_array($type, $validValues);
    }
}
