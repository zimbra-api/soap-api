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
 * ActionGrantRight enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ActionGrantRight extends Enum
{
    /**
     * Constant for value 'r'
     * @return string 'r'
     */
    protected const READ = 'r';

    /**
     * Constant for value 'w'
     * @return string 'w'
     */
    protected const WRITE = 'w';

    /**
     * Constant for value 'i'
     * @return string 'i'
     */
    protected const INSERT = 'i';

    /**
     * Constant for value 'd'
     * @return string 'd'
     */
    protected const DELETE = 'd';

    /**
     * Constant for value 'a'
     * @return string 'a'
     */
    protected const ADMINISTER = 'a';

    /**
     * Constant for value 'x'
     * @return string 'x'
     */
    protected const WORKFLOW_ACTION = 'x';

    /**
     * Constant for value 'p'
     * @return string 'p'
     */
    protected const VIEW_PRIVATE = 'p';

    /**
     * Constant for value 'f'
     * @return string 'f'
     */
    protected const VIEW_FREEBUSY = 'f';

    /**
     * Constant for value 'c'
     * @return string 'c'
     */
    protected const CREATE_SUBFOLDER = 'c';
}
