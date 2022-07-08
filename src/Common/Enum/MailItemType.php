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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MailItemType extends Enum
{
    /**
     * Constant for value 'UNKNOWN'
     * @return string 'UNKNOWN'
     */
    private const UNKNOWN = 'UNKNOWN';

    /**
     * Item is a standard Folder
     * @return string 'FOLDER'
     */
    private const FOLDER = 'FOLDER';

    /**
     * Item is a saved search - SearchFolder
     * @return string 'SEARCHFOLDER'
     */
    private const SEARCHFOLDER = 'SEARCHFOLDER';

    /**
     * Item is a user-created Tag
     * @return string 'TAG'
     */
    private const TAG = 'TAG';

    /**
     * Item is a real, persisted Conversation
     * @return string 'CONVERSATION'
     */
    private const CONVERSATION = 'CONVERSATION';

    /**
     * Item is a mail Message
     * @return string 'MESSAGE'
     */
    private const MESSAGE = 'MESSAGE';

    /**
     * Item is a Contact
     * @return string 'CONTACT'
     */
    private const CONTACT = 'CONTACT';

    /**
     * Item is a InviteMessage with a MIME part
     * @return string 'INVITE'
     */
    private const INVITE = 'INVITE';

    /**
     * Item is a bare Document
     * @return string 'DOCUMENT'
     */
    private const DOCUMENT = 'DOCUMENT';

    /**
     * Item is a Note
     * @return string 'NOTE'
     */
    private const NOTE = 'NOTE';

    /**
     * Item is a memory-only system Flag
     * @return string 'FLAG'
     */
    private const FLAG = 'FLAG';

    /**
     * Item is a calendar Appointment
     * @return string 'APPOINTMENT'
     */
    private const APPOINTMENT = 'APPOINTMENT';

    /**
     * Item is a memory-only, 1-message VirtualConversation
     * @return string 'VIRTUAL_CONVERSATION'
     */
    private const VIRTUAL_CONVERSATION = 'VIRTUAL_CONVERSATION';

    /**
     * Item is a Mountpoint pointing to a Folder, possibly in another user's Mailbox
     * @return string 'MOUNTPOINT'
     */
    private const MOUNTPOINT = 'MOUNTPOINT';

    /**
     * Item is a WikiItem
     * @return string 'WIKI'
     */
    private const WIKI = 'WIKI';

    /**
     * Item is a Task
     * @return string 'TASK'
     */
    private const TASK = 'TASK';

    /**
     * Item is a Chat
     * @return string 'CHAT'
     */
    private const CHAT = 'CHAT';

    /**
     * Item is a Comment
     * @return string 'COMMENT'
     */
    private const COMMENT = 'COMMENT';

    /**
     * Item is a Link pointing to a Document
     * @return string 'LINK'
     */
    private const LINK = 'LINK';
}
