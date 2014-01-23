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
 * InterestType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class InterestType extends Base
{
    /**
     * Constant for value 'f'
     * @return string 'f'
     */
    const FOLDERS = 'f';

    /**
     * Constant for value 'm'
     * @return string 'm'
     */
    const MESSAGES = 'm';

    /**
     * Constant for value 'c'
     * @return string 'c'
     */
    const CONTACTS = 'c';

    /**
     * Constant for value 'a'
     * @return string 'a'
     */
    const APPOINTMENTS = 'a';

    /**
     * Constant for value 't'
     * @return string 't'
     */
    const TASKS = 't';

    /**
     * Constant for value 'd'
     * @return string 'd'
     */
    const DOCUMENTS = 'd';

    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    const ALL = 'all';
}
