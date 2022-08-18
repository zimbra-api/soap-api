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
use Zimbra\Account\Struct\DistributionListGranteeSelector as GranteeSelector;

/**
 * DistributionListRightSpec struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DistributionListRightSpec
{
    /**
     * @var string
     */
    #[Accessor(getter: 'getRight', setter: 'setRight')]
    #[SerializedName('right')]
    #[Type('string')]
    #[XmlAttribute]
    private $right;

    /**
     * The sequence of grantee
     * 
     * @var array
     */
    #[Accessor(getter: 'getGrantees', setter: 'setGrantees')]
    #[Type('array<Zimbra\Account\Struct\DistributionListGranteeSelector>')]
    #[XmlList(inline: true, entry: 'grantee', namespace: 'urn:zimbraAccount')]
    private $grantees = [];

    /**
     * Constructor
     * 
     * @param string $right
     * @param array  $grantees
     * @return self
     */
    public function __construct(string $right = '', array $grantees = [])
    {
        $this->setRight($right)
             ->setGrantees($grantees);
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
     * Add a grantee
     *
     * @param  GranteeSelector $grantee
     * @return self
     */
    public function addGrantee(GranteeSelector $grantee): self
    {
        $this->grantees[] = $grantee;
        return $this;
    }

    /**
     * Set grantees
     *
     * @return self
     */
    public function setGrantees(array $grantees): self
    {
        $this->grantees = array_filter($grantees, static fn ($grantee) => $grantee instanceof GranteeSelector);
        return $this;
    }

    /**
     * Get grantees
     *
     * @return array
     */
    public function getGrantees(): array
    {
        return $this->grantees;
    }
}
