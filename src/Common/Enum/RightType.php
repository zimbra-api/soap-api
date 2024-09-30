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
 * RightType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RightType extends Enum
{
    /**
     * Constant for value 'preset'
     * @return string 'preset'
     */
    protected const PRESET = "preset";

    /**
     * Constant for value 'getAttrs'
     * @return string 'getAttrs'
     */
    protected const GET_ATTRS = "getAttrs";

    /**
     * Constant for value 'setAttrs'
     * @return string 'setAttrs'
     */
    protected const SET_ATTRS = "setAttrs";

    /**
     * Constant for value 'setAttrs'
     * @return string 'setAttrs'
     */
    protected const COMBO = "combo";
}
