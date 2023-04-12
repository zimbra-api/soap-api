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
 * ContentType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum ContentType: string
{
    /**
     * Constant for value 'text/plain'
     * @return string 'text/plain'
     */
    case TEXT_PLAIN = 'text/plain';

    /**
     * Constant for value 'text/html'
     * @return string 'text/html'
     */
    case TEXT_HTML = 'text/html';
}
