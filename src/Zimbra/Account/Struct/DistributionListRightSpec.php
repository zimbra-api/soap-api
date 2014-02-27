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
    private $_grantee = array();

    /**
     * Constructor method for DistributionListRightSpec
     * @param string $right
     * @param array $grantees
     * @return self
     */
    public function __construct($right, array $grantees = array())
    {
		parent::__construct();
		$this->property('right', trim($right));
        $this->_grantee = new TypedSequence(
            'Zimbra\Account\Struct\DistributionListGranteeSelector', $grantees
        );

        $this->on('before', function(Base $sender)
        {
            if($sender->grantee()->count())
            {
                $sender->child('grantee', $sender->grantee()->all());
            }
        });
    }

    /**
     * Gets or sets right
     *
     * @param  string $right
     * @return string|self
     */
    public function right($right = null)
    {
        if(null === $right)
        {
            return $this->property('right');
        }
        return $this->property('right', trim($right));
    }

    /**
     * Add a grantee
     *
     * @param  GranteeSelector $grantee
     * @return GranteeSelector
     */
    public function addGrantee(GranteeSelector $grantee)
    {
        $this->_grantee->add($grantee);
        return $this;
    }

    /**
     * Gets grantee Sequence
     *
     * @return Sequence
     */
    public function grantee()
    {
        return $this->_grantee;
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
