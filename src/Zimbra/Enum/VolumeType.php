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
 * VolumeType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class VolumeType extends Base
{
    /**
     * Constant for value '1'
     * @return int '1'
     */
    const PRIMARY = 1;

    /**
     * Constant for value '2'
     * @return int '2'
     */
    const SECONDARY = 2;

    /**
     * Constant for value '10'
     * @return int '10'
     */
    const INDEX = 10;
}
