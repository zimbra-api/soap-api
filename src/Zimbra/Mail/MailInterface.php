<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail;

use Zimbra\Account\AccountInterface;

use Zimbra\Enum\Action;
use Zimbra\Enum\BrowseBy;
use Zimbra\Enum\GalSearchType;
use Zimbra\Enum\InterestType;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Enum\SortBy;

use Zimbra\Mail\Struct\ActivityFilter;
use Zimbra\Mail\Struct\AddedComment;
use Zimbra\Mail\Struct\AddMsgSpec;
use Zimbra\Mail\Struct\AttributeName;
use Zimbra\Mail\Struct\BounceMsgSpec;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\ContactActionSelector;
use Zimbra\Mail\Struct\ContactSpec;
use Zimbra\Mail\Struct\Content;
use Zimbra\Mail\Struct\ContentSpec;
use Zimbra\Mail\Struct\ConvActionSelector;
use Zimbra\Mail\Struct\ConversationSpec;
use Zimbra\Mail\Struct\DiffDocumentVersionSpec;
use Zimbra\Mail\Struct\DismissAppointmentAlarm;
use Zimbra\Mail\Struct\DismissTaskAlarm;
use Zimbra\Mail\Struct\DocumentActionSelector;
use Zimbra\Mail\Struct\DocumentSpec;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\ExpandedRecurrenceCancel;
use Zimbra\Mail\Struct\ExpandedRecurrenceException;
use Zimbra\Mail\Struct\ExpandedRecurrenceInvite;
use Zimbra\Mail\Struct\FilterRules;
use Zimbra\Mail\Struct\FreeBusyUserSpec;
use Zimbra\Mail\Struct\FolderActionSelector;
use Zimbra\Mail\Struct\FolderSpec;
use Zimbra\Mail\Struct\GetFolderSpec;
use Zimbra\Mail\Struct\IdsAttr;
use Zimbra\Mail\Struct\IdStatus;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\ItemActionSelector;
use Zimbra\Mail\Struct\ItemSpec;
use Zimbra\Mail\Struct\ListDocumentRevisionsSpec;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Mail\Struct\ModifyContactSpec;
use Zimbra\Mail\Struct\ModifySearchFolderSpec;
use Zimbra\Mail\Struct\Msg;
use Zimbra\Mail\Struct\MsgActionSelector;
use Zimbra\Mail\Struct\MsgPartIds;
use Zimbra\Mail\Struct\MsgSpec;
use Zimbra\Mail\Struct\MsgToSend;
use Zimbra\Mail\Struct\NamedFilterRules;
use Zimbra\Mail\Struct\NewFolderSpec;
use Zimbra\Mail\Struct\NewMountpointSpec;
use Zimbra\Mail\Struct\NewNoteSpec;
use Zimbra\Mail\Struct\NewSearchFolderSpec;
use Zimbra\Mail\Struct\NoteActionSelector;
use Zimbra\Mail\Struct\ParentId;
use Zimbra\Mail\Struct\PurgeRevisionSpec;
use Zimbra\Mail\Struct\RankingActionSpec;
use Zimbra\Mail\Struct\Replies;
use Zimbra\Mail\Struct\SaveDraftMsg;
use Zimbra\Mail\Struct\SectionAttr;
use Zimbra\Mail\Struct\SetCalendarItemInfo;
use Zimbra\Mail\Struct\SharedReminderMount;
use Zimbra\Mail\Struct\SnoozeAppointmentAlarm;
use Zimbra\Mail\Struct\SnoozeTaskAlarm;
use Zimbra\Mail\Struct\TagSpec;
use Zimbra\Mail\Struct\TagActionSelector;
use Zimbra\Mail\Struct\TargetSpec;

use Zimbra\Mail\Struct\MailDataSource;
use Zimbra\Mail\Struct\MailImapDataSource;
use Zimbra\Mail\Struct\MailPop3DataSource;
use Zimbra\Mail\Struct\MailCaldavDataSource;
use Zimbra\Mail\Struct\MailYabDataSource;
use Zimbra\Mail\Struct\MailRssDataSource;
use Zimbra\Mail\Struct\MailGalDataSource;
use Zimbra\Mail\Struct\MailCalDataSource;
use Zimbra\Mail\Struct\MailUnknownDataSource;

use Zimbra\Mail\Struct\ImapDataSourceNameOrId;
use Zimbra\Mail\Struct\Pop3DataSourceNameOrId;
use Zimbra\Mail\Struct\CaldavDataSourceNameOrId;
use Zimbra\Mail\Struct\YabDataSourceNameOrId;
use Zimbra\Mail\Struct\RssDataSourceNameOrId;
use Zimbra\Mail\Struct\GalDataSourceNameOrId;
use Zimbra\Mail\Struct\CalDataSourceNameOrId;
use Zimbra\Mail\Struct\UnknownDataSourceNameOrId;

use Zimbra\Struct\CursorInfo;
use Zimbra\Struct\Id;
use Zimbra\Struct\NamedElement;
use Zimbra\Struct\WaitSetAdd;
use Zimbra\Struct\WaitSetSpec;
use Zimbra\Struct\WaitSetId;

/**
 * MailInterface is a interface which allows to connect Zimbra API mail functions via SOAP
 *
 * @package   Zimbra
 * @category  Mail
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
interface MailInterface extends AccountInterface
{
    /**
     * Add an invite to an appointment.
     * The invite corresponds to a VEVENT component.
     * Based on the UID specified (required),
     * a new appointment is created in the default calendar if necessary.
     * If an appointment with the same UID exists,
     * the appointment is updated with the new invite only if the invite is not outdated,
     * according to the iCalendar sequencing rule (based on SEQUENCE, RECURRENCE-ID and DTSTAMP).
     *
     * @param  Msg $message Message.
     * @param  ParticipationStatus $ptst iCalendar PTST (Participation status). Valid values: NE|AC|TE|DE|DG|CO|IN|WE|DF. Meanings: "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo), "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     * @return mix
     */
    function addAppointmentInvite(Msg $m = null, ParticipationStatus $ptst = null);

    /**
     * Add a comment to the specified item. Currently comments can only be added to documents.
     *
     * @param  AddedComment $comment Added comment.
     * @return mix
     */
    function addComment(AddedComment $comment);

    /**
     * Add a message.
     *
     * @param  AddMsgSpec $m Specification of the message to add.
     * @param  bool $filterSent If set, then do outgoing message filtering if the msg is being added to the Sent folder and has been flagged as sent. Default is unset.
     * @return mix
     */
    function addMsg(AddMsgSpec $m, $filterSent = null);

    /**
     * Add a task invite.
     *
     * @param  Msg $m Message.
     * @param  ParticipationStatus $ptst iCalendar PTST (Participation status). Valid values: NE|AC|TE|DE|DG|CO|IN|WE|DF. Meanings: "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo), "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     * @return mix
     */
    function addTaskInvite(Msg $m = null, ParticipationStatus $ptst = null);

    /**
     * Announce change of organizer.
     *
     * @param  string $id ID.
     * @return mix
     */
    function announceOrganizerChange($id);

    /**
     * Applies one or more filter rules to messages specified by a comma-separated ID list, or returned by a search query.
     * One or the other can be specified, but not both.
     * Returns the list of ids of existing messages that were affected.
     * Note that redirect actions are ignored when applying filter rules to existing messages.
     *
     * @param  NamedFilterRules $filterRules Filter rules.
     * @param  IdsAttr $m Comma-separated list of message IDs.
     * @param  string $query Query string.
     * @return mix
     */
    function applyFilterRules(
        NamedFilterRules $filterRules,
        IdsAttr $m = null,
        $query = null
    );

    /**
     * Applies one or more filter rules to messages specified by a comma-separated ID list, or returned by a search query.
     * One or the other can be specified, but not both.
     * Returns the list of ids of existing messages that were affected.
     *
     * @param  NamedFilterRules $filterRules Filter rules.
     * @param  IdsAttr $m Comma-separated list of message IDs.
     * @param  string $query Query string.
     * @return mix
     */
    function applyOutgoingFilterRules(
        NamedFilterRules $filterRules,
        IdsAttr $m = null,
        $query = null
    );

    /**
     * AutoComplete.
     *
     * @param  string $name Name.
     * @param  GalSearchType $t GAL Search type - default value is "account". Valid values: all|account|resource|group
     * @param  bool $needExp Set if the "exp" flag is needed in the response for group entries. Default is unset..
     * @param  string $folders Comma separated list of folder IDs.
     * @param  bool $includeGal Flag whether to include Global Address Book (GAL).
     * @return mix
     */
    function autoComplete(
        $name,
        GalSearchType $t = null,
        $needExp = null,
        $folders = null,
        $includeGal = null
    );

    /**
     * Resend a message.
     * Supports (f)rom, (t)o, (c)c, (b)cc, (s)ender "type" on <e> elements 
     * (these get mapped to Resent-From, Resent-To, Resent-CC, Resent-Bcc, Resent-Sender headers,
     * which are prepended to copy of existing message) 
     * Aside from these prepended headers, message is reinjected verbatim
     *
     * @param  BounceMsgSpec $m Specification of message to be resent.
     * @return mix
     */
    function bounceMsg(BounceMsgSpec $m);

    /**
     * Browse.
     *
     * @param  BrowseBy $browseBy Browse by setting - domains|attachments|objects.
     * @param  string  $regex Regex string. Return only those results which match the specified regular expression.
     * @param  int    $maxToReturn Return only a maximum number of entries as requested. If more than {max-entries} results exist, the server will return the first {max-entries}, sorted by frequency.
     * @return mix
     */
    function browse(BrowseBy $browseBy, $regex = null, $maxToReturn = null);

    /**
     * Cancel appointment.
     * NOTE: If canceling an exception, the original instance (ie the one the exception was "excepting") WILL NOT be restored when you cancel this exception.
     * If <inst> is set, then this cancels just the specified instance or range of instances, otherwise it cancels the entire appointment. If <inst> is not set, then id MUST refer to the default invite for the appointment.
     *
     * @param  InstanceRecurIdInfo $inst Instance recurrence ID information
     * @param  CalTZInfo $tz Definition for TZID referenced by DATETIME in <inst>
     * @param  Msg $m Message
     * @param  string $id ID of default invite
     * @param  int $comp Component number of default invite
     * @param  int $ms Modified sequence
     * @param  int $rev Revision
     * @return mix
     */
    function cancelAppointment(
        InstanceRecurIdInfo $inst = null,
        CalTZInfo $tz = null,
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null
    );

    /**
     * Cancel task.
     *
     * @param  InstanceRecurIdInfo $inst Instance recurrence ID information
     * @param  CalTZInfo $tz Definition for TZID referenced by DATETIME in <inst>
     * @param  Msg $m Message
     * @param  string $id ID of default invite
     * @param  int $comp Component number of default invite
     * @param  int $ms Modified sequence
     * @param  int $rev Revision
     * @return mix
     */
    function cancelTask(
        InstanceRecurIdInfo $inst = null,
        CalTZInfo $tz = null,
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null
    );

    /**
     * Check device status.
     *
     * @param  Id $id Device ID.
     * @return mix
     */
    function checkDeviceStatus(Id $device);

    /**
     * Check if the authed user has the specified right(s) on a target.
     * If the specified target cannot be found:
     *  1. if by is "id", throw NO_SUCH_ACCOUNT/NO_SUCH_CALENDAR_RESOURCE
     *  2. if by is "name", return the default permission for the right.
     *
     * @param  TargetSpec $target Target specification
     * @param  array $rights Rights to check.
     * @return mix
     */
    function checkPermission(TargetSpec $target = null, array $right = []);

    /**
     * Check conflicts in recurrence against list of users.
     * Set all attribute to get all instances, even those without conflicts.
     * By default only instances that have conflicts are returned.
     *
     * @param  array $tz Timezones
     * @param  int $s Start time in millis.  If not specified, defaults to current time
     * @param  int $e End time in millis.  If not specified, unlimited
     * @param  bool $all Set this to get all instances, even those without conflicts. By default only instances that have conflicts are returned.
     * @param  string $excludeUid UID of appointment to exclude from free/busy search
     * @param  array $timezones Timezones
     * @param  array $component Expanded recurrences
     * @param  array $users Freebusy user specifications
     * @return mix
     */
    function checkRecurConflicts(
        $s = null,
        $e = null,
        $all = null,
        $excludeUid = null,
        array $timezones = [],
        array $component = [],
        array $users = []
    );

    /**
     * Check spelling.
     * Suggested words are listed in decreasing order of their match score.
     * The "available" attribute specifies whether the server-side spell checking interface is available or not.
     *
     * @param  string $value Text to spell check
     * @param  string $dictionary The optional name of the aspell dictionary that will be used to check spelling.
     * @param  string $ignore Comma-separated list of words to ignore just for this request.
     * @return mix
     */
    function checkSpelling($value = null, $dictionary = null, $ignore = null);

    /**
     * Complete a task instance.
     *
     * @param  string $id ID
     * @param  DtTimeInfo $exceptId Exception ID
     * @param  CalTZInfo $tz Timezone information
     * @return mix
     */
    function completeTaskInstance(
        $id,
        DtTimeInfo $exceptId,
        CalTZInfo $tz = null
    );

    /**
     * Contact Action.
     *
     * @param  ContactActionSelector $action Contact action selector
     * @return mix
     */
    function contactAction(ContactActionSelector $action);

    /**
     * Conv Action.
     *
     * @param  ConvActionSelector $action Action selector.
     * @return mix
     */
    function convAction(ConvActionSelector $action);

    /**
     * Propose a new time/location. Sent by meeting attendee to organizer.
     * The syntax is very similar to CreateAppointmentRequest. 
     *
     * @param  Msg $m Details of counter proposal.
     * @param  string $id Invite ID of default invite
     * @param  int $comp Component number of default component
     * @param  int $ms Changed sequence of fetched version.
     * @param  int $rev Revision
     * @return mix
     */
    function counterAppointment(
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null
    );

    /**
     * This is the API to create a new Appointment, optionally sending out meeting Invitations to other people.
     *
     * @param  Msg $m Message
     * @param  bool $echo If specified, the created appointment is echoed back in the response as if a GetMsgRequest was made
     * @param  int $max Maximum inlined length
     * @param  bool $html Set if want HTML included in echoing
     * @param  bool $neuter Set if want "neuter" set for echoed response
     * @param  bool $forcesend If set, ignore smtp 550 errors when sending the notification to attendees.
     * @return mix
     */
    function createAppointment(
        Msg $m = null,
        $echo = null,
        $max = null,
        $html = null,
        $neuter = null,
        $forcesend = null
    );

    /**
     * Create Appointment Exception.
     *
     * @param  Msg $m Message
     * @param  string $id ID of default invite
     * @param  int $comp Component of default invite
     * @param  int $ms Change sequence of fetched series
     * @param  int $rev Revision of fetched series
     * @param  bool $echo If specified, the created appointment is echoed back in the response as if a GetMsgRequest was made
     * @param  int $max Maximum inlined length
     * @param  bool $html Set if want HTML included in echoing
     * @param  bool $neuter Set if want "neuter" set for echoed response
     * @param  bool $forcesend If set, ignore smtp 550 errors when sending the notification to attendees.
     * @return mix
     */
    function createAppointmentException(
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null,
        $echo = null,
        $max = null,
        $html = null,
        $neuter = null,
        $forcesend = null
    );

    /**
     * Create a contact.
     *
     * @param  ContactSpec $cn Contact specification
     * @param  bool $verbose If set (defaults to unset) The returned <cn> is just a placeholder containing the new contact ID (i.e. <cn id="{id}"/>)
     * @return mix
     */
    function createContact(ContactSpec $cn, $verbose = null);

    /**
     * Creates a data source that imports mail items into the specified folder,
     * for example via the POP3 or IMAP protocols.
     * Only one data source is allowed per request.
     *
     * @param  MailDataSource $ds Data source
     * @return mix
     */
    function createDataSource(MailDataSource $ds);

    /**
     * Creates a imap data source that imports mail items into the specified folder.
     *
     * @param  MailImapDataSource $imap Imap data source
     * @return mix
     */
    function createImapDataSource(MailImapDataSource $imap);

    /**
     * Creates a pop3 data source that imports mail items into the specified folder.
     *
     * @param  MailPop3DataSource $pop3 Pop3 data source
     * @return mix
     */
    function createPop3DataSource(MailPop3DataSource $pop3);

    /**
     * Creates a caldav data source that imports mail items into the specified folder.
     *
     * @param  MailCaldavDataSource $caldav Caldav data source
     * @return mix
     */
    function createCaldavDataSource(MailCaldavDataSource $caldav);

    /**
     * Creates a yab data source that imports mail items into the specified folder.
     *
     * @param  MailYabDataSource $yab Caldav data source
     * @return mix
     */
    function createYabDataSource(MailYabDataSource $yab);

    /**
     * Creates a rss data source that imports mail items into the specified folder.
     *
     * @param  MailRssDataSource $rss Rss data source
     * @return mix
     */
    function createRssDataSource(MailRssDataSource $rss);

    /**
     * Creates a gal data source that imports mail items into the specified folder.
     *
     * @param  MailGalDataSource $gal Gal data source
     * @return mix
     */
    function createGalDataSource(MailGalDataSource $gal);

    /**
     * Creates a cal data source that imports mail items into the specified folder.
     *
     * @param  MailCalDataSource $cal Cal data source
     * @return mix
     */
    function createCalDataSource(MailCalDataSource $cal);

    /**
     * Creates a unknown data source that imports mail items into the specified folder.
     *
     * @param  MailUnknownDataSource $unknown Unknown data source
     * @return mix
     */
    function createUnknownDataSource(MailUnknownDataSource $unknown);

    /**
     * Create folder.
     *
     * @param  NewFolderSpec $folder New folder specification.
     * @return mix
     */
    function createFolder(NewFolderSpec $folder);

    /**
     * Create mountpoint.
     *
     * @param  NewMountpointSpec $link New mountpoint specification.
     * @return mix
     */
    function createMountpoint(NewMountpointSpec $link);

    /**
     * Create a note.
     *
     * @param  NewNoteSpec $note New note specification.
     * @return mix
     */
    function createNote(NewNoteSpec $note);

    /**
     * Create a search folder.
     *
     * @param  NewSearchFolderSpec $search New search folder specification.
     * @return mix
     */
    function createSearchFolder(NewSearchFolderSpec $search);

    /**
     * Create a tag.
     *
     * @param  TagSpec $tag Tag specification.
     * @return mix
     */
    function createTag(TagSpec $tag);

    /**
     * This is the API to create a new Task.
     *
     * @param  Msg $m Message
     * @param  bool $echo If specified, the created appointment is echoed back in the response as if a GetMsgRequest was made
     * @param  int $max Maximum inlined length
     * @param  bool $html Set if want HTML included in echoing
     * @param  bool $neuter Set if want "neuter" set for echoed response
     * @param  bool $forcesend If set, ignore smtp 550 errors when sending the notification to attendees.
     * @return mix
     */
    function createTask(
        Msg $m = null,
        $echo = null,
        $max = null,
        $html = null,
        $neuter = null,
        $forcesend = null
    );

    /**
     * Create Task Exception.
     *
     * @param  Msg $m Message
     * @param  string $id ID of default invite
     * @param  int $comp Component of default invite
     * @param  int $ms Change sequence of fetched series
     * @param  int $rev Revision of fetched series
     * @param  bool $echo If specified, the created appointment is echoed back in the response as if a GetMsgRequest was made
     * @param  int $max Maximum inlined length
     * @param  bool $html Set if want HTML included in echoing
     * @param  bool $neuter Set if want "neuter" set for echoed response
     * @param  bool $forcesend If set, ignore smtp 550 errors when sending the notification to attendees.
     * @return mix
     */
    function createTaskException(
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null,
        $echo = null,
        $max = null,
        $html = null,
        $neuter = null,
        $forcesend = null
    );

    /**
     * Create a waitset to listen for changes on one or more accounts.
     * Called once to initialize a WaitSet and to set its "default interest types"
     * WaitSet: scalable mechanism for listening for changes to one or more accounts
     *
     * @param  WaitSetSpec $add WaitSet add specification.
     * @param  array $defTypes Default interest types: comma-separated list.
     * @param  bool  $allAccounts If {all-accounts} is set, then all mailboxes on the system will be listened to, including any mailboxes which are created on the system while the WaitSet is in existence.
     * @return mix
     */
    function createWaitSet(
        WaitSetSpec $add = null,
        array $defTypes = [],
        $allAccounts = null
    );

    /**
     * Decline a change proposal from an attendee.
     * Sent by organizer to an attendee who has previously sent a COUNTER message.
     * The syntax of the request is very similar to CreateAppointmentRequest.
     *
     * @param  Msg $message Details of the Decline Counter.
     * @return mix
     */
    function declineCounterAppointment(Msg $m = null);

    /**
     * Deletes the given data sources.
     * The name or id of each data source must be specified.
     *
     * @param  ImapDataSourceNameOrId $imap
     * @param  Pop3DataSourceNameOrId $pop3
     * @param  CaldavDataSourceNameOrId $caldav
     * @param  YabDataSourceNameOrId $yab
     * @param  RssDataSourceNameOrId $rss
     * @param  GalDataSourceNameOrId $gal
     * @param  CalDataSourceNameOrId $cal
     * @param  UnknownDataSourceNameOrId $unknown
     * @return mix
     */
    function deleteDataSource(
        ImapDataSourceNameOrId $imap = null,
        Pop3DataSourceNameOrId $pop3 = null,
        CaldavDataSourceNameOrId $caldav = null,
        YabDataSourceNameOrId $yab = null,
        RssDataSourceNameOrId $rss = null,
        GalDataSourceNameOrId $gal = null,
        CalDataSourceNameOrId $cal = null,
        UnknownDataSourceNameOrId $unknown = null
    );

    /**
     * Permanently deletes mapping for indicated device.
     *
     * @param  Id $id Device ID.
     * @return mix
     */
    function deleteDevice(Id $device);

    /**
     * Use this to close out the waitset.
     * Note that the server will automatically time out a wait set if there is no reference to it for (default of) 20 minutes.
     * WaitSet: scalable mechanism for listening for changes to one or more accounts.
     *
     * @param  string $waitSet Waitset ID.
     * @return mix
     */
    function destroyWaitSet($waitSet);

    /**
     * Performs line by line diff of two revisions of a Document then returns a list of <chunk/> containing the result.
     * Sections of text that are identical to both versions are indicated with disp="common".
     * For each conflict the chunk will show disp="first", disp="second" or both.
     *
     * @param  DiffDocumentVersionSpec $doc Diff document version specification.
     * @return mix
     */
    function diffDocument(DiffDocumentVersionSpec $doc);

    /**
     * Dismiss calendar item alarm.
     *
     * @param  array $alarms Details of alarms to dismiss.
     * @return mix
     */
    function dismissCalendarItemAlarm(array $alarms);

    /**
     * Document action.
     *
     * @param  DocumentActionSelector $action Document action selector.
     * @return mix
     */
    function documentAction(DocumentActionSelector $action);

    /**
     * Empty dumpster.
     *
     * @return mix
     */
    function emptyDumpster();

    /**
     * Enable/disable reminders for shared appointments/tasks on a mountpoint.
     *
     * @param  SharedReminderMount $link Specification for mountpoint.
     * @return mix
     */
    function enableSharedReminder(SharedReminderMount $link);

    /**
     * Expand recurrences.
     *
     * @param  int $startTime Start time in milliseconds
     * @param  int $endTime End time in milliseconds
     * @param  array $timezones Timezone definitions
     * @param  array $components Specifications for series, modified instances and canceled instances
     * @return mix
     */
    function expandRecur(
        $startTime,
        $endTime,
        array $timezones = [],
        array $components = []
    );

    /**
     * Export contacts.
     *
     * @param  string $ct        Content type. Currently, the only supported content type is "csv" (comma-separated values).
     * @param  string $l         Optional folder id to export contacts from.
     * @param  string $csvfmt    Optional csv format for exported contacts. the supported formats are defined in $ZIMBRA_HOME/conf/zimbra-contact-fields.xml.
     * @param  string $csvlocale The locale to use when there are multiple {csv-format} locales defined. When it is not specified, the {csv-format} with no locale specification is used.
     * @param  string $csvsep    Optional delimiter character to use in the resulting csv file - usually "," or ";".
     * @return mix
     */
    function exportContacts(
        $ct,
        $l = null,
        $csvfmt = null,
        $csvlocale = null,
        $csvsep = null
    );

    /**
     * Perform an action on a folder.
     *
     * @param  FolderActionSelector $action Select action to perform on folder.
     * @return mix
     */
    function folderAction(FolderActionSelector $action);

    /**
     * Used by an attendee to forward an instance or entire appointment to another user who is not already an attendee.
     *
     * @param  string $id Appointment item ID
     * @param  DtTimeInfo $exceptId RECURRENCE-ID information if forwarding a single instance of a recurring appointment
     * @param  CalTZInfo $tz Definition for TZID referenced by DATETIME in <exceptId>
     * @param  Msg $m Details of the appointment.
     * @return mix
     */
    function forwardAppointment(
        $id = null,
        DtTimeInfo $exceptId = null,
        CalTZInfo $tz = null,
        Msg $m = null
    );

    /**
     * Used by an attendee to forward an appointment invite email to another user who is not already an attendee.
     * To forward an appointment item, use ForwardAppointmentRequest instead.
     *
     * @param  string $id Appointment item ID
     * @param  Msg $m Details of the appointment.
     * @return mix
     */
    function forwardAppointmentInvite($id = null, Msg $m = null);

    /**
     * Ajax client can use this request to ask the server for help in generating a proper,
     * globally unique UUID.
     *
     * @return mix
     */
    function generateUUID();

    /**
     * Get activity stream.
     *
     * @param  string $id Item ID. If the id is for a Document, the response will include the activities for the requested Document. if it is for a Folder, the response will include the activities for all the Documents in the folder and subfolders.
     * @param  int    $limit Limit - maximum number of activities to be returned
     * @param  int    $offset Offset - for getting the next page worth of activities.
     * @param  ActivityFilter $filter  Optionally <filter> can be used to filter the response based on the user that performed the activity, operation, or both. the server will cache previously established filter search results, and return the identifier in session attribute. The client is expected to reuse the session identifier in the subsequent filter search to improve the performance.
     * @return mix
     */
    function getActivityStream(
        $id,
        $offset = null,
        $limit = null,
        ActivityFilter $filter = null
    );

    /**
     * Get all devices.
     *
     * @return mix
     */
    function getAllDevices();

    /**
     * Get appointment.
     * Returns the metadata info for each Invite that makes up this appointment.
     *
     * @param  bool   $sync    Set this to return the modified date (md) on the appointment.
     * @param  bool   $includeContent If true, MIME parts for body content are returned; default false.
     * @param  bool   $includeInvites If set, information for each invite is included.
     * @param  string $uid     iCalendar UID Either id or uid should be specified, but not both.
     * @param  string $id      Appointment ID. Either id or uid should be specified, but not both.
     * @return mix
     */
    function getAppointment(
        $sync = null,
        $includeContent = null,
        $includeInvites = null,
        $uid = null,
        $id = null
    );

    /**
     * Get appointment summaries.
     *
     * @param  int    $s Range start in milliseconds since the epoch GMT.
     * @param  int    $e Range end in milliseconds since the epoch GMT.
     * @param  string $l Folder Id. Optional folder to constrain requests to; otherwise, searches all folders but trash and spam.
     * @return mix
     */
    function getApptSummaries($s, $e, $l = null);

    /**
     * Get Calendar item summaries.
     *
     * @param  int    $s Range start in milliseconds since the epoch GMT.
     * @param  int    $e Range end in milliseconds since the epoch GMT.
     * @param  string $l Folder Id.
     * @return mix
     */
    function getCalendarItemSummaries($s, $e, $l = null);

    /**
     * Get comments.
     *
     * @param  ParentId $parentId Select parent for comments.
     * @return mix
     */
    function getComments(ParentId $comment);

    /**
     * Get contacts.
     * Contact group members are returned as <m> elements.
     * If derefGroupMember is not set, group members are returned in the order they were inserted in the group.
     * If derefGroupMember is set, group members are returned ordered by the "key" of member.
     * Key is:
     *   1. for contact ref (type="C"): the fileAs field of the Contact
     *   2. for GAL ref (type="G"): email address of the GAL entry
     *   3. for inlined member (type="I"): the value
     *
     * @param  bool   $sync   If set, return modified date (md) on contacts.
     * @param  string $l      If is present, return only contacts in the specified folder.
     * @param  string $sortBy Sort by.
     * @param  bool   $derefGroupMember If set, deref contact group members.
     * @param  bool   $returnHiddenAttrs Whether to return contact hidden attrs defined in zimbraContactHiddenAttributes ignored if <a> is present..
     * @param  int    $maxMembers Max members.
     * @param  array  $a      Attributes - if present, return only the specified attribute(s).
     * @param  array  $ma     If present, return only the specified attribute(s) for derefed members, applicable only when derefGroupMember is set.
     * @param  array  $cn     If present, only get the specified contact(s)..
     * @return mix
     */
    function getContacts(
        $sync = null,
        $l = null,
        $sortBy = null,
        $derefGroupMember = null,
        $returnHiddenAttrs = null,
        $maxMembers = null,
        array $a = [],
        array $ma = [],
        array $cn = []
    );

    /**
     * Get conversation.
     * GetConvRequest gets information about the 1 conversation named by id's value.
     * It will return exactly 1 conversation element. 
     * If fetch="1|all" is included,
     * the full expanded message structure is inlined for the first (or for all) messages in the conversation.
     * If fetch="{item-id}", only the message with the given {item-id} is expanded inline
     *
     * @param  ConversationSpec $c Conversation specification.
     * @return mix
     */
    function getConv(ConversationSpec $c);

    /**
     * Get custom metadata.
     *
     * @param  string $id Item ID.
     * @param  SectionAttr $section Metadata section selector.
     * @return mix
     */
    function getCustomMetadata($id, SectionAttr $meta = null);

    /**
     * Returns all data sources defined for the given mailbox.
     * For each data source, every attribute value is returned except password.
     *
     * @return mix
     */
    function getDataSources();

    /**
     * Get the download URL of shared document.
     *
     * @param  ItemSpec $item Folder specification.
     * @return mix
     */
    function getDocumentShareURL(ItemSpec $item);

    /**
     * Returns the effective permissions of the specified folder.
     *
     * @param  FolderSpec $folder Folder ID.
     * @return mix
     */
    function getEffectiveFolderPerms(FolderSpec $folder);

    /**
     * Get filter rules.
     *
     * @return mix
     */
    function getFilterRules();

    /**
     * Get folder.
     * A {base-folder-id}, a {base-folder-uuid} or a {fully-qualified-path} can optionally be specified in the folder element; if none is present, the descent of the folder hierarchy begins at the mailbox's root folder (id 1).
     * If {fully-qualified-path} is present and {base-folder-id} or {base-folder-uuid} is also present, the path is treated as relative to the folder that was specified by id/uuid. {base-folder-id} is ignored if {base-folder-uuid} is present.
     *
     * @param  bool $visible If set we include all visible subfolders of the specified folder.
     * @param  bool $needGranteeName If set then grantee names are supplied in the d attribute in <grant>.
     * @param  string $view If "view" is set then only the folders with matching view will be returned.
     * @param  int $depth If "depth" is set to a non-negative number, we include that many levels of subfolders in the response.
     * @param  bool $tr If true, one level of mountpoints are traversed and the target folder's counts are applied to the local mountpoint.
     * @param  GetFolderSpec $folder Folder specification
     * @return mix
     */
    function getFolder(
        $visible = null,
        $needGranteeName = null,
        $view = null,
        $depth = null,
        $tr = null,
        GetFolderSpec $folder = null
    );

    /**
     * Get Free/Busy information.
     * For accounts listed using uid,id or name attributes, f/b search will be done for all calendar folders. 
     * To view free/busy for a single folder in a particular account, use <usr>.
     *
     * @param  int $s Range start in milliseconds
     * @param  int $e Range end in milliseconds
     * @param  string $uid Comma-separated list of Zimbra IDs or emails. Each value can be a Ziimbra ID or an email. DEPRECATED.
     * @param  string $id Comma separated list of Zimbra IDs
     * @param  string $name Comma separated list of Emails
     * @param  string $excludeUid UID of appointment to exclude from free/busy search
     * @param  array  $usr To view free/busy for a single folders in particular accounts, use these.
     * @return mix
     */
    function getFreeBusy(
        $s,
        $e,
        $uid = null,
        $id = null,
        $name = null,
        $excludeUid = null,
        array $usr = []
    );

    /**
     * Retrieve the unparsed (but XML-encoded (&quot)) iCalendar data for an Invite.
     * This is intended for interfacing with 3rd party programs. 
     *   1. If id attribute specified, gets the iCalendar representation for one invite.
     *   1. If id attribute is not specified, then start/end MUST be, Calendar data is returned for entire specified range.
     *
     * @param  string $id If specified, gets the iCalendar representation for one invite.
     * @param  int    $s  Range start in milliseconds.
     * @param  int    $e  Range end in milliseconds.
     * @return mix
     */
    function getICal($id = null, $s = null, $e = null);

    /**
     * Returns current import status for all data sources.
     * Status values for a data source are reinitialized when either (a) another
     * import process is started or (b) when the server is restarted.
     * If import has not run yet, the success and error attributes are not specified in the response.
     *
     * @return mix
     */
    function getImportStatus();

    /**
     * Get item.
     * A successful GetItemResponse will contain a single element appropriate for the type of
     * the requested item if there is no matching item, a fault containing the code mail.
     * NO_SUCH_ITEM is returned
     *
     * @param  ItemSpec $item Item specification.
     * @return mix
     */
    function getItem(ItemSpec $item);

    /**
     * Get Mailbox metadata.
     *
     * @param  SectionAttr $meta Metadata section specification.
     * @return mix
     */
    function getMailboxMetadata(SectionAttr $meta = null);

    /**
     * Get information needed for Mini Calendar.
     * Date is returned if there is at least one appointment on that date.
     * The date computation uses the requesting (authenticated) account's time zone,
     * not the time zone of the account that owns the calendar folder.
     *
     * @param  int $s Range start in milliseconds
     * @param  int $e Range end in milliseconds
     * @param  array $folder Local and/or remote calendar folders
     * @param  CalTZInfo $tz Optional timezone specifier.
     * @return mix
     */
    function getMiniCal(
        $s,
        $e,
        array $folder = [],
        CalTZInfo $tz = null
    );

    /**
     * Get message.
     *
     * @param  MsgSpec $message Message specification.
     * @return mix
     */
    function getMsg(MsgSpec $m);

    /**
     * Get message metadata.
     *
     * @param  IdsAttr $ids Messages selector.
     * @return mix
     */
    function getMsgMetadata(IdsAttr $m);

    /**
     * Get note.
     *
     * @param  Id $id Specification for note.
     * @return mix
     */
    function getNote(Id $note);

    /**
     * Get notifications.
     *
     * @param  bool $markSeen If set then all the notifications will be marked as seen. Default: unset.
     * @return mix
     */
    function getNotifications($markSeen = null);

    /**
     * Get outgoing filter rules.
     *
     * @return mix
     */
    function getOutgoingFilterRules();

    /**
     * Get account level permissions.
     * If no <ace> elements are provided, all ACEs are returned in the response. 
     * If <ace> elements are provided, only those ACEs with specified rights are returned in the response.
     *
     * @param  array $rights Specification of rights.
     * @return mix
     */
    function getPermission(array $ace = []);

    /**
     * Retrieve the recurrence definition of an appointment.
     *
     * @param  string $id Calendar item ID.
     * @return mix
     */
    function getRecur($id);

    /**
     * Get all search folders.
     *
     * @return mix
     */
    function getSearchFolder();

    /**
     * Get item acl details.
     *
     * @param  Id $id Item ID.
     * @return mix
     */
    function getShareDetails(Id $item);

    /**
     * Get Share notifications.
     *
     * @return mix
     */
    function getShareNotifications();

    /**
     * GetReturns the list of dictionaries that can be used for spell checking.
     *
     * @return mix
     */
    function getSpellDictionaries();

    /**
     * Get system retention policy.
     *
     * @return mix
     */
    function getSystemRetentionPolicy();

    /**
     * Get information about Tags.
     *
     * @return mix
     */
    function getTag();

    /**
     * Get Task.
     * Similar to GetAppointmentRequest/GetAppointmentResponse
     *
     * @param  bool   $sync Set this to return the modified date (md) on the appointment.
     * @param  bool   $includeContent If set, MIME parts for body content are returned. default false.
     * @param  bool   $includeInvites If set, information for each invite is included. default false.
     * @param  string $uid  iCalendar UID Either id or uid should be specified, but not both.
     * @param  string $id   Appointment ID. Either id or uid should be specified, but not both.
     * @return mix
     */
    function getTask(
        $sync = null,
        $includeContent = null,
        $includeInvites = null,
        $uid = null,
        $id = null
    );

    /**
     * Get task summaries.
     *
     * @param  int    $s Range start in milliseconds since the epoch GMT.
     * @param  int    $e Range end in milliseconds since the epoch GMT.
     * @param  string $l Folder Id. Optional folder to constrain requests to; otherwise, searches all folders but trash and spam.
     * @return mix
     */
    function getTaskSummaries($s, $e, $l = null);

    /**
     * Returns a list of items in the user's mailbox currently being watched by other users.
     *
     * @return mix
     */
    function getWatchers();

    /**
     * Returns a list of items the user is currently watching.
     *
     * @return mix
     */
    function getWatchingItems();

    /**
     * User's working hours within the given time range are expressed in a similar format to the format used for GetFreeBusy.
     * Working hours are indicated as free, non-working hours as unavailable/out of office.
     * The entire time range is marked as unknown if there was an error determining the working hours, e.g. unknown user.
     *
     * @param  int    $s    Range start in milliseconds since the epoch.
     * @param  int    $e    Range end in milliseconds since the epoch.
     * @param  string $id   Comma-separated list of Zimbra IDs.
     * @param  string $name Comma-separated list of email addresses
     * @return mix
     */
    function getWorkingHours($s, $e, $id = null, $name = null);

    /**
     * Get Yahoo Auth Token.
     *
     * @param  string $user     Yahoo user.
     * @param  string $password Yahoo user password.
     * @return mix
     */
    function getYahooAuthToken($user, $password);

    /**
     * Get Yahoo cookie.
     *
     * @param  string $user Yahoo user.
     * @return mix
     */
    function getYahooCookie($user);

    /**
     * Grant account level permissions.
     * GrantPermissionResponse returns permissions that are successfully granted.
     *
     * @param  array $ace Specify Access Control Entries (ACEs).
     * @return mix
     */
    function grantPermission(array $ace = []);

    /**
     * Do an iCalendar Reply.
     *
     * @param  string $ical iCalendar text containing components with method REPLY.
     * @return mix
     */
    function iCalReply($ical);

    /**
     * Import appointments.
     *
     * @param  string $ct Content type
     * @param  ContentSpec $content Content specification
     * @param  string $l Optional folder ID to import appointments into
     * @return mix
     */
    function importAppointments($ct, ContentSpec $content, $l = null);

    /**
     * Import appointments.
     *
     * @param  string $ct Content type. Only currenctly supported content type is "csv".
     * @param  Content $content Content specification.
     * @param  string $l Optional Folder ID to import contacts to.
     * @param  string $csvfmt The format of csv being imported. when it's not defined, Zimbra format is assumed. the supported formats are defined in $ZIMBRA_HOME/conf/zimbra-contact-fields.xml.
     * @param  string $csvlocale The locale to use when there are multiple {csv-format} locales defined. When it is not specified, the {csv-format} with no locale specification is used.
     * @return mix
     */
    function importContacts(
        $ct,
        Content $content,
        $l = null,
        $csvfmt = null,
        $csvlocale = null
    );

    /**
     * Triggers the specified data sources to kick off their import processes.
     * Data import runs asynchronously, so the response immediately returns.
     * Status of an import can be queried via the <GetImportStatusRequest> message.
     * If the server receives an <ImportDataRequest> while an import is already running
     * for a given data source, the second request is ignored.
     *
     * @param  array $dataSources
     * @return mix
     */
    function importData(array $dataSources);

    /**
     * Invalidate reminder device.
     *
     * @param  string $a Device email address.
     * @return mix
     */
    function invalidateReminderDevice($a);

    /**
     * Perform an action on an item.
     *
     * @param  ItemActionSelector $action Specify the action to perform.
     * @return mix
     */
    function itemAction(ItemActionSelector $action);

    /**
     * Returns {num} number of revisions starting from {version} of the requested document.
     * {num} defaults to 1. {version} defaults to the current version.
     * Documents that have multiple revisions have the flag "/", which indicates that the document is versioned.
     *
     * @param  ListDocumentRevisionsSpec $doc Specification for the list of document revisions.
     * @return mix
     */
    function listDocumentRevisions(ListDocumentRevisionsSpec $doc);

    /**
     * Modify an appointment, or if the appointment is a recurrence then modify the "default" invites.
     * That is, all instances that do not have exceptions. .
     * If the appointment has a <recur>, then the following caveats are worth mentioning:.
     * If any of: START, DURATION, END or RECUR change, then all exceptions are implicitly canceled!.
     *
     * @param  Msg $m Message
     * @param  string $id Invite ID of default invite
     * @param  int $comp Component number of default component
     * @param  int $ms Changed sequence of fetched version.
     * @param  int $rev Revision
     * @param  bool $echo If specified, the created appointment is echoed back in the response as if a GetMsgRequest was made
     * @param  int $max Maximum inlined length
     * @param  bool $html Set if want HTML included in echoing
     * @param  bool $neuter Set if want "neuter" set for echoed response
     * @param  bool $forcesend If set, ignore smtp 550 errors when sending the notification to attendees.
     * @return mix
     */
    function modifyAppointment(
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null,
        $echo = null,
        $max = null,
        $html = null,
        $neuter = null,
        $forcesend = null
    );

    /**
     * Modify Contact.
     * When modifying tags, all specified tags are set and all others are unset.
     * If tn="{tag-names}" is NOT specified then any existing tags will remain set.
     *
     * @param  ModifyContactSpec $cn Specification of contact modifications
     * @param  bool  $replace If set, all attrs and group members in the specified contact are replaced with specified attrs and group members, otherwise the attrs and group members are merged with the existing contact. Unset by default.
     * @param  bool  $verbose If set (defaults to unset) The returned <cn> is just a placeholder containing the new contact ID (i.e. <cn id="{id}"/>).
     * @return mix
     */
    function modifyContact(
        ModifyContactSpec $cn,
        $replace = null,
        $verbose = null
    );

    /**
     * Changes attributes of the given data source.
     * Only the attributes specified in the request are modified.
     * If the username, host or leaveOnServer settings are modified,
     * the server wipes out saved state for this data source.
     * As a result, any previously downloaded messages that are still stored
     * on the remote server will be downloaded again.
     *
     * @param  MailDataSource $ds Mail data source
     * @return mix
     */
    function modifyDataSource(MailDataSource $ds = null);

    /**
     * Changes attributes of the imap data source.
     *
     * @param  MailImapDataSource $imap Imap data source
     * @return mix
     */
    function modifyImapDataSource(MailImapDataSource $imap = null);

    /**
     * Changes attributes of the pop3 data source.
     *
     * @param  MailPop3DataSource $pop3 Pop3 data source
     * @return mix
     */
    function modifyPop3DataSource(MailPop3DataSource $pop3 = null);

    /**
     * Changes attributes of the caldav data source.
     *
     * @param  MailCaldavDataSource $caldav Caldav data source
     * @return mix
     */
    function modifyCaldavDataSource(MailCaldavDataSource $caldav = null);

    /**
     * Changes attributes of the yab data source.
     *
     * @param  MailYabDataSource $yab Yab data source
     * @return mix
     */
    function modifyYabDataSource(MailYabDataSource $yab = null);

    /**
     * Changes attributes of the rss data source.
     *
     * @param  MailRssDataSource $rss Rss data source
     * @return mix
     */
    function modifyRssDataSource(MailRssDataSource $rss = null);

    /**
     * Changes attributes of the gal data source.
     *
     * @param  MailGalDataSource $gal Gal data source
     * @return mix
     */
    function modifyGalDataSource(MailGalDataSource $gal = null);

    /**
     * Changes attributes of the cal data source.
     *
     * @param  MailCalDataSource $cal Cal data source
     * @return mix
     */
    function modifyCalDataSource(MailCalDataSource $cal = null);

    /**
     * Changes attributes of the unknown data source.
     *
     * @param  MailUnknownDataSource $unknown Unknown data source
     * @return mix
     */
    function modifyUnknownDataSource(MailUnknownDataSource $unknown = null);

    /**
     * Modify Filter rules.
     *
     * @param  FilterRules $rules Filter rules.
     * @return mix
     */
    function modifyFilterRules(FilterRules $filterRules);

    /**
     * AppliesModify Mailbox Metadata.
     *   1. Modify request must contain one or more key/value pairs.
     *   2. Existing keys' values will be replaced by new values
     *   3. Empty or null value will remove a key
     *   4. New keys can be added
     *
     * @param  MailCustomMetadata $meta Metadata changes
     * @return mix
     */
    function modifyMailboxMetadata(MailCustomMetadata $meta = null);

    /**
     * Modify Outgoing Filter rules.
     *
     * @param  FilterRules $rules Filter rules.
     * @return mix
     */
    function modifyOutgoingFilterRules(FilterRules $filterRules);

    /**
     * Modify Search Folder.
     *
     * @param  ModifySearchFolderSpec $search Specification of Search folder modifications.
     * @return mix
     */
    function modifySearchFolder(ModifySearchFolderSpec $search);

    /**
     * Modify Task.
     *
     * @param  Msg $m Message
     * @param  string $id Invite ID of default invite
     * @param  int $comp Component number of default component
     * @param  int $ms Changed sequence of fetched version.
     * @param  int $rev Revision
     * @param  bool $echo If specified, the created appointment is echoed back in the response as if a GetMsgRequest was made
     * @param  int $max Maximum inlined length
     * @param  bool $html Set if want HTML included in echoing
     * @param  bool $neuter Set if want "neuter" set for echoed response
     * @param  bool $forcesend If set, ignore smtp 550 errors when sending the notification to attendees.
     * @return mix
     */
    function modifyTask(
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null,
        $echo = null,
        $max = null,
        $html = null,
        $neuter = null,
        $forcesend = null
    );

    /**
     * Perform an action on a message.
     * For op="update", caller can specify any or all of: l="{folder}", name="{name}", color="{color}", tn="{tag-names}", f="{flags}". 
     * For op="!spam", can optionally specify a destination folder
     *
     * @param  MsgActionSelector $action Specify the action to perform.
     * @return mix
     */
    function msgAction(MsgActionSelector $action);

    /**
     * A request that does nothing and always returns nothing.
     * Used to keep a session alive, and return any pending notifications.
     *
     * If "wait" is set, and if the current session allows them, this request will block until there are new notifications for the client.
     * Note that the soap envelope must reference an existing session that has notifications enabled, and the notification sequencing number should be specified.
     *
     * If "wait" is set, the caller can specify whether notifications on delegate sessions will cause the operation to return.
     * If "delegate" is unset, delegate mailbox notifications will be ignored. "delegate" is set by default. 
     *
     * @param  bool $wait     Wait setting.
     * @param  bool $delegate If "wait" is set, the caller can use this setting to determine whether notifications on delegate sessions will cause the operation to return. If "delegate" is unset, delegate mailbox notifications will be ignored. "delegate" is set by default.
     * @param  bool $limitToOneBlocked If specified, the server will only allow a given user to have one single waiting-NoOp on the server at a time, it will complete (with waitDisallowed set) any existing limited hanging NoOpRequests when a new request comes in.
     * @param  int  $timeout  The client may specify a custom timeout-length for their request if they know something about the particular underlying network. The server may or may not honor this request (depending on server configured max/min values: see LocalConfig variables zimbra_noop_default_timeout, zimbra_noop_min_timeout and zimbra_noop_max_timeout).
     * @return mix
     */
    function noOp(
        $wait = null,
        $delegate = null,
        $limitToOneBlocked = null,
        $timeout = null
    );

    /**
     * Perform an action on an note.
     *
     * @param  NoteActionSelector $action Specify the action to perform.
     * @return mix
     */
    function noteAction(NoteActionSelector $action);

    /**
     * Purge revision.
     *
     * @param  PurgeRevisionSpec $revision Specification or revision to purge.
     * @return mix
     */
    function purgeRevision(PurgeRevisionSpec $revision);

    /**
     * Perform an action on the contact ranking table.
     *
     * @param  RankingActionSpec $action Specification ranking action.
     * @return mix
     */
    function rankingAction(RankingActionSpec $action);

    /**
     * Register a device.
     *
     * @param  NamedElement $name Specify the device.
     * @return mix
     */
    function registerDevice(NamedElement $device);

    /**
     * Remove attachments from a message body.
     * NOTE that this operation is effectively a create and a delete, and thus the message's item ID will change.
     *
     * @param  MsgPartIds $m Specification of parts to remove.
     * @return mix
     */
    function removeAttachments(MsgPartIds $m);

    /**
     * Revoke account level permissions.
     * RevokePermissionResponse returns permissions that are successfully revoked.
     *
     * @param  array $ace Specify Access Control Entries (ACEs).
     * @return mix
     */
    function revokePermission(array $ace = []);

    /**
     * Save Document.
     * One mechanism for Creating and updating a Document is:
     *   1. Use FileUploadServlet to upload the document.
     *   1. Call SaveDocumentRequest using the upload-id returned from FileUploadServlet.
     * A Document represents a file.
     * A file can be created by uploading to FileUploadServlet.
     * Or it can refer to an attachment of an existing message.
     *
     * Documents are versioned.
     * The server maintains the metadata of each version, such as by who and when the version was edited, and the fragment. 
     *
     * @param  DocumentSpec $doc Document specification.
     * @return mix
     */
    function saveDocument(DocumentSpec $doc);

    /**
     * Save draft.
     *   1. Only allowed one top-level <mp> but can nest <mp>s within if multipart/* on reply/forward. Set origid on <m> element and set rt to "r" or "w", respectively.
     *   2. Can optionally set identity-id to specify the identity being used to compose the message. If updating an existing draft, set "id" attr on <m> element.
     *   3. Can refer to parts of existing draft in <attach> block.
     *   4. Drafts default to the Drafts folder.
     *   5. Setting folder/tags/flags/color occurs after the draft is created/updated, and if it fails the content WILL STILL BE SAVED.
     *   6. Can optionally set autoSendTime to specify the time at which the draft should be automatically sent by the server.
     *   7. The ID of the saved draft is returned in the "id" attribute of the response.
     *   8. The ID referenced in the response's "idnt" attribute specifies the folder where the sent message is saved.
     *
     * @param  SaveDraftMsg $m Details of Draft to save.
     * @return mix
     */
    function saveDraft(SaveDraftMsg $m);

    /**
     * Search.
     * For a response, the order of the returned results represents the sorted order.
     * There is not a separate index attribute or element.
     *
     * @param  bool $warmup Warmup: When this option is specified, all other options are simply ignored, so you can't include this option in regular search requests.
     * @param  string $query Query string
     * @param  array $header if <header>s are requested, any matching headers are included in inlined message hits
     * @param  CalTZInfo $tz Timezone specification
     * @param  string $locale Client locale identification.
     * @param  CursorInfo $cursor Cursor specification
     * @param  bool $includeTagDeleted Set to 1 (true) to include items with the \Deleted calExpandInstStart set in results
     * @param  bool $includeTagMuted Set to 1 (true) to include items with the Muted calExpandInstStart set in results
     * @param  string $allowableTaskStatus Comma separated list of allowable Task statuses.
     * @param  int $calExpandInstStart Start time in milliseconds for the range to include instances for calendar items from. 
     * @param  int $calExpandInstEnd End time in milliseconds for the range to include instances for calendar items from.
     * @param  bool $inDumpster Set this flat to 1 (true) to search dumpster data instead of live data.
     * @param  string $types Comma separated list of search types. Legal values are: conversation|message|contact|appointment|task|wiki|document 
     * @param  string $groupBy Deprecated. Use {comma-sep-search-types} instead
     * @param  bool $quick "Quick" flag.
     * @param  SortBy $sortBy SortBy setting. Default value is "dateDesc" 
     * @param  string $fetch Select setting for hit expansion.
     * @param  bool $read Inlined hits will be marked as read
     * @param  int $max If specified, inlined body content in limited to the given length;
     * @param  bool $html Set to 1 (true) to cause inlined hits to return HTML parts if available
     * @param  bool $needExp If 'includeTagDeleted' is set in the request, two additional flags may be included in <e> elements for messages returned inline.
     * @param  bool $neuter Set to 0 (false) to stop images in inlined HTML parts from being "neutered"
     * @param  bool $recip Want recipients setting. 
     * @param  bool $prefetch Prefetch
     * @param  string $resultMode Specifies the type of result.
     * @param  bool $fullConversation Full conversation
     * @param  string $field By default, text without an operator searches the CONTENT field.
     * @param  int $limit The maximum number of results to return.
     * @param  int $offset Specifies the 0-based offset into the results list to return as the first result for this search operation.
     * @return mix
     */
    function search(
        $warmup = null,
        $query = null,
        array $header = [],
        CalTZInfo $tz = null,
        $locale = null,
        CursorInfo $cursor = null,
        $includeTagDeleted = null,
        $includeTagMuted = null,
        $allowableTaskStatus = null,
        $calExpandInstStart = null,
        $calExpandInstEnd = null,
        $inDumpster = null,
        $types = null,
        $groupBy = null,
        $quick = null,
        SortBy $sortBy = null,
        $fetch = null,
        $read = null,
        $max = null,
        $html = null,
        $needExp = null,
        $neuter = null,
        $recip = null,
        $prefetch = null,
        $resultMode = null,
        $fullConversation = null,
        $field = null,
        $limit = null,
        $offset = null
    );

    /**
     * Search a conversation.
     *
     * @param  string $cid The ID of the conversation to search within. REQUIRED.
     * @param  string $nest If set then the response will contain a top level <c element representing the conversation with child <m> elements representing messages in the conversation.
     * @param  string $query Query string
     * @param  array $header if <header>s are requested, any matching headers are included in inlined message hits
     * @param  CalTZInfo $tz Timezone specification
     * @param  string $locale Client locale identification.
     * @param  CursorInfo $cursor Cursor specification
     * @param  bool $includeTagDeleted Set to 1 (true) to include items with the \Deleted calExpandInstStart set in results
     * @param  bool $includeTagMuted Set to 1 (true) to include items with the Muted calExpandInstStart set in results
     * @param  string $allowableTaskStatus Comma separated list of allowable Task statuses.
     * @param  int $calExpandInstStart Start time in milliseconds for the range to include instances for calendar items from. 
     * @param  int $calExpandInstEnd End time in milliseconds for the range to include instances for calendar items from.
     * @param  bool $inDumpster Set this flat to 1 (true) to search dumpster data instead of live data.
     * @param  string $types Comma separated list of search types. Legal values are: conversation|message|contact|appointment|task|wiki|document 
     * @param  string $groupBy Deprecated. Use {comma-sep-search-types} instead
     * @param  bool $quick "Quick" flag.
     * @param  SortBy $sortBy SortBy setting. Default value is "dateDesc" 
     * @param  string $fetch Select setting for hit expansion.
     * @param  bool $read Inlined hits will be marked as read
     * @param  int $max If specified, inlined body content in limited to the given length;
     * @param  bool $html Set to 1 (true) to cause inlined hits to return HTML parts if available
     * @param  bool $needExp If 'includeTagDeleted' is set in the request, two additional flags may be included in <e> elements for messages returned inline.
     * @param  bool $neuter Set to 0 (false) to stop images in inlined HTML parts from being "neutered"
     * @param  bool $recip Want recipients setting. 
     * @param  bool $prefetch Prefetch
     * @param  string $resultMode Specifies the type of result.
     * @param  bool $fullConversation Full conversation
     * @param  string $field By default, text without an operator searches the CONTENT field.
     * @param  int $limit The maximum number of results to return.
     * @param  int $offset Specifies the 0-based offset into the results list to return as the first result for this search operation.
     * @return mix
     */
    function searchConv(
        $cid,
        $nest = null,
        $query = null,
        array $header = [],
        CalTZInfo $tz = null,
        $locale = null,
        CursorInfo $cursor = null,
        $includeTagDeleted = null,
        $includeTagMuted = null,
        $allowableTaskStatus = null,
        $calExpandInstStart = null,
        $calExpandInstEnd = null,
        $inDumpster = null,
        $types = null,
        $groupBy = null,
        $quick = null,
        SortBy $sortBy = null,
        $fetch = null,
        $read = null,
        $max = null,
        $html = null,
        $needExp = null,
        $neuter = null,
        $recip = null,
        $prefetch = null,
        $resultMode = null,
        $fullConversation = null,
        $field = null,
        $limit = null,
        $offset = null
    );

    /**
     * Send a delivery report.
     *
     * @param  string $mid Message ID.
     * @return mix
     */
    function sendDeliveryReport($mid);

    /**
     * Send a reply to an invite.
     *
     * @param  string $id Unique ID of the invite (and component therein) you are replying to
     * @param  int $compNum Component number of the invite
     * @param  string $verb Verb - ACCEPT, DECLINE, TENTATIVE, COMPLETED, DELEGATED (Completed/Delegated are NOT supported as of 9/12/2005)
     * @param  bool $updateOrganizer Update organizer. Set by default.
     * @param  string $idnt Identity ID to use to send reply
     * @param  DtTimeInfo $exceptId If supplied then reply to just one instance of the specified Invite (default is all instances)
     * @param  CalTZInfo $tz Definition for TZID referenced by DATETIME in <exceptId>
     * @param  Msg $m Embedded message, if the user wants to send a custom update message.
     * @return mix
     */
    function sendInviteReply(
        $id,
        $compNum,
        $verb,
        $updateOrganizer = null,
        $idnt = null,
        DtTimeInfo $exceptId = null,
        CalTZInfo $tz = null,
        Msg $m = null
    );

    /**
     * Send message.
     *   1. Supports (f)rom, (t)o, (c)c, (b)cc, (r)eply-to, (s)ender, read-receipt (n)otification "type" on <e> elements.
     *   2. Only allowed one top-level <mp> but can nest <mp>s within if multipart/*.
     *   3. A leaf <mp> can have inlined content (<mp ct="{content-type}"><content>...</content></mp>).
     *   4. A leaf <mp> can have referenced content (<mp><attach ...></mp>).
     *   5. Any <mp> can have a Content-ID header attached to it.
     *   6. On reply/forward, set origid on <m> element and set rt to "r" or "w", respectively.
     *   7. Can optionally set identity-id to specify the identity being used to compose the message.
     *   8. If noSave is set, a copy will not be saved to sent regardless of account/identity settings.
     *   9. Can set priority high (!) or low (?) on sent message by specifying "f" attr on <m>
     *   10. The message to be sent can be fully specified under the <m> element or, to compose the message remotely remotely, upload it via FileUploadServlet, and submit it through our server.
     *   11. If the message is saved to the sent folder then the ID of the message is returned. Otherwise, no ID is returned -- just a <m> is returned.
     *
     * @param  MsgToSend $m Message
     * @param  bool $needCalendarSentByFixup If set then Add SENT-BY parameter to ORGANIZER and/or ATTENDEE properties in iCalendar part when sending message on behalf of another user.
     * @param  bool $isCalendarForward Indicates whether this a forward of calendar invitation in which case the server sends Forward Invitation Notification, default is unset.
     * @param  bool $noSave If set, a copy will not be saved to sent regardless of account/identity settings
     * @param  string $suid Send UID
     * @return mix
     */
    function sendMsg(
        MsgToSend $m = null,
        $needCalendarSentByFixup = null,
        $isCalendarForward = null,
        $noSave = null,
        $suid = null
    );

    /**
     * Send share notification.
     * The client can list the recipient email addresses for the share, along with the itemId of the item being shared.
     *
     * @param  Id $m Item ID
     * @param  array $e Email addresses
     * @param  string $notes Notes
     * @param  Action $action Set to "revoke" if it is a grant revoke notification.
     * @return mix
     */
    function sendShareNotification(
        Id $item = null,
        array $e = [],
        $notes = null,
        Action $action = null
    );

    /**
     * SendVerificationCodeRequest results in a random verification code being generated and sent to a device.
     *
     * @param  string $a Device email address.
     * @return mix
     */
    function sendVerificationCode($a = null);

    /**
     * Directly set status of an entire appointment.
     * This API is intended for mailbox Migration (ie migrating a mailbox onto this server) and is not used by normal mail clients.
     * Need to specify folder for appointment 
     * Need way to add message WITHOUT processing it for calendar parts.
     * Need to generate and patch-in the iCalendar for the <inv> but w/o actually processing the <inv> as a new request.
     *
     * @param  string $f Flags
     * @param  string $t Tags (Deprecated - use {tag-names} instead)
     * @param  string $tn Comma separated list of tag names
     * @param  string $l ID of folder to create appointment in
     * @param  bool $noNextAlarm Set if all alarms have been dismissed; if this is set, nextAlarm should not be set
     * @param  int $nextAlarm If specified, time when next alarm should go off. 
     * @param  SetCalendarItemInfo $m Default calendar item information
     * @param  array $except Calendar item information for exceptions 
     * @param  array $cancel Calendar item information for cancellations 
     * @param  Replies $replies Replies
     * @return mix
     */
    function setAppointment(
        $f = null,
        $t = null,
        $tn = null,
        $l = null,
        $noNextAlarm = null,
        $nextAlarm = null,
        SetCalendarItemInfo $default = null,
        array $except = [],
        array $cancel = [],
        Replies $replies = null
    );

    /**
     * Set Custom Metadata.
     * Setting a custom metadata section but providing no key/value pairs will remove the sction from the item.
     *
     * @param  string $id      Item ID.
     * @param  MailCustomMetadata $meta New metadata information
     * @return mix
     */
    function setCustomMetadata($id, MailCustomMetadata $meta = null);

    /**
     * Set Mailbox Metadata.
     *   1. Setting a mailbox metadata section but providing no key/value pairs will remove the section from mailbox metadata.
     *   2. Empty value not allowed
     *   3. {metadata-section-key} must be no more than 36 characters long and must be in the format of {namespace}:{section-name}. currently the only valid namespace is "zwc".
     *
     * @param  MailCustomMetadata $meta New metadata information.
     * @return mix
     */
    function setMailboxMetadata(MailCustomMetadata $meta = null);

    /**
     * Directly set status of an entire task.
     * See SetAppointment for more information.
     *
     * @param  string $f Flags
     * @param  string $t Tags (Deprecated - use {tag-names} instead)
     * @param  string $tn Comma separated list of tag names
     * @param  string $l ID of folder to create appointment in
     * @param  bool $noNextAlarm Set if all alarms have been dismissed; if this is set, nextAlarm should not be set
     * @param  int $nextAlarm If specified, time when next alarm should go off. 
     * @param  SetCalendarItemInfo $m Default calendar item information
     * @param  array $except Calendar item information for exceptions 
     * @param  array $cancel Calendar item information for cancellations 
     * @param  Replies $replies Replies
     * @return mix
     */
    function setTask(
        $f = null,
        $t = null,
        $tn = null,
        $l = null,
        $noNextAlarm = null,
        $nextAlarm = null,
        SetCalendarItemInfo $default = null,
        array $except = [],
        array $cancel = [],
        Replies $replies = null
    );

    /**
     * Snooze alarm(s) for appointments or tasks.
     *
     * @param  array $alarms.
     * @return mix
     */
    function snoozeCalendarItemAlarm(array $alarms = []);

    /**
     * Snooze alarm(s) for appointments or tasks.
     *
     * @param  string $token Token - not provided for initial sync.
     * @param  int    $calCutoff Earliest Calendar date. If present, omit all appointments and tasks that don't have a recurrence ending after that time (specified in ms).
     * @param  string $l Root folder ID. If present, we start sync there rather than at folder 11.
     * @param  bool   $typed If specified and set, deletes are also broken down by item type.
     * @return mix
     */
    function sync(
        $token = null,
        $calCutoff = null,
        $l = null,
        $typed = null
    );

    /**
     * Perform an action on a tag.
     *
     * @param  TagActionSelector $action Specify action to perform.
     * @return mix
     */
    function tagAction(TagActionSelector $action);

    /**
     * Tests the connection to the specified data source.
     * Does not modify the data source or import data.
     * If the id is specified, uses an existing data source.
     * Any values specified in the request are used in the test instead of the saved values.
     *
     * @param  MailImapDataSource $imap Imap data source
     * @param  MailPop3DataSource $pop3 Pop3 data source
     * @param  MailCaldavDataSource $caldav Caldav data source
     * @param  MailYabDataSource $yab Yab data source
     * @param  MailRssDataSource $rss Rss data source
     * @param  MailGalDataSource $gal Gal data source
     * @param  MailCalDataSource $cal Cal data source
     * @param  MailUnknownDataSource $unknown Unknown data source
     * @return mix
     */
    function testDataSource(MailDataSource $ds = null);

    /**
     * Tests the connection to the imap data source.
     *
     * @param  MailImapDataSource $imap Imap data source
     * @return mix
     */
    function testImapDataSource(MailImapDataSource $imap);

    /**
     * Tests the connection to the pop3 data source.
     *
     * @param  MailPop3DataSource $pop3 Pop3 data source
     * @return mix
     */
    function testPop3DataSource(MailPop3DataSource $pop3);

    /**
     * Tests the connection to the caldav data source.
     *
     * @param  MailCaldavDataSource $caldav Caldav data source
     * @return mix
     */
    function testCaldavDataSource(MailCaldavDataSource $caldav);

    /**
     * Tests the connection to the yab data source.
     *
     * @param  MailYabDataSource $yab Caldav data source
     * @return mix
     */
    function testYabDataSource(MailYabDataSource $yab);

    /**
     * Tests the connection to the rss data source.
     *
     * @param  MailRssDataSource $rss Rss data source
     * @return mix
     */
    function testRssDataSource(MailRssDataSource $rss);

    /**
     * Tests the connection to the gal data source.
     *
     * @param  MailGalDataSource $gal Gal data source
     * @return mix
     */
    function testGalDataSource(MailGalDataSource $gal);

    /**
     * Tests the connection to the cal data source.
     *
     * @param  MailCalDataSource $cal Cal data source
     * @return mix
     */
    function testCalDataSource(MailCalDataSource $cal);

    /**
     * Tests the connection to the unknown data source.
     *
     * @param  MailUnknownDataSource $unknown Unknown data source
     * @return mix
     */
    function testUnknownDataSource(MailUnknownDataSource $unknown);

    /**
     * Update device status.
     *
     * @param  IdStatus $device Information about device status.
     * @return mix
     */
    function updateDeviceStatus(IdStatus $device);

    /**
     * Validate the verification code sent to a device.
     * After successful validation the server sets the device email address as the value of zimbraCalendarReminderDeviceEmail account attribute.
     *
     * @param  string $a Device email address.
     * @param  string $code Verification code.
     * @return mix
     */
    function verifyCode($a = null, $code = null);

    /**
     * WaitSetRequest optionally modifies the wait set and checks for any notifications.
     * If block is set and there are no notificatins, then this API will BLOCK until there is data.
     * Client should always set 'seq' to be the highest known value it has received from the server.
     * The server will use this information to retransmit lost data.
     * If the client sends a last known sync token then the notification is calculated by comparing the accounts current token with the client's last known.
     * If the client does not send a last known sync token, then notification is based on change since last Wait (or change since <add> if this is the first time Wait has been called with the account)
     * The client may specifiy a custom timeout-length for their request if they know something about the particular underlying network.
     * The server may or may not honor this request (depending on server configured max/min values).
     *
     * @param  string $waitSet Waitset ID
     * @param  string $seq Last known sequence number
     * @param  WaitSetSpec $add WaitSet add specification
     * @param  WaitSetSpec $update WaitSet update specification
     * @param  WaitSetId $remove WaitSet remove specification
     * @param  bool $block Flag whether or not to block until some account has new data
     * @param  array $defTypes Default interest types: comma-separated list.
     * @param  int $timeout Timeout length
     * @return mix
     */
    function waitSet(
        $waitSet,
        $seq,
        WaitSetSpec $add = null,
        WaitSetSpec $update = null,
        WaitSetId $remove = null,
        $block = null,
        array $defTypes = [],
        $timeout = null
    );
}
