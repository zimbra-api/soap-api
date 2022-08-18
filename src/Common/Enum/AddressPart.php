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
 * AddressPart enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum AddressPart: string
{
    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    case ALL = 'all';

    /**
     * Constant for value 'localpart'
     * @return string 'localpart'
     */
    case LOCALPART = 'localpart';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    case DOMAIN = 'domain';
}
