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
 * InviteChange enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InviteChange extends Enum
{
    /**
     * Constant for value 'subject'
     * @return string 'subject'
     */
    protected const SUBJECT = "subject";

    /**
     * Constant for value 'location'
     * @return string 'location'
     */
    protected const LOCATION = "location";

    /**
     * Constant for value 'time'
     * @return string 'time'
     */
    protected const TIME = "time";

    /**
     * Constant for value 'recurrence'
     * @return string 'recurrence'
     */
    protected const RECURRENCE = "recurrence";
}
