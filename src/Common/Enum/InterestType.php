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
 * InterestType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InterestType extends Enum
{
    /**
     * Constant for value 'f'
     * @return string 'f'
     */
    protected const FOLDERS = 'f';

    /**
     * Constant for value 'm'
     * @return string 'm'
     */
    protected const MESSAGES = 'm';

    /**
     * Constant for value 'c'
     * @return string 'c'
     */
    protected const CONTACTS = 'c';

    /**
     * Constant for value 'a'
     * @return string 'a'
     */
    protected const APPOINTMENTS = 'a';

    /**
     * Constant for value 't'
     * @return string 't'
     */
    protected const TASKS = 't';

    /**
     * Constant for value 'd'
     * @return string 'd'
     */
    protected const DOCUMENTS = 'd';

    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    protected const ALL = 'all';
}
