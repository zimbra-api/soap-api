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
 * AuthScheme class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AuthScheme
{
    /**
     * Constant for value 'basic'
     * @return string 'basic'
     */
    const BASIC = 'basic';
    /**
     * Constant for value 'form'
     * @return string 'form'
     */
    const FORM = 'form';

    /**
     * Return true if value is allowed
     * @param  string $scheme
     * @return bool true|false
     */
    public static function isValid($scheme)
    {
        $validValues = array(
            self::BASIC,
            self::FORM,
        );
        return in_array($scheme, $validValues);
    }
}
