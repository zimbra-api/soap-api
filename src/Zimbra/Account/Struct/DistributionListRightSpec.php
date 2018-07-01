<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;


use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Account\Struct\DistributionListGranteeSelector as GranteeSelector;

/**
 * DistributionListRightSpec struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
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
    private $_right;

    /**
     * The sequence of grantee
     * @Accessor(getter="getGrantees", setter="setGrantees")
     * @Type("array<Zimbra\Account\Struct\DistributionListGranteeSelector>")
     * @XmlList(inline = true, entry = "grantee")
     */
    private $_grantees;

    /**
     * Constructor method for DistributionListRightSpec
     * @param string $right
     * @param array $grantees
     * @return self
     */
    public function __construct($right, array $grantees = [])
    {
        $this->setRight($right)->setGrantees($grantees);
    }

    /**
     * Gets right
     *
     * @return string
     */
    public function getRight()
    {
        return $this->_right;
    }

    /**
     * Sets right
     *
     * @param  string $right
     * @return self
     */
    public function setRight($right)
    {
        $this->_right = trim($right);
        return $this;
    }

    /**
     * Add a grantee
     *
     * @param  GranteeSelector $grantee
     * @return self
     */
    public function addGrantee(GranteeSelector $grantee)
    {
        $this->_grantees[] = $grantee;
        return $this;
    }

    /**
     * Sets grantee sequence
     *
     * @return self
     */
    public function setGrantees(array $grantees)
    {
        $this->_grantees = [];
        foreach ($grantees as $grantee) {
            if ($grantee instanceof GranteeSelector) {
                $this->_grantees[] = $grantee;
            }
        }
        return $this;
    }

    /**
     * Gets grantee sequence
     *
     * @return Sequence
     */
    public function getGrantees()
    {
        return $this->_grantees;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'right')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'right')
    {
        return parent::toXml($name);
    }
}
