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
 * AceRightType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AceRightType extends Enum
{
    /**
     * Constant for value 'viewFreeBusy'
     * @return string 'viewFreeBusy'
     */
    private const VIEW_FREE_BUSY = 'viewFreeBusy';

    /**
     * Constant for value 'invite'
     * @return string 'invite'
     */
    private const INVITE = 'invite';
}