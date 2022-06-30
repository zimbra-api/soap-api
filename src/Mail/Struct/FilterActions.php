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

use JMS\Serializer\Annotation\{Accessor, Exclude, Type, VirtualProperty, XmlList};

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
     * Filter actions
     * @Exclude
     */
    private $filterActions = [];

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
     * @Type("array<Zimbra\Mail\Struct\FilterVariables>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="filterVariables", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getFilterVariables(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof FilterVariables);
    }

    /**
     * Gets keep filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\KeepAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionKeep", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getKeepActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof KeepAction);
    }

    /**
     * Gets discard filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\MailCaldavFilterAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionDiscard", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getDiscardActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof DiscardAction);
    }

    /**
     * Gets file into filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\FileIntoAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionFileInto", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getFileIntoActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof FileIntoAction);
    }

    /**
     * Gets flag filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\FlagAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionFlag", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getFlagActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof FlagAction);
    }

    /**
     * Gets tag filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\TagAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionTag", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getTagActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof TagAction);
    }

    /**
     * Gets redirect filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\RedirectAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionRedirect", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getRedirectActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof RedirectAction);
    }

    /**
     * Gets reply filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\ReplyAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionReply", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getReplyActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof ReplyAction);
    }

    /**
     * Gets notify filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\NotifyAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionNotify", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getNotifyActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof NotifyAction);
    }

    /**
     * Gets RFC compliant notify filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\RFCCompliantNotifyAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionRFCCompliantNotify", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getRFCCompliantNotifyActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof RFCCompliantNotifyAction);
    }

    /**
     * Gets stop filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\StopAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionStop", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getStopActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof StopAction);
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
        return array_filter($this->filterActions, static fn ($action) => $action instanceof RejectAction);
    }

    /**
     * Gets ereject filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\ErejectAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionEreject", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getErejectActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof ErejectAction);
    }

    /**
     * Gets log filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\LogAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionLog", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getLogActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof LogAction);
    }

    /**
     * Gets add header filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\AddheaderAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionAddheader", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getAddheaderActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof AddheaderAction);
    }

    /**
     * Gets delete header filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\DeleteheaderAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionDeleteheader", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getDeleteheaderActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof DeleteheaderAction);
    }

    /**
     * Gets replace header filter actions
     *
     * @Type("array<Zimbra\Mail\Struct\ReplaceheaderAction>")
     * @VirtualProperty
     * @XmlList(inline=true, entry="actionReplaceheader", namespace="urn:zimbraMail")
     *
     * @return array
     */
    public function getReplaceheaderActions(): array
    {
        return array_filter($this->filterActions, static fn ($action) => $action instanceof ReplaceheaderAction);
    }

    /**
     * Add filter action
     *
     * @param  FilterAction $filterAction
     * @return self
     */
    public function addFilterAction(FilterAction $filterAction): self
    {
        $this->filterActions[] = $filterAction;
        return $this;
    }

    /**
     * Set filterActions
     *
     * @param  array $filterActions
     * @return self
     */
    public function setFilterActions(array $filterActions): self
    {
        $this->filterActions = array_filter($filterActions, static fn ($action) => $action instanceof FilterAction);
        return $this;
    }

    /**
     * Gets filterActions
     *
     * @return array
     */
    public function getFilterActions(): array
    {
        return $this->filterActions;
    }

    public static function filterActionTypes(): array
    {
        return [
            'filterVariables' => FilterVariables::class,
            'actionKeep' => KeepAction::class,
            'actionDiscard' => DiscardAction::class,
            'actionFileInto' => FileIntoAction::class,
            'actionFlag' => FlagAction::class,
            'actionTag' => TagAction::class,
            'actionRedirect' => RedirectAction::class,
            'actionReply' => ReplyAction::class,
            'actionNotify' => NotifyAction::class,
            'actionRFCCompliantNotify' => RFCCompliantNotifyAction::class,
            'actionStop' => StopAction::class,
            'actionReject' => RejectAction::class,
            'actionEreject' => ErejectAction::class,
            'actionLog' => LogAction::class,
            'actionAddheader' => AddheaderAction::class,
            'actionDeleteheader' => DeleteheaderAction::class,
            'actionReplaceheader' => ReplaceheaderAction::class,
        ];
    }
}
