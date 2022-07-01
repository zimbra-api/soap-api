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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FilterActions
{
    /**
     * Filter variables
     * 
     * @Accessor(getter="getFilterVariables", setter="setFilterVariables")
     * @Type("array<Zimbra\Mail\Struct\FilterVariables>")
     * @XmlList(inline=true, entry="filterVariables", namespace="urn:zimbraMail")
     */
    private $filterVariables = [];

    /**
     * Keep filter actions
     * 
     * @Accessor(getter="getKeepActions", setter="setKeepActions")
     * @Type("array<Zimbra\Mail\Struct\KeepAction>")
     * @XmlList(inline=true, entry="actionKeep", namespace="urn:zimbraMail")
     */
    private $keepActions = [];

    /**
     * Discard filter actions
     * 
     * @Accessor(getter="getDiscardActions", setter="setDiscardActions")
     * @Type("array<Zimbra\Mail\Struct\DiscardAction>")
     * @XmlList(inline=true, entry="actionDiscard", namespace="urn:zimbraMail")
     */
    private $discardActions = [];

    /**
     * File into filter actions
     * 
     * @Accessor(getter="getFileIntoActions", setter="setFileIntoActions")
     * @Type("array<Zimbra\Mail\Struct\FileIntoAction>")
     * @XmlList(inline=true, entry="actionFileInto", namespace="urn:zimbraMail")
     */
    private $fileIntoActions = [];

    /**
     * Flag filter actions
     * 
     * @Accessor(getter="getFlagActions", setter="setFlagActions")
     * @Type("array<Zimbra\Mail\Struct\FlagAction>")
     * @XmlList(inline=true, entry="actionFlag", namespace="urn:zimbraMail")
     */
    private $flagActions = [];

    /**
     * Tag filter actions
     * 
     * @Accessor(getter="getTagActions", setter="setTagActions")
     * @Type("array<Zimbra\Mail\Struct\TagAction>")
     * @XmlList(inline=true, entry="actionTag", namespace="urn:zimbraMail")
     */
    private $tagActions = [];

    /**
     * Redirect filter actions
     * 
     * @Accessor(getter="getRedirectActions", setter="setRedirectActions")
     * @Type("array<Zimbra\Mail\Struct\RedirectAction>")
     * @XmlList(inline=true, entry="actionRedirect", namespace="urn:zimbraMail")
     */
    private $redirectActions = [];

    /**
     * Reply filter actions
     * 
     * @Accessor(getter="getReplyActions", setter="setReplyActions")
     * @Type("array<Zimbra\Mail\Struct\ReplyAction>")
     * @XmlList(inline=true, entry="actionReply", namespace="urn:zimbraMail")
     */
    private $replyActions = [];

    /**
     * Notify filter actions
     * 
     * @Accessor(getter="getNotifyActions", setter="setNotifyActions")
     * @Type("array<Zimbra\Mail\Struct\NotifyAction>")
     * @XmlList(inline=true, entry="actionNotify", namespace="urn:zimbraMail")
     */
    private $notifyActions = [];

    /**
     * RFC compliant notify filter actions
     * 
     * @Accessor(getter="getRFCCompliantNotifyActions", setter="setRFCCompliantNotifyActions")
     * @Type("array<Zimbra\Mail\Struct\RFCCompliantNotifyAction>")
     * @XmlList(inline=true, entry="actionRFCCompliantNotify", namespace="urn:zimbraMail")
     */
    private $rfcCompliantNotifyActions = [];

    /**
     * Stop filter actions
     * 
     * @Accessor(getter="getStopActions", setter="setStopActions")
     * @Type("array<Zimbra\Mail\Struct\StopAction>")
     * @XmlList(inline=true, entry="actionStop", namespace="urn:zimbraMail")
     */
    private $stopActions = [];

    /**
     * Reject filter actions
     * 
     * @Accessor(getter="getRejectActions", setter="setRejectActions")
     * @Type("array<Zimbra\Mail\Struct\RejectAction>")
     * @XmlList(inline=true, entry="actionReject", namespace="urn:zimbraMail")
     */
    private $rejectActions = [];

    /**
     * Ereject filter actions
     * 
     * @Accessor(getter="getErejectActions", setter="setErejectActions")
     * @Type("array<Zimbra\Mail\Struct\ErejectAction>")
     * @XmlList(inline=true, entry="actionEreject", namespace="urn:zimbraMail")
     */
    private $erejectActions = [];

    /**
     * Log filter actions
     * 
     * @Accessor(getter="getLogActions", setter="setLogActions")
     * @Type("array<Zimbra\Mail\Struct\LogAction>")
     * @XmlList(inline=true, entry="actionLog", namespace="urn:zimbraMail")
     */
    private $logActions = [];

    /**
     * Add header filter actions
     * 
     * @Accessor(getter="getAddheaderActions", setter="setAddheaderActions")
     * @Type("array<Zimbra\Mail\Struct\AddheaderAction>")
     * @XmlList(inline=true, entry="actionAddheader", namespace="urn:zimbraMail")
     */
    private $addheaderActions = [];

    /**
     * Delete header filter actions
     * 
     * @Accessor(getter="getDeleteheaderActions", setter="setDeleteheaderActions")
     * @Type("array<Zimbra\Mail\Struct\DeleteheaderAction>")
     * @XmlList(inline=true, entry="actionDeleteheader", namespace="urn:zimbraMail")
     */
    private $deleteheaderActions = [];

    /**
     * Replace header filter actions
     * 
     * @Accessor(getter="getReplaceheaderActions", setter="setReplaceheaderActions")
     * @Type("array<Zimbra\Mail\Struct\ReplaceheaderAction>")
     * @XmlList(inline=true, entry="actionReplaceheader", namespace="urn:zimbraMail")
     */
    private $replaceheaderActions = [];

    /**
     * Constructor method for FilterActions
     * 
     * @param  array $filterActions
     * @return self
     */
    public function __construct(array $filterActions = [])
    {
        $this->setFilterActions($filterActions);
    }

    /**
     * Gets filter variables
     *
     * @return array
     */
    public function getFilterVariables(): array
    {
        return $this->filterVariables;
    }

    /**
     * Sets filter variables
     *
     * @return self
     */
    public function setFilterVariables(array $filterVariables): self
    {
        $this->filterVariables = array_filter($filterVariables, static fn ($action) => $action instanceof FilterVariables);
        return $this;
    }

    /**
     * Gets keep filter actions
     *
     * @return array
     */
    public function getKeepActions(): array
    {
        return $this->keepActions;
    }

    /**
     * Sets keep filter actions
     *
     * @return self
     */
    public function setKeepActions(array $filterActions): self
    {
        $this->keepActions = array_filter($this->filterActions, static fn ($action) => $action instanceof KeepAction);
        return $this;
    }

    /**
     * Gets discard filter actions
     *
     * @return array
     */
    public function getDiscardActions(): array
    {
        return $this->discardActions;
    }

    /**
     * Sets discard filter actions
     *
     * @return self
     */
    public function setDiscardActions(array $filterActions): self
    {
        $this->discardActions = array_filter($filterActions, static fn ($action) => $action instanceof DiscardAction);
        return $this;
    }

    /**
     * Gets file into filter actions
     *
     * @return array
     */
    public function getFileIntoActions(): array
    {
        return $this->fileIntoActions;
    }

    /**
     * Sets file into filter actions
     *
     * @return self
     */
    public function setFileIntoActions(array $filterActions): self
    {
        $this->fileIntoActions = array_filter($filterActions, static fn ($action) => $action instanceof FileIntoAction);
        return $this;
    }

    /**
     * Gets flag filter actions
     *
     * @return array
     */
    public function getFlagActions(): array
    {
        return $this->flagActions;
    }

    /**
     * Sets flag filter actions
     *
     * @return self
     */
    public function setFlagActions(array $filterActions): self
    {
        $this->flagActions = array_filter($filterActions, static fn ($action) => $action instanceof FlagAction);
        return $this;
    }

    /**
     * Gets tag filter actions
     *
     * @return array
     */
    public function getTagActions(): array
    {
        return $this->tagActions;
    }

    /**
     * Sets tag filter actions
     *
     * @return self
     */
    public function setTagActions(array $filterActions): self
    {
        $this->tagActions = array_filter($filterActions, static fn ($action) => $action instanceof TagAction);
        return $this;
    }

    /**
     * Gets redirect filter actions
     *
     * @return array
     */
    public function getRedirectActions(): array
    {
        return $this->redirectActions;
    }

    /**
     * Sets redirect filter actions
     *
     * @return self
     */
    public function setRedirectActions(array $filterActions): self
    {
        $this->redirectActions = array_filter($filterActions, static fn ($action) => $action instanceof RedirectAction);
        return $this;
    }

    /**
     * Gets reply filter actions
     *
     * @return array
     */
    public function getReplyActions(): array
    {
        return $this->replyActions;
    }

    /**
     * Sets reply filter actions
     *
     * @return self
     */
    public function setReplyActions(array $filterActions): self
    {
        $this->replyActions = array_filter($filterActions, static fn ($action) => $action instanceof ReplyAction);
        return $this;
    }

    /**
     * Gets notify filter actions
     *
     * @return array
     */
    public function getNotifyActions(): array
    {
        return $this->notifyActions;
    }

    /**
     * Sets notify filter actions
     *
     * @return self
     */
    public function setNotifyActions(array $filterActions): self
    {
        $this->notifyActions = array_filter($filterActions, static fn ($action) => $action instanceof NotifyAction);
        return $this;
    }

    /**
     * Gets RFC compliant notify filter actions
     *
     * @return array
     */
    public function getRFCCompliantNotifyActions(): array
    {
        return $this->rfcCompliantNotifyActions;
    }

    /**
     * Sets RFC compliant notify filter actions
     *
     * @return self
     */
    public function setRFCCompliantNotifyActions(array $filterActions): self
    {
        $this->rfcCompliantNotifyActions = array_filter($filterActions, static fn ($action) => $action instanceof RFCCompliantNotifyAction);
        return $this;
    }

    /**
     * Gets stop filter actions
     *
     * @return array
     */
    public function getStopActions(): array
    {
        return $this->stopActions;
    }

    /**
     * Sets stop filter actions
     *
     * @return self
     */
    public function setStopActions(array $filterActions): self
    {
        $this->stopActions = array_filter($filterActions, static fn ($action) => $action instanceof StopAction);
        return $this;
    }

    /**
     * Gets reject filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\RejectAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionReject", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getRejectActions(): array
    {
        return $this->rejectActions;
    }

    /**
     * Sets reject filter actions
     *
     * @return self
     */
    public function setRejectActions(array $filterActions): self
    {
        $this->rejectActions = array_filter($filterActions, static fn ($action) => $action instanceof RejectAction);
        return $this;
    }

    /**
     * Gets ereject filter actions
     *
     * @return array
     */
    public function getErejectActions(): array
    {
        return $this->erejectActions;
    }

    /**
     * Sets ereject filter actions
     *
     * @return self
     */
    public function setErejectActions(array $filterActions): self
    {
        $this->erejectActions = array_filter($filterActions, static fn ($action) => $action instanceof ErejectAction);
        return $this;
    }

    /**
     * Gets log filter actions
     *
     * @return array
     */
    public function getLogActions(): array
    {
        return $this->logActions;
    }

    /**
     * Sets log filter actions
     *
     * @return self
     */
    public function setLogActions(array $filterActions): self
    {
        $this->logActions = array_filter($filterActions, static fn ($action) => $action instanceof LogAction);
        return $this;
    }

    /**
     * Gets add header filter actions
     *
     * @return array
     */
    public function getAddheaderActions(): array
    {
        return $this->addheaderActions;
    }

    /**
     * Sets add header filter actions
     *
     * @return self
     */
    public function setAddheaderActions(array $filterActions): self
    {
        $this->addheaderActions = array_filter($filterActions, static fn ($action) => $action instanceof AddheaderAction);
        return $this;
    }

    /**
     * Gets delete header filter actions
     *
     * @return array
     */
    public function getDeleteheaderActions(): array
    {
        return $this->deleteheaderActions;
    }

    /**
     * Sets delete header filter actions
     *
     * @return self
     */
    public function setDeleteheaderActions(array $filterActions): self
    {
        $this->deleteheaderActions = array_filter($filterActions, static fn ($action) => $action instanceof DeleteheaderAction);
        return $this;
    }

    /**
     * Gets replace header filter actions
     *
     * @return array
     */
    public function getReplaceheaderActions(): array
    {
        return $this->replaceheaderActions;
    }

    /**
     * Sets replace header filter actions
     *
     * @return self
     */
    public function setReplaceheaderActions(array $filterActions): self
    {
        $this->replaceheaderActions = array_filter($filterActions, static fn ($action) => $action instanceof ReplaceheaderAction);
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
        if ($filterAction instanceof RejectAction) {
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
        if ($filterAction instanceof DeleteheaderAction) {
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
     * Gets filter actions
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
