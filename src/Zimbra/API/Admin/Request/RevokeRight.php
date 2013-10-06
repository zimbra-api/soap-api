<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\EffectiveRightsTargetSelector as Target;
use Zimbra\Soap\Struct\GranteeSelector as Grantee;
use Zimbra\Soap\Struct\RightModifierInfo as Right;

/**
 * RevokeRight class
 * GrantRevoke a right from a target that was previously granted to an individual or group grantee.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RevokeRight extends Request
{
    /**
     * Target selector
     * @var Target
     */
    private $_target;

    /**
     * Grantee selector
     * @var Grantee
     */
    private $_grantee;

    /**
     * Right
     * @var Right
     */
    private $_right;

    /**
     * Constructor method for RevokeRight 
     * @param  Hostname $target
     * @param  StatsSpec $stats
     * @param  string $limit
     * @return self
     */
    public function __construct(
        Target $target,
        Grantee $grantee,
        Right $right)
    {
        parent::__construct();
        $this->_target = $target;
        $this->_grantee = $grantee;
        $this->_right = $right;
    }

    /**
     * Gets or sets target
     *
     * @param  Target $target
     * @return Target|self
     */
    public function target(Target $target = null)
    {
        if(null === $target)
        {
            return $this->_target;
        }
        $this->_target = $target;
        return $this;
    }

    /**
     * Gets or sets grantee
     *
     * @param  Grantee $grantee
     * @return Grantee|self
     */
    public function grantee(Grantee $grantee = null)
    {
        if(null === $grantee)
        {
            return $this->_grantee;
        }
        $this->_grantee = $grantee;
        return $this;
    }

    /**
     * Gets or sets right
     *
     * @param  Right $right
     * @return Right|self
     */
    public function right(Right $right = null)
    {
        if(null === $right)
        {
            return $this->_right;
        }
        $this->_right = $right;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_target->toArray();
        $this->array += $this->_grantee->toArray();
        $this->array += $this->_right->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_target->toXml())
                  ->append($this->_grantee->toXml())
                  ->append($this->_right->toXml());
        return parent::toXml();
    }
}