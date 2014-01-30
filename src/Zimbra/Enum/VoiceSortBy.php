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
 * VoiceSortBy enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class VoiceSortBy extends Base
{
    /**
     * Constant for value 'dateDesc'
     * @return string 'dateDesc'
     */
    const DATE_DESC = 'dateDesc';

    /**
     * Constant for value 'dateAsc'
     * @return string 'dateAsc'
     */
    const DATE_ASC = 'dateAsc';

    /**
     * Constant for value 'durDesc'
     * @return string 'durDesc'
     */
    const DUR_DESC = 'durDesc';

    /**
     * Constant for value 'durAsc'
     * @return string 'durAsc'
     */
    const DUR_ASC = 'durAsc';

    /**
     * Constant for value 'nameDesc'
     * @return string 'nameDesc'
     */
    const NAME_DESC = 'nameDesc';

    /**
     * Constant for value 'nameAsc'
     * @return string 'nameAsc'
     */
    const NAME_ASC = 'nameAsc';
}
