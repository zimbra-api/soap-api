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
 * ContentType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ContentType extends Base
{
    /**
     * Constant for value 'userAccount'
     * @return string 'userAccount'
     */
    const TEXT_PLAIN = 'text/plain';

    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    const TEXT_HTML = 'text/html';
}
