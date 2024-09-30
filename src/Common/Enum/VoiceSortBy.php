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

use MyCLabs\Enum\Enum;

/**
 * VoiceSortBy enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class VoiceSortBy extends Enum
{
    /**
     * Constant for value 'dateDesc'
     * @return string 'dateDesc'
     */
    protected const DATE_DESC = "dateDesc";

    /**
     * Constant for value 'dateAsc'
     * @return string 'dateAsc'
     */
    protected const DATE_ASC = "dateAsc";

    /**
     * Constant for value 'durDesc'
     * @return string 'durDesc'
     */
    protected const DUR_DESC = "durDesc";

    /**
     * Constant for value 'durAsc'
     * @return string 'durAsc'
     */
    protected const DUR_ASC = "durAsc";

    /**
     * Constant for value 'nameDesc'
     * @return string 'nameDesc'
     */
    protected const NAME_DESC = "nameDesc";

    /**
     * Constant for value 'nameAsc'
     * @return string 'nameAsc'
     */
    protected const NAME_ASC = "nameAsc";
}
