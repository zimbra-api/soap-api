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
 * GetSessionsSortBy class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetSessionsSortBy
{
    /**
     * Constant for value 'nameAsc'
     * @return string 'nameAsc'
     */
    const NAME_ASC = 'nameAsc';

    /**
     * Constant for value 'nameDesc'
     * @return string 'nameDesc'
     */
    const NAME_DESC = 'nameDesc';

    /**
     * Constant for value 'createdAsc'
     * @return string 'createdAsc'
     */
    const CREATED_ASC = 'createdAsc';

    /**
     * Constant for value 'createdDesc'
     * @return string 'createdDesc'
     */
    const CREATED_DESC = 'createdDesc';

    /**
     * Constant for value 'accessedAsc'
     * @return string 'accessedAsc'
     */
    const ACCESSED_ASC = 'accessedAsc';

    /**
     * Constant for value 'accessedDesc'
     * @return string 'accessedDesc'
     */
    const ACCESSED_DESC = 'accessedDesc';

    /**
     * Return true if value is allowed
     * @param  string $sortBy
     * @return bool true|false
     */
    public static function isValid($sortBy)
    {
        $validValues = array(
            self::NAME_ASC,
            self::NAME_DESC,
            self::CREATED_ASC,
            self::CREATED_DESC,
            self::ACCESSED_ASC,
            self::ACCESSED_DESC,
        );
        return in_array($sortBy, $validValues);
    }
}
