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

use Zimbra\Soap\Request\Attr;
use Zimbra\Soap\Struct\GranteeSelector as Grantee;
use Zimbra\Soap\Struct\EffectiveRightsTargetSelector as Target;

/**
 * CheckRight class
 * Check if a principal has the specified right on target.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckRight extends Attr
{
    /**
     * The target
     * @var Target
     */
    private $_target;

    /**
     * The grantee
     * @var Grantee
     */
    private $_grantee;

    /**
     * The right
     * @var string
     */
    private $_right;

    /**
     * Constructor method for CheckRight
     * @param Target $target
     * @param Grantee $grantee
     * @param string $right
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        Target $target,
        Grantee $grantee,
        $right,
        array $attrs = array()
    )
    {
        parent::__construct($attrs);
        $this->_target = $target;
        $this->_grantee = $grantee;
        $this->_right = trim($right);
    }

    /**
     * Gets or sets target
     *
     * @param  Target $action
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
     * @param  Grantee $action
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
     * @param  string $action
     * @return string|self
     */
    public function right($right = null)
    {
        if(null === $right)
        {
            return $this->_right;
        }
        $this->_right = trim($right);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'right' => $this->_right,
        );
        $this->array += $this->_target->toArray();
        $this->array += $this->_grantee->toArray();
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
                  ->addChild('right', $this->_right);
        return parent::toXml();
    }
}
