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
 * ContentType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ContentType extends Enum
{
    /**
     * Constant for value 'userAccount'
     * @return string 'userAccount'
     */
    private const TEXT_PLAIN = 'text/plain';

    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    private const TEXT_HTML = 'text/html';
}
