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
 * GalSearchType class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GalSearchType
{
    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    const ALL = 'all';
    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    const ACCOUNT = 'account';
    /**
     * Constant for value 'resource'
     * @return string 'resource'
     */
    const RESOURCE = 'resource';
    /**
     * Constant for value 'group'
     * @return string 'group'
     */
    const GROUP = 'group';

    /**
     * Return true if value is allowed
     * @param  string $type
     * @return bool true|false
     */
    public static function isValid($type)
    {
        $validValues = array(
            self::ALL,
            self::ACCOUNT,
            self::RESOURCE,
            self::GROUP,
        );
        return in_array($type, $validValues);
    }
}
