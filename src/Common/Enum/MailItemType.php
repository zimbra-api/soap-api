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
 * MailItemType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum MailItemType: string
{
    /**
     * Constant for value 'UNKNOWN'
     * @return string 'UNKNOWN'
     */
    case UNKNOWN = 'UNKNOWN';

    /**
     * Item is a standard Folder
     * @return string 'FOLDER'
     */
    case FOLDER = 'FOLDER';

    /**
     * Item is a saved search - SearchFolder
     * @return string 'SEARCHFOLDER'
     */
    case SEARCHFOLDER = 'SEARCHFOLDER';

    /**
     * Item is a user-created Tag
     * @return string 'TAG'
     */
    case TAG = 'TAG';

    /**
     * Item is a real, persisted Conversation
     * @return string 'CONVERSATION'
     */
    case CONVERSATION = 'CONVERSATION';

    /**
     * Item is a mail Message
     * @return string 'MESSAGE'
     */
    case MESSAGE = 'MESSAGE';

    /**
     * Item is a Contact
     * @return string 'CONTACT'
     */
    case CONTACT = 'CONTACT';

    /**
     * Item is a InviteMessage with a MIME part
     * @return string 'INVITE'
     */
    case INVITE = 'INVITE';

    /**
     * Item is a bare Document
     * @return string 'DOCUMENT'
     */
    case DOCUMENT = 'DOCUMENT';

    /**
     * Item is a Note
     * @return string 'NOTE'
     */
    case NOTE = 'NOTE';

    /**
     * Item is a memory-only system Flag
     * @return string 'FLAG'
     */
    case FLAG = 'FLAG';

    /**
     * Item is a calendar Appointment
     * @return string 'APPOINTMENT'
     */
    case APPOINTMENT = 'APPOINTMENT';

    /**
     * Item is a memory-only, 1-message VirtualConversation
     * @return string 'VIRTUAL_CONVERSATION'
     */
    case VIRTUAL_CONVERSATION = 'VIRTUAL_CONVERSATION';

    /**
     * Item is a Mountpoint pointing to a Folder, possibly in another user's Mailbox
     * @return string 'MOUNTPOINT'
     */
    case MOUNTPOINT = 'MOUNTPOINT';

    /**
     * Item is a WikiItem
     * @return string 'WIKI'
     */
    case WIKI = 'WIKI';

    /**
     * Item is a Task
     * @return string 'TASK'
     */
    case TASK = 'TASK';

    /**
     * Item is a Chat
     * @return string 'CHAT'
     */
    case CHAT = 'CHAT';

    /**
     * Item is a Comment
     * @return string 'COMMENT'
     */
    case COMMENT = 'COMMENT';

    /**
     * Item is a Link pointing to a Document
     * @return string 'LINK'
     */
    case LINK = 'LINK';
}
