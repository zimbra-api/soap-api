<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * DiscoverRightsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DiscoverRightsInfo
{
    /**
     * Right the targets relate to
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("string")
     * @XmlAttribute
     */
    private $right;

    /**
     * Targets
     * @Accessor(getter="getTargets", setter="setTargets")
     * @SerializedName("target")
     * @Type("array<Zimbra\Account\Struct\DiscoverRightsTarget>")
     * @XmlList(inline = true, entry = "target")
     */
    private $targets = [];

    /**
     * Constructor method for DiscoverRightsInfo
     *
     * @param  string $right
     * @param  array $targets
     * @return self
     */
    public function __construct(
        string $right,
        array $targets = []
    )
    {
        $this->setRight($right)
             ->setTargets($targets);
    }

    /**
     * Gets right
     *
     * @return string
     */
    public function getRight(): string
    {
        return $this->right;
    }

    /**
     * Sets right
     *
     * @param  string $right
     * @return self
     */
    public function setRight(string $right): self
    {
        $this->right = $right;
        return $this;
    }

    /**
     * Add a target
     *
     * @param  DiscoverRightsTarget $target
     * @return self
     */
    public function addTarget(DiscoverRightsTarget $target): self
    {
        $this->targets[] = $target;
        return $this;
    }

    /**
     * Sets targets
     *
     * @param  array $targets
     * @return self
     */
    public function setTargets(array $targets): self
    {
        $this->targets = array_filter($targets, static fn ($target) => $target instanceof DiscoverRightsTarget);
        return $this;
    }

    /**
     * Gets targets
     *
     * @return array
     */
    public function getTargets(): array
    {
        return $this->targets;
    }
}
