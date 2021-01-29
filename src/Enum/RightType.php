<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

use MyCLabs\Enum\Enum;

/**
 * RightType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RightType extends Enum
{
    /**
     * Constant for value 'preset'
     * @return string 'preset'
     */
    private const PRESET = 'preset';

    /**
     * Constant for value 'getAttrs'
     * @return string 'getAttrs'
     */
    private const GET_ATTRS = 'getAttrs';

    /**
     * Constant for value 'setAttrs'
     * @return string 'setAttrs'
     */
    private const SET_ATTRS = 'setAttrs';

    /**
     * Constant for value 'setAttrs'
     * @return string 'setAttrs'
     */
    private const COMBO = 'combo';
}
