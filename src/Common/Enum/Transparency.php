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
 * Transparency enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Transparency extends Enum
{
    /**
     * Constant for value 'Opaque'
     * @return string 'O'
     */
    protected const OPAQUE = "O";

    /**
     * Constant for value 'Transparent'
     * @return string 'T'
     */
    protected const TRANSPARENT = "T";
}
