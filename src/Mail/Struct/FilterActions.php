<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};

/**
 * FilterActions struct class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FilterActions
{
    /**
     * Filter variables
     * 
     * @Accessor(getter="getFilterVariables", setter="setFilterVariables")
     * @Type("array<Zimbra\Mail\Struct\FilterVariables>")
     * @XmlList(inline=true, entry="filterVariables", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getFilterVariables', setter: 'setFilterVariables')]
    #[Type(name: 'array<Zimbra\Mail\Struct\FilterVariables>')]
    #[XmlList(inline: true, entry: 'filterVariables', namespace: 'urn:zimbraMail')]
    private $filterVariables = [];

    /**
     * Keep filter actions
     * 
     * @Accessor(getter="getKeepActions", setter="setKeepActions")
     * @Type("array<Zimbra\Mail\Struct\KeepAction>")
     * @XmlList(inline=true, entry="actionKeep", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getKeepActions', setter: 'setKeepActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\KeepAction>')]
    #[XmlList(inline: true, entry: 'actionKeep', namespace: 'urn:zimbraMail')]
    private $keepActions = [];

    /**
     * Discard filter actions
     * 
     * @Accessor(getter="getDiscardActions", setter="setDiscardActions")
     * @Type("array<Zimbra\Mail\Struct\DiscardAction>")
     * @XmlList(inline=true, entry="actionDiscard", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getDiscardActions', setter: 'setDiscardActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\DiscardAction>')]
    #[XmlList(inline: true, entry: 'actionDiscard', namespace: 'urn:zimbraMail')]
    private $discardActions = [];

    /**
     * File into filter actions
     * 
     * @Accessor(getter="getFileIntoActions", setter="setFileIntoActions")
     * @Type("array<Zimbra\Mail\Struct\FileIntoAction>")
     * @XmlList(inline=true, entry="actionFileInto", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getFileIntoActions', setter: 'setFileIntoActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\FileIntoAction>')]
    #[XmlList(inline: true, entry: 'actionFileInto', namespace: 'urn:zimbraMail')]
    private $fileIntoActions = [];

    /**
     * Flag filter actions
     * 
     * @Accessor(getter="getFlagActions", setter="setFlagActions")
     * @Type("array<Zimbra\Mail\Struct\FlagAction>")
     * @XmlList(inline=true, entry="actionFlag", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getFlagActions', setter: 'setFlagActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\FlagAction>')]
    #[XmlList(inline: true, entry: 'actionFlag', namespace: 'urn:zimbraMail')]
    private $flagActions = [];

    /**
     * Tag filter actions
     * 
     * @Accessor(getter="getTagActions", setter="setTagActions")
     * @Type("array<Zimbra\Mail\Struct\TagAction>")
     * @XmlList(inline=true, entry="actionTag", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getTagActions', setter: 'setTagActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\TagAction>')]
    #[XmlList(inline: true, entry: 'actionTag', namespace: 'urn:zimbraMail')]
    private $tagActions = [];

    /**
     * Redirect filter actions
     * 
     * @Accessor(getter="getRedirectActions", setter="setRedirectActions")
     * @Type("array<Zimbra\Mail\Struct\RedirectAction>")
     * @XmlList(inline=true, entry="actionRedirect", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getRedirectActions', setter: 'setRedirectActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\RedirectAction>')]
    #[XmlList(inline: true, entry: 'actionRedirect', namespace: 'urn:zimbraMail')]
    private $redirectActions = [];

    /**
     * Reply filter actions
     * 
     * @Accessor(getter="getReplyActions", setter="setReplyActions")
     * @Type("array<Zimbra\Mail\Struct\ReplyAction>")
     * @XmlList(inline=true, entry="actionReply", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getReplyActions', setter: 'setReplyActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\ReplyAction>')]
    #[XmlList(inline: true, entry: 'actionReply', namespace: 'urn:zimbraMail')]
    private $replyActions = [];

    /**
     * Notify filter actions
     * 
     * @Accessor(getter="getNotifyActions", setter="setNotifyActions")
     * @Type("array<Zimbra\Mail\Struct\NotifyAction>")
     * @XmlList(inline=true, entry="actionNotify", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getNotifyActions', setter: 'setNotifyActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\NotifyAction>')]
    #[XmlList(inline: true, entry: 'actionNotify', namespace: 'urn:zimbraMail')]
    private $notifyActions = [];

    /**
     * RFC compliant notify filter actions
     * 
     * @Accessor(getter="getRFCCompliantNotifyActions", setter="setRFCCompliantNotifyActions")
     * @Type("array<Zimbra\Mail\Struct\RFCCompliantNotifyAction>")
     * @XmlList(inline=true, entry="actionRFCCompliantNotify", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getRFCCompliantNotifyActions', setter: 'setRFCCompliantNotifyActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\RFCCompliantNotifyAction>')]
    #[XmlList(inline: true, entry: 'actionRFCCompliantNotify', namespace: 'urn:zimbraMail')]
    private $rfcCompliantNotifyActions = [];

    /**
     * Stop filter actions
     * 
     * @Accessor(getter="getStopActions", setter="setStopActions")
     * @Type("array<Zimbra\Mail\Struct\StopAction>")
     * @XmlList(inline=true, entry="actionStop", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getStopActions', setter: 'setStopActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\StopAction>')]
    #[XmlList(inline: true, entry: 'actionStop', namespace: 'urn:zimbraMail')]
    private $stopActions = [];

    /**
     * Reject filter actions
     * 
     * @Accessor(getter="getRejectActions", setter="setRejectActions")
     * @Type("array<Zimbra\Mail\Struct\RejectAction>")
     * @XmlList(inline=true, entry="actionReject", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getRejectActions', setter: 'setRejectActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\RejectAction>')]
    #[XmlList(inline: true, entry: 'actionReject', namespace: 'urn:zimbraMail')]
    private $rejectActions = [];

    /**
     * Ereject filter actions
     * 
     * @Accessor(getter="getErejectActions", setter="setErejectActions")
     * @Type("array<Zimbra\Mail\Struct\ErejectAction>")
     * @XmlList(inline=true, entry="actionEreject", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getErejectActions', setter: 'setErejectActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\ErejectAction>')]
    #[XmlList(inline: true, entry: 'actionEreject', namespace: 'urn:zimbraMail')]
    private $erejectActions = [];

    /**
     * Log filter actions
     * 
     * @Accessor(getter="getLogActions", setter="setLogActions")
     * @Type("array<Zimbra\Mail\Struct\LogAction>")
     * @XmlList(inline=true, entry="actionLog", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getLogActions', setter: 'setLogActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\LogAction>')]
    #[XmlList(inline: true, entry: 'actionLog', namespace: 'urn:zimbraMail')]
    private $logActions = [];

    /**
     * Add header filter actions
     * 
     * @Accessor(getter="getAddheaderActions", setter="setAddheaderActions")
     * @Type("array<Zimbra\Mail\Struct\AddheaderAction>")
     * @XmlList(inline=true, entry="actionAddheader", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getAddheaderActions', setter: 'setAddheaderActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\AddheaderAction>')]
    #[XmlList(inline: true, entry: 'actionAddheader', namespace: 'urn:zimbraMail')]
    private $addheaderActions = [];

    /**
     * Delete header filter actions
     * 
     * @Accessor(getter="getDeleteheaderActions", setter="setDeleteheaderActions")
     * @Type("array<Zimbra\Mail\Struct\DeleteheaderAction>")
     * @XmlList(inline=true, entry="actionDeleteheader", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getDeleteheaderActions', setter: 'setDeleteheaderActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\DeleteheaderAction>')]
    #[XmlList(inline: true, entry: 'actionDeleteheader', namespace: 'urn:zimbraMail')]
    private $deleteheaderActions = [];

    /**
     * Replace header filter actions
     * 
     * @Accessor(getter="getReplaceheaderActions", setter="setReplaceheaderActions")
     * @Type("array<Zimbra\Mail\Struct\ReplaceheaderAction>")
     * @XmlList(inline=true, entry="actionReplaceheader", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getReplaceheaderActions', setter: 'setReplaceheaderActions')]
    #[Type(name: 'array<Zimbra\Mail\Struct\ReplaceheaderAction>')]
    #[XmlList(inline: true, entry: 'actionReplaceheader', namespace: 'urn:zimbraMail')]
    private $replaceheaderActions = [];

    /**
     * Constructor
     * 
     * @param  array $filterActions
     * @return self
     */
    public function __construct(array $filterActions = [])
    {
        $this->setFilterActions($filterActions);
    }

    /**
     * Get filter variables
     *
     * @return array
     */
    public function getFilterVariables(): array
    {
        return $this->filterVariables;
    }

    /**
     * Set filter variables
     *
     * @return self
     */
    public function setFilterVariables(array $filterVariables): self
    {
        $this->filterVariables = array_values(
            array_filter($filterVariables, static fn ($action) => $action instanceof FilterVariables)
        );
        return $this;
    }

    /**
     * Get keep filter actions
     *
     * @return array
     */
    public function getKeepActions(): array
    {
        return $this->keepActions;
    }

    /**
     * Set keep filter actions
     *
     * @return self
     */
    public function setKeepActions(array $filterActions): self
    {
        $this->keepActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof KeepAction)
        );
        return $this;
    }

    /**
     * Get discard filter actions
     *
     * @return array
     */
    public function getDiscardActions(): array
    {
        return $this->discardActions;
    }

    /**
     * Set discard filter actions
     *
     * @return self
     */
    public function setDiscardActions(array $filterActions): self
    {
        $this->discardActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof DiscardAction)
        );
        return $this;
    }

    /**
     * Get file into filter actions
     *
     * @return array
     */
    public function getFileIntoActions(): array
    {
        return $this->fileIntoActions;
    }

    /**
     * Set file into filter actions
     *
     * @return self
     */
    public function setFileIntoActions(array $filterActions): self
    {
        $this->fileIntoActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof FileIntoAction)
        );
        return $this;
    }

    /**
     * Get flag filter actions
     *
     * @return array
     */
    public function getFlagActions(): array
    {
        return $this->flagActions;
    }

    /**
     * Set flag filter actions
     *
     * @return self
     */
    public function setFlagActions(array $filterActions): self
    {
        $this->flagActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof FlagAction)
        );
        return $this;
    }

    /**
     * Get tag filter actions
     *
     * @return array
     */
    public function getTagActions(): array
    {
        return $this->tagActions;
    }

    /**
     * Set tag filter actions
     *
     * @return self
     */
    public function setTagActions(array $filterActions): self
    {
        $this->tagActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof TagAction)
        );
        return $this;
    }

    /**
     * Get redirect filter actions
     *
     * @return array
     */
    public function getRedirectActions(): array
    {
        return $this->redirectActions;
    }

    /**
     * Set redirect filter actions
     *
     * @return self
     */
    public function setRedirectActions(array $filterActions): self
    {
        $this->redirectActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof RedirectAction)
        );
        return $this;
    }

    /**
     * Get reply filter actions
     *
     * @return array
     */
    public function getReplyActions(): array
    {
        return $this->replyActions;
    }

    /**
     * Set reply filter actions
     *
     * @return self
     */
    public function setReplyActions(array $filterActions): self
    {
        $this->replyActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof ReplyAction)
        );
        return $this;
    }

    /**
     * Get notify filter actions
     *
     * @return array
     */
    public function getNotifyActions(): array
    {
        return $this->notifyActions;
    }

    /**
     * Set notify filter actions
     *
     * @return self
     */
    public function setNotifyActions(array $filterActions): self
    {
        $this->notifyActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof NotifyAction)
        );
        return $this;
    }

    /**
     * Get RFC compliant notify filter actions
     *
     * @return array
     */
    public function getRFCCompliantNotifyActions(): array
    {
        return $this->rfcCompliantNotifyActions;
    }

    /**
     * Set RFC compliant notify filter actions
     *
     * @return self
     */
    public function setRFCCompliantNotifyActions(array $filterActions): self
    {
        $this->rfcCompliantNotifyActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof RFCCompliantNotifyAction)
        );
        return $this;
    }

    /**
     * Get stop filter actions
     *
     * @return array
     */
    public function getStopActions(): array
    {
        return $this->stopActions;
    }

    /**
     * Set stop filter actions
     *
     * @return self
     */
    public function setStopActions(array $filterActions): self
    {
        $this->stopActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof StopAction)
        );
        return $this;
    }

    /**
     * Get reject filter actions
     *
     * @return array
     */
    public function getRejectActions(): array
    {
        return $this->rejectActions;
    }

    /**
     * Set reject filter actions
     *
     * @return self
     */
    public function setRejectActions(array $filterActions): self
    {
        $this->rejectActions = array_values(
            array_filter($filterActions, static fn ($action) => get_class($action) === RejectAction::class)
        );
        return $this;
    }

    /**
     * Get ereject filter actions
     *
     * @return array
     */
    public function getErejectActions(): array
    {
        return $this->erejectActions;
    }

    /**
     * Set ereject filter actions
     *
     * @return self
     */
    public function setErejectActions(array $filterActions): self
    {
        $this->erejectActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof ErejectAction)
        );
        return $this;
    }

    /**
     * Get log filter actions
     *
     * @return array
     */
    public function getLogActions(): array
    {
        return $this->logActions;
    }

    /**
     * Set log filter actions
     *
     * @return self
     */
    public function setLogActions(array $filterActions): self
    {
        $this->logActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof LogAction)
        );
        return $this;
    }

    /**
     * Get add header filter actions
     *
     * @return array
     */
    public function getAddheaderActions(): array
    {
        return $this->addheaderActions;
    }

    /**
     * Set add header filter actions
     *
     * @return self
     */
    public function setAddheaderActions(array $filterActions): self
    {
        $this->addheaderActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof AddheaderAction)
        );
        return $this;
    }

    /**
     * Get delete header filter actions
     *
     * @return array
     */
    public function getDeleteheaderActions(): array
    {
        return $this->deleteheaderActions;
    }

    /**
     * Set delete header filter actions
     *
     * @return self
     */
    public function setDeleteheaderActions(array $filterActions): self
    {
        $this->deleteheaderActions = array_values(
            array_filter($filterActions, static fn ($action) => get_class($action) ===DeleteheaderAction::class)
        );
        return $this;
    }

    /**
     * Get replace header filter actions
     *
     * @return array
     */
    public function getReplaceheaderActions(): array
    {
        return $this->replaceheaderActions;
    }

    /**
     * Set replace header filter actions
     *
     * @return self
     */
    public function setReplaceheaderActions(array $filterActions): self
    {
        $this->replaceheaderActions = array_values(
            array_filter($filterActions, static fn ($action) => $action instanceof ReplaceheaderAction)
        );
        return $this;
    }

    /**
     * Add filter action
     *
     * @param  FilterAction $filterAction
     * @return self
     */
    public function addFilterAction(FilterAction $filterAction): self
    {
        if ($filterAction instanceof FilterVariables) {
            $this->filterVariables[] = $filterAction;
        }
        if ($filterAction instanceof KeepAction) {
            $this->keepActions[] = $filterAction;
        }
        if ($filterAction instanceof DiscardAction) {
            $this->discardActions[] = $filterAction;
        }
        if ($filterAction instanceof FileIntoAction) {
            $this->fileIntoActions[] = $filterAction;
        }
        if ($filterAction instanceof FlagAction) {
            $this->flagActions[] = $filterAction;
        }
        if ($filterAction instanceof TagAction) {
            $this->tagActions[] = $filterAction;
        }
        if ($filterAction instanceof RedirectAction) {
            $this->redirectActions[] = $filterAction;
        }
        if ($filterAction instanceof ReplyAction) {
            $this->replyActions[] = $filterAction;
        }
        if ($filterAction instanceof NotifyAction) {
            $this->notifyActions[] = $filterAction;
        }
        if ($filterAction instanceof RFCCompliantNotifyAction) {
            $this->rfcCompliantNotifyActions[] = $filterAction;
        }
        if ($filterAction instanceof StopAction) {
            $this->stopActions[] = $filterAction;
        }
        if (get_class($filterAction) === RejectAction::class) {
            $this->rejectActions[] = $filterAction;
        }
        if ($filterAction instanceof ErejectAction) {
            $this->erejectActions[] = $filterAction;
        }
        if ($filterAction instanceof LogAction) {
            $this->logActions[] = $filterAction;
        }
        if ($filterAction instanceof AddheaderAction) {
            $this->addheaderActions[] = $filterAction;
        }
        if (get_class($filterAction) === DeleteheaderAction::class) {
            $this->deleteheaderActions[] = $filterAction;
        }
        if ($filterAction instanceof ReplaceheaderAction) {
            $this->replaceheaderActions[] = $filterAction;
        }
        return $this;
    }

    /**
     * Set filter actions
     *
     * @param  array $filterActions
     * @return self
     */
    public function setFilterActions(array $filterActions): self
    {
        $this->setFilterVariables($filterActions)
             ->setKeepActions($filterActions)
             ->setDiscardActions($filterActions)
             ->setFileIntoActions($filterActions)
             ->setFlagActions($filterActions)
             ->setTagActions($filterActions)
             ->setRedirectActions($filterActions)
             ->setReplyActions($filterActions)
             ->setNotifyActions($filterActions)
             ->setRFCCompliantNotifyActions($filterActions)
             ->setStopActions($filterActions)
             ->setRejectActions($filterActions)
             ->setErejectActions($filterActions)
             ->setLogActions($filterActions)
             ->setAddheaderActions($filterActions)
             ->setDeleteheaderActions($filterActions)
             ->setReplaceheaderActions($filterActions);
        return $this;
    }

    /**
     * Get filter actions
     *
     * @return array
     */
    public function getFilterActions(): array
    {
        return array_merge(
            $this->filterVariables,
            $this->keepActions,
            $this->discardActions,
            $this->fileIntoActions,
            $this->flagActions,
            $this->tagActions,
            $this->redirectActions,
            $this->replyActions,
            $this->notifyActions,
            $this->rfcCompliantNotifyActions,
            $this->stopActions,
            $this->rejectActions,
            $this->erejectActions,
            $this->logActions,
            $this->addheaderActions,
            $this->deleteheaderActions,
            $this->replaceheaderActions
        );
    }
}
