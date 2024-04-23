<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail;

use Zimbra\Account\AccountApiInterface;
use Zimbra\Common\Enum\{
    BrowseBy,
    Channel,
    GalSearchType,
    InterestType,
    MailItemType,
    MsgContent,
    ParticipationStatus,
    RecoverAccountOperation,
    RestoreResolve,
    RecoveryAccountOperation,
    SearchSortBy,
    ShareAction,
    VerbType,
    WantRecipsSetting
};
use Zimbra\Common\Struct\{
    CursorInfo,
    Id,
    SectionAttr
};
use Zimbra\Mail\Struct\{
    AddedComment,
    AddMsgSpec,
    ActionSelector,
    BounceMsgSpec,
    BulkAction,
    CalTZInfo,
    ContactActionSelector,
    ContactSpec,
    Content,
    ContentSpec,
    ConvActionSelector,
    ConversationSpec,
    DtTimeInfo,
    DiffDocumentVersionSpec,
    DocumentActionSelector,
    DocumentSpec,
    ExpandedRecurrenceCancel,
    ExpandedRecurrenceComponent,
    ExpandedRecurrenceException,
    ExpandedRecurrenceInvite,
    FolderActionSelector,
    FolderSpec,
    FreeBusyUserSpec,
    GetFolderSpec,
    IdsAttr,
    ImapCursorInfo,
    InstanceRecurIdInfo,
    ItemSpec,
    ListDocumentRevisionsSpec,
    MailCustomMetadata,
    MailDataSource,
    ModifyContactSpec,
    ModifySearchFolderSpec,
    Msg,
    MsgSpec,
    MsgPartIds,
    MsgToSend,
    NewFolderSpec,
    NewMountpointSpec,
    NewNoteSpec,
    NewSearchFolderSpec,
    NoteActionSelector,
    ParentId,
    PurgeRevisionSpec,
    RankingActionSpec,
    SaveDraftMsg,
    SetCalendarItemInfo,
    SharedReminderMount,
    TagSpec,
    TagActionSelector,
    TargetSpec
};

/**
 * MailApiInterface interface
 *
 * @package   Zimbra
 * @category  Mail
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface MailApiInterface extends AccountApiInterface
{
    /**
     * Add an invite to an appointment.
     * The invite corresponds to a VEVENT component.
     * Based on the UID specified (required), a new appointment is created in the default calendar if necessary.
     * If an appointment with the same UID exists, the appointment is updated with the new invite only
     * if the invite is not outdated, according to the iCalendar sequencing rule
     * (based on SEQUENCE, RECURRENCE-ID and DTSTAMP).
     *
     * @param  ParticipationStatus $partStat
     * @param  Msg $msg
     * @return Message\AddAppointmentInviteResponse
     */
    function addAppointmentInvite(
        ?ParticipationStatus $partStat = null, ?Msg $msg = null
    ): ?Message\AddAppointmentInviteResponse;

    /**
     * Add a comment to the specified item.
     * Currently comments can only be added to documents
     *
     * @param  AddedComment $comment
     * @return Message\AddCommentResponse
     */
    function addComment(AddedComment $comment): ?Message\AddCommentResponse;

    /**
     * Add a message
     *
     * @param  AddMsgSpec $msg
     * @param  bool $filterSent
     * @return Message\AddMsgResponse
     */
    function addMsg(AddMsgSpec $msg, ?bool $filterSent = null): ?Message\AddMsgResponse;

    /**
     * Add a task invite
     *
     * @param  ParticipationStatus $partStat
     * @param  Msg $msg
     * @return Message\AddTaskInviteResponse
     */
    function addTaskInvite(
        ?ParticipationStatus $partStat = null, ?Msg $msg = null
    ): ?Message\AddTaskInviteResponse;

    /**
     * Announce change of organizer
     *
     * @param  string $id
     * @return Message\AnnounceOrganizerChangeResponse
     */
    function announceOrganizerChange(string $id): ?Message\AnnounceOrganizerChangeResponse;

    /**
     * Applies one or more filter rules to messages specified by a comma-separated ID list,
     * or returned by a search query.
     * One or the other can be specified, but not both.
     * Returns the list of ids of existing messages that were affected.
     *
     * Note that redirect actions are ignored when applying filter rules to existing messages.
     *
     * @param  array $filterRules
     * @param  IdsAttr $msgIds
     * @param  string $query
     * @return Message\ApplyFilterRulesResponse
     */
    function applyFilterRules(
        array $filterRules = [], ?IdsAttr $msgIds = null, ?string $query = null
    ): ?Message\ApplyFilterRulesResponse;

    /**
     * Applies one or more filter rules to messages specified by a comma-separated ID list,
     * or returned by a search query.
     * One or the other can be specified, but not both.
     * Returns the list of ids of existing messages that were affected.
     *
     * Note that redirect actions are ignored when applying filter rules to existing messages.
     *
     * @param  array $filterRules
     * @param  IdsAttr $msgIds
     * @param  string $query
     * @return Message\ApplyOutgoingFilterRulesResponse
     */
    function applyOutgoingFilterRules(
        array $filterRules = [], ?IdsAttr $msgIds = null, ?string $query = null
    ): ?Message\ApplyOutgoingFilterRulesResponse;

    /**
     * Auto complete
     *
     * @param  string $name
     * @param  GalSearchType $type
     * @param  bool $needCanExpand
     * @param  string $folderList
     * @param  bool $includeGal
     * @return Message\AutoCompleteResponse
     */
    function autoComplete(
        string $name,
        ?GalSearchType $type = null,
        ?bool $needCanExpand = null,
        ?string $folderList = null,
        ?bool $includeGal = null
    ): ?Message\AutoCompleteResponse;

    /**
     * Begin tracking IMAP
     *
     * @return Message\BeginTrackingIMAPResponse
     */
    function beginTrackingIMAP(): ?Message\BeginTrackingIMAPResponse;

    /**
     * Resend a message
     * 
     * Supports (f)rom, (t)o, (c)c, (b)cc, (s)ender "type" on <e> elements
     * (these get mapped to Resent-From, Resent-To, Resent-CC, Resent-Bcc, Resent-Sender headers,
     * which are prepended to copy of existing message)
     * Aside from these prepended headers, message is reinjected verbatim
     *
     * @param  BounceMsgSpec $msg
     * @return Message\BounceMsgResponse
     */
    function bounceMsg(BounceMsgSpec $msg): ?Message\BounceMsgResponse;

    /**
     * Browse
     *
     * @param  BrowseBy $browseBy
     * @param  string $regex
     * @param  int $max
     * @return Message\BrowseResponse
     */
    function browse(
        ?BrowseBy $browseBy = null, ?string $regex = null, ?int $max = null
    ): ?Message\BrowseResponse;

    /**
     * Cancel appointment
     * NOTE: If canceling an exception, the original instance (ie the one the exception was "excepting")
     * WILL NOT be restored when you cancel this exception.
     *
     * @param  string $id
     * @param  int $componentNum
     * @param  int $modifiedSequence
     * @param  int $revision
     * @param  InstanceRecurIdInfo $instance
     * @param  CalTZInfo $timezone
     * @param  Msg $msg
     * @return Message\CancelAppointmentResponse
     */
    function cancelAppointment(
        ?string $id = null,
        ?int $componentNum = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?InstanceRecurIdInfo $instance = null,
        ?CalTZInfo $timezone = null,
        ?Msg $msg = null
    ): ?Message\CancelAppointmentResponse;

    /**
     * Cancel task request
     *
     * @param  string $id
     * @param  int $componentNum
     * @param  int $modifiedSequence
     * @param  int $revision
     * @param  InstanceRecurIdInfo $instance
     * @param  CalTZInfo $timezone
     * @param  Msg $msg
     * @return Message\CancelTaskResponse
     */
    function cancelTask(
        ?string $id = null,
        ?int $componentNum = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?InstanceRecurIdInfo $instance = null,
        ?CalTZInfo $timezone = null,
        ?Msg $msg = null
    ): ?Message\CancelTaskResponse;

    /**
     * Check if the authed user has the specified right(s) on a target.
     * Note: to be deprecated in Zimbra 9.  Use zimbraAccount CheckRights instead.
     *
     * @param  TargetSpec $target
     * @param  array $rights
     * @return Message\CheckPermissionResponse
     */
    function checkPermission(
        ?TargetSpec $target = null, array $rights = []
    ): ?Message\CheckPermissionResponse;

    /**
     * Check conflicts in recurrence against list of users.
     * Set {all} attribute to get all instances, even those without conflicts.
     * By default only instances that have conflicts are returned.
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  bool $allInstances
     * @param  string $excludeUid
     * @param  array $timezones
     * @param  array $components
     * @param  array $freebusyUsers
     * @return Message\CheckRecurConflictsResponse
     */
    function checkRecurConflicts(
        ?int $startTime = null,
        ?int $endTime = null,
        ?bool $allInstances = null,
        ?string $excludeUid = null,
        array $timezones = [],
        array $components = [],
        array $freebusyUsers = []
    ): ?Message\CheckRecurConflictsResponse;

    /**
     * Check spelling.
     * Suggested words are listed in decreasing order of their match score.
     * The "available" attribute specifies whether the server-side spell checking interface is available or not.
     *
     * @param  string $dictionary
     * @param  string $ignoreList
     * @param  string $text
     * @return Message\CheckSpellingResponse
     */
    function checkSpelling(
        ?string $dictionary = null, ?string $ignoreList = null, ?string $text = null
    ): ?Message\CheckSpellingResponse;

    /**
     * Complete a task instance
     *
     * @param  DtTimeInfo $exceptionId
     * @param  string $id
     * @param  CalTZInfo $timezone
     * @return Message\CompleteTaskInstanceResponse
     */
    function completeTaskInstance(
        DtTimeInfo $exceptionId, string $id, ?CalTZInfo $timezone = null
    ): ?Message\CompleteTaskInstanceResponse;

    /**
     * Contact action
     *
     * @param  ContactActionSelector $action
     * @return Message\ContactActionResponse
     */
    function contactAction(ContactActionSelector $action): ?Message\ContactActionResponse;

    /**
     * Conv action
     *
     * @param  ConvActionSelector $action
     * @return Message\ConvActionResponse
     */
    function convAction(ConvActionSelector $action): ?Message\ConvActionResponse;

    /**
     * Propose a new time/location.
     * Sent by meeting attendee to organizer.
     * The syntax is very similar to CreateAppointmentRequest.
     * Should include an <inv> element which encodes an iCalendar COUNTER object
     *
     * @param  string $id
     * @param  int $componentNum
     * @param  int $modifiedSequence
     * @param  int $revision
     * @param  Msg $msg
     * @return Message\CounterAppointmentResponse
     */
    function counterAppointment(
        ?string $id = null,
        ?int $componentNum = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?Msg $msg = null
    ): ?Message\CounterAppointmentResponse;

    /**
     * Create appointment exception.
     *
     * @param  string $id
     * @param  int $numComponents
     * @param  int $modifiedSequence
     * @param  int $revision
     * @param  Msg $msg
     * @param  bool $echo
     * @param  int $maxSize
     * @param  bool $wantHtml
     * @param  bool $neuter
     * @param  bool $forceSend
     * @return Message\CreateAppointmentExceptionResponse
     */
    function createAppointmentException(
        ?string $id = null,
        ?int $numComponents = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?Msg $msg = null,
        ?bool $echo = null,
        ?int $maxSize = null,
        ?bool $wantHtml = null,
        ?bool $neuter = null,
        ?bool $forceSend = null
    ): ?Message\CreateAppointmentExceptionResponse;

    /**
     * This is the API to create a new appointment, optionally sending out meeting invitations to other people.
     *
     * @param  Msg $msg
     * @param  bool $echo
     * @param  int $maxSize
     * @param  bool $wantHtml
     * @param  bool $neuter
     * @param  bool $forceSend
     * @return Message\CreateAppointmentResponse
     */
    function createAppointment(
        ?Msg $msg = null,
        ?bool $echo = null,
        ?int $maxSize = null,
        ?bool $wantHtml = null,
        ?bool $neuter = null,
        ?bool $forceSend = null
    ): ?Message\CreateAppointmentResponse;

    /**
     * Create a contact
     *
     * @param  ContactSpec $contact
     * @param  bool $verbose
     * @param  bool $wantImapUid
     * @param  bool $wantModifiedSequence
     * @return Message\CreateContactResponse
     */
    function createContact(
        ContactSpec $contact,
        ?bool $verbose = null,
        ?bool $wantImapUid = null,
        ?bool $wantModifiedSequence = null
    ): ?Message\CreateContactResponse;

    /**
     * Creates a data source that imports mail items into the specified folder,
     * for example via the POP3 or IMAP protocols.
     * Only one data source is allowed per request.
     *
     * @param  MailDataSource $dataSource
     * @return Message\CreateDataSourceResponse
     */
    function createDataSource(?MailDataSource $dataSource = null): ?Message\CreateDataSourceResponse;

    /**
     * Create folder
     *
     * @param  NewFolderSpec $folder
     * @return Message\CreateFolderResponse
     */
    function createFolder(NewFolderSpec $folder): ?Message\CreateFolderResponse;

    /**
     * Create mountpoint
     *
     * @param  NewMountpointSpec $folder
     * @return Message\CreateMountpointResponse
     */
    function createMountpoint(NewMountpointSpec $folder): ?Message\CreateMountpointResponse;

    /**
     * Create a note
     *
     * @param  NewNoteSpec $note
     * @return Message\CreateNoteResponse
     */
    function createNote(NewNoteSpec $note): ?Message\CreateNoteResponse;

    /**
     * Create a search folder
     *
     * @param  NewSearchFolderSpec $searchFolder
     * @return Message\CreateSearchFolderResponse
     */
    function createSearchFolder(NewSearchFolderSpec $searchFolder): ?Message\CreateSearchFolderResponse;

    /**
     * Create a tag
     *
     * @param  TagSpec $tag
     * @return Message\CreateTagResponse
     */
    function createTag(?TagSpec $tag = null): ?Message\CreateTagResponse;

    /**
     * Create task exception.
     *
     * @param  string $id
     * @param  int $numComponents
     * @param  int $modifiedSequence
     * @param  int $revision
     * @param  Msg $msg
     * @param  bool $echo
     * @param  int $maxSize
     * @param  bool $wantHtml
     * @param  bool $neuter
     * @param  bool $forceSend
     * @return Message\CreateTaskExceptionResponse
     */
    function createTaskException(
        ?string $id = null,
        ?int $numComponents = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?Msg $msg = null,
        ?bool $echo = null,
        ?int $maxSize = null,
        ?bool $wantHtml = null,
        ?bool $neuter = null,
        ?bool $forceSend = null
    ): ?Message\CreateTaskExceptionResponse;

    /**
     * This is the API to create a new task
     *
     * @param  Msg $msg
     * @param  bool $echo
     * @param  int $maxSize
     * @param  bool $wantHtml
     * @param  bool $neuter
     * @param  bool $forceSend
     * @return Message\CreateTaskResponse
     */
    function createTask(
        ?Msg $msg = null,
        ?bool $echo = null,
        ?int $maxSize = null,
        ?bool $wantHtml = null,
        ?bool $neuter = null,
        ?bool $forceSend = null
    ): ?Message\CreateTaskResponse;

    /**
     * Create a waitset to listen for changes on one or more accounts
     * Called once to initialize a WaitSet and to set its "default interest types"
     * WaitSet: scalable mechanism for listening for changes to one or more accounts
     *
     * @param  string $defaultInterests
     * @param  bool $allAccounts
     * @param  array $accounts
     * @return Message\CreateWaitSetResponse
     */
    function createWaitSet(
        string $defaultInterests, ?bool $allAccounts = null, array $accounts = []
    ): ?Message\CreateWaitSetResponse;

    /**
     * Decline a change proposal from an attendee.
     * Sent by organizer to an attendee who has previously sent a COUNTER message.
     * The syntax of the request is very similar to CreateAppointmentRequest.
     *
     * @param  Msg $msg
     * @return Message\DeclineCounterAppointmentResponse
     */
    function declineCounterAppointment(?Msg $msg = null): ?Message\DeclineCounterAppointmentResponse;

    /**
     * Deletes the given data sources.
     * The name or id of each data source must be specified.
     *
     * @param  array $dataSources
     * @return Message\DeleteDataSourceResponse
     */
    function deleteDataSource(array $dataSources = []): ?Message\DeleteDataSourceResponse;

    /**
     * Use this to close out the waitset.
     * Note that the server will automatically time out a wait set
     * if there is no reference to it for (default of) 20 minutes.
     * WaitSet: scalable mechanism for listening for changes to one or more accounts
     *
     * @param  string $waitSetId
     * @return Message\DestroyWaitSetResponse
     */
    function destroyWaitSet(string $waitSetId): ?Message\DestroyWaitSetResponse;

    /**
     * Performs line by line diff of two revisions of a document then returns a list of <chunk> containing the result.
     * Sections of text that are identical to both versions are indicated with disp="common".
     * For each conflict the chunk will show disp="first", disp="second" or both.
     *
     * @param  DiffDocumentVersionSpec $doc
     * @return Message\DiffDocumentResponse
     */
    function diffDocument(?DiffDocumentVersionSpec $doc = null): ?Message\DiffDocumentResponse;

    /**
     * Dismiss calendar item alarm
     *
     * @param  array $alarms
     * @return Message\DismissCalendarItemAlarmResponse
     */
    function dismissCalendarItemAlarm(array $alarms = []): ?Message\DismissCalendarItemAlarmResponse;

    /**
     * Document action
     *
     * @param  DocumentActionSelector $action
     * @return Message\DocumentActionResponse
     */
    function documentAction(DocumentActionSelector $action): ?Message\DocumentActionResponse;

    /**
     * Empty dumpster
     *
     * @return Message\EmptyDumpsterResponse
     */
    function emptyDumpster(): ?Message\EmptyDumpsterResponse;

    /**
     * Enable/disable reminders for shared appointments/tasks on a mountpoint
     *
     * @param  SharedReminderMount $mount
     * @return Message\EnableSharedReminderResponse
     */
    function enableSharedReminder(SharedReminderMount $mount): ?Message\EnableSharedReminderResponse;

    /**
     * Expand recurrences
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  array $timezones
     * @param  array $components
     * @return Message\ExpandRecurResponse
     */
    function expandRecur(
        int $startTime,
        int $endTime,
        array $timezones = [],
        array $components = []
    ): ?Message\ExpandRecurResponse;

    /**
     * Export contacts
     *
     * @param  string $contentType
     * @param  string $folderId
     * @param  string $csvFormat
     * @param  string $csvLocale
     * @param  string $csvDelimiter
     * @return Message\ExportContactsResponse
     */
    function exportContacts(
        string $contentType,
        ?string $folderId = null,
        ?string $csvFormat = null,
        ?string $csvLocale = null,
        ?string $csvDelimiter = null
    ): ?Message\ExportContactsResponse;

    /**
     * File Shared With Me.
     * This is an internal API, cannot be invoked directly
     *
     * @param  string $action
     * @param  string $fileName
     * @param  int $ownerFileId
     * @param  string $fileUUID
     * @param  string $fileOwnerName
     * @param  string $rights
     * @param  string $contentType
     * @param  int $size
     * @param  string $ownerAccountId
     * @param  int $date
     * @return Message\FileSharedWithMeResponse
     */
    function fileSharedWithMe(
        string $action = '',
        string $fileName = '',
        int $ownerFileId = 0,
        string $fileUUID = '',
        string $fileOwnerName = '',
        string $rights = '',
        string $contentType = '',
        int $size = 0,
        string $ownerAccountId = '',
        int $date = 0
    ): ?Message\FileSharedWithMeResponse;

    /**
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
     *   <action op="url" id="{list}" url="{target-url}" [excludeFreeBusy="{exclude-free-busy-bool}"]/>
     *     - set the synchronization url on the folder to {target-url}, empty the folder, and\
     *       synchronize the folder's contents to the remote feed, also sets {exclude-free-busy-bool}
     *
     *   <action op="sync" id="{list}"/>
     *     - synchronize the folder's contents to the remote feed specified by the folder's {url}
     *
     *   <action op="import" id="{list}" url="{target-url}"/>
     *     - add the contents to the remote feed at {target-url} to the folder [1-time action]
     *
     *   <action op="fb" id="{list}" excludeFreeBusy="{exclude-free-busy-bool}"/>
     *     - set the excludeFreeBusy bool for this folder (must specify {exclude-free-busy-bool})
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
     * @param  FolderActionSelector $action
     * @return Message\FolderActionResponse
     */
    function folderAction(FolderActionSelector $action): ?Message\FolderActionResponse;

    /**
     * Used by an attendee to forward an appointment invite email to another user who is not already an attendee.
     * To forward an appointment item, use ForwardAppointmentRequest instead.
     *
     * @param  string $id
     * @param  Msg $msg
     * @return Message\ForwardAppointmentInviteResponse
     */
    function forwardAppointmentInvite(
        ?string $id = null, ?Msg $msg = null
    ): ?Message\ForwardAppointmentInviteResponse;

    /**
     * Used by an attendee to forward an instance or entire appointment to another user who is not already an attendee.
     *
     * @param  string $id
     * @param  DtTimeInfo $exceptionId
     * @param  CalTZInfo $timezone
     * @param  Msg $msg
     * @return Message\ForwardAppointmentResponse
     */
    function forwardAppointment(
        ?string $id = null,
        ?DtTimeInfo $exceptionId = null,
        ?CalTZInfo $timezone = null,
        ?Msg $msg = null
    ): ?Message\ForwardAppointmentResponse;

    /**
     * Ajax client can use this request to ask the server for help in generating a proper, globally unique UUID.
     *
     * @return Message\GenerateUUIDResponse
     */
    function generateUUID(): ?Message\GenerateUUIDResponse;

    /**
     * Get appointment.
     * Returns the metadata info for each invite that makes up this appointment.
     *
     * @param  bool $sync
     * @param  bool $includeContent
     * @param  bool $includeInvites
     * @param  string $uid
     * @param  string $id
     * @return Message\GetAppointmentResponse
     */
    function getAppointment(
        ?bool $sync = null,
        ?bool $includeContent = null,
        ?bool $includeInvites = null,
        ?string $uid = null,
        ?string $id = null
    ): ?Message\GetAppointmentResponse;

    /**
     * Get appointment ids for given range 
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  string $folderId
     * @return Message\GetAppointmentIdsInRangeResponse
     */
    function getAppointmentIdsInRange(
        int $startTime, int $endTime, string $folderId = ''
    ): ?Message\GetAppointmentIdsInRangeResponse;

    /**
     * Get appointment ids since given id
     *
     * @param  int $lastSync
     * @param  string $folderId
     * @return Message\GetAppointmentIdsSinceResponse
     */
    function getAppointmentIdsSince(
        int $lastSync, string $folderId = ''
    ): ?Message\GetAppointmentIdsSinceResponse;

    /**
     * Get appointment summaries
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  string $folderId
     * @return Message\GetApptSummariesResponse
     */
    function getApptSummaries(
        int $startTime, int $endTime, ?string $folderId = null
    ): ?Message\GetApptSummariesResponse;

    /**
     * Get calendar item summaries
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  string $folderId
     * @return Message\GetCalendarItemSummariesResponse
     */
    function getCalendarItemSummaries(
        int $startTime, int $endTime, ?string $folderId = null
    ): ?Message\GetCalendarItemSummariesResponse;

    /**
     * Get comments
     *
     * @param  ParentId $comment
     * @return Message\GetCommentsResponse
     */
    function getComments(ParentId $comment): ?Message\GetCommentsResponse;

    /**
     * Get list of available contact backups
     *
     * @return Message\GetContactBackupListResponse
     */
    function getContactBackupList(): ?Message\GetContactBackupListResponse;

    /**
     * Get contact
     * Contact group members are returned as <m> elements.
     * If derefGroupMember is not set, group members are returned in the order they were inserted in the group.
     * If derefGroupMember is set, group members are returned ordered by the "key" of member.
     * Key is:
     * - for contact ref (type="C"): the fileAs field of the Contact
     * - for GAL ref (type="G"): email address of the GAL entry
     * - for inlined member (type="I"): the value
     * 
     * Contact group members are returned as sub-elements of <m>.
     * If for any(transient or permanent) reason a member cannot be dereferenced,
     * then there will be no sub-element under <m>.
     *
     * @param  bool $sync
     * @param  string $folderId
     * @param  string $sortBy
     * @param  bool $derefGroupMember
     * @param  bool $includeMemberOf
     * @param  bool $returnHiddenAttrs
     * @param  bool $returnCertInfo
     * @param  bool $wantImapUid
     * @param  int $maxMembers
     * @param  array $attributes
     * @param  array $memberAttributes
     * @param  array $contacts
     * @return Message\GetContactsResponse
     */
    function getContacts(
        ?bool $sync = null,
        ?string $folderId = null,
        ?string $sortBy = null,
        ?bool $derefGroupMember = null,
        ?bool $includeMemberOf = null,
        ?bool $returnHiddenAttrs = null,
        ?bool $returnCertInfo = null,
        ?bool $wantImapUid = null,
        ?int $maxMembers = null,
        array $attributes = [],
        array $memberAttributes = [],
        array $contacts = []
    ): ?Message\GetContactsResponse;

    /**
     * Get Conversation
     * 
     * GetConvRequest gets information about the 1 conversation named by id's value.
     * It will return exactly 1 conversation element.
     * 
     * If fetch="1|all" is included, the full expanded message structure is inlined for the first (or for all) messages
     * in the conversation.  If fetch="{item-id}", only the message with the given {item-id} is expanded inline.
     * 
     * if headers are requested, any matching headers are inlined into the response (not available when raw="1")
     *
     * @return Message\GetConvResponse
     */
    function getConv(ConversationSpec $conversation): ?Message\GetConvResponse;

    /**
     * Get custom metadata
     *
     * @param  string $id
     * @param  SectionAttr $metadata
     * @return Message\GetCustomMetadataResponse
     */
    function getCustomMetadata(
        SectionAttr $metadata, ?string $id = null
    ): ?Message\GetCustomMetadataResponse;

    /**
     * Returns all data sources defined for the given mailbox.
     * For each data source, every attribute value is returned except password.
     *
     * @return Message\GetDataSourcesResponse
     */
    function getDataSources(): ?Message\GetDataSourcesResponse;

    /**
     * Get data source usage
     *
     * @return Message\GetDataSourceUsageResponse
     */
    function getDataSourceUsage(): ?Message\GetDataSourceUsageResponse;

    /**
     * Get the download URL of shared document
     *
     * @param  ItemSpec $item
     * @return Message\GetDocumentShareURLResponse
     */
    function getDocumentShareURL(ItemSpec $item): ?Message\GetDocumentShareURLResponse;

    /**
     * Returns the effective permissions of the specified folder
     *
     * @param  FolderSpec $folder
     * @return Message\GetEffectiveFolderPermsResponse
     */
    function getEffectiveFolderPerms(FolderSpec $folder): ?Message\GetEffectiveFolderPermsResponse;

    /**
     * Get filter rules
     *
     * @return Message\GetFilterRulesResponse
     */
    function getFilterRules(): ?Message\GetFilterRulesResponse;

    /**
     * Get folder
     * 
     * A {base-folder-id}, a {base-folder-uuid} or a {fully-qualified-path} can optionally be specified in the folder
     * element; if none is present, the descent of the folder hierarchy begins at the mailbox's root folder (id 1).
     * 
     * If {fully-qualified-path} is present and {base-folder-id} or {base-folder-uuid} is also present, the path is
     * treated as relative to the folder that was specified by id/uuid.  {base-folder-id} is ignored if {base-folder-uuid}
     * is present.
     *
     * @param  GetFolderSpec $folder
     * @param  bool $isVisible
     * @param  bool $needGranteeName
     * @param  string $viewConstraint
     * @param  int $treeDepth
     * @param  bool $traverseMountpoints
     * @return Message\GetFolderResponse
     */
    function getFolder(
        ?GetFolderSpec $folder = null,
        ?bool $isVisible = null,
        ?bool $needGranteeName = null,
        ?string $viewConstraint = null,
        ?int $treeDepth = null,
        ?bool $traverseMountpoints = null
    ): ?Message\GetFolderResponse;

    /**
     * Get Free/Busy information.
     * For freebusyUsers listed using uid,id or name attributes, f/b search will be done for all calendar folders.
     * To view free/busy for a single folder in a particular account, use <usr>
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  string $uid
     * @param  string $id
     * @param  string $name
     * @param  string $excludeUid
     * @param  array $freebusyUsers
     * @return Message\GetFreeBusyResponse
     */
    function getFreeBusy(
        int $startTime,
        int $endTime,
        ?string $uid = null,
        ?string $id = null,
        ?string $name = null,
        ?string $excludeUid = null,
        array $freebusyUsers = []
    ): ?Message\GetFreeBusyResponse;

    /**
     * Retrieve the unparsed (but XML-encoded) iCalendar data for an Invite
     * This is intended for interfacing with 3rd party programs
     * If <id> attribute specified, gets the iCalendar representation for one invite
     * If <id> attribute is not specified, then start/end MUST be, Calendar data is returned for entire specified range
     *
     * @param  string $id
     * @param  int $startTime
     * @param  int $endTime
     * @return Message\GetICalResponse
     */
    function getICal(
        ?string $id = null, ?int $startTime = null, ?int $endTime = null
    ): ?Message\GetICalResponse;

    /**
     * Return the count of recent items in the specified folder
     *
     * @param  string $id
     * @return Message\GetIMAPRecentCutoffResponse
     */
    function getIMAPRecentCutoff(string $id): ?Message\GetIMAPRecentCutoffResponse;

    /**
     * Return the count of recent items in the specified folder
     *
     * @param  string $id
     * @return Message\GetIMAPRecentResponse
     */
    function getIMAPRecent(string $id): ?Message\GetIMAPRecentResponse;

    /**
     * Returns current import status for all data sources.  Status values for a data source
     * are reinitialized when either (a) another import process is started or (b) when the server is restarted.
     * If import has not run yet, the success and error attributes are not specified in the response.
     *
     * @return Message\GetImportStatusResponse
     */
    function getImportStatus(): ?Message\GetImportStatusResponse;

    /**
     * Get item
     * A successful GetItemResponse will contain a single element appropriate for the type of the requested item if there
     * is no matching item, a fault containing the code mail.NO_SUCH_ITEM is returned
     *
     * @param  ItemSpec $item
     * @return Message\GetItemResponse
     */
    function getItem(ItemSpec $item): ?Message\GetItemResponse;

    /**
     * Returns the last ID assigned to an item successfully created in the mailbox
     *
     * @return Message\GetLastItemIdInMailboxResponse
     */
    function getLastItemIdInMailbox(): ?Message\GetLastItemIdInMailboxResponse;

    /**
     * Get Mailbox metadata
     *
     * @param  SectionAttr $metadata
     * @return Message\GetMailboxMetadataResponse
     */
    function getMailboxMetadata(SectionAttr $metadata): ?Message\GetMailboxMetadataResponse;

    /**
     * Get information needed for Mini Calendar.
     * Date is returned if there is at least one appointment on that date.  The date computation uses the requesting
     * (authenticated) account's time zone, not the time zone of the account that owns the calendar folder.
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  array $folders
     * @param  CalTZInfo $timezone
     * @return Message\GetMiniCalResponse
     */
    function getMiniCal(
        int $startTime,
        int $endTime,
        array $folders = [],
        ?CalTZInfo $timezone = null
    ): ?Message\GetMiniCalResponse;

    /**
     * Returns the IDs of all items modified since a given change number
     *
     * @param  string $folderId
     * @param  int $modSeq
     * @return Message\GetModifiedItemsIDsResponse
     */
    function getModifiedItemsIDs(string $folderId, int $modSeq): ?Message\GetModifiedItemsIDsResponse;

    /**
     * Get message metadata
     *
     * @param  IdsAttr $msgIds
     * @return Message\GetMsgMetadataResponse
     */
    function getMsgMetadata(IdsAttr $msgIds): ?Message\GetMsgMetadataResponse;

    /**
     * Get Message
     *
     * @param  MsgSpec $msg
     * @return Message\GetMsgResponse
     */
    function getMsg(MsgSpec $msg): ?Message\GetMsgResponse;

    /**
     * Get Note
     *
     * @param  Id $note
     * @return Message\GetNoteResponse
     */
    function getNote(Id $note): ?Message\GetNoteResponse;

    /**
     * Get outgoing filter rules
     *
     * @return Message\GetOutgoingFilterRulesResponse
     */
    function getOutgoingFilterRules(): ?Message\GetOutgoingFilterRulesResponse;

    /**
     * Get account level permissions
     * If no <ace> elements are provided, all ACEs are returned in the response.
     * If <ace> elements are provided, only those ACEs with specified rights are returned in the response.
     * Note: to be deprecated in Zimbra 9.  Use zimbraAccount GetRights instead.
     *
     * @param  array $aces
     * @return Message\GetPermissionResponse
     */
    function getPermission(array $aces = []): ?Message\GetPermissionResponse;

    /**
     * Retrieve the recurrence definition of an appointment
     *
     * @param  string $id
     * @return Message\GetRecurResponse
     */
    function getRecur(string $id): ?Message\GetRecurResponse;

    /**
     * Get all search folders
     *
     * @return Message\GetSearchFolderResponse
     */
    function getSearchFolder(): ?Message\GetSearchFolderResponse;

    /**
     * Get share notifications
     *
     * @return Message\GetShareNotificationsResponse
     */
    function getShareNotifications(): ?Message\GetShareNotificationsResponse;

    /**
     * Returns the list of dictionaries that can be used for spell checking.
     *
     * @return Message\GetSpellDictionariesResponse
     */
    function getSpellDictionaries(): ?Message\GetSpellDictionariesResponse;

    /**
     * Get system retention policy
     *
     * @return Message\GetSystemRetentionPolicyResponse
     */
    function getSystemRetentionPolicy(): ?Message\GetSystemRetentionPolicyResponse;

    /**
     * Get information about tags
     *
     * @return Message\GetTagResponse
     */
    function getTag(): ?Message\GetTagResponse;

    /**
     * Get task
     * Similar to GetAppointmentRequest/GetAppointmentResponse
     *
     * @param  bool $sync
     * @param  bool $includeContent
     * @param  bool $includeInvites
     * @param  string $uid
     * @param  string $id
     * @return Message\GetTaskResponse
     */
    function getTask(
        ?bool $sync = null,
        ?bool $includeContent = null,
        ?bool $includeInvites = null,
        ?string $uid = null,
        ?string $id = null
    ): ?Message\GetTaskResponse;

    /**
     * Get Task summaries
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  string $folderId
     * @return Message\GetTaskSummariesResponse
     */
    function getTaskSummaries(
        int $startTime, int $endTime, ?string $folderId = null
    ): ?Message\GetTaskSummariesResponse;

    /**
     * User's working hours within the given time range are expressed in a similar format
     * to the format used for GetFreeBusy.
     * Working hours are indicated as free, non-working hours as unavailable/out of office
     * The entire time range is marked as unknown if there was an error determining the working hours,
     *
     * @param  int $startTime
     * @param  int $endTime
     * @param  string $id
     * @param  string $name
     * @return Message\GetWorkingHoursResponse
     */
    function getWorkingHours(
        int $startTime, int $endTime, ?string $id = null, ?string $name = null
    ): ?Message\GetWorkingHoursResponse;

    /**
     * Get Yahoo Auth Token
     *
     * @param  string $user
     * @param  string $password
     * @return Message\GetYahooAuthTokenResponse
     */
    function getYahooAuthToken(string $user, string $password): ?Message\GetYahooAuthTokenResponse;

    /**
     * Get Yahoo cookie
     *
     * @param  string $user
     * @return Message\GetYahooCookieResponse
     */
    function getYahooCookie(string $user): ?Message\GetYahooCookieResponse;

    /**
     * Grant account level permissions
     * GrantPermissionResponse returns permissions that are successfully granted.
     * Note: to be deprecated in Zimbra 9.  Use zimbraAccount GrantRights instead.
     *
     * @param  array $aces
     * @return Message\GrantPermissionResponse
     */
    function grantPermission(array $aces = []): ?Message\GrantPermissionResponse;

    /**
     * Do an iCalendar Reply
     *
     * @param  string $ical
     * @return Message\ICalReplyResponse
     */
    function iCalReply(string $ical): ?Message\ICalReplyResponse;

    /**
     * Return the count of recent items in the specified folder
     *
     * @param  string $ids
     * @param  MailItemType $type
     * @param  int $folder
     * @return Message\IMAPCopyResponse
     */
    function imapCopy(string $ids, ?MailItemType $type = null, int $folder = 0): ?Message\IMAPCopyResponse;

    /**
     * Import appointments
     *
     * @param  ContentSpec $content
     * @param  string $contentType
     * @param  string $folderId
     * @return Message\ImportAppointmentsResponse
     */
    function importAppointments(
        ContentSpec $content,
        string $contentType = 'text/calendar',
        ?string $folderId = null
    ): ?Message\ImportAppointmentsResponse;

    /**
     * Import contacts
     *
     * @param  Content $content
     * @param  string $contentType
     * @param  string $folderId
     * @param  string $csvFormat
     * @param  string $csvLocale
     * @return Message\ImportContactsResponse
     */
    function importContacts(
        Content $content,
        string $contentType = 'text/csv',
        ?string $folderId = null,
        ?string $csvFormat = null,
        ?string $csvLocale = null
    ): ?Message\ImportContactsResponse;

    /**
     * Triggers the specified data sources to kick off their import processes.
     * Data import runs asynchronously, so the response immediately returns.  Status of an import can be queried via
     * the <GetImportStatusRequest> message.  If the server receives an <ImportDataRequest> while
     * an import is already running for a given data source, the second request is ignored.
     *
     * @param  array $dataSources
     * @return Message\ImportDataResponse
     */
    function importData(array $dataSources = []): ?Message\ImportDataResponse;

    /**
     * Invalidate reminder device
     *
     * @param  string $address
     * @return Message\InvalidateReminderDeviceResponse
     */
    function invalidateReminderDevice(string $address): ?Message\InvalidateReminderDeviceResponse;

    /**
     * Perform an action on an item
     *
     * @param  ActionSelector $action
     * @return Message\ItemActionResponse
     */
    function itemAction(ActionSelector $action): ?Message\ItemActionResponse;

    /**
     * Returns {num} number of revisions starting from {version} of the requested document.
     * {num} defaults to 1. {version} defaults to the current version.
     * Documents that have multiple revisions have the flag "/", which indicates that the document is versioned.
     *
     * @param  ListDocumentRevisionsSpec $doc
     * @return Message\ListDocumentRevisionsResponse
     */
    function listDocumentRevisions(ListDocumentRevisionsSpec $doc): ?Message\ListDocumentRevisionsResponse;

    /**
     * Return a list of subscribed folder names
     *
     * @return Message\ListIMAPSubscriptionsResponse
     */
    function listIMAPSubscriptions(): ?Message\ListIMAPSubscriptionsResponse;

    /**
     * Modify an appointment, or if the appointment is a recurrence then modify the "default"
     * invites. That is, all instances that do not have exceptions.
     * If the appointment has a <recur>, then the following caveats are worth mentioning:
     * If any of: START, DURATION, END or RECUR change, then all exceptions are implicitly canceled!
     *
     * @param  string $id
     * @param  int $componentNum
     * @param  int $modifiedSequence
     * @param  int $revision
     * @param  Msg $msg
     * @param  bool $echo
     * @param  int $maxSize
     * @param  bool $wantHtml
     * @param  bool $neuter
     * @param  bool $forceSend
     * @return Message\ModifyAppointmentResponse
     */
    function modifyAppointment(
        ?string $id = null,
        ?int $componentNum = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?Msg $msg = null,
        ?bool $echo = null,
        ?int $maxSize = null,
        ?bool $wantHtml = null,
        ?bool $neuter = null,
        ?bool $forceSend = null
    ): ?Message\ModifyAppointmentResponse;

    /**
     * Modify Contact
     * When modifying tags, all specified tags are set and all others are unset.  If tn="{tag-names}" is NOT specified
     * then any existing tags will remain set.
     *
     * @param  ModifyContactSpec $contact
     * @param  bool $replace
     * @param  bool $verbose
     * @param  bool $wantImapUid
     * @param  bool $wantModifiedSequence
     * @return Message\ModifyContactResponse
     */
    function modifyContact(
        ModifyContactSpec $contact,
        ?bool $replace = null,
        ?bool $verbose = null,
        ?bool $wantImapUid = null,
        ?bool $wantModifiedSequence = null
    ): ?Message\ModifyContactResponse;

    /**
     * Changes attributes of the given data source.  Only the attributes specified in the
     * request are modified.  If the username, host or leaveOnServer settings are modified, the server wipes out saved
     * state for this data source.  As a result, any previously downloaded messages that are still stored on the remote
     * server will be downloaded again.
     *
     * @param  MailDataSource $dataSource
     * @return Message\ModifyDataSourceResponse
     */
    function modifyDataSource(?MailDataSource $dataSource = null): ?Message\ModifyDataSourceResponse;

    /**
     * Modify Filter rules
     *
     * @param  array $filterRules
     * @return Message\ModifyFilterRulesResponse
     */
    function modifyFilterRules(array $filterRules = []): ?Message\ModifyFilterRulesResponse;

    /**
     * Modify Mailbox Metadata
     * - Modify request must contain one or more key/value pairs
     * - Existing keys' values will be replaced by new values
     * - Empty or null value will remove a key
     * - New keys can be added
     *
     * @param  MailCustomMetadata $metadata
     * @return Message\ModifyMailboxMetadataResponse
     */
    function modifyMailboxMetadata(
        ?MailCustomMetadata $metadata = null
    ): ?Message\ModifyMailboxMetadataResponse;

    /**
     * Modify Outgoing Filter rules
     *
     * @param  array $filterRules
     * @return Message\ModifyOutgoingFilterRulesResponse
     */
    function modifyOutgoingFilterRules(
        array $filterRules = []
    ): ?Message\ModifyOutgoingFilterRulesResponse;

    /**
     * Modify profile image
     *
     * @param  string $uploadId
     * @param  string $imageB64Data
     * @return Message\ModifyProfileImageResponse
     */
    function modifyProfileImage(
        ?string $uploadId = null, ?string $imageB64Data = null
    ): ?Message\ModifyProfileImageResponse;

    /**
     * Modify Search Folder
     *
     * @param  ModifySearchFolderSpec $searchFolder
     * @return Message\ModifySearchFolderResponse
     */
    function modifySearchFolder(
        ModifySearchFolderSpec $searchFolder
    ): ?Message\ModifySearchFolderResponse;

    /**
     * Modify Task
     *
     * @param  string $id
     * @param  int $componentNum
     * @param  int $modifiedSequence
     * @param  int $revision
     * @param  Msg $msg
     * @param  bool $echo
     * @param  int $maxSize
     * @param  bool $wantHtml
     * @param  bool $neuter
     * @param  bool $forceSend
     * @return Message\ModifyTaskResponse
     */
    function modifyTask(
        ?string $id = null,
        ?int $componentNum = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?Msg $msg = null,
        ?bool $echo = null,
        ?int $maxSize = null,
        ?bool $wantHtml = null,
        ?bool $neuter = null,
        ?bool $forceSend = null
    ): ?Message\ModifyTaskResponse;

    /**
     * Perform an action on a message
     * For op="update", caller can specify any or all of: l="{folder}", name="{name}", color="{color}", tn="{tag-names}",
     * f="{flags}".
     * For op="!spam", can optionally specify a destination folder
     *
     * @param  ActionSelector $action
     * @return Message\MsgActionResponse
     */
    function msgAction(ActionSelector $action): ?Message\MsgActionResponse;

    /**
     * A request that does nothing and always returns nothing. Used to keep a session alive,
     * and return any pending notifications.
     *
     * If "wait" is set, and if the current session allows them, this request will block until there are new notifications
     * for the client.  Note that the soap envelope must reference an existing session that has notifications enabled, and
     * the notification sequencing number should be specified.
     * 
     * If "wait" is set, the caller can specify whether notifications on delegate sessions will cause the operation to
     * return.  If "delegate" is unset, delegate mailbox notifications will be ignored.  "delegate" is set by default.
     * 
     * Some clients (notably browsers) have a global-limit on the number of outstanding sockets...in situations with two
     * App Instances connected to one Zimbra Server, the browser app my appear to 'hang' if two app sessions attempt to do
     * a blocking-NoOp simultaneously.  Since the apps are completely separate in the browser, it is impossible for the
     * apps to coordinate with each other -- therefore the 'limitToOneBlocked' setting is exposed by the server.  If
     * specified, the server will only allow a given user to have one single waiting-NoOp on the server at a time, it will
     * complete (with waitDisallowed set) any existing limited hanging NoOpRequests when a new request comes in.
     * 
     * The server may reply with a "waitDisallowed" attribute on response to a request with wait set.  If "waitDisallowed"
     * is set, then blocking-NoOpRequests (ie requests with wait set) are <b>not</b> allowed by the server right now, and
     * the client should stop attempting them.
     * 
     * The client may specify a custom timeout-length for their request if they know something about the particular
     * underlying network.  The server may or may not honor this request (depending on server configured max/min values:
     * see LocalConfig variables zimbra_noop_default_timeout, zimbra_noop_min_timeout and zimbra_noop_max_timeout)
     *
     * @param  bool $wait
     * @param  bool $includeDelegates
     * @param  bool $enforceLimit
     * @param  int $timeout
     * @return Message\NoOpResponse
     */
    function noOp(
        ?bool $wait = null,
        ?bool $includeDelegates = null,
        ?bool $enforceLimit = null,
        ?int $timeout = null
    ): ?Message\NoOpResponse;

    /**
     * Perform an action on an note
     *
     * @param  NoteActionSelector $action
     * @return Message\NoteActionResponse
     */
    function noteAction(NoteActionSelector $action): ?Message\NoteActionResponse;

    /**
     * Open IMAP folder
     *
     * @param  string $folderId
     * @param  int $limit
     * @param  ImapCursorInfo $cursor
     * @return Message\OpenIMAPFolderResponse
     */
    function openIMAPFolder(
        string $folderId, int $limit, ?ImapCursorInfo $cursor = null
    ): ?Message\OpenIMAPFolderResponse;

    /**
     * Purge revision
     *
     * @param  PurgeRevisionSpec $revision
     * @return Message\PurgeRevisionResponse
     */
    function purgeRevision(PurgeRevisionSpec $revision): ?Message\PurgeRevisionResponse;

    /**
     * Perform an action on the contact ranking table
     *
     * @param  RankingActionSpec $action
     * @return Message\RankingActionResponse
     */
    function rankingAction(RankingActionSpec $action): ?Message\RankingActionResponse;

    /**
     * Record that an IMAP client has seen all the messages in this folder as they
     * are at this time.
     * This is used to determine which messages are considered by IMAP to be RECENT.
     * This is achieved by invoking Mailbox::recordImapSession for the specified folder
     *
     * @param  string $folderId
     * @return Message\RecordIMAPSessionResponse
     */
    function recordIMAPSession(string $folderId): ?Message\RecordIMAPSessionResponse;

    /**
     * Recover account request
     *
     * @param  string $email
     * @param  RecoverAccountOperation $op
     * @param  Channel $channel
     * @return Message\RecoverAccountResponse
     */
    function recoverAccount(
        string $email,
        ?RecoverAccountOperation $op = null,
        ?Channel $channel = null
    ): ?Message\RecoverAccountResponse;

    /**
     * Remove attachments from a message body
     * NOTE: that this operation is effectively a create and a delete, and thus the message's item ID will change
     *
     * @param  MsgPartIds $msg
     * @return Message\RemoveAttachmentsResponse
     */
    function removeAttachments(MsgPartIds $msg): ?Message\RemoveAttachmentsResponse;

    /**
     * Resets the mailbox's "recent message count" to 0.  A message is considered "recent" if:
     * - (a) it's not a draft or a sent message, and
     * - (b) it was added since the last write operation associated with any SOAP session.
     *
     * @return Message\ResetRecentMessageCountResponse
     */
    function resetRecentMessageCount(): ?Message\ResetRecentMessageCountResponse;

    /**
     * Restore contacts
     *
     * @param  string $fileName
     * @param  RestoreResolve $resolve
     * @return Message\RestoreContactsResponse
     */
    function restoreContacts(
        string $fileName, ?RestoreResolve $resolve = null
    ): ?Message\RestoreContactsResponse;

    /**
     * Revoke account level permissions
     * RevokePermissionResponse returns permissions that are successfully revoked.
     * Note: to be deprecated in Zimbra 9.  Use zimbraAccount RevokeRights instead.
     *
     * @param  array $aces
     * @return Message\RevokePermissionResponse
     */
    function revokePermission(array $aces = []): ?Message\RevokePermissionResponse;

    /**
     * Save Document
     * One mechanism for Creating and updating a Document is:
     * - Use FileUploadServlet to upload the document
     * - Call SaveDocumentRequest using the upload-id returned from FileUploadServlet.
     * 
     * A Document represents a file.  A file can be created by uploading to FileUploadServlet.  Or it can refer to an
     * attachment of an existing message.
     * 
     * Documents are versioned.  The server maintains the metadata of each version, such as by who and when the version
     * was edited, and the fragment.
     * 
     * When updating an existing Document, the client must supply the id of Document, and the last known version of the
     * document in the 'ver' attribute.  This is used to prevent blindly overwriting someone else's change made after
     * the version this update was based upon.  The update will succeed only when the last known version supplied by the
     * client matches the current version of the item identified by item-id.
     * 
     * Saving a new document, as opposed to adding a revision of existing document, should leave the id and ver fields
     * empty in the request.  Then the server checks and see if the named document already exists, if so returns an error.
     * 
     * The request should contain either an <upload> element or a <msg> element, but not both.
     * When <upload> is used, the document should first be uploaded to FileUploadServlet, and then use the
     * upload-id from the FileUploadResponse.
     * 
     * When <m> is used, the document is retrieved from an existing message in the mailbox, identified by the
     * msg-id and part-id.  The content of the document can be inlined in the <content> element.
     * The content can come from another document / revision specified in the <doc> sub element.
     *
     * @param  DocumentSpec $doc
     * @return Message\SaveDocumentResponse
     */
    function saveDocument(DocumentSpec $doc): ?Message\SaveDocumentResponse;

    /**
     * Save draft
     * - Only allowed one top-level <mp> but can nest <mp>s within if multipart/* on reply/forward.
     *   Set origid on <m> element and set rt to "r" or "w", respectively.
     * - Can optionally set identity-id to specify the identity being used to compose the message.  If updating an
     *   existing draft, set "id" attr on <m> element.
     * - Can refer to parts of existing draft in <attach> block
     * - Drafts default to the Drafts folder
     * - Setting folder/tags/flags/color occurs <b>after</b> the draft is created/updated, and if it fails the content
     *   WILL STILL BE SAVED
     * - Can optionally set autoSendTime to specify the time at which the draft should be automatically sent by the server
     * - The ID of the saved draft is returned in the "id" attribute of the response.
     * - The ID referenced in the response's "idnt" attribute specifies the folder where the sent message is saved.
     *
     * @param  SaveDraftMsg $msg
     * @param  bool $wantImapUid
     * @param  bool $wantModifiedSequence
     * @return Message\SaveDraftResponse
     */
    function saveDraft(
        SaveDraftMsg $msg,
        ?bool $wantImapUid = null,
        ?bool $wantModifiedSequence = null
    ): ?Message\SaveDraftResponse;

    /**
     * Save a list of folder names subscribed to via IMAP
     *
     * @param  array $subscriptions
     * @return Message\SaveIMAPSubscriptionsResponse
     */
    function saveIMAPSubscriptions(array $subscriptions = []): ?Message\SaveIMAPSubscriptionsResponse;

    /**
     * Search action
     *
     * @param  Message\SearchRequest $searchRequest
     * @param  BulkAction $bulkAction
     * @return Message\SearchActionResponse
     */
    function searchAction(
        Message\SearchRequest $searchRequest, BulkAction $bulkAction
    ): ?Message\SearchActionResponse;

    /**
     * Search a conversation
     *
     * @param string $conversationId
     * @param string $query
     * @param bool $inDumpster
     * @param string $searchTypes
     * @param string $groupBy
     * @param bool $quick
     * @param SearchSortBy $sortBy
     * @param bool $includeTagDeleted
     * @param bool $includeTagMuted
     * @param string $taskStatus
     * @param int $calItemExpandStart
     * @param int $calItemExpandEnd
     * @param string $fetch
     * @param bool $markRead
     * @param int $maxInlinedLength
     * @param bool $wantHtml
     * @param bool $needCanExpand
     * @param bool $neuterImages
     * @param WantRecipsSetting $wantRecipients
     * @param bool $prefetch
     * @param string $resultMode
     * @param bool $fullConversation
     * @param string $field
     * @param int $limit
     * @param int $offset
     * @param array $headers
     * @param CalTZInfo $calTz
     * @param string $locale
     * @param CursorInfo $cursor
     * @param MsgContent $wantContent
     * @param bool $includeMemberOf
     * @param bool $nestMessages
     * @return Message\SearchConvResponse
     */
    function searchConv(
        string $conversationId = '',
        ?string $query = null,
        ?bool $inDumpster = null,
        ?string $searchTypes = null,
        ?string $groupBy = null,
        ?int $calItemExpandStart = null,
        ?int $calItemExpandEnd = null,
        ?bool $quick = null,
        ?SearchSortBy $sortBy = null,
        ?bool $includeTagDeleted = null,
        ?bool $includeTagMuted = null,
        ?string $taskStatus = null,
        ?string $fetch = null,
        ?bool $markRead = null,
        ?int $maxInlinedLength = null,
        ?bool $wantHtml = null,
        ?bool $needCanExpand = null,
        ?bool $neuterImages = null,
        ?WantRecipsSetting $wantRecipients = null,
        ?bool $prefetch = null,
        ?string $resultMode = null,
        ?bool $fullConversation = null,
        ?string $field = null,
        ?int $limit = null,
        ?int $offset = null,
        array $headers = [],
        ?CalTZInfo $calTz = null,
        ?string $locale = null,
        ?CursorInfo $cursor = null,
        ?MsgContent $wantContent = null,
        ?bool $includeMemberOf = null,
        ?bool $nestMessages = null
    ): ?Message\SearchConvResponse;

    /**
     * Search
     * For a response, the order of the returned results represents the sorted order.
     * There is not a separate index attribute or element.
     *
     * @param string $query
     * @param bool $inDumpster
     * @param string $searchTypes
     * @param string $groupBy
     * @param bool $quick
     * @param SearchSortBy $sortBy
     * @param bool $includeTagDeleted
     * @param bool $includeTagMuted
     * @param string $taskStatus
     * @param int $calItemExpandStart
     * @param int $calItemExpandEnd
     * @param string $fetch
     * @param bool $markRead
     * @param int $maxInlinedLength
     * @param bool $wantHtml
     * @param bool $needCanExpand
     * @param bool $neuterImages
     * @param WantRecipsSetting $wantRecipients
     * @param bool $prefetch
     * @param string $resultMode
     * @param bool $fullConversation
     * @param string $field
     * @param int $limit
     * @param int $offset
     * @param array $headers
     * @param CalTZInfo $calTz
     * @param string $locale
     * @param CursorInfo $cursor
     * @param MsgContent $wantContent
     * @param bool $includeMemberOf
     * @param bool $warmup
     * @return Message\SearchResponse
     */
    function search(
        ?string $query = null,
        ?bool $inDumpster = null,
        ?string $searchTypes = null,
        ?string $groupBy = null,
        ?int $calItemExpandStart = null,
        ?int $calItemExpandEnd = null,
        ?bool $quick = null,
        ?SearchSortBy $sortBy = null,
        ?bool $includeTagDeleted = null,
        ?bool $includeTagMuted = null,
        ?string $taskStatus = null,
        ?string $fetch = null,
        ?bool $markRead = null,
        ?int $maxInlinedLength = null,
        ?bool $wantHtml = null,
        ?bool $needCanExpand = null,
        ?bool $neuterImages = null,
        ?WantRecipsSetting $wantRecipients = null,
        ?bool $prefetch = null,
        ?string $resultMode = null,
        ?bool $fullConversation = null,
        ?string $field = null,
        ?int $limit = null,
        ?int $offset = null,
        array $headers = [],
        ?CalTZInfo $calTz = null,
        ?string $locale = null,
        ?CursorInfo $cursor = null,
        ?MsgContent $wantContent = null,
        ?bool $includeMemberOf = null,
        ?bool $warmup = null
    ): ?Message\SearchResponse;

    /**
     * Send a delivery report
     *
     * @param  string $messageId
     * @return Message\SendDeliveryReportResponse
     */
    function sendDeliveryReport(string $messageId): ?Message\SendDeliveryReportResponse;

    /**
     * Send a reply to an invite
     *
     * @param  string $id
     * @param  int $componentNum
     * @param  VerbType $verb
     * @param  bool $updateOrganizer
     * @param  string $identityId
     * @param  Msg $msg
     * @return Message\SendInviteReplyResponse
     */
    function sendInviteReply(
        string $id,
        int $componentNum,
        ?VerbType $verb = null,
        ?bool $updateOrganizer = null,
        ?string $identityId = null,
        ?DtTimeInfo $exceptionId = null,
        ?CalTZInfo $timezone = null,
        ?Msg $msg = null
    ): ?Message\SendInviteReplyResponse;

    /**
     * Send message
     * 
     * - Supports (f)rom, (t)o, (c)c, (b)cc, (r)eply-to, (s)ender, read-receipt (n)otification "type" on <e> elements.
     * - Only allowed one top-level <mp> but can nest <mp>s within if multipart/*
     * - A leaf <mp> can have inlined content (<mp ct="{content-type}"><content>...</content></mp>)
     * - A leaf <mp> can have referenced content (<mp><attach ...></mp>)
     * - Any <mp> can have a Content-ID header attached to it.
     * - On reply/forward, set origid on <m> element and set rt to "r" or "w", respectively
     * - Can optionally set identity-id to specify the identity being used to compose the message
     * - If noSave is set, a copy will not be saved to sent regardless of account/identity settings
     * - Can set priority high (!) or low (?) on sent message by specifying "f" attr on <m>
     * - The message to be sent can be fully specified under the <m> element or, to compose the message
     *      remotely remotely, upload it via FileUploadServlet, and submit it through our server using something like:
     *      <code>
     *         <SendMsgRequest [suid="{send-uid}"] [needCalendarSentByFixup="0|1"]>
     *             <m aid="{uploaded-MIME-body-ID}" [origid="..." rt="r|w"]/>
     *         </SendMsgRequest>
     *      </code>
     * - If the message is saved to the sent folder then the ID of the message is returned.  Otherwise, no ID is
     *   returned -- just a <m> is returned.
     *
     * @param MsgToSend $msg
     * @param bool $needCalendarSentbyFixup
     * @param bool $isCalendarForward
     * @param bool $noSaveToSent
     * @param bool $fetchSavedMsg
     * @param string $sendUid
     * @param bool $deliveryReport
     * @return Message\SendMsgResponse
     */
    function sendMsg(
        MsgToSend $msg,
        ?bool $needCalendarSentbyFixup = null,
        ?bool $isCalendarForward = null,
        ?bool $noSaveToSent = null,
        ?bool $fetchSavedMsg = null,
        ?string $sendUid = null,
        ?bool $deliveryReport = null
    ): ?Message\SendMsgResponse;

    /**
     * Send share notification
     * The client can list the recipient email addresses for the share, along with the itemId of the item being shared.
     *
     * @param Id $item
     * @param array $emailAddresses
     * @param ShareAction $action
     * @param string $notes
     * @return Message\SendShareNotificationResponse
     */
    function sendShareNotification(
        Id $item, array $emailAddresses = [], ?ShareAction $action = null, ?string $notes = null
    ): ?Message\SendShareNotificationResponse;

    /**
     * SendVerificationCodeRequest results in a random verification code being generated and sent to a device.
     *
     * @param string $address
     * @return Message\SendVerificationCodeResponse
     */
    function sendVerificationCode(
        ?string $address = null
    ): ?Message\SendVerificationCodeResponse;

    /**
     * Directly set status of an entire appointment.  This API is intended for mailbox
     * Migration (ie migrating a mailbox onto this server) and is not used by normal mail clients.
     * Need to specify folder for appointment
     * Need way to add message WITHOUT processing it for calendar parts.
     * Need to generate and patch-in the iCalendar for the <inv> but w/o actually processing the
     * <inv> as a new request
     *
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  string $folderId
     * @param  bool $noNextAlarm
     * @param  int $nextAlarm
     * @param  SetCalendarItemInfo $defaultId
     * @param  array $exceptions
     * @param  array $cancellations
     * @param  array $replies
     * @return Message\SetAppointmentResponse
     */
    function setAppointment(
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?string $folderId = null,
        ?bool $noNextAlarm = null,
        ?int $nextAlarm = null,
        ?SetCalendarItemInfo $defaultId = null,
        array $exceptions = [],
        array $cancellations = [],
        array $replies = []
    ): ?Message\SetAppointmentResponse;

    /**
     * Set Custom Metadata
     * Setting a custom metadata section but providing no key/value pairs will remove the sction from the item
     *
     * @param  MailCustomMetadata $metadata
     * @param  string $id
     * @return Message\SetCustomMetadataResponse
     */
    function setCustomMetadata(
        MailCustomMetadata $metadata, string $id
    ): ?Message\SetCustomMetadataResponse;

    /**
     * Set Mailbox Metadata
     * - Setting a mailbox metadata section but providing no key/value pairs will remove the section from mailbox metadata
     * - Empty value not allowed
     * - {metadata-section-key} must be no more than 36 characters long and must be in the format of
     *   {namespace}:{section-name}.  currently the only valid namespace is "zwc".
     *
     * @param  MailCustomMetadata $metadata
     * @return Message\SetMailboxMetadataResponse
     */
    function setMailboxMetadata(
        MailCustomMetadata $metadata
    ): ?Message\SetMailboxMetadataResponse;

    /**
     * Set recover account request
     *
     * @param  RecoveryAccountOperation $op
     * @param  string $recoveryAccount
     * @param  string $verificationCode
     * @param  Channel $channel
     * @return Message\SetRecoveryAccountResponse
     */
    function setRecoveryAccount(
        ?RecoveryAccountOperation $op = null,
        ?string $recoveryAccount = null,
        ?string $verificationCode = null,
        ?Channel $channel = null
    ): ?Message\SetRecoveryAccountResponse;

    /**
     * Directly set status of an entire task.
     * See SetAppointment for more information.
     *
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  string $folderId
     * @param  bool $noNextAlarm
     * @param  int $nextAlarm
     * @param  SetCalendarItemInfo $defaultId
     * @param  array $exceptions
     * @param  array $cancellations
     * @param  array $replies
     * @return Message\SetTaskResponse
     */
    function setTask(
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?string $folderId = null,
        ?bool $noNextAlarm = null,
        ?int $nextAlarm = null,
        ?SetCalendarItemInfo $defaultId = null,
        array $exceptions = [],
        array $cancellations = [],
        array $replies = []
    ): ?Message\SetTaskResponse;

    /**
     * Snooze alarm(s) for appointments or tasks
     *
     * @param  array $alarms
     * @return Message\SnoozeCalendarItemAlarmResponse
     */
    function snoozeCalendarItemAlarm(array $alarms = []): ?Message\SnoozeCalendarItemAlarmResponse;

    /**
     * Sync
     * Sync on other mailbox is done via specifying target account in SOAP header
     * If we're delta syncing on another user's mailbox and any folders have changed:
     * - If there are now no visible folders, you'll get an empty <folder> element
     * - If there are any visible folders, you'll get the full visible folder hierarchy
     * If a {root-folder-id} other than the mailbox root (folder 1) is requested or if not all folders are visible
     * when syncing to another user's mailbox, all changed items in other folders are presented as deletes
     * If the response is a mail.MUST_RESYNC fault, client has fallen too far out of date and must re-initial sync
     *
     * @param  string $token
     * @param  int $calendarCutoff
     * @param  int $msgCutoff
     * @param  string $folderId
     * @param  bool $typedDeletes
     * @param  int $deleteLimit
     * @param  int $changeLimit
     * @return Message\SyncResponse
     */
    function sync(
        ?string $token = null,
        ?int $calendarCutoff = null,
        ?int $msgCutoff = null,
        ?string $folderId = null,
        ?bool $typedDeletes = null,
        ?int $deleteLimit = null,
        ?int $changeLimit = null
    ): ?Message\SyncResponse;

    /**
     * Perform an action on a tag
     *
     * @param  TagActionSelector $action
     * @return Message\TagActionResponse
     */
    function tagAction(TagActionSelector $action): ?Message\TagActionResponse;

    /**
     * Tests the connection to the specified data source.  Does not modify the data source or
     * import data.  If the id is specified, uses an existing data source.  Any values specified in the request are used
     * in the test instead of the saved values.
     *
     * @param  MailDataSource $dataSource
     * @return Message\TestDataSourceResponse
     */
    function testDataSource(?MailDataSource $dataSource = null): ?Message\TestDataSourceResponse;

    /**
     * Validate the verification code sent to a device.
     * After successful validation the server sets the device email address as
     * the value of zimbraCalendarReminderDeviceEmail account attribute.
     *
     * @param  string $address
     * @param  string $verificationCode
     * @return Message\VerifyCodeResponse
     */
    function verifyCode(
        ?string $address = null, ?string $verificationCode = null
    ): ?Message\VerifyCodeResponse;

    /**
     * WaitSetRequest optionally modifies the wait set and checks for any notifications.
     * If <block> is set and there are no notifications, then this API will BLOCK until there is data.
     * 
     * Client should always set 'seq' to be the highest known value it has received from the server.  The server will use
     * this information to retransmit lost data.
     * 
     * If the client sends a last known sync token then the notification is calculated by comparing the accounts current
     * token with the client's last known.
     * 
     * If the client does not send a last known sync token, then notification is based on change since last Wait
     * (or change since &lt;add> if this is the first time Wait has been called with the account)
     * 
     * The client may specify a custom timeout-length for their request if they know something about the particular
     * underlying network.  The server may or may not honor this request (depending on server configured max/min values).
     * See LocalConfig values:
     * - zimbra_waitset_default_request_timeout,
     * - zimbra_waitset_min_request_timeout,
     * - zimbra_waitset_max_request_timeout,
     * - zimbra_admin_waitset_default_request_timeout,
     * - zimbra_admin_waitset_min_request_timeout, and
     * - zimbra_admin_waitset_max_request_timeout
     * WaitSet: scalable mechanism for listening for changes to one or more accounts
     *
     * @param  string $waitSetId
     * @param  string $lastKnownSeqNo
     * @param  bool $block
     * @param  string $defaultInterests
     * @param  int $timeout
     * @param  bool $expand
     * @param  array $addAccounts
     * @param  array $updateAccounts
     * @param  array $removeAccounts
     * @return Message\WaitSetResponse
     */
    function waitSet(
        string $waitSetId,
        string $lastKnownSeqNo,
        ?bool $block = null,
        ?string $defaultInterests = null,
        ?int $timeout = null,
        ?bool $expand = null,
        array $addAccounts = [],
        array $updateAccounts = [],
        array $removeAccounts = []
    ): ?Message\WaitSetResponse;
}
