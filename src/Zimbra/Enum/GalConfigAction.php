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
 * GalConfigAction enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GalConfigAction extends Base
{
    /**
     * Constant for value 'autocomplete'
     * @return string 'autocomplete'
     */
    const AUTOCOMPLETE = 'autocomplete';

    /**
     * Constant for value 'search'
     * @return string 'search'
     */
    const SEARCH = 'search';

    /**
     * Constant for value 'sync'
     * @return string 'sync'
     */
    const SYNC = 'sync';
}
