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
 * ViewType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum ViewType: string
{
    /**
     * Constant for value ''
     * @return string ''
     */
    case UNKNOWN = "";

    /**
     * Constant for value 'search folder'
     * @return string 'search folder'
     */
    case SEARCH_FOLDER = "search folder";

    /**
     * Constant for value 'tag'
     * @return string 'tag'
     */
    case TAG = "tag";

    /**
     * Constant for value 'conversation'
     * @return string 'conversation'
     */
    case CONVERSATION = "conversation";

    /**
     * Constant for value 'message'
     * @return string 'message'
     */
    case MESSAGE = "message";

    /**
     * Constant for value 'contact'
     * @return string 'contact'
     */
    case CONTACT = "contact";

    /**
     * Constant for value 'document'
     * @return string 'document'
     */
    case DOCUMENT = "document";

    /**
     * Constant for value 'appointment'
     * @return string 'appointment'
     */
    case APPOINTMENT = "appointment";

    /**
     * Constant for value 'virtual conversation'
     * @return string 'virtual conversation'
     */
    case VIRTUAL_CONVERSATION = "virtual conversation";

    /**
     * Constant for value 'remote folder'
     * @return string 'remote folder'
     */
    case REMOTE_FOLDER = "remote folder";

    /**
     * Constant for value 'wiki'
     * @return string 'wiki'
     */
    case WIKI = "wiki";

    /**
     * Constant for value 'task'
     * @return string 'task'
     */
    case TASK = "task";

    /**
     * Constant for value 'chat'
     * @return string 'chat'
     */
    case CHAT = "chat";
}
