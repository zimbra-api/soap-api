<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\FolderActionSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * FolderActionRequest class
 * Perform an action on a folder
 * 
 * Actions:
 *   <action op="read" id="{list}"/>
 *     - mark all items in the folder as read
 *
 *   <action op="delete" id="{list}"/>
 *     - hard-delete the folder, all items in the folder, and all the folder's subfolders
 *
 *   <action op="empty" id="{list}" [recusive="{delete-subfolders}"]/>
 *     - hard-delete all items in the folder (and all the folder's subfolders if "recursive" is set)
 *
 *   <action op="rename" id="{list}" name="{new-name}" [l="{new-folder}"]/>
 *     - change the folder's name (and optionally location);
 *       if {new-name} begins with '/', the folder is moved to the new path and any missing path elements are created
 *
 *   <action op="move" id="{list}" l="{new-folder}"/>
 *     - move the folder to be a child of {target-folder}
 *
 *   <action op="trash" id="{list}"/>
 *     - move the folder to the Trash, marking all contents as read and
 *       renaming the folder if a folder by that name is already present in the Trash
 *
 *   <action op="color" id="{list}" color="{new-color} rgb="{new-color-in-rgb}"/>
 *     - see ItemActionRequest
 *
 *   <action op="grant" id="{list}">
 *     <grant perm="..." gt="..." zid="..." [expiry="{millis-since-epoch}"] [d="..."] [key="..."]/>
 *   </action>
 *     - add the <grant> object to the folder
 *
 *   <action op="!grant" id="{list}" zid="{grantee-zimbra-id}"/>
 *     - revoke access from {grantee-zimbra-id}
 *         (you can use "00000000-0000-0000-0000-000000000000" to revoke acces granted to "all"
 *         or use "99999999-9999-9999-9999-999999999999" to revoke acces granted to "pub" )
 *
 *   <action op="revokeorphangrants" id="{folder-id}" zid="{grantee-zimbra-id}" gt="{grantee-type}"/>
 *     - revoke orphan grants on the folder hierarchy granted to the grantee specified by zid and gt
 *       "orphan grant" is a grant whose grantee object is deleted/non-existing.  Server will throw
 *       INVALID_REQUEST if zid points to an existing object,
 *       Only supported if gt is usr|grp|cos|dom; otherwise server will throw INVALID_REQUEST.
 *
 *   <action op="url" id="{list}" url="{target-url}" [excludeFreeBusy="{exclude-free-busy-boolean}"]/>
 *     - set the synchronization url on the folder to {target-url}, empty the folder, and\
 *       synchronize the folder's contents to the remote feed, also sets {exclude-free-busy-boolean}
 *
 *   <action op="sync" id="{list}"/>
 *     - synchronize the folder's contents to the remote feed specified by the folder's {url}
 *
 *   <action op="import" id="{list}" url="{target-url}"/>
 *     - add the contents to the remote feed at {target-url} to the folder [1-time action]
 *
 *   <action op="fb" id="{list}" excludeFreeBusy="{exclude-free-busy-boolean}"/>
 *     - set the excludeFreeBusy boolean for this folder (must specify {exclude-free-busy-boolean})
 *
 *   <action op="[!]check" id="{list}"/>
 *     - set or unset the "checked" state of the folder in the UI
 *
 *   <action op="[!]syncon" id="{list}"/>
 *     - set or unset the "sync" flag of the folder to sync a local folder with a remote source
 *     
 *   <action op="[!]disableactivesync" id="{list}"/>
 *     - If set, disable access to the folder via activesync.
 *       Note: Only works for user folders, doesn't have any effect on system folders.
 *
 *   <action op="webofflinesyncdays" id="{list}" numDays="{web-offline-sync-days}/>
 *     - set the number of days for which web client would sync folder data for offline use
 *       {web-offline-sync-days} must not be greater than value of zimbraWebClientOfflineSyncMaxDays account attribute
 *
 *   <action op="update" id="{list}" [f="{new-flags}"] [name="{new-name}"]
 *                          [l="{target-folder}"] [color="{new-color}"] [view="{new-view}"]>
 *     [<acl><grant .../>*</acl>]
 *   </action>
 *     - do several operations at once:
 *           name="{new-name}"        to change the folder's name
 *           l="{target-folder}"      to change the folder's location
 *           color="{new-color}"      to set the folder's color
 *           view="{new-view}"        to change folder's default view (useful for migration)
 *           f="{new-flags}"          to change the folder's exclude free/(b)usy, checked (#), and
 *                                    IMAP subscribed (*) state
 *           <acl><grant ...>*</acl>  to replace the folder's existing ACL with a new ACL
 *
 *     {list} = on input, list of folders to act on, on output, list of folders that were acted on;
 *              list may only have 1 element for actions empty, sync, fb, check, !check, url, import, grant,
 *              !grant, revokeorphangrants, !flag, !tag, syncon, !syncon, retentionpolicy
 *
 * output of "grant" action includes the zimbra id the rights were granted on
 *
 * note that "delete", "empty", "rename", "move", "color", "update" can be used on search folders as well as standard 
 * folders
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FolderActionRequest extends SoapRequest
{
    /**
     * Select action to perform on folder
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\FolderActionSelector")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private FolderActionSelector $action;

    /**
     * Constructor method for FolderActionRequest
     *
     * @param  FolderActionSelector $action
     * @return self
     */
    public function __construct(FolderActionSelector $action)
    {
        $this->setAction($action);
    }

    /**
     * Get action
     *
     * @return FolderActionSelector
     */
    public function getAction(): FolderActionSelector
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param  FolderActionSelector $action
     * @return self
     */
    public function setAction(FolderActionSelector $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new FolderActionEnvelope(
            new FolderActionBody($this)
        );
    }
}
