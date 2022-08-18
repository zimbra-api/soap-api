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
 * InterestType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum InterestType: string
{
    /**
     * Constant for value 'f'
     * @return string 'f'
     */
    case FOLDERS = 'f';

    /**
     * Constant for value 'm'
     * @return string 'm'
     */
    case MESSAGES = 'm';

    /**
     * Constant for value 'c'
     * @return string 'c'
     */
    case CONTACTS = 'c';

    /**
     * Constant for value 'a'
     * @return string 'a'
     */
    case APPOINTMENTS = 'a';

    /**
     * Constant for value 't'
     * @return string 't'
     */
    case TASKS = 't';

    /**
     * Constant for value 'd'
     * @return string 'd'
     */
    case DOCUMENTS = 'd';

    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    case ALL = 'all';
}
