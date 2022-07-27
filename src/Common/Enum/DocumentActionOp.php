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
 * DocumentAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DocumentActionOp extends Enum
{
    /**
     * Constant for value 'watch'
     * @return string 'watch'
     */
    private const WATCH = 'watch';

    /**
     * Constant for value '!watch'
     * @return string '!watch'
     */
    private const NOT_WATCH = '!watch';

    /**
     * Constant for value 'grant'
     * @return string 'grant'
     */
    private const GRANT = 'grant';

    /**
     * Constant for value 'grant'
     * @return string 'grant'
     */
    private const NOT_GRANT = '!grant';
}
