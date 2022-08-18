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
 * RightType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum RightType: string
{
    /**
     * Constant for value 'preset'
     * @return string 'preset'
     */
    case PRESET = 'preset';

    /**
     * Constant for value 'getAttrs'
     * @return string 'getAttrs'
     */
    case GET_ATTRS = 'getAttrs';

    /**
     * Constant for value 'setAttrs'
     * @return string 'setAttrs'
     */
    case SET_ATTRS = 'setAttrs';

    /**
     * Constant for value 'setAttrs'
     * @return string 'setAttrs'
     */
    case COMBO = 'combo';
}
