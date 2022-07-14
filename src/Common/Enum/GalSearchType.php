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
 * GalSearchType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GalSearchType extends Enum
{
    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    private const ALL = 'all';

    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    private const ACCOUNT = 'account';

    /**
     * Constant for value 'resource'
     * @return string 'resource'
     */
    private const RESOURCE = 'resource';

    /**
     * Constant for value 'group'
     * @return string 'group'
     */
    private const GROUP = 'group';
}