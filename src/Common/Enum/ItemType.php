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
 * ItemType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ItemType extends Enum
{
    /**
     * Constant for value 'appointment'
     * @return string 'appointment'
     */
    private const APPOINTMENT = 'appointment';

    /**
     * Constant for value 'chat'
     * @return string 'chat'
     */
    private const CHAT = 'chat';

    /**
     * Constant for value 'contact'
     * @return string 'contact'
     */
    private const CONTACT = 'contact';

    /**
     * Constant for value 'conversation'
     * @return string 'conversation'
     */
    private const CONVERSATION = 'conversation';

    /**
     * Constant for value 'document'
     * @return string 'document'
     */
    private const DOCUMENT = 'document';

    /**
     * Constant for value 'message'
     * @return string 'message'
     */
    private const MESSAGE = 'message';

    /**
     * Constant for value 'tag'
     * @return string 'tag'
     */
    private const TAG = 'tag';

    /**
     * Constant for value 'task'
     * @return string 'task'
     */
    private const TASK = 'task';

    /**
     * Constant for value 'wiki'
     * @return string 'wiki'
     */
    private const WIKI = 'wiki';
}
