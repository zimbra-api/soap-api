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
 * DocumentAction enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DocumentActionOp extends Base
{
    /**
     * Constant for value 'watch'
     * @return string 'watch'
     */
    const WATCH = 'watch';

    /**
     * Constant for value '!watch'
     * @return string '!watch'
     */
    const NOT_WATCH = '!watch';

    /**
     * Constant for value 'grant'
     * @return string 'grant'
     */
    const GRANT = 'grant';

    /**
     * Constant for value 'grant'
     * @return string 'grant'
     */
    const NOT_GRANT = '!grant';
}
