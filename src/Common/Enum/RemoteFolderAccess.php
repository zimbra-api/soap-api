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
 * RemoteFolderAccess enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum RemoteFolderAccess: string
{
    /**
     * Constant for value 'c'
     * @return string 'c'
     */
    case CREATE = 'c';

    /**
     * Constant for value 'i'
     * @return string 'i'
     */
    case INSERT = 'i';

    /**
     * Constant for value 'r'
     * @return string 'r'
     */
    case READ = 'r';
}
