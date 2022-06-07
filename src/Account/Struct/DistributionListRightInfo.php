<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copygrantee and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * DistributionListRightInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copygrantee © 2013-present by Nguyen Van Nguyen.
 */
class DistributionListRightInfo
{
    /**
     * Right
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("string")
     * @XmlAttribute
     */
    private $right;

    /**
     * Grantees
     * @Accessor(getter="getGrantees", setter="setGrantees")
     * @SerializedName("grantee")
     * @Type("array<Zimbra\Account\Struct\DistributionListGranteeInfo>")
     * @XmlList(inline = true, entry = "grantee")
     */
    private $grantees = [];

    /**
     * Constructor method for DistributionListRightInfo
     *
     * @param string $right
     * @param array  $grantees
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
     * Gets grantees
     *
     * @return array
     */
    public function getGrantees()
    {
        return $this->grantees;
    }

    /**
     * Sets grantees
     *
     * @param  array $grantees
     * @return self
     */
    public function setGrantees(array $grantees)
    {
        $this->grantees = array_filter($grantees, static fn($grantee) => $grantee instanceof DistributionListGranteeInfo);
        return $this;
    }

    /**
     * Add grantee
     *
     * @param  DistributionListGranteeInfo $grantee
     * @return self
     */
    public function addGrantee(DistributionListGranteeInfo $grantee)
    {
        $this->grantees[] = $grantee;
        return $this;
    }
}
