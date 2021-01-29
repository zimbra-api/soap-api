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

use JMS\Serializer\Annotation\{
    Accessor, AccessType, SerializedName, SkipWhenEmpty, Type, XmlElement, XmlKeyValuePairs, XmlRoot
};

/**
 * NestedRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="nestedRule")
 */
class NestedRule
{
    /**
     * Filter Variables
     * @Accessor(getter="getFilterVariables", setter="setFilterVariables")
     * @SerializedName("filterVariables")
     * @Type("Zimbra\Mail\Struct\FilterVariables")
     * @XmlElement
     */
    private $filterVariables;

    /**
     * Filter tests
     * @Accessor(getter="getFilterTests", setter="setFilterTests")
     * @SerializedName("filterTests")
     * @Type("Zimbra\Mail\Struct\FilterTests")
     * @XmlElement
     */
    private $tests;

    /**
     * Filter actions
     * @Accessor(getter="getFilterActions", setter="setFilterActions")
     * @Type("array<string, Zimbra\Mail\Struct\FilterAction>")
     * @SerializedName("filterActions")
     ^ @SkipWhenEmpty
     * @XmlKeyValuePairs
     */
    private $actions;

    /**
     * NestedRule child
     * @Accessor(getter="getChild", setter="setChild")
     * @SerializedName("nestedRule")
     * @Type("Zimbra\Mail\Struct\NestedRule")
     * @XmlElement
     */
    private $child;

    /**
     * Constructor method for NestedRule
     * 
     * @param FilterTests $tests
     * @param FilterVariables $filterVariables
     * @param array $actions
     * @param NestedRule $child
     * @return self
     */
    public function __construct(
        FilterTests $tests, ?FilterVariables $filterVariables = NULL, array $actions = [], ?NestedRule $child = NULL
    )
    {
        $this->setFilterTests($tests)
            ->setFilterActions($actions);
        if ($filterVariables instanceof FilterVariables) {
            $this->setFilterVariables($filterVariables);
        }
        if ($child instanceof NestedRule) {
            $this->setChild($child);
        }
    }

    /**
     * Gets filterVariables
     *
     * @return FilterVariables
     */
    public function getFilterVariables(): ?FilterVariables
    {
        return $this->filterVariables;
    }

    /**
     * Sets filterVariables
     *
     * @param  FilterVariables $filterVariables
     * @return self
     */
    public function setFilterVariables(FilterVariables $filterVariables)
    {
        $this->filterVariables = $filterVariables;
        return $this;
    }

    /**
     * Gets tests
     *
     * @return FilterTests
     */
    public function getFilterTests(): FilterTests
    {
        return $this->tests;
    }

    /**
     * Sets tests
     *
     * @param  FilterTests $tests
     * @return self
     */
    public function setFilterTests(FilterTests $tests): self
    {
        $this->tests = $tests;
        return $this;
    }

    /**
     * Gets filter actions
     *
     * @return array
     */
    public function getFilterActions(): array
    {
        return $this->actions;
    }

    /**
     * Sets filter actions
     *
     * @param  array $actions
     * @return self
     */
    public function setFilterActions(array $actions): self
    {
        $this->actions = [];
        foreach ($actions as $action) {
            if ($action instanceof FilterAction) {
                $this->addFilterAction($action);
            }
        }
        return $this;
    }

    /**
     * Add filter action
     *
     * @param  FilterAction $action
     * @return self
     */
    public function addFilterAction(FilterAction $action): self
    {
        foreach (self::filterActionTypes() as $key => $type) {
            if (get_class($action) === $type) {
                $this->actions[$key] = $action;
            }
        }
        return $this;
    }

    /**
     * Gets child
     *
     * @return NestedRule
     */
    public function getChild(): ?NestedRule
    {
        return $this->child;
    }

    /**
     * Sets child
     *
     * @param  NestedRule $child
     * @return self
     */
    public function setChild(NestedRule $child)
    {
        $this->child = $child;
        return $this;
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
