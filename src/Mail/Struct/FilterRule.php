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
    Accessor, SerializedName, SkipWhenEmpty, Type, XmlAttribute, XmlElement, XmlKeyValuePairs
};

/**
 * FilterRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FilterRule
{
    /**
     * Rule name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Active flag.  Set by default.
     * @Accessor(getter="isActive", setter="setActive")
     * @SerializedName("active")
     * @Type("bool")
     * @XmlAttribute
     */
    private $active;

    /**
     * Filter Variables
     * @Accessor(getter="getFilterVariables", setter="setFilterVariables")
     * @SerializedName("filterVariables")
     * @Type("Zimbra\Mail\Struct\FilterVariables")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?FilterVariables $filterVariables = NULL;

    /**
     * Filter tests
     * @Accessor(getter="getFilterTests", setter="setFilterTests")
     * @SerializedName("filterTests")
     * @Type("Zimbra\Mail\Struct\FilterTests")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private FilterTests $tests;

    /**
     * Filter actions
     * @Accessor(getter="getFilterActions", setter="setFilterActions")
     * @Type("array<string, Zimbra\Mail\Struct\FilterAction>")
     * @SerializedName("filterActions")
     ^ @SkipWhenEmpty
     * @XmlKeyValuePairs
     */
    private $actions = [];

    /**
     * Nested Rule
     * @Accessor(getter="getChild", setter="setChild")
     * @SerializedName("nestedRule")
     * @Type("Zimbra\Mail\Struct\NestedRule")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?NestedRule $child = NULL;

    /**
     * Constructor method for FilterRule
     * 
     * @param string $name
     * @param bool $active
     * @param FilterTests $tests
     * @param FilterVariables $filterVariables
     * @param array $actions
     * @param NestedRule $child
     * @return self
     */
    public function __construct(
        string $name = '',
        bool $active = FALSE,
        FilterTests $tests,
        ?FilterVariables $filterVariables = NULL,
        array $actions = [],
        ?NestedRule $child = NULL
    )
    {
        $this->setName($name)
            ->setActive($active)
            ->setFilterTests($tests)
            ->setFilterActions($actions);
        if ($filterVariables instanceof FilterVariables) {
            $this->setFilterVariables($filterVariables);
        }
        if ($child instanceof NestedRule) {
            $this->setChild($child);
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets active
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * Sets active
     *
     * @param  bool $active
     * @return self
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
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
