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
 * GalConfigAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GalConfigAction extends Enum
{
    /**
     * Constant for value 'autocomplete'
     * @return string 'autocomplete'
     */
    protected const AUTOCOMPLETE = "autocomplete";

    /**
     * Constant for value 'search'
     * @return string 'search'
     */
    protected const SEARCH_ = "search";

    /**
     * Constant for value 'sync'
     * @return string 'sync'
     */
    protected const SYNC = "sync";
}
