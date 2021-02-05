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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Account\Struct\DistributionListGranteeSelector as GranteeSelector;

/**
 * DistributionListRightSpec struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="right")
 */
class DistributionListRightSpec
{
    /**
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("string")
     * @XmlAttribute
     */
    private $right;

    /**
     * The sequence of grantee
     * 
     * @Accessor(getter="getGrantees", setter="setGrantees")
     * @SerializedName("grantee")
     * @Type("array<Zimbra\Account\Struct\DistributionListGranteeSelector>")
     * @XmlList(inline = true, entry = "grantee")
     */
    private $grantees;

    /**
     * Constructor method for DistributionListRightSpec
     * @param string $right
     * @param array $grantees
     * @return self
     */
    public function __construct(string $right, array $grantees = [])
    {
        $this->setRight($right)
             ->setGrantees($grantees);
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
     * Sets grantees
     *
     * @return self
     */
    public function setGrantees(array $grantees): self
    {
        $this->grantees = [];
        foreach ($grantees as $grantee) {
            if ($grantee instanceof GranteeSelector) {
                $this->grantees[] = $grantee;
            }
        }
        return $this;
    }

    /**
     * Gets grantees
     *
     * @return array
     */
    public function getGrantees(): array
    {
        return $this->grantees;
    }
}