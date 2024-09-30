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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * NestedRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NestedRule
{
    /**
     * Filter Variables
     *
     * @Accessor(getter="getFilterVariables", setter="setFilterVariables")
     * @SerializedName("filterVariables")
     * @Type("Zimbra\Mail\Struct\FilterVariables")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var FilterVariables
     */
    #[Accessor(getter: "getFilterVariables", setter: "setFilterVariables")]
    #[SerializedName("filterVariables")]
    #[Type(FilterVariables::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?FilterVariables $filterVariables;

    /**
     * Filter tests
     *
     * @Accessor(getter="getFilterTests", setter="setFilterTests")
     * @SerializedName("filterTests")
     * @Type("Zimbra\Mail\Struct\FilterTests")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var FilterTests
     */
    #[Accessor(getter: "getFilterTests", setter: "setFilterTests")]
    #[SerializedName("filterTests")]
    #[Type(FilterTests::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?FilterTests $tests;

    /**
     * Filter actions
     *
     * @Accessor(getter="getActions", setter="setActions")
     * @SerializedName("filterActions")
     * @Type("Zimbra\Mail\Struct\FilterActions")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var FilterActions
     */
    #[Accessor(getter: "getActions", setter: "setActions")]
    #[SerializedName("filterActions")]
    #[Type(FilterActions::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private $actions;

    /**
     * NestedRule child
     *
     * @Accessor(getter="getChild", setter="setChild")
     * @SerializedName("nestedRule")
     * @Type("Zimbra\Mail\Struct\NestedRule")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var NestedRule
     */
    #[Accessor(getter: "getChild", setter: "setChild")]
    #[SerializedName("nestedRule")]
    #[Type(NestedRule::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?NestedRule $child;

    /**
     * Constructor
     *
     * @param FilterTests $tests
     * @param FilterVariables $filterVariables
     * @param array $actions
     * @param NestedRule $child
     * @return self
     */
    public function __construct(
        ?FilterTests $tests = null,
        ?FilterVariables $filterVariables = null,
        array $actions = [],
        ?NestedRule $child = null
    ) {
        $this->setFilterActions($actions);
        $this->tests = $tests;
        $this->filterVariables = $filterVariables;
        $this->child = $child;
    }

    /**
     * Get filterVariables
     *
     * @return FilterVariables
     */
    public function getFilterVariables(): ?FilterVariables
    {
        return $this->filterVariables;
    }

    /**
     * Set filterVariables
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
     * Get tests
     *
     * @return FilterTests
     */
    public function getFilterTests(): FilterTests
    {
        return $this->tests;
    }

    /**
     * Set tests
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
     * Get filter actions
     *
     * @return array
     */
    public function getFilterActions(): array
    {
        return $this->actions->getFilterActions();
    }

    /**
     * Set filter actions
     *
     * @param  array $actions
     * @return self
     */
    public function setFilterActions(array $actions): self
    {
        if (!empty($actions)) {
            $this->actions = new FilterActions($actions);
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
        if (!($this->actions instanceof FilterActions)) {
            $this->actions = new FilterActions();
        }
        $this->actions->addFilterAction($action);
        return $this;
    }

    /**
     * Get filterActions
     *
     * @return FilterActions
     */
    public function getActions(): ?FilterActions
    {
        return $this->actions;
    }

    /**
     * Set filterActions
     *
     * @param  FilterActions $actions
     * @return self
     */
    public function setActions(FilterActions $actions): self
    {
        $this->actions = $actions;
        return $this;
    }

    /**
     * Get child
     *
     * @return NestedRule
     */
    public function getChild(): ?NestedRule
    {
        return $this->child;
    }

    /**
     * Set child
     *
     * @param  NestedRule $child
     * @return self
     */
    public function setChild(NestedRule $child)
    {
        $this->child = $child;
        return $this;
    }
}
