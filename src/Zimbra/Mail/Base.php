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

use Zimbra\Account\Base as AccountBase;

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
 * Base is a abstract class which allows to connect Zimbra API mail public functions via SOAP
 *
 * @package   Zimbra
 * @category  Mail
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Base extends AccountBase implements MailInterface
{
    /**
     * Base constructor
     *
     * @param string $location The Zimbra api soap location.
     */
    public function __construct($location)
    {
        parent::__construct($location);
    }

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
    public function addAppointmentInvite(Msg $m = null, ParticipationStatus $ptst = null)
    {
        $request = new \Zimbra\Mail\Request\AddAppointmentInvite(
            $m, $ptst
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Add a comment to the specified item. Currently comments can only be added to documents.
     *
     * @param  AddedComment $comment Added comment.
     * @return mix
     */
    public function addComment(AddedComment $comment)
    {
        $request = new \Zimbra\Mail\Request\AddComment(
            $comment
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Add a message.
     *
     * @param  AddMsgSpec $m Specification of the message to add.
     * @param  bool $filterSent If set, then do outgoing message filtering if the msg is being added to the Sent folder and has been flagged as sent. Default is unset.
     * @return mix
     */
    public function addMsg(AddMsgSpec $m, $filterSent = null)
    {
        $request = new \Zimbra\Mail\Request\AddMsg(
            $m, $filterSent
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Add a task invite.
     *
     * @param  Msg $m Message.
     * @param  ParticipationStatus $ptst iCalendar PTST (Participation status). Valid values: NE|AC|TE|DE|DG|CO|IN|WE|DF. Meanings: "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo), "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     * @return mix
     */
    public function addTaskInvite(Msg $m = null, ParticipationStatus $ptst = null)
    {
        $request = new \Zimbra\Mail\Request\AddTaskInvite(
            $m, $ptst
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Announce change of organizer.
     *
     * @param  string $id ID.
     * @return mix
     */
    public function announceOrganizerChange($id)
    {
        $request = new \Zimbra\Mail\Request\AnnounceOrganizerChange(
            $id
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function applyFilterRules(
        NamedFilterRules $filterRules,
        IdsAttr $m = null,
        $query = null
    )
    {
        $request = new \Zimbra\Mail\Request\ApplyFilterRules(
            $filterRules, $m, $query
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function applyOutgoingFilterRules(
        NamedFilterRules $filterRules,
        IdsAttr $m = null,
        $query = null
    )
    {
        $request = new \Zimbra\Mail\Request\ApplyOutgoingFilterRules(
            $filterRules, $m, $query
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function autoComplete(
        $name,
        GalSearchType $t = null,
        $needExp = null,
        $folders = null,
        $includeGal = null
    )
    {
        $request = new \Zimbra\Mail\Request\AutoComplete(
            $name,
            $t,
            $needExp,
            $folders,
            $includeGal
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Resend a message.
     * Supports (f)rom, (t)o, (c)c, (b)cc, (s)ender "type" on <e> elements 
     * (these get mapped to Resent-From, Resent-To, Resent-CC, Resent-Bcc, Resent-Sender headers,
     * which are prepended to copy of existing message) 
     * Aside from these prepended headers, message is reinjected verbatim
     *
     * @param  BounceMsgSpec $msg Specification of message to be resent.
     * @return mix
     */
    public function bounceMsg(BounceMsgSpec $msg)
    {
        $request = new \Zimbra\Mail\Request\BounceMsg(
            $msg
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Browse.
     *
     * @param  BrowseBy $browseBy Browse by setting - domains|attachments|objects.
     * @param  string  $regex Regex string. Return only those results which match the specified regular expression.
     * @param  int    $maxToReturn Return only a maximum number of entries as requested. If more than {max-entries} results exist, the server will return the first {max-entries}, sorted by frequency.
     * @return mix
     */
    public function browse(BrowseBy $browseBy, $regex = null, $maxToReturn = null)
    {
        $request = new \Zimbra\Mail\Request\Browse(
            $browseBy, $regex, $maxToReturn
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function cancelAppointment(
        InstanceRecurIdInfo $inst = null,
        CalTZInfo $tz = null,
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null
    )
    {
        $request = new \Zimbra\Mail\Request\CancelAppointment(
            $inst,
            $tz,
            $m,
            $id,
            $comp,
            $ms,
            $rev
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function cancelTask(
        InstanceRecurIdInfo $inst = null,
        CalTZInfo $tz = null,
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null
    )
    {
        $request = new \Zimbra\Mail\Request\CancelTask(
            $inst,
            $tz,
            $m,
            $id,
            $comp,
            $ms,
            $rev
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Check device status.
     *
     * @param  Id $id Device ID.
     * @return mix
     */
    public function checkDeviceStatus(Id $device)
    {
        $request = new \Zimbra\Mail\Request\CheckDeviceStatus(
            $device
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function checkPermission(TargetSpec $target = null, array $right = [])
    {
        $request = new \Zimbra\Mail\Request\CheckPermission(
            $target, $right
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Check conflicts in recurrence against list of users.
     * Set all attribute to get all instances, even those without conflicts.
     * By default only instances that have conflicts are returned.
     *
     * @param  int $s Start time in millis.  If not specified, defaults to current time
     * @param  int $e End time in millis.  If not specified, unlimited
     * @param  bool $all Set this to get all instances, even those without conflicts. By default only instances that have conflicts are returned.
     * @param  string $excludeUid UID of appointment to exclude from free/busy search
     * @param  array $timezones Timezones
     * @param  array $component Expanded recurrences
     * @param  array $users Freebusy user specifications
     * @return mix
     */
    public function checkRecurConflicts(
        $s = null,
        $e = null,
        $all = null,
        $excludeUid = null,
        array $timezones = [],
        array $component = [],
        array $users = []
    )
    {
        $request = new \Zimbra\Mail\Request\CheckRecurConflicts(
            $s,
            $e,
            $all,
            $excludeUid,
            $timezones,
            $component,
            $users
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function checkSpelling($value = null, $dictionary = null, $ignore = null)
    {
        $request = new \Zimbra\Mail\Request\CheckSpelling(
            $value, $dictionary, $ignore
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Complete a task instance.
     *
     * @param  string $id ID
     * @param  DtTimeInfo $exceptId Exception ID
     * @param  CalTZInfo $tz Timezone information
     * @return mix
     */
    public function completeTaskInstance(
        $id,
        DtTimeInfo $exceptId,
        CalTZInfo $tz = null
    )
    {
        $request = new \Zimbra\Mail\Request\CompleteTaskInstance(
            $id, $exceptId, $tz
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Contact Action.
     *
     * @param  ContactActionSelector $action Contact action selector
     * @return mix
     */
    public function contactAction(ContactActionSelector $action)
    {
        $request = new \Zimbra\Mail\Request\ContactAction(
            $action
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Conv Action.
     *
     * @param  ConvActionSelector $action Action selector.
     * @return mix
     */
    public function convAction(ConvActionSelector $action)
    {
        $request = new \Zimbra\Mail\Request\ConvAction(
            $action
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function counterAppointment(
        Msg $m = null,
        $id = null,
        $comp = null,
        $ms = null,
        $rev = null
    )
    {
        $request = new \Zimbra\Mail\Request\CounterAppointment(
            $m,
            $id,
            $comp,
            $ms,
            $rev
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function createAppointment(
        Msg $m = null,
        $echo = null,
        $max = null,
        $html = null,
        $neuter = null,
        $forcesend = null
    )
    {
        $request = new \Zimbra\Mail\Request\CreateAppointment(
            $m,
            $echo,
            $max,
            $html,
            $neuter,
            $forcesend
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function createAppointmentException(
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
    )
    {
        $request = new \Zimbra\Mail\Request\CreateAppointmentException(
            $m,
            $id,
            $comp,
            $ms,
            $rev,
            $echo,
            $max,
            $html,
            $neuter,
            $forcesend
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Create a contact.
     *
     * @param  ContactSpec $cn Contact specification
     * @param  bool $verbose If set (defaults to unset) The returned <cn> is just a placeholder containing the new contact ID (i.e. <cn id="{id}"/>)
     * @return mix
     */
    public function createContact(ContactSpec $cn, $verbose = null)
    {
        $request = new \Zimbra\Mail\Request\CreateContact(
            $cn, $verbose
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Creates a data source that imports mail items into the specified folder,
     * for example via the POP3 or IMAP protocols.
     * Only one data source is allowed per request.
     *
     * @param  MailDataSource $ds Data source
     * @return mix
     */
    public function createDataSource(MailDataSource $ds)
    {
        $request = new \Zimbra\Mail\Request\CreateDataSource($ds);
        return $this->getClient()->doRequest($request);
    }

    /**
     * Creates a imap data source that imports mail items into the specified folder.
     *
     * @param  MailImapDataSource $imap Imap data source
     * @return mix
     */
    public function createImapDataSource(MailImapDataSource $imap)
    {
        return $this->createDataSource($imap);
    }

    /**
     * Creates a pop3 data source that imports mail items into the specified folder.
     *
     * @param  MailPop3DataSource $pop3 Pop3 data source
     * @return mix
     */
    public function createPop3DataSource(MailPop3DataSource $pop3)
    {
        return $this->createDataSource($pop3);
    }

    /**
     * Creates a caldav data source that imports mail items into the specified folder.
     *
     * @param  MailCaldavDataSource $caldav Caldav data source
     * @return mix
     */
    public function createCaldavDataSource(MailCaldavDataSource $caldav)
    {
        return $this->createDataSource($caldav);
    }

    /**
     * Creates a yab data source that imports mail items into the specified folder.
     *
     * @param  MailYabDataSource $yab Caldav data source
     * @return mix
     */
    public function createYabDataSource(MailYabDataSource $yab)
    {
        return $this->createDataSource($yab);
    }

    /**
     * Creates a rss data source that imports mail items into the specified folder.
     *
     * @param  MailRssDataSource $rss Rss data source
     * @return mix
     */
    public function createRssDataSource(MailRssDataSource $rss)
    {
        return $this->createDataSource($rss);
    }

    /**
     * Creates a gal data source that imports mail items into the specified folder.
     *
     * @param  MailGalDataSource $gal Gal data source
     * @return mix
     */
    public function createGalDataSource(MailGalDataSource $gal)
    {
        return $this->createDataSource($gal);
    }

    /**
     * Creates a cal data source that imports mail items into the specified folder.
     *
     * @param  MailCalDataSource $cal Cal data source
     * @return mix
     */
    public function createCalDataSource(MailCalDataSource $cal)
    {
        return $this->createDataSource($cal);
    }

    /**
     * Creates a unknown data source that imports mail items into the specified folder.
     *
     * @param  MailUnknownDataSource $unknown Unknown data source
     * @return mix
     */
    public function createUnknownDataSource(MailUnknownDataSource $unknown)
    {
        return $this->createDataSource($unknown);
    }

    /**
     * Create folder.
     *
     * @param  NewFolderSpec $folder New folder specification.
     * @return mix
     */
    public function createFolder(NewFolderSpec $folder)
    {
        $request = new \Zimbra\Mail\Request\CreateFolder(
            $folder
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Create mountpoint.
     *
     * @param  NewMountpointSpec $link New mountpoint specification.
     * @return mix
     */
    public function createMountpoint(NewMountpointSpec $link)
    {
        $request = new \Zimbra\Mail\Request\CreateMountpoint(
            $link
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Create a note.
     *
     * @param  NewNoteSpec $note New note specification.
     * @return mix
     */
    public function createNote(NewNoteSpec $note)
    {
        $request = new \Zimbra\Mail\Request\CreateNote(
            $note
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Create a search folder.
     *
     * @param  NewSearchFolderSpec $search New search folder specification.
     * @return mix
     */
    public function createSearchFolder(NewSearchFolderSpec $search)
    {
        $request = new \Zimbra\Mail\Request\CreateSearchFolder(
            $search
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Create a tag.
     *
     * @param  TagSpec $tag Tag specification.
     * @return mix
     */
    public function createTag(TagSpec $tag)
    {
        $request = new \Zimbra\Mail\Request\CreateTag(
            $tag
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function createTask(
        Msg $m = null,
        $echo = null,
        $max = null,
        $html = null,
        $neuter = null,
        $forcesend = null
    )
    {
        $request = new \Zimbra\Mail\Request\CreateTask(
            $m,
            $echo,
            $max,
            $html,
            $neuter,
            $forcesend
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function createTaskException(
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
    )
    {
        $request = new \Zimbra\Mail\Request\CreateTaskException(
            $m,
            $id,
            $comp,
            $ms,
            $rev,
            $echo,
            $max,
            $html,
            $neuter,
            $forcesend
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function createWaitSet(
        WaitSetSpec $add = null,
        array $defTypes = [],
        $allAccounts = null
    )
    {
        $request = new \Zimbra\Mail\Request\CreateWaitSet(
            $add,
            $defTypes,
            $allAccounts
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Decline a change proposal from an attendee.
     * Sent by organizer to an attendee who has previously sent a COUNTER message.
     * The syntax of the request is very similar to CreateAppointmentRequest.
     *
     * @param  Msg $message Details of the Decline Counter.
     * @return mix
     */
    public function declineCounterAppointment(Msg $m = null)
    {
        $request = new \Zimbra\Mail\Request\DeclineCounterAppointment(
            $m
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function deleteDataSource(
        ImapDataSourceNameOrId $imap = null,
        Pop3DataSourceNameOrId $pop3 = null,
        CaldavDataSourceNameOrId $caldav = null,
        YabDataSourceNameOrId $yab = null,
        RssDataSourceNameOrId $rss = null,
        GalDataSourceNameOrId $gal = null,
        CalDataSourceNameOrId $cal = null,
        UnknownDataSourceNameOrId $unknown = null
    )
    {
        $request = new \Zimbra\Mail\Request\DeleteDataSource(
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
            $unknown
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Permanently deletes mapping for indicated device.
     *
     * @param  Id $id Device ID.
     * @return mix
     */
    public function deleteDevice(Id $device)
    {
        $request = new \Zimbra\Mail\Request\DeleteDevice(
            $device
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Use this to close out the waitset.
     * Note that the server will automatically time out a wait set if there is no reference to it for (default of) 20 minutes.
     * WaitSet: scalable mechanism for listening for changes to one or more accounts.
     *
     * @param  string $waitSet Waitset ID.
     * @return mix
     */
    public function destroyWaitSet($waitSet)
    {
        $request = new \Zimbra\Mail\Request\DestroyWaitSet(
            $waitSet
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Performs line by line diff of two revisions of a Document then returns a list of <chunk/> containing the result.
     * Sections of text that are identical to both versions are indicated with disp="common".
     * For each conflict the chunk will show disp="first", disp="second" or both.
     *
     * @param  DiffDocumentVersionSpec $doc Diff document version specification.
     * @return mix
     */
    public function diffDocument(DiffDocumentVersionSpec $doc)
    {
        $request = new \Zimbra\Mail\Request\DiffDocument(
            $doc
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Dismiss calendar item alarm.
     *
     * @param  array $alarms Details of alarms to dismiss.
     * @return mix
     */
    public function dismissCalendarItemAlarm(array $alarms)
    {
        $request = new \Zimbra\Mail\Request\DismissCalendarItemAlarm(
            $alarms
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Document action.
     *
     * @param  DocumentActionSelector $action Document action selector.
     * @return mix
     */
    public function documentAction(DocumentActionSelector $action)
    {
        $request = new \Zimbra\Mail\Request\DocumentAction(
            $action
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Empty dumpster.
     *
     * @return mix
     */
    public function emptyDumpster()
    {
        $request = new \Zimbra\Mail\Request\EmptyDumpster();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Enable/disable reminders for shared appointments/tasks on a mountpoint.
     *
     * @param  SharedReminderMount $link Specification for mountpoint.
     * @return mix
     */
    public function enableSharedReminder(SharedReminderMount $link)
    {
        $request = new \Zimbra\Mail\Request\EnableSharedReminder(
            $link
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Expand recurrences.
     *
     * @param  int $startTime Start time in milliseconds
     * @param  int $endTime End time in milliseconds
     * @param  array $timezones Timezone definitions
     * @param  array $components Specifications for series, modified instances and canceled instances
     * @return mix
     */
    public function expandRecur(
        $startTime,
        $endTime,
        array $timezones = [],
        array $components = []
    )
    {
        $request = new \Zimbra\Mail\Request\ExpandRecur(
            $startTime,
            $endTime,
            $timezones,
            $components
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function exportContacts(
        $ct,
        $l = null,
        $csvfmt = null,
        $csvlocale = null,
        $csvsep = null
    )
    {
        $request = new \Zimbra\Mail\Request\ExportContacts(
            $ct,
            $l,
            $csvfmt,
            $csvlocale,
            $csvsep
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Perform an action on a folder.
     *
     * @param  FolderActionSelector $action Select action to perform on folder.
     * @return mix
     */
    public function folderAction(FolderActionSelector $action)
    {
        $request = new \Zimbra\Mail\Request\FolderAction(
            $action
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Used by an attendee to forward an instance or entire appointment to another user who is not already an attendee.
     *
     * @param  string $id Appointment item ID
     * @param  DtTimeInfo $exceptId RECURRENCE-ID information if forwarding a single instance of a recurring appointment
     * @param  CalTZInfo $tz Definition for TZID referenced by DATETIME in <exceptId>
     * @param  Msg $m Details of the appointment.
     * @return mix
     */
    public function forwardAppointment(
        $id = null,
        DtTimeInfo $exceptId = null,
        CalTZInfo $tz = null,
        Msg $m = null
    )
    {
        $request = new \Zimbra\Mail\Request\ForwardAppointment(
            $id,
            $exceptId,
            $tz,
            $m
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Used by an attendee to forward an appointment invite email to another user who is not already an attendee.
     * To forward an appointment item, use ForwardAppointmentRequest instead.
     *
     * @param  string $id Appointment item ID
     * @param  Msg $m Details of the appointment.
     * @return mix
     */
    public function forwardAppointmentInvite($id = null, Msg $m = null)
    {
        $request = new \Zimbra\Mail\Request\ForwardAppointmentInvite(
            $id, $m
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Ajax client can use this request to ask the server for help in generating a proper,
     * globally unique UUID.
     *
     * @return mix
     */
    public function generateUUID()
    {
        $request = new \Zimbra\Mail\Request\GenerateUUID();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get activity stream.
     *
     * @param  string $id Item ID. If the id is for a Document, the response will include the activities for the requested Document. if it is for a Folder, the response will include the activities for all the Documents in the folder and subfolders.
     * @param  int    $limit Limit - maximum number of activities to be returned
     * @param  int    $offset Offset - for getting the next page worth of activities.
     * @param  ActivityFilter $filter  Optionally <filter> can be used to filter the response based on the user that performed the activity, operation, or both. the server will cache previously established filter search results, and return the identifier in session attribute. The client is expected to reuse the session identifier in the subsequent filter search to improve the performance.
     * @return mix
     */
    public function getActivityStream(
        $id,
        $offset = null,
        $limit = null,
        ActivityFilter $filter = null
    )
    {
        $request = new \Zimbra\Mail\Request\GetActivityStream(
            $id,
            $offset,
            $limit,
            $filter
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get all devices.
     *
     * @return mix
     */
    public function getAllDevices()
    {
        $request = new \Zimbra\Mail\Request\GetAllDevices();
        return $this->getClient()->doRequest($request);
    }

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
    public function getAppointment(
        $sync = null,
        $includeContent = null,
        $includeInvites = null,
        $uid = null,
        $id = null
    )
    {
        $request = new \Zimbra\Mail\Request\GetAppointment(
            $sync,
            $includeContent,
            $includeInvites,
            $uid,
            $id
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get appointment summaries.
     *
     * @param  int    $s Range start in milliseconds since the epoch GMT.
     * @param  int    $e Range end in milliseconds since the epoch GMT.
     * @param  string $l Folder Id. Optional folder to constrain requests to; otherwise, searches all folders but trash and spam.
     * @return mix
     */
    public function getApptSummaries($s, $e, $l = null)
    {
        $request = new \Zimbra\Mail\Request\GetApptSummaries(
            $s, $e, $l
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get Calendar item summaries.
     *
     * @param  int    $s Range start in milliseconds since the epoch GMT.
     * @param  int    $e Range end in milliseconds since the epoch GMT.
     * @param  string $l Folder Id.
     * @return mix
     */
    public function getCalendarItemSummaries($s, $e, $l = null)
    {
        $request = new \Zimbra\Mail\Request\GetCalendarItemSummaries(
            $s, $e, $l
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get comments.
     *
     * @param  ParentId $parentId Select parent for comments.
     * @return mix
     */
    public function getComments(ParentId $comment)
    {
        $request = new \Zimbra\Mail\Request\GetComments(
            $comment
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function getContacts(
        $sync = null,
        $l = null,
        $sortBy = null,
        $derefGroupMember = null,
        $returnHiddenAttrs = null,
        $maxMembers = null,
        array $a = [],
        array $ma = [],
        array $cn = []
    )
    {
        $request = new \Zimbra\Mail\Request\GetContacts(
            $sync,
            $l,
            $sortBy,
            $derefGroupMember,
            $returnHiddenAttrs,
            $maxMembers,
            $a,
            $ma,
            $cn
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function getConv(ConversationSpec $c)
    {
        $request = new \Zimbra\Mail\Request\GetConv(
            $c
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get custom metadata.
     *
     * @param  string $id Item ID.
     * @param  SectionAttr $section Metadata section selector.
     * @return mix
     */
    public function getCustomMetadata($id, SectionAttr $meta = null)
    {
        $request = new \Zimbra\Mail\Request\GetCustomMetadata(
            $id, $meta
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Returns all data sources defined for the given mailbox.
     * For each data source, every attribute value is returned except password.
     *
     * @return mix
     */
    public function getDataSources()
    {
        $request = new \Zimbra\Mail\Request\GetDataSources();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get data source usage.
     *
     * @return mix
     */
    public function getDataSourceUsage()
    {
        $request = new \Zimbra\Mail\Request\GetDataSourceUsage();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get the download URL of shared document.
     *
     * @param  ItemSpec $item Folder specification.
     * @return mix
     */
    public function getDocumentShareURL(ItemSpec $item)
    {
        $request = new \Zimbra\Mail\Request\GetDocumentShareURL(
            $item
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Returns the effective permissions of the specified folder.
     *
     * @param  FolderSpec $folder Folder ID.
     * @return mix
     */
    public function getEffectiveFolderPerms(FolderSpec $folder)
    {
        $request = new \Zimbra\Mail\Request\GetEffectiveFolderPerms(
            $folder
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get filter rules.
     *
     * @return mix
     */
    public function getFilterRules()
    {
        $request = new \Zimbra\Mail\Request\GetFilterRules();
        return $this->getClient()->doRequest($request);
    }

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
    public function getFolder(
        $visible = null,
        $needGranteeName = null,
        $view = null,
        $depth = null,
        $tr = null,
        GetFolderSpec $folder = null
    )
    {
        $request = new \Zimbra\Mail\Request\GetFolder(
            $visible,
            $needGranteeName,
            $view,
            $depth,
            $tr,
            $folder
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function getFreeBusy(
        $s,
        $e,
        $uid = null,
        $id = null,
        $name = null,
        $excludeUid = null,
        array $usr = []
    )
    {
        $request = new \Zimbra\Mail\Request\GetFreeBusy(
            $s,
            $e,
            $uid,
            $id,
            $name,
            $excludeUid,
            $usr
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function getICal($id = null, $s = null, $e = null)
    {
        $request = new \Zimbra\Mail\Request\GetICal(
            $id, $s, $e
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Returns current import status for all data sources.
     * Status values for a data source are reinitialized when either (a) another
     * import process is started or (b) when the server is restarted.
     * If import has not run yet, the success and error attributes are not specified in the response.
     *
     * @return mix
     */
    public function getImportStatus()
    {
        $request = new \Zimbra\Mail\Request\GetImportStatus();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get item.
     * A successful GetItemResponse will contain a single element appropriate for the type of
     * the requested item if there is no matching item, a fault containing the code mail.
     * NO_SUCH_ITEM is returned
     *
     * @param  ItemSpec $item Item specification.
     * @return mix
     */
    public function getItem(ItemSpec $item)
    {
        $request = new \Zimbra\Mail\Request\GetItem(
            $item
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get Mailbox metadata.
     *
     * @param  SectionAttr $meta Metadata section specification.
     * @return mix
     */
    public function getMailboxMetadata(SectionAttr $meta = null)
    {
        $request = new \Zimbra\Mail\Request\GetMailboxMetadata(
            $meta
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function getMiniCal(
        $s,
        $e,
        array $folder = [],
        CalTZInfo $tz = null
    )
    {
        $request = new \Zimbra\Mail\Request\GetMiniCal(
            $s,
            $e,
            $folder,
            $tz
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get message.
     *
     * @param  MsgSpec $message Message specification.
     * @return mix
     */
    public function getMsg(MsgSpec $m)
    {
        $request = new \Zimbra\Mail\Request\GetMsg(
            $m
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get message metadata.
     *
     * @param  IdsAttr $ids Messages selector.
     * @return mix
     */
    public function getMsgMetadata(IdsAttr $m)
    {
        $request = new \Zimbra\Mail\Request\GetMsgMetadata(
            $m
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get note.
     *
     * @param  Id $id Specification for note.
     * @return mix
     */
    public function getNote(Id $note)
    {
        $request = new \Zimbra\Mail\Request\GetNote(
            $note
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get notifications.
     *
     * @param  bool $markSeen If set then all the notifications will be marked as seen. Default: unset.
     * @return mix
     */
    public function getNotifications($markSeen = null)
    {
        $request = new \Zimbra\Mail\Request\GetNotifications(
            $markSeen
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get outgoing filter rules.
     *
     * @return mix
     */
    public function getOutgoingFilterRules()
    {
        $request = new \Zimbra\Mail\Request\GetOutgoingFilterRules();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get account level permissions.
     * If no <ace> elements are provided, all ACEs are returned in the response. 
     * If <ace> elements are provided, only those ACEs with specified rights are returned in the response.
     *
     * @param  array $rights Specification of rights.
     * @return mix
     */
    public function getPermission(array $ace = [])
    {
        $request = new \Zimbra\Mail\Request\GetPermission(
            $ace
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Retrieve the recurrence definition of an appointment.
     *
     * @param  string $id Calendar item ID.
     * @return mix
     */
    public function getRecur($id)
    {
        $request = new \Zimbra\Mail\Request\GetRecur(
            $id
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get all search folders.
     *
     * @return mix
     */
    public function getSearchFolder()
    {
        $request = new \Zimbra\Mail\Request\GetSearchFolder();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get item acl details.
     *
     * @param  Id $id Item ID.
     * @return mix
     */
    public function getShareDetails(Id $item)
    {
        $request = new \Zimbra\Mail\Request\GetShareDetails(
            $item
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get Share notifications.
     *
     * @return mix
     */
    public function getShareNotifications()
    {
        $request = new \Zimbra\Mail\Request\GetShareNotifications();
        return $this->getClient()->doRequest($request);
    }

    /**
     * GetReturns the list of dictionaries that can be used for spell checking.
     *
     * @return mix
     */
    public function getSpellDictionaries()
    {
        $request = new \Zimbra\Mail\Request\GetSpellDictionaries();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get system retention policy.
     *
     * @return mix
     */
    public function getSystemRetentionPolicy()
    {
        $request = new \Zimbra\Mail\Request\GetSystemRetentionPolicy();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get information about Tags.
     *
     * @return mix
     */
    public function getTag()
    {
        $request = new \Zimbra\Mail\Request\GetTag();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get Task.
     * Similar to GetAppointmentRequest/GetAppointmentResponse
     *
     * @param  bool   $sync Set this to return the modified date (md) on the appointment..
     * @param  bool   $includeContent If set, MIME parts for body content are returned; default false.
     * @param  bool   $includeInvites If set, information for each invite is included. default false.
     * @param  string $uid  iCalendar UID Either id or uid should be specified, but not both.
     * @param  string $id   Appointment ID. Either id or uid should be specified, but not both.
     * @return mix
     */
    public function getTask(
        $sync = null,
        $includeContent = null,
        $includeInvites = null,
        $uid = null,
        $id = null
    )
    {
        $request = new \Zimbra\Mail\Request\GetTask(
            $sync,
            $includeContent,
            $includeInvites,
            $uid,
            $id
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get task summaries.
     *
     * @param  int    $s Range start in milliseconds since the epoch GMT.
     * @param  int    $e Range end in milliseconds since the epoch GMT.
     * @param  string $l Folder Id. Optional folder to constrain requests to; otherwise, searches all folders but trash and spam.
     * @return mix
     */
    public function getTaskSummaries($s, $e, $l = null)
    {
        $request = new \Zimbra\Mail\Request\GetTaskSummaries(
            $s, $e, $l
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Returns a list of items in the user's mailbox currently being watched by other users.
     *
     * @return mix
     */
    public function getWatchers()
    {
        $request = new \Zimbra\Mail\Request\GetWatchers();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Returns a list of items the user is currently watching.
     *
     * @return mix
     */
    public function getWatchingItems()
    {
        $request = new \Zimbra\Mail\Request\GetWatchingItems();
        return $this->getClient()->doRequest($request);
    }

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
    public function getWorkingHours($s, $e, $id = null, $name = null)
    {
        $request = new \Zimbra\Mail\Request\GetWorkingHours(
            $s, $e, $id, $name
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get Yahoo Auth Token.
     *
     * @param  string $user     Yahoo user.
     * @param  string $password Yahoo user password.
     * @return mix
     */
    public function getYahooAuthToken($user, $password)
    {
        $request = new \Zimbra\Mail\Request\GetYahooAuthToken(
            $user, $password
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get Yahoo cookie.
     *
     * @param  string $user Yahoo user.
     * @return mix
     */
    public function getYahooCookie($user)
    {
        $request = new \Zimbra\Mail\Request\GetYahooCookie(
            $user
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Grant account level permissions.
     * GrantPermissionResponse returns permissions that are successfully granted.
     *
     * @param  array $ace Specify Access Control Entries (ACEs).
     * @return mix
     */
    public function grantPermission(array $ace = [])
    {
        $request = new \Zimbra\Mail\Request\GrantPermission(
            $ace
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Do an iCalendar Reply.
     *
     * @param  string $ical iCalendar text containing components with method REPLY.
     * @return mix
     */
    public function iCalReply($ical)
    {
        $request = new \Zimbra\Mail\Request\ICalReply(
            $ical
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Import appointments.
     *
     * @param  string $ct Content type
     * @param  ContentSpec $content Content specification
     * @param  string $l Optional folder ID to import appointments into
     * @return mix
     */
    public function importAppointments($ct, ContentSpec $content, $l = null)
    {
        $request = new \Zimbra\Mail\Request\ImportAppointments(
            $ct, $content, $l
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function importContacts(
        $ct,
        Content $content,
        $l = null,
        $csvfmt = null,
        $csvlocale = null
    )
    {
        $request = new \Zimbra\Mail\Request\ImportContacts(
            $ct,
            $content,
            $l,
            $csvfmt,
            $csvlocale
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function importData(array $dataSources)
    {
        $request = new \Zimbra\Mail\Request\ImportData($dataSources);
        return $this->getClient()->doRequest($request);
    }

    /**
     * Invalidate reminder device.
     *
     * @param  string $a Device email address.
     * @return mix
     */
    public function invalidateReminderDevice($a)
    {
        $request = new \Zimbra\Mail\Request\InvalidateReminderDevice(
            $a
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Perform an action on an item.
     *
     * @param  ItemActionSelector $action Specify the action to perform.
     * @return mix
     */
    public function itemAction(ItemActionSelector $action)
    {
        $request = new \Zimbra\Mail\Request\ItemAction(
            $action
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Returns {num} number of revisions starting from {version} of the requested document.
     * {num} defaults to 1. {version} defaults to the current version.
     * Documents that have multiple revisions have the flag "/", which indicates that the document is versioned.
     *
     * @param  ListDocumentRevisionsSpec $doc Specification for the list of document revisions.
     * @return mix
     */
    public function listDocumentRevisions(ListDocumentRevisionsSpec $doc)
    {
        $request = new \Zimbra\Mail\Request\ListDocumentRevisions(
            $doc
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function modifyAppointment(
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
    )
    {
        $request = new \Zimbra\Mail\Request\ModifyAppointment(
            $m,
            $id,
            $comp,
            $ms,
            $rev,
            $echo,
            $max,
            $html,
            $neuter,
            $forcesend
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function modifyContact(
        ModifyContactSpec $cn,
        $replace = null,
        $verbose = null
    )
    {
        $request = new \Zimbra\Mail\Request\ModifyContact(
            $cn,
            $replace,
            $verbose
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function modifyDataSource(MailDataSource $ds = null)
    {
        $request = new \Zimbra\Mail\Request\ModifyDataSource(
            $ds
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Changes attributes of the imap data source.
     *
     * @param  MailImapDataSource $imap Imap data source
     * @return mix
     */
    public function modifyImapDataSource(MailImapDataSource $imap = null)
    {
        return $this->modifyDataSource($imap);
    }

    /**
     * Changes attributes of the pop3 data source.
     *
     * @param  MailPop3DataSource $pop3 Pop3 data source
     * @return mix
     */
    public function modifyPop3DataSource(MailPop3DataSource $pop3 = null)
    {
        return $this->modifyDataSource($pop3);
    }

    /**
     * Changes attributes of the caldav data source.
     *
     * @param  MailCaldavDataSource $caldav Caldav data source
     * @return mix
     */
    public function modifyCaldavDataSource(MailCaldavDataSource $caldav = null)
    {
        return $this->modifyDataSource($caldav);
    }

    /**
     * Changes attributes of the yab data source.
     *
     * @param  MailYabDataSource $yab Yab data source
     * @return mix
     */
    public function modifyYabDataSource(MailYabDataSource $yab = null)
    {
        return $this->modifyDataSource($yab);
    }

    /**
     * Changes attributes of the rss data source.
     *
     * @param  MailRssDataSource $rss Rss data source
     * @return mix
     */
    public function modifyRssDataSource(MailRssDataSource $rss = null)
    {
        return $this->modifyDataSource($rss);
    }

    /**
     * Changes attributes of the gal data source.
     *
     * @param  MailGalDataSource $gal Gal data source
     * @return mix
     */
    public function modifyGalDataSource(MailGalDataSource $gal = null)
    {
        return $this->modifyDataSource($gal);
    }

    /**
     * Changes attributes of the cal data source.
     *
     * @param  MailCalDataSource $cal Cal data source
     * @return mix
     */
    public function modifyCalDataSource(MailCalDataSource $cal = null)
    {
        return $this->modifyDataSource($cal);
    }

    /**
     * Changes attributes of the unknown data source.
     *
     * @param  MailUnknownDataSource $unknown Unknown data source
     * @return mix
     */
    public function modifyUnknownDataSource(MailUnknownDataSource $unknown = null)
    {
        return $this->modifyDataSource($unknown);
    }

    /**
     * Modify Filter rules.
     *
     * @param  FilterRules $rules Filter rules.
     * @return mix
     */
    public function modifyFilterRules(FilterRules $filterRules)
    {
        $request = new \Zimbra\Mail\Request\ModifyFilterRules(
            $filterRules
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function modifyMailboxMetadata(MailCustomMetadata $meta = null)
    {
        $request = new \Zimbra\Mail\Request\ModifyMailboxMetadata(
            $meta
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Modify Outgoing Filter rules.
     *
     * @param  FilterRules $rules Filter rules.
     * @return mix
     */
    public function modifyOutgoingFilterRules(FilterRules $filterRules)
    {
        $request = new \Zimbra\Mail\Request\ModifyOutgoingFilterRules(
            $filterRules
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Modify Search Folder.
     *
     * @param  ModifySearchFolderSpec $search Specification of Search folder modifications.
     * @return mix
     */
    public function modifySearchFolder(ModifySearchFolderSpec $search)
    {
        $request = new \Zimbra\Mail\Request\ModifySearchFolder(
            $search
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function modifyTask(
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
    )
    {
        $request = new \Zimbra\Mail\Request\ModifyTask(
            $m,
            $id,
            $comp,
            $ms,
            $rev,
            $echo,
            $max,
            $html,
            $neuter,
            $forcesend
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Perform an action on a message.
     * For op="update", caller can specify any or all of: l="{folder}", name="{name}", color="{color}", tn="{tag-names}", f="{flags}". 
     * For op="!spam", can optionally specify a destination folder
     *
     * @param  MsgActionSelector $action Specify the action to perform.
     * @return mix
     */
    public function msgAction(MsgActionSelector $action)
    {
        $request = new \Zimbra\Mail\Request\MsgAction(
            $action
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function noOp(
        $wait = null,
        $delegate = null,
        $limitToOneBlocked = null,
        $timeout = null
    )
    {
        $request = new \Zimbra\Mail\Request\NoOp(
            $wait,
            $delegate,
            $limitToOneBlocked,
            $timeout
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Perform an action on an note.
     *
     * @param  NoteActionSelector $action Specify the action to perform.
     * @return mix
     */
    public function noteAction(NoteActionSelector $action)
    {
        $request = new \Zimbra\Mail\Request\NoteAction(
            $action
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Purge revision.
     *
     * @param  PurgeRevisionSpec $revision Specification or revision to purge.
     * @return mix
     */
    public function purgeRevision(PurgeRevisionSpec $revision)
    {
        $request = new \Zimbra\Mail\Request\PurgeRevision(
            $revision
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Perform an action on the contact ranking table.
     *
     * @param  RankingActionSpec $action Specification ranking action.
     * @return mix
     */
    public function rankingAction(RankingActionSpec $action)
    {
        $request = new \Zimbra\Mail\Request\RankingAction(
            $action
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Register a device.
     *
     * @param  NamedElement $name Specify the device.
     * @return mix
     */
    public function registerDevice(NamedElement $device)
    {
        $request = new \Zimbra\Mail\Request\RegisterDevice(
            $device
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Remove attachments from a message body.
     * NOTE that this operation is effectively a create and a delete, and thus the message's item ID will change.
     *
     * @param  MsgPartIds $m Specification of parts to remove.
     * @return mix
     */
    public function removeAttachments(MsgPartIds $m)
    {
        $request = new \Zimbra\Mail\Request\RemoveAttachments(
            $m
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Revoke account level permissions.
     * RevokePermissionResponse returns permissions that are successfully revoked.
     *
     * @param  array $ace Specify Access Control Entries (ACEs).
     * @return mix
     */
    public function revokePermission(array $ace = [])
    {
        $request = new \Zimbra\Mail\Request\RevokePermission(
            $ace
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function saveDocument(DocumentSpec $doc)
    {
        $request = new \Zimbra\Mail\Request\SaveDocument(
            $doc
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function saveDraft(SaveDraftMsg $m)
    {
        $request = new \Zimbra\Mail\Request\SaveDraft(
            $m
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function search(
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
    )
    {
        $request = new \Zimbra\Mail\Request\Search(
            $warmup,
            $query,
            $header,
            $tz,
            $locale,
            $cursor,
            $includeTagDeleted,
            $includeTagMuted,
            $allowableTaskStatus,
            $calExpandInstStart,
            $calExpandInstEnd,
            $inDumpster,
            $types,
            $groupBy,
            $quick,
            $sortBy,
            $fetch,
            $read,
            $max,
            $html,
            $needExp,
            $neuter,
            $recip,
            $prefetch,
            $resultMode,
            $fullConversation,
            $field,
            $limit,
            $offset
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function searchConv(
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
    )
    {
        $request = new \Zimbra\Mail\Request\SearchConv(
            $cid,
            $nest,
            $query,
            $header,
            $tz,
            $locale,
            $cursor,
            $includeTagDeleted,
            $includeTagMuted,
            $allowableTaskStatus,
            $calExpandInstStart,
            $calExpandInstEnd,
            $inDumpster,
            $types,
            $groupBy,
            $quick,
            $sortBy,
            $fetch,
            $read,
            $max,
            $html,
            $needExp,
            $neuter,
            $recip,
            $prefetch,
            $resultMode,
            $fullConversation,
            $field,
            $limit,
            $offset
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Send a delivery report.
     *
     * @param  string $mid Message ID.
     * @return mix
     */
    public function sendDeliveryReport($mid)
    {
        $request = new \Zimbra\Mail\Request\SendDeliveryReport(
            $mid
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function sendInviteReply(
        $id,
        $compNum,
        $verb,
        $updateOrganizer = null,
        $idnt = null,
        DtTimeInfo $exceptId = null,
        CalTZInfo $tz = null,
        Msg $m = null
    )
    {
        $request = new \Zimbra\Mail\Request\SendInviteReply(
            $id,
            $compNum,
            $verb,
            $updateOrganizer,
            $idnt,
            $exceptId,
            $tz,
            $m
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function sendMsg(
        MsgToSend $m = null,
        $needCalendarSentByFixup = null,
        $isCalendarForward = null,
        $noSave = null,
        $suid = null
    )
    {
        $request = new \Zimbra\Mail\Request\SendMsg(
            $m,
            $needCalendarSentByFixup,
            $isCalendarForward,
            $noSave,
            $suid
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function sendShareNotification(
        Id $item = null,
        array $e = [],
        $notes = null,
        Action $action = null
    )
    {
        $request = new \Zimbra\Mail\Request\SendShareNotification(
            $item,
            $e,
            $notes,
            $action
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * SendVerificationCodeRequest results in a random verification code being generated and sent to a device.
     *
     * @param  string $a Device email address.
     * @return mix
     */
    public function sendVerificationCode($a = null)
    {
        $request = new \Zimbra\Mail\Request\SendVerificationCode(
            $a
        );
        return $this->getClient()->doRequest($request);
    }

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
     * @param  SetCalendarItemInfo $default Default calendar item information
     * @param  array $except Calendar item information for exceptions 
     * @param  array $cancel Calendar item information for cancellations 
     * @param  Replies $replies Replies
     * @return mix
     */
    public function setAppointment(
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
    )
    {
        $request = new \Zimbra\Mail\Request\SetAppointment(
            $f,
            $t,
            $tn,
            $l,
            $noNextAlarm,
            $nextAlarm,
            $default,
            $except,
            $cancel,
            $replies
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Set Custom Metadata.
     * Setting a custom metadata section but providing no key/value pairs will remove the sction from the item.
     *
     * @param  string $id      Item ID.
     * @param  MailCustomMetadata $meta New metadata information
     * @return mix
     */
    public function setCustomMetadata($id, MailCustomMetadata $meta = null)
    {
        $request = new \Zimbra\Mail\Request\SetCustomMetadata(
            $id, $meta
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Set Mailbox Metadata.
     *   1. Setting a mailbox metadata section but providing no key/value pairs will remove the section from mailbox metadata.
     *   2. Empty value not allowed
     *   3. {metadata-section-key} must be no more than 36 characters long and must be in the format of {namespace}:{section-name}. currently the only valid namespace is "zwc".
     *
     * @param  MailCustomMetadata $meta New metadata information.
     * @return mix
     */
    public function setMailboxMetadata(MailCustomMetadata $meta = null)
    {
        $request = new \Zimbra\Mail\Request\SetMailboxMetadata(
            $meta
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function setTask(
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
    )
    {
        $request = new \Zimbra\Mail\Request\SetTask(
            $f,
            $t,
            $tn,
            $l,
            $noNextAlarm,
            $nextAlarm,
            $default,
            $except,
            $cancel,
            $replies
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Snooze alarm(s) for appointments or tasks.
     *
     * @param  array $alarms.
     * @return mix
     */
    public function snoozeCalendarItemAlarm(array $alarms = [])
    {
        $request = new \Zimbra\Mail\Request\SnoozeCalendarItemAlarm(
            $alarms
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Snooze alarm(s) for appointments or tasks.
     *
     * @param  string $token Token - not provided for initial sync.
     * @param  int    $calCutoff Earliest Calendar date. If present, omit all appointments and tasks that don't have a recurrence ending after that time (specified in ms).
     * @param  string $l Root folder ID. If present, we start sync there rather than at folder 11.
     * @param  bool   $typed If specified and set, deletes are also broken down by item type.
     * @return mix
     */
    public function sync(
        $token = null,
        $calCutoff = null,
        $l = null,
        $typed = null
    )
    {
        $request = new \Zimbra\Mail\Request\Sync(
            $token,
            $calCutoff,
            $l,
            $typed
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Perform an action on a tag.
     *
     * @param  TagActionSelector $action Specify action to perform.
     * @return mix
     */
    public function tagAction(TagActionSelector $action)
    {
        $request = new \Zimbra\Mail\Request\TagAction(
            $action
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function testDataSource(MailDataSource $ds = null)
    {
        $request = new \Zimbra\Mail\Request\TestDataSource($ds);
        return $this->getClient()->doRequest($request);
    }

    /**
     * Tests the connection to the imap data source.
     *
     * @param  MailImapDataSource $imap Imap data source
     * @return mix
     */
    public function testImapDataSource(MailImapDataSource $imap)
    {
        return $this->testDataSource($imap);
    }

    /**
     * Tests the connection to the pop3 data source.
     *
     * @param  MailPop3DataSource $pop3 Pop3 data source
     * @return mix
     */
    public function testPop3DataSource(MailPop3DataSource $pop3)
    {
        return $this->testDataSource($pop3);
    }

    /**
     * Tests the connection to the caldav data source.
     *
     * @param  MailCaldavDataSource $caldav Caldav data source
     * @return mix
     */
    public function testCaldavDataSource(MailCaldavDataSource $caldav)
    {
        return $this->testDataSource($caldav);
    }

    /**
     * Tests the connection to the yab data source.
     *
     * @param  MailYabDataSource $yab Caldav data source
     * @return mix
     */
    public function testYabDataSource(MailYabDataSource $yab)
    {
        return $this->testDataSource($yab);
    }

    /**
     * Tests the connection to the rss data source.
     *
     * @param  MailRssDataSource $rss Rss data source
     * @return mix
     */
    public function testRssDataSource(MailRssDataSource $rss)
    {
        return $this->testDataSource($rss);
    }

    /**
     * Tests the connection to the gal data source.
     *
     * @param  MailGalDataSource $gal Gal data source
     * @return mix
     */
    public function testGalDataSource(MailGalDataSource $gal)
    {
        return $this->testDataSource($gal);
    }

    /**
     * Tests the connection to the cal data source.
     *
     * @param  MailCalDataSource $cal Cal data source
     * @return mix
     */
    public function testCalDataSource(MailCalDataSource $cal)
    {
        return $this->testDataSource($cal);
    }

    /**
     * Tests the connection to the unknown data source.
     *
     * @param  MailUnknownDataSource $unknown Unknown data source
     * @return mix
     */
    public function testUnknownDataSource(MailUnknownDataSource $unknown)
    {
        return $this->testDataSource($unknown);
    }

    /**
     * Update device status.
     *
     * @param  IdStatus $device Information about device status.
     * @return mix
     */
    public function updateDeviceStatus(IdStatus $device)
    {
        $request = new \Zimbra\Mail\Request\UpdateDeviceStatus(
            $device
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Validate the verification code sent to a device.
     * After successful validation the server sets the device email address as the value of zimbraCalendarReminderDeviceEmail account attribute.
     *
     * @param  string $a Device email address.
     * @param  string $code Verification code.
     * @return mix
     */
    public function verifyCode($a = null, $code = null)
    {
        $request = new \Zimbra\Mail\Request\VerifyCode(
            $a, $code
        );
        return $this->getClient()->doRequest($request);
    }

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
    public function waitSet(
        $waitSet,
        $seq,
        WaitSetSpec $add = null,
        WaitSetSpec $update = null,
        WaitSetId $remove = null,
        $block = null,
        array $defTypes = [],
        $timeout = null
    )
    {
        $request = new \Zimbra\Mail\Request\WaitSet(
            $waitSet,
            $seq,
            $add,
            $update,
            $remove,
            $block,
            $defTypes,
            $timeout
        );
        return $this->getClient()->doRequest($request);
    }
}
