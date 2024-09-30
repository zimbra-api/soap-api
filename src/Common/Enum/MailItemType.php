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
 * MailItemType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailItemType extends Enum
{
    /**
     * Constant for value 'UNKNOWN'
     * @return string 'UNKNOWN'
     */
    protected const UNKNOWN = "UNKNOWN";

    /**
     * Item is a standard Folder
     * @return string 'FOLDER'
     */
    protected const FOLDER = "FOLDER";

    /**
     * Item is a saved search - SearchFolder
     * @return string 'SEARCHFOLDER'
     */
    protected const SEARCHFOLDER = "SEARCHFOLDER";

    /**
     * Item is a user-created Tag
     * @return string 'TAG'
     */
    protected const TAG = "TAG";

    /**
     * Item is a real, persisted Conversation
     * @return string 'CONVERSATION'
     */
    protected const CONVERSATION = "CONVERSATION";

    /**
     * Item is a mail Message
     * @return string 'MESSAGE'
     */
    protected const MESSAGE = "MESSAGE";

    /**
     * Item is a Contact
     * @return string 'CONTACT'
     */
    protected const CONTACT = "CONTACT";

    /**
     * Item is a InviteMessage with a MIME part
     * @return string 'INVITE'
     */
    protected const INVITE = "INVITE";

    /**
     * Item is a bare Document
     * @return string 'DOCUMENT'
     */
    protected const DOCUMENT = "DOCUMENT";

    /**
     * Item is a Note
     * @return string 'NOTE'
     */
    protected const NOTE = "NOTE";

    /**
     * Item is a memory-only system Flag
     * @return string 'FLAG'
     */
    protected const FLAG = "FLAG";

    /**
     * Item is a calendar Appointment
     * @return string 'APPOINTMENT'
     */
    protected const APPOINTMENT = "APPOINTMENT";

    /**
     * Item is a memory-only, 1-message VirtualConversation
     * @return string 'VIRTUAL_CONVERSATION'
     */
    protected const VIRTUAL_CONVERSATION = "VIRTUAL_CONVERSATION";

    /**
     * Item is a Mountpoint pointing to a Folder, possibly in another user's Mailbox
     * @return string 'MOUNTPOINT'
     */
    protected const MOUNTPOINT = "MOUNTPOINT";

    /**
     * Item is a WikiItem
     * @return string 'WIKI'
     */
    protected const WIKI = "WIKI";

    /**
     * Item is a Task
     * @return string 'TASK'
     */
    protected const TASK = "TASK";

    /**
     * Item is a Chat
     * @return string 'CHAT'
     */
    protected const CHAT = "CHAT";

    /**
     * Item is a Comment
     * @return string 'COMMENT'
     */
    protected const COMMENT = "COMMENT";

    /**
     * Item is a Link pointing to a Document
     * @return string 'LINK'
     */
    protected const LINK = "LINK";
}
