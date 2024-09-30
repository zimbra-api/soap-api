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
 * AutoCompleteMatchType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AutoCompleteMatchType extends Enum
{
    /**
     * Constant for value 'gal'
     * @return string 'gal'
     */
    protected const GAL = "gal";

    /**
     * Constant for value 'contact'
     * @return string 'contact'
     */
    protected const CONTACT = "contact";

    /**
     * Constant for value 'rankingTable'
     * @return string 'rankingTable'
     */
    protected const RANKING_TABLE = "rankingTable";
}
