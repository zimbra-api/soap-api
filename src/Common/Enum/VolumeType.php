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
 * VolumeType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class VolumeType extends Enum
{
    /**
     * Constant for value '1'
     * @return int '1'
     */
    protected const PRIMARY = 1;

    /**
     * Constant for value '2'
     * @return int '2'
     */
    protected const SECONDARY = 2;

    /**
     * Constant for value '10'
     * @return int '10'
     */
    protected const INDEX = 10;
}
