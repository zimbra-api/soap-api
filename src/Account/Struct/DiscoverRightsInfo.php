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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DiscoverRightsInfo
{
    /**
     * Right the targets relate to
     * 
     * @var string
     */
    #[Accessor(getter: 'getRight', setter: 'setRight')]
    #[SerializedName(name: 'right')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $right;

    /**
     * Targets
     * 
     * @var array
     */
    #[Accessor(getter: 'getTargets', setter: 'setTargets')]
    #[Type(name: 'array<Zimbra\Account\Struct\DiscoverRightsTarget>')]
    #[XmlList(inline: true, entry: 'target', namespace: 'urn:zimbraAccount')]
    private $targets = [];

    /**
     * Constructor
     *
     * @param  string $right
     * @param  array $targets
     * @return self
     */
    public function __construct(
        string $right = '',
        array $targets = []
    )
    {
        $this->setRight($right)
             ->setTargets($targets);
    }

    /**
     * Get right
     *
     * @return string
     */
    public function getRight(): string
    {
        return $this->right;
    }

    /**
     * Set right
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
     * Set targets
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
     * Get targets
     *
     * @return array
     */
    public function getTargets(): array
    {
        return $this->targets;
    }
}
