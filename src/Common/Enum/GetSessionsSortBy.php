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
 * GetSessionsSortBy enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum GetSessionsSortBy: string
{
    /**
     * Constant for value 'nameAsc'
     * @return string 'nameAsc'
     */
    case NAME_ASC = "nameAsc";

    /**
     * Constant for value 'nameDesc'
     * @return string 'nameDesc'
     */
    case NAME_DESC = "nameDesc";

    /**
     * Constant for value 'createdAsc'
     * @return string 'createdAsc'
     */
    case CREATED_ASC = "createdAsc";

    /**
     * Constant for value 'createdDesc'
     * @return string 'createdDesc'
     */
    case CREATED_DESC = "createdDesc";

    /**
     * Constant for value 'accessedAsc'
     * @return string 'accessedAsc'
     */
    case ACCESSED_ASC = "accessedAsc";

    /**
     * Constant for value 'accessedDesc'
     * @return string 'accessedDesc'
     */
    case ACCESSED_DESC = "accessedDesc";
}
