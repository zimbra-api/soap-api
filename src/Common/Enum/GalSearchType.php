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
 * GalSearchType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum GalSearchType: string
{
    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    case ALL = 'all';

    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    case ACCOUNT = 'account';

    /**
     * Constant for value 'resource'
     * @return string 'resource'
     */
    case RESOURCE = 'resource';

    /**
     * Constant for value 'group'
     * @return string 'group'
     */
    case GROUP = 'group';
}
