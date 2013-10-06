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

/**
 * GetGrants class
 * Returns all grants on the specified target entry, or all grants granted to the specified grantee entry.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetGrants extends Request
{
    /**
     * Target
     * @var Target
     */
    private $_target;

    /**
     * Grantee
     * @var Grantee
     */
    private $_grantee;

    /**
     * Constructor method for GetGrants
     * @param  Target $target
     * @param  Grantee $grantee
     * @return self
     */
    public function __construct(Target $target = null, Grantee $grantee = null)
    {
        parent::__construct();
        if($target instanceof Target)
        {
            $this->_target = $target;
        }
        if($grantee instanceof Grantee)
        {
            $this->_grantee = $grantee;
        }
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_target instanceof Target)
        {
            $this->array += $this->_target->toArray();
        }
        if($this->_grantee instanceof Grantee)
        {
            $this->array += $this->_grantee->toArray();
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if($this->_target instanceof Target)
        {
            $this->xml->append($this->_target->toXml());
        }
        if($this->_grantee instanceof Grantee)
        {
            $this->xml->append($this->_grantee->toXml());
        }
        return parent::toXml();
    }
}
