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

use Zimbra\Account\Struct\DistributionListGranteeSelector as GranteeSelector;
use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * DistributionListRightSpec struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DistributionListRightSpec extends Base
{
    /**
     * The sequence of grantee
     * @var TypedSequence
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
		parent::__construct();
		$this->setProperty('right', trim($right));
        $this->setGrantees($grantees);

        $this->on('before', function(Base $sender)
        {
            if($sender->getGrantees()->count())
            {
                $sender->setChild('grantee', $sender->getGrantees()->all());
            }
        });
    }

    /**
     * Gets right
     *
     * @return string
     */
    public function getRight()
    {
        return $this->getProperty('right');
    }

    /**
     * Sets right
     *
     * @param  string $right
     * @return self
     */
    public function setRight($right)
    {
        return $this->setProperty('right', trim($right));
    }

    /**
     * Add a grantee
     *
     * @param  GranteeSelector $grantee
     * @return self
     */
    public function addGrantee(GranteeSelector $grantee)
    {
        $this->_grantees->add($grantee);
        return $this;
    }

    /**
     * Sets grantee sequence
     *
     * @return self
     */
    public function setGrantees(array $grantees)
    {
        $this->_grantees = new TypedSequence(
            'Zimbra\Account\Struct\DistributionListGranteeSelector', $grantees
        );
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
