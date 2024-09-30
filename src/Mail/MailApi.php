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

use Zimbra\Account\AccountApi;
use Zimbra\Common\Enum\{
    BrowseBy,
    Channel,
    GalSearchType,
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
use Zimbra\Common\Struct\{CursorInfo, Id, SectionAttr};
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
    FolderActionSelector,
    FolderSpec,
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
 * Mail api class
 *
 * @package   Zimbra
 * @category  Mail
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailApi extends AccountApi implements MailApiInterface
{
    /**
     * {@inheritdoc}
     */
    public function addAppointmentInvite(
        ?ParticipationStatus $partStat = null,
        ?Msg $msg = null
    ): ?Message\AddAppointmentInviteResponse {
        return $this->invoke(
            new Message\AddAppointmentInviteRequest($partStat, $msg)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function addComment(
        AddedComment $comment
    ): ?Message\AddCommentResponse {
        return $this->invoke(new Message\AddCommentRequest($comment));
    }

    /**
     * {@inheritdoc}
     */
    public function addMsg(
        AddMsgSpec $msg,
        ?bool $filterSent = null
    ): ?Message\AddMsgResponse {
        return $this->invoke(new Message\AddMsgRequest($msg, $filterSent));
    }

    /**
     * {@inheritdoc}
     */
    public function addTaskInvite(
        ?ParticipationStatus $partStat = null,
        ?Msg $msg = null
    ): ?Message\AddTaskInviteResponse {
        return $this->invoke(new Message\AddTaskInviteRequest($partStat, $msg));
    }

    /**
     * {@inheritdoc}
     */
    public function announceOrganizerChange(
        string $id
    ): ?Message\AnnounceOrganizerChangeResponse {
        return $this->invoke(new Message\AnnounceOrganizerChangeRequest($id));
    }

    /**
     * {@inheritdoc}
     */
    public function applyFilterRules(
        array $filterRules = [],
        ?IdsAttr $msgIds = null,
        ?string $query = null
    ): ?Message\ApplyFilterRulesResponse {
        return $this->invoke(
            new Message\ApplyFilterRulesRequest($filterRules, $msgIds, $query)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function applyOutgoingFilterRules(
        array $filterRules = [],
        ?IdsAttr $msgIds = null,
        ?string $query = null
    ): ?Message\ApplyOutgoingFilterRulesResponse {
        return $this->invoke(
            new Message\ApplyOutgoingFilterRulesRequest(
                $filterRules,
                $msgIds,
                $query
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function autoComplete(
        string $name,
        ?GalSearchType $type = null,
        ?bool $needCanExpand = null,
        ?string $folderList = null,
        ?bool $includeGal = null
    ): ?Message\AutoCompleteResponse {
        return $this->invoke(
            new Message\AutoCompleteRequest(
                $name,
                $type,
                $needCanExpand,
                $folderList,
                $includeGal
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function beginTrackingIMAP(): ?Message\BeginTrackingIMAPResponse
    {
        return $this->invoke(new Message\BeginTrackingIMAPRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function bounceMsg(BounceMsgSpec $msg): ?Message\BounceMsgResponse
    {
        return $this->invoke(new Message\BounceMsgRequest($msg));
    }

    /**
     * {@inheritdoc}
     */
    public function browse(
        ?BrowseBy $browseBy = null,
        ?string $regex = null,
        ?int $max = null
    ): ?Message\BrowseResponse {
        return $this->invoke(
            new Message\BrowseRequest($browseBy, $regex, $max)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function cancelAppointment(
        ?string $id = null,
        ?int $componentNum = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?InstanceRecurIdInfo $instance = null,
        ?CalTZInfo $timezone = null,
        ?Msg $msg = null
    ): ?Message\CancelAppointmentResponse {
        return $this->invoke(
            new Message\CancelAppointmentRequest(
                $id,
                $componentNum,
                $modifiedSequence,
                $revision,
                $instance,
                $timezone,
                $msg
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function cancelTask(
        ?string $id = null,
        ?int $componentNum = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?InstanceRecurIdInfo $instance = null,
        ?CalTZInfo $timezone = null,
        ?Msg $msg = null
    ): ?Message\CancelTaskResponse {
        return $this->invoke(
            new Message\CancelTaskRequest(
                $id,
                $componentNum,
                $modifiedSequence,
                $revision,
                $instance,
                $timezone,
                $msg
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function checkPermission(
        ?TargetSpec $target = null,
        array $rights = []
    ): ?Message\CheckPermissionResponse {
        return $this->invoke(
            new Message\CheckPermissionRequest($target, $rights)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function checkRecurConflicts(
        ?int $startTime = null,
        ?int $endTime = null,
        ?bool $allInstances = null,
        ?string $excludeUid = null,
        array $timezones = [],
        array $components = [],
        array $freebusyUsers = []
    ): ?Message\CheckRecurConflictsResponse {
        return $this->invoke(
            new Message\CheckRecurConflictsRequest(
                $startTime,
                $endTime,
                $allInstances,
                $excludeUid,
                $timezones,
                $components,
                $freebusyUsers
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function checkSpelling(
        ?string $dictionary = null,
        ?string $ignoreList = null,
        ?string $text = null
    ): ?Message\CheckSpellingResponse {
        return $this->invoke(
            new Message\CheckSpellingRequest($dictionary, $ignoreList, $text)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function completeTaskInstance(
        DtTimeInfo $exceptionId,
        string $id,
        ?CalTZInfo $timezone = null
    ): ?Message\CompleteTaskInstanceResponse {
        return $this->invoke(
            new Message\CompleteTaskInstanceRequest(
                $exceptionId,
                $id,
                $timezone
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function contactAction(
        ContactActionSelector $action
    ): ?Message\ContactActionResponse {
        return $this->invoke(new Message\ContactActionRequest($action));
    }

    /**
     * {@inheritdoc}
     */
    public function convAction(
        ConvActionSelector $action
    ): ?Message\ConvActionResponse {
        return $this->invoke(new Message\ConvActionRequest($action));
    }

    /**
     * {@inheritdoc}
     */
    public function counterAppointment(
        ?string $id = null,
        ?int $componentNum = null,
        ?int $modifiedSequence = null,
        ?int $revision = null,
        ?Msg $msg = null
    ): ?Message\CounterAppointmentResponse {
        return $this->invoke(
            new Message\CounterAppointmentRequest(
                $id,
                $componentNum,
                $modifiedSequence,
                $revision,
                $msg
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createAppointmentException(
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
    ): ?Message\CreateAppointmentExceptionResponse {
        return $this->invoke(
            new Message\CreateAppointmentExceptionRequest(
                $id,
                $numComponents,
                $modifiedSequence,
                $revision,
                $msg,
                $echo,
                $maxSize,
                $wantHtml,
                $neuter,
                $forceSend
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createAppointment(
        ?Msg $msg = null,
        ?bool $echo = null,
        ?int $maxSize = null,
        ?bool $wantHtml = null,
        ?bool $neuter = null,
        ?bool $forceSend = null
    ): ?Message\CreateAppointmentResponse {
        return $this->invoke(
            new Message\CreateAppointmentRequest(
                $msg,
                $echo,
                $maxSize,
                $wantHtml,
                $neuter,
                $forceSend
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createContact(
        ContactSpec $contact,
        ?bool $verbose = null,
        ?bool $wantImapUid = null,
        ?bool $wantModifiedSequence = null
    ): ?Message\CreateContactResponse {
        return $this->invoke(
            new Message\CreateContactRequest(
                $contact,
                $verbose,
                $wantImapUid,
                $wantModifiedSequence
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createDataSource(
        ?MailDataSource $dataSource = null
    ): ?Message\CreateDataSourceResponse {
        return $this->invoke(new Message\CreateDataSourceRequest($dataSource));
    }

    /**
     * {@inheritdoc}
     */
    public function createFolder(
        NewFolderSpec $folder
    ): ?Message\CreateFolderResponse {
        return $this->invoke(new Message\CreateFolderRequest($folder));
    }

    /**
     * {@inheritdoc}
     */
    public function createMountpoint(
        NewMountpointSpec $folder
    ): ?Message\CreateMountpointResponse {
        return $this->invoke(new Message\CreateMountpointRequest($folder));
    }

    /**
     * {@inheritdoc}
     */
    public function createNote(NewNoteSpec $note): ?Message\CreateNoteResponse
    {
        return $this->invoke(new Message\CreateNoteRequest($note));
    }

    /**
     * {@inheritdoc}
     */
    public function createSearchFolder(
        NewSearchFolderSpec $searchFolder
    ): ?Message\CreateSearchFolderResponse {
        return $this->invoke(
            new Message\CreateSearchFolderRequest($searchFolder)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createTag(?TagSpec $tag = null): ?Message\CreateTagResponse
    {
        return $this->invoke(new Message\CreateTagRequest($tag));
    }

    /**
     * {@inheritdoc}
     */
    public function createTaskException(
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
    ): ?Message\CreateTaskExceptionResponse {
        return $this->invoke(
            new Message\CreateTaskExceptionRequest(
                $id,
                $numComponents,
                $modifiedSequence,
                $revision,
                $msg,
                $echo,
                $maxSize,
                $wantHtml,
                $neuter,
                $forceSend
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createTask(
        ?Msg $msg = null,
        ?bool $echo = null,
        ?int $maxSize = null,
        ?bool $wantHtml = null,
        ?bool $neuter = null,
        ?bool $forceSend = null
    ): ?Message\CreateTaskResponse {
        return $this->invoke(
            new Message\CreateTaskRequest(
                $msg,
                $echo,
                $maxSize,
                $wantHtml,
                $neuter,
                $forceSend
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createWaitSet(
        string $defaultInterests,
        ?bool $allAccounts = null,
        array $accounts = []
    ): ?Message\CreateWaitSetResponse {
        return $this->invoke(
            new Message\CreateWaitSetRequest(
                $defaultInterests,
                $allAccounts,
                $accounts
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function declineCounterAppointment(
        ?Msg $msg = null
    ): ?Message\DeclineCounterAppointmentResponse {
        return $this->invoke(
            new Message\DeclineCounterAppointmentRequest($msg)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function deleteDataSource(
        array $dataSources = []
    ): ?Message\DeleteDataSourceResponse {
        return $this->invoke(new Message\DeleteDataSourceRequest($dataSources));
    }

    /**
     * {@inheritdoc}
     */
    public function destroyWaitSet(
        string $waitSetId
    ): ?Message\DestroyWaitSetResponse {
        return $this->invoke(new Message\DestroyWaitSetRequest($waitSetId));
    }

    /**
     * {@inheritdoc}
     */
    public function diffDocument(
        ?DiffDocumentVersionSpec $doc = null
    ): ?Message\DiffDocumentResponse {
        return $this->invoke(new Message\DiffDocumentRequest($doc));
    }

    /**
     * {@inheritdoc}
     */
    public function dismissCalendarItemAlarm(
        array $alarms = []
    ): ?Message\DismissCalendarItemAlarmResponse {
        return $this->invoke(
            new Message\DismissCalendarItemAlarmRequest($alarms)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function documentAction(
        DocumentActionSelector $action
    ): ?Message\DocumentActionResponse {
        return $this->invoke(new Message\DocumentActionRequest($action));
    }

    /**
     * {@inheritdoc}
     */
    public function emptyDumpster(): ?Message\EmptyDumpsterResponse
    {
        return $this->invoke(new Message\EmptyDumpsterRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function enableSharedReminder(
        SharedReminderMount $mount
    ): ?Message\EnableSharedReminderResponse {
        return $this->invoke(new Message\EnableSharedReminderRequest($mount));
    }

    /**
     * {@inheritdoc}
     */
    public function expandRecur(
        int $startTime,
        int $endTime,
        array $timezones = [],
        array $components = []
    ): ?Message\ExpandRecurResponse {
        return $this->invoke(
            new Message\ExpandRecurRequest(
                $startTime,
                $endTime,
                $timezones,
                $components
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function exportContacts(
        string $contentType,
        ?string $folderId = null,
        ?string $csvFormat = null,
        ?string $csvLocale = null,
        ?string $csvDelimiter = null
    ): ?Message\ExportContactsResponse {
        return $this->invoke(
            new Message\ExportContactsRequest(
                $contentType,
                $folderId,
                $csvFormat,
                $csvLocale,
                $csvDelimiter
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function fileSharedWithMe(
        string $action = "",
        string $fileName = "",
        int $ownerFileId = 0,
        string $fileUUID = "",
        string $fileOwnerName = "",
        string $rights = "",
        string $contentType = "",
        int $size = 0,
        string $ownerAccountId = "",
        int $date = 0
    ): ?Message\FileSharedWithMeResponse {
        return $this->invoke(
            new Message\FileSharedWithMeRequest(
                $action,
                $fileName,
                $ownerFileId,
                $fileUUID,
                $fileOwnerName,
                $rights,
                $contentType,
                $size,
                $ownerAccountId,
                $date
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function folderAction(
        FolderActionSelector $action
    ): ?Message\FolderActionResponse {
        return $this->invoke(new Message\FolderActionRequest($action));
    }

    /**
     * {@inheritdoc}
     */
    public function forwardAppointmentInvite(
        ?string $id = null,
        ?Msg $msg = null
    ): ?Message\ForwardAppointmentInviteResponse {
        return $this->invoke(
            new Message\ForwardAppointmentInviteRequest($id, $msg)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function forwardAppointment(
        ?string $id = null,
        ?DtTimeInfo $exceptionId = null,
        ?CalTZInfo $timezone = null,
        ?Msg $msg = null
    ): ?Message\ForwardAppointmentResponse {
        return $this->invoke(
            new Message\ForwardAppointmentRequest(
                $id,
                $exceptionId,
                $timezone,
                $msg
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function generateUUID(): ?Message\GenerateUUIDResponse
    {
        return $this->invoke(new Message\GenerateUUIDRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAppointment(
        ?bool $sync = null,
        ?bool $includeContent = null,
        ?bool $includeInvites = null,
        ?string $uid = null,
        ?string $id = null
    ): ?Message\GetAppointmentResponse {
        return $this->invoke(
            new Message\GetAppointmentRequest(
                $sync,
                $includeContent,
                $includeInvites,
                $uid,
                $id
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getAppointmentIdsInRange(
        int $startTime,
        int $endTime,
        string $folderId = ""
    ): ?Message\GetAppointmentIdsInRangeResponse {
        return $this->invoke(
            new Message\GetAppointmentIdsInRangeRequest(
                $startTime,
                $endTime,
                $folderId
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getAppointmentIdsSince(
        int $lastSync,
        string $folderId = ""
    ): ?Message\GetAppointmentIdsSinceResponse {
        return $this->invoke(
            new Message\GetAppointmentIdsSinceRequest($lastSync, $folderId)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getApptSummaries(
        int $startTime,
        int $endTime,
        ?string $folderId = null
    ): ?Message\GetApptSummariesResponse {
        return $this->invoke(
            new Message\GetApptSummariesRequest($startTime, $endTime, $folderId)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getCalendarItemSummaries(
        int $startTime,
        int $endTime,
        ?string $folderId = null
    ): ?Message\GetCalendarItemSummariesResponse {
        return $this->invoke(
            new Message\GetCalendarItemSummariesRequest(
                $startTime,
                $endTime,
                $folderId
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getComments(ParentId $comment): ?Message\GetCommentsResponse
    {
        return $this->invoke(new Message\GetCommentsRequest($comment));
    }

    /**
     * {@inheritdoc}
     */
    public function getContactBackupList(): ?Message\GetContactBackupListResponse
    {
        return $this->invoke(new Message\GetContactBackupListRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getContacts(
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
    ): ?Message\GetContactsResponse {
        return $this->invoke(
            new Message\GetContactsRequest(
                $sync,
                $folderId,
                $sortBy,
                $derefGroupMember,
                $includeMemberOf,
                $returnHiddenAttrs,
                $returnCertInfo,
                $wantImapUid,
                $maxMembers,
                $attributes,
                $memberAttributes,
                $contacts
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getConv(
        ConversationSpec $conversation
    ): ?Message\GetConvResponse {
        return $this->invoke(new Message\GetConvRequest($conversation));
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomMetadata(
        SectionAttr $metadata,
        ?string $id = null
    ): ?Message\GetCustomMetadataResponse {
        return $this->invoke(
            new Message\GetCustomMetadataRequest($metadata, $id)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSources(): ?Message\GetDataSourcesResponse
    {
        return $this->invoke(new Message\GetDataSourcesRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSourceUsage(): ?Message\GetDataSourceUsageResponse
    {
        return $this->invoke(new Message\GetDataSourceUsageRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getDocumentShareURL(
        ItemSpec $item
    ): ?Message\GetDocumentShareURLResponse {
        return $this->invoke(new Message\GetDocumentShareURLRequest($item));
    }

    /**
     * {@inheritdoc}
     */
    public function getEffectiveFolderPerms(
        FolderSpec $folder
    ): ?Message\GetEffectiveFolderPermsResponse {
        return $this->invoke(
            new Message\GetEffectiveFolderPermsRequest($folder)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFilterRules(): ?Message\GetFilterRulesResponse
    {
        return $this->invoke(new Message\GetFilterRulesRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getFolder(
        ?GetFolderSpec $folder = null,
        ?bool $isVisible = null,
        ?bool $needGranteeName = null,
        ?string $viewConstraint = null,
        ?int $treeDepth = null,
        ?bool $traverseMountpoints = null
    ): ?Message\GetFolderResponse {
        return $this->invoke(
            new Message\GetFolderRequest(
                $folder,
                $isVisible,
                $needGranteeName,
                $viewConstraint,
                $treeDepth,
                $traverseMountpoints
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFreeBusy(
        int $startTime,
        int $endTime,
        ?string $uid = null,
        ?string $id = null,
        ?string $name = null,
        ?string $excludeUid = null,
        array $freebusyUsers = []
    ): ?Message\GetFreeBusyResponse {
        return $this->invoke(
            new Message\GetFreeBusyRequest(
                $startTime,
                $endTime,
                $uid,
                $id,
                $name,
                $excludeUid,
                $freebusyUsers
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getICal(
        ?string $id = null,
        ?int $startTime = null,
        ?int $endTime = null
    ): ?Message\GetICalResponse {
        return $this->invoke(
            new Message\GetICalRequest($id, $startTime, $endTime)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getIMAPRecentCutoff(
        string $id
    ): ?Message\GetIMAPRecentCutoffResponse {
        return $this->invoke(new Message\GetIMAPRecentCutoffRequest($id));
    }

    /**
     * {@inheritdoc}
     */
    public function getIMAPRecent(string $id): ?Message\GetIMAPRecentResponse
    {
        return $this->invoke(new Message\GetIMAPRecentRequest($id));
    }

    /**
     * {@inheritdoc}
     */
    public function getImportStatus(): ?Message\GetImportStatusResponse
    {
        return $this->invoke(new Message\GetImportStatusRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getItem(ItemSpec $item): ?Message\GetItemResponse
    {
        return $this->invoke(new Message\GetItemRequest($item));
    }

    /**
     * {@inheritdoc}
     */
    public function getLastItemIdInMailbox(): ?Message\GetLastItemIdInMailboxResponse
    {
        return $this->invoke(new Message\GetLastItemIdInMailboxRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getMailboxMetadata(
        SectionAttr $metadata
    ): ?Message\GetMailboxMetadataResponse {
        return $this->invoke(new Message\GetMailboxMetadataRequest($metadata));
    }

    /**
     * {@inheritdoc}
     */
    public function getMiniCal(
        int $startTime,
        int $endTime,
        array $folders = [],
        ?CalTZInfo $timezone = null
    ): ?Message\GetMiniCalResponse {
        return $this->invoke(
            new Message\GetMiniCalRequest(
                $startTime,
                $endTime,
                $folders,
                $timezone
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getModifiedItemsIDs(
        string $folderId,
        int $modSeq
    ): ?Message\GetModifiedItemsIDsResponse {
        return $this->invoke(
            new Message\GetModifiedItemsIDsRequest($folderId, $modSeq)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getMsgMetadata(
        IdsAttr $msgIds
    ): ?Message\GetMsgMetadataResponse {
        return $this->invoke(new Message\GetMsgMetadataRequest($msgIds));
    }

    /**
     * {@inheritdoc}
     */
    public function getMsg(MsgSpec $msg): ?Message\GetMsgResponse
    {
        return $this->invoke(new Message\GetMsgRequest($msg));
    }

    /**
     * {@inheritdoc}
     */
    public function getNote(Id $note): ?Message\GetNoteResponse
    {
        return $this->invoke(new Message\GetNoteRequest($note));
    }

    /**
     * {@inheritdoc}
     */
    public function getOutgoingFilterRules(): ?Message\GetOutgoingFilterRulesResponse
    {
        return $this->invoke(new Message\GetOutgoingFilterRulesRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getPermission(
        array $aces = []
    ): ?Message\GetPermissionResponse {
        return $this->invoke(new Message\GetPermissionRequest($aces));
    }

    /**
     * {@inheritdoc}
     */
    public function getRecur(string $id): ?Message\GetRecurResponse
    {
        return $this->invoke(new Message\GetRecurRequest($id));
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchFolder(): ?Message\GetSearchFolderResponse
    {
        return $this->invoke(new Message\GetSearchFolderRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getShareNotifications(): ?Message\GetShareNotificationsResponse
    {
        return $this->invoke(new Message\GetShareNotificationsRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getSpellDictionaries(): ?Message\GetSpellDictionariesResponse
    {
        return $this->invoke(new Message\GetSpellDictionariesRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getSystemRetentionPolicy(): ?Message\GetSystemRetentionPolicyResponse
    {
        return $this->invoke(new Message\GetSystemRetentionPolicyRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getTag(): ?Message\GetTagResponse
    {
        return $this->invoke(new Message\GetTagRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getTask(
        ?bool $sync = null,
        ?bool $includeContent = null,
        ?bool $includeInvites = null,
        ?string $uid = null,
        ?string $id = null
    ): ?Message\GetTaskResponse {
        return $this->invoke(
            new Message\GetTaskRequest(
                $sync,
                $includeContent,
                $includeInvites,
                $uid,
                $id
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getTaskSummaries(
        int $startTime,
        int $endTime,
        ?string $folderId = null
    ): ?Message\GetTaskSummariesResponse {
        return $this->invoke(
            new Message\GetTaskSummariesRequest($startTime, $endTime, $folderId)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getWorkingHours(
        int $startTime,
        int $endTime,
        ?string $id = null,
        ?string $name = null
    ): ?Message\GetWorkingHoursResponse {
        return $this->invoke(
            new Message\GetWorkingHoursRequest($startTime, $endTime, $id, $name)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getYahooAuthToken(
        string $user,
        string $password
    ): ?Message\GetYahooAuthTokenResponse {
        return $this->invoke(
            new Message\GetYahooAuthTokenRequest($user, $password)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getYahooCookie(
        string $user
    ): ?Message\GetYahooCookieResponse {
        return $this->invoke(new Message\GetYahooCookieRequest($user));
    }

    /**
     * {@inheritdoc}
     */
    public function grantPermission(
        array $aces = []
    ): ?Message\GrantPermissionResponse {
        return $this->invoke(new Message\GrantPermissionRequest($aces));
    }

    /**
     * {@inheritdoc}
     */
    public function iCalReply(string $ical): ?Message\ICalReplyResponse
    {
        return $this->invoke(new Message\ICalReplyRequest($ical));
    }

    /**
     * {@inheritdoc}
     */
    public function imapCopy(
        string $ids,
        ?MailItemType $type = null,
        int $folder = 0
    ): ?Message\IMAPCopyResponse {
        return $this->invoke(new Message\IMAPCopyRequest($ids, $type, $folder));
    }

    /**
     * {@inheritdoc}
     */
    public function importAppointments(
        ContentSpec $content,
        string $contentType = "text/calendar",
        ?string $folderId = null
    ): ?Message\ImportAppointmentsResponse {
        return $this->invoke(
            new Message\ImportAppointmentsRequest(
                $content,
                $contentType,
                $folderId
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function importContacts(
        Content $content,
        string $contentType = "text/csv",
        ?string $folderId = null,
        ?string $csvFormat = null,
        ?string $csvLocale = null
    ): ?Message\ImportContactsResponse {
        return $this->invoke(
            new Message\ImportContactsRequest(
                $content,
                $contentType,
                $folderId,
                $csvFormat,
                $csvLocale
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function importData(
        array $dataSources = []
    ): ?Message\ImportDataResponse {
        return $this->invoke(new Message\ImportDataRequest($dataSources));
    }

    /**
     * {@inheritdoc}
     */
    public function invalidateReminderDevice(
        string $address
    ): ?Message\InvalidateReminderDeviceResponse {
        return $this->invoke(
            new Message\InvalidateReminderDeviceRequest($address)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function itemAction(
        ActionSelector $action
    ): ?Message\ItemActionResponse {
        return $this->invoke(new Message\ItemActionRequest($action));
    }

    /**
     * {@inheritdoc}
     */
    public function listDocumentRevisions(
        ListDocumentRevisionsSpec $doc
    ): ?Message\ListDocumentRevisionsResponse {
        return $this->invoke(new Message\ListDocumentRevisionsRequest($doc));
    }

    /**
     * {@inheritdoc}
     */
    public function listIMAPSubscriptions(): ?Message\ListIMAPSubscriptionsResponse
    {
        return $this->invoke(new Message\ListIMAPSubscriptionsRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function modifyAppointment(
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
    ): ?Message\ModifyAppointmentResponse {
        return $this->invoke(
            new Message\ModifyAppointmentRequest(
                $id,
                $componentNum,
                $modifiedSequence,
                $revision,
                $msg,
                $echo,
                $maxSize,
                $wantHtml,
                $neuter,
                $forceSend
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function modifyContact(
        ModifyContactSpec $contact,
        ?bool $replace = null,
        ?bool $verbose = null,
        ?bool $wantImapUid = null,
        ?bool $wantModifiedSequence = null
    ): ?Message\ModifyContactResponse {
        return $this->invoke(
            new Message\ModifyContactRequest(
                $contact,
                $replace,
                $verbose,
                $wantImapUid,
                $wantModifiedSequence
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function modifyDataSource(
        ?MailDataSource $dataSource = null
    ): ?Message\ModifyDataSourceResponse {
        return $this->invoke(new Message\ModifyDataSourceRequest($dataSource));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyFilterRules(
        array $filterRules = []
    ): ?Message\ModifyFilterRulesResponse {
        return $this->invoke(
            new Message\ModifyFilterRulesRequest($filterRules)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function modifyMailboxMetadata(
        ?MailCustomMetadata $metadata = null
    ): ?Message\ModifyMailboxMetadataResponse {
        return $this->invoke(
            new Message\ModifyMailboxMetadataRequest($metadata)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function modifyOutgoingFilterRules(
        array $filterRules = []
    ): ?Message\ModifyOutgoingFilterRulesResponse {
        return $this->invoke(
            new Message\ModifyOutgoingFilterRulesRequest($filterRules)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function modifyProfileImage(
        ?string $uploadId = null,
        ?string $imageB64Data = null
    ): ?Message\ModifyProfileImageResponse {
        return $this->invoke(
            new Message\ModifyProfileImageRequest($uploadId, $imageB64Data)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function modifySearchFolder(
        ModifySearchFolderSpec $searchFolder
    ): ?Message\ModifySearchFolderResponse {
        return $this->invoke(
            new Message\ModifySearchFolderRequest($searchFolder)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function modifyTask(
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
    ): ?Message\ModifyTaskResponse {
        return $this->invoke(
            new Message\ModifyTaskRequest(
                $id,
                $componentNum,
                $modifiedSequence,
                $revision,
                $msg,
                $echo,
                $maxSize,
                $wantHtml,
                $neuter,
                $forceSend
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function msgAction(
        ActionSelector $action
    ): ?Message\MsgActionResponse {
        return $this->invoke(new Message\MsgActionRequest($action));
    }

    /**
     * {@inheritdoc}
     */
    public function noOp(
        ?bool $wait = null,
        ?bool $includeDelegates = null,
        ?bool $enforceLimit = null,
        ?int $timeout = null
    ): ?Message\NoOpResponse {
        return $this->invoke(
            new Message\NoOpRequest(
                $wait,
                $includeDelegates,
                $enforceLimit,
                $timeout
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function noteAction(
        NoteActionSelector $action
    ): ?Message\NoteActionResponse {
        return $this->invoke(new Message\NoteActionRequest($action));
    }

    /**
     * {@inheritdoc}
     */
    public function openIMAPFolder(
        string $folderId,
        int $limit,
        ?ImapCursorInfo $cursor = null
    ): ?Message\OpenIMAPFolderResponse {
        return $this->invoke(
            new Message\OpenIMAPFolderRequest($folderId, $limit, $cursor)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function purgeRevision(
        PurgeRevisionSpec $revision
    ): ?Message\PurgeRevisionResponse {
        return $this->invoke(new Message\PurgeRevisionRequest($revision));
    }

    /**
     * {@inheritdoc}
     */
    public function rankingAction(
        RankingActionSpec $action
    ): ?Message\RankingActionResponse {
        return $this->invoke(new Message\RankingActionRequest($action));
    }

    /**
     * {@inheritdoc}
     */
    public function recordIMAPSession(
        string $folderId
    ): ?Message\RecordIMAPSessionResponse {
        return $this->invoke(new Message\RecordIMAPSessionRequest($folderId));
    }

    /**
     * {@inheritdoc}
     */
    public function recoverAccount(
        string $email,
        ?RecoverAccountOperation $op = null,
        ?Channel $channel = null
    ): ?Message\RecoverAccountResponse {
        return $this->invoke(
            new Message\RecoverAccountRequest($email, $op, $channel)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function removeAttachments(
        MsgPartIds $msg
    ): ?Message\RemoveAttachmentsResponse {
        return $this->invoke(new Message\RemoveAttachmentsRequest($msg));
    }

    /**
     * {@inheritdoc}
     */
    public function resetRecentMessageCount(): ?Message\ResetRecentMessageCountResponse
    {
        return $this->invoke(new Message\ResetRecentMessageCountRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function restoreContacts(
        string $fileName,
        ?RestoreResolve $resolve = null
    ): ?Message\RestoreContactsResponse {
        return $this->invoke(
            new Message\RestoreContactsRequest($fileName, $resolve)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function revokePermission(
        array $aces = []
    ): ?Message\RevokePermissionResponse {
        return $this->invoke(new Message\RevokePermissionRequest($aces));
    }

    /**
     * {@inheritdoc}
     */
    public function saveDocument(
        DocumentSpec $doc
    ): ?Message\SaveDocumentResponse {
        return $this->invoke(new Message\SaveDocumentRequest($doc));
    }

    /**
     * {@inheritdoc}
     */
    public function saveDraft(
        SaveDraftMsg $msg,
        ?bool $wantImapUid = null,
        ?bool $wantModifiedSequence = null
    ): ?Message\SaveDraftResponse {
        return $this->invoke(
            new Message\SaveDraftRequest(
                $msg,
                $wantImapUid,
                $wantModifiedSequence
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function saveIMAPSubscriptions(
        array $subscriptions = []
    ): ?Message\SaveIMAPSubscriptionsResponse {
        return $this->invoke(
            new Message\SaveIMAPSubscriptionsRequest($subscriptions)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function searchAction(
        Message\SearchRequest $searchRequest,
        BulkAction $bulkAction
    ): ?Message\SearchActionResponse {
        return $this->invoke(
            new Message\SearchActionRequest($searchRequest, $bulkAction)
        );
    }

    /**
     * {@inheritdoc}
     */
    function searchConv(
        string $conversationId = "",
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
    ): ?Message\SearchConvResponse {
        return $this->invoke(
            new Message\SearchConvRequest(
                $conversationId,
                $query,
                $inDumpster,
                $searchTypes,
                $groupBy,
                $calItemExpandStart,
                $calItemExpandEnd,
                $quick,
                $sortBy,
                $includeTagDeleted,
                $includeTagMuted,
                $taskStatus,
                $fetch,
                $markRead,
                $maxInlinedLength,
                $wantHtml,
                $needCanExpand,
                $neuterImages,
                $wantRecipients,
                $prefetch,
                $resultMode,
                $fullConversation,
                $field,
                $limit,
                $offset,
                $headers,
                $calTz,
                $locale,
                $cursor,
                $wantContent,
                $includeMemberOf,
                $nestMessages
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function search(
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
    ): ?Message\SearchResponse {
        return $this->invoke(
            new Message\SearchRequest(
                $query,
                $inDumpster,
                $searchTypes,
                $groupBy,
                $calItemExpandStart,
                $calItemExpandEnd,
                $quick,
                $sortBy,
                $includeTagDeleted,
                $includeTagMuted,
                $taskStatus,
                $fetch,
                $markRead,
                $maxInlinedLength,
                $wantHtml,
                $needCanExpand,
                $neuterImages,
                $wantRecipients,
                $prefetch,
                $resultMode,
                $fullConversation,
                $field,
                $limit,
                $offset,
                $headers,
                $calTz,
                $locale,
                $cursor,
                $wantContent,
                $includeMemberOf,
                $warmup
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function sendDeliveryReport(
        string $messageId
    ): ?Message\SendDeliveryReportResponse {
        return $this->invoke(new Message\SendDeliveryReportRequest($messageId));
    }

    /**
     * {@inheritdoc}
     */
    public function sendInviteReply(
        string $id,
        int $componentNum,
        ?VerbType $verb = null,
        ?bool $updateOrganizer = null,
        ?string $identityId = null,
        ?DtTimeInfo $exceptionId = null,
        ?CalTZInfo $timezone = null,
        ?Msg $msg = null
    ): ?Message\SendInviteReplyResponse {
        return $this->invoke(
            new Message\SendInviteReplyRequest(
                $id,
                $componentNum,
                $verb,
                $updateOrganizer,
                $identityId,
                $exceptionId,
                $timezone,
                $msg
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function sendMsg(
        MsgToSend $msg,
        ?bool $needCalendarSentbyFixup = null,
        ?bool $isCalendarForward = null,
        ?bool $noSaveToSent = null,
        ?bool $fetchSavedMsg = null,
        ?string $sendUid = null,
        ?bool $deliveryReport = null
    ): ?Message\SendMsgResponse {
        return $this->invoke(
            new Message\SendMsgRequest(
                $msg,
                $needCalendarSentbyFixup,
                $isCalendarForward,
                $noSaveToSent,
                $fetchSavedMsg,
                $sendUid,
                $deliveryReport
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function sendShareNotification(
        Id $item,
        array $emailAddresses = [],
        ?ShareAction $action = null,
        ?string $notes = null
    ): ?Message\SendShareNotificationResponse {
        return $this->invoke(
            new Message\SendShareNotificationRequest(
                $item,
                $emailAddresses,
                $action,
                $notes
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function sendVerificationCode(
        ?string $address = null
    ): ?Message\SendVerificationCodeResponse {
        return $this->invoke(new Message\SendVerificationCodeRequest($address));
    }

    /**
     * {@inheritdoc}
     */
    public function setAppointment(
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
    ): ?Message\SetAppointmentResponse {
        return $this->invoke(
            new Message\SetAppointmentRequest(
                $flags,
                $tags,
                $tagNames,
                $folderId,
                $noNextAlarm,
                $nextAlarm,
                $defaultId,
                $exceptions,
                $cancellations,
                $replies
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomMetadata(
        MailCustomMetadata $metadata,
        string $id
    ): ?Message\SetCustomMetadataResponse {
        return $this->invoke(
            new Message\SetCustomMetadataRequest($metadata, $id)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setMailboxMetadata(
        MailCustomMetadata $metadata
    ): ?Message\SetMailboxMetadataResponse {
        return $this->invoke(new Message\SetMailboxMetadataRequest($metadata));
    }

    /**
     * {@inheritdoc}
     */
    public function setRecoveryAccount(
        ?RecoveryAccountOperation $op = null,
        ?string $recoveryAccount = null,
        ?string $verificationCode = null,
        ?Channel $channel = null
    ): ?Message\SetRecoveryAccountResponse {
        return $this->invoke(
            new Message\SetRecoveryAccountRequest(
                $op,
                $recoveryAccount,
                $verificationCode,
                $channel
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setTask(
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
    ): ?Message\SetTaskResponse {
        return $this->invoke(
            new Message\SetTaskRequest(
                $flags,
                $tags,
                $tagNames,
                $folderId,
                $noNextAlarm,
                $nextAlarm,
                $defaultId,
                $exceptions,
                $cancellations,
                $replies
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function snoozeCalendarItemAlarm(
        array $alarms = []
    ): ?Message\SnoozeCalendarItemAlarmResponse {
        return $this->invoke(
            new Message\SnoozeCalendarItemAlarmRequest($alarms)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function sync(
        ?string $token = null,
        ?int $calendarCutoff = null,
        ?int $msgCutoff = null,
        ?string $folderId = null,
        ?bool $typedDeletes = null,
        ?int $deleteLimit = null,
        ?int $changeLimit = null
    ): ?Message\SyncResponse {
        return $this->invoke(
            new Message\SyncRequest(
                $token,
                $calendarCutoff,
                $msgCutoff,
                $folderId,
                $typedDeletes,
                $deleteLimit,
                $changeLimit
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function tagAction(
        TagActionSelector $action
    ): ?Message\TagActionResponse {
        return $this->invoke(new Message\TagActionRequest($action));
    }

    /**
     * {@inheritdoc}
     */
    public function testDataSource(
        ?MailDataSource $dataSource = null
    ): ?Message\TestDataSourceResponse {
        return $this->invoke(new Message\TestDataSourceRequest($dataSource));
    }

    /**
     * {@inheritdoc}
     */
    public function verifyCode(
        ?string $address = null,
        ?string $verificationCode = null
    ): ?Message\VerifyCodeResponse {
        return $this->invoke(
            new Message\VerifyCodeRequest($address, $verificationCode)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function waitSet(
        string $waitSetId,
        string $lastKnownSeqNo,
        ?bool $block = null,
        ?string $defaultInterests = null,
        ?int $timeout = null,
        ?bool $expand = null,
        array $addAccounts = [],
        array $updateAccounts = [],
        array $removeAccounts = []
    ): ?Message\WaitSetResponse {
        return $this->invoke(
            new Message\WaitSetRequest(
                $waitSetId,
                $lastKnownSeqNo,
                $block,
                $defaultInterests,
                $timeout,
                $expand,
                $addAccounts,
                $updateAccounts,
                $removeAccounts
            )
        );
    }
}
