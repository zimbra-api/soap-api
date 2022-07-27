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
 * AddressPart enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AddressPart extends Enum
{
    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    private const ALL = 'all';

    /**
     * Constant for value 'localpart'
     * @return string 'localpart'
     */
    private const LOCALPART = 'localpart';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    private const DOMAIN = 'domain';
}
