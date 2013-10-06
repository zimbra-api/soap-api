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
use Zimbra\Soap\Struct\GranteeSelector as Grantee;

/**
 * GetAllEffectiveRights class
 * Get all effective Admin rights.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllEffectiveRights extends Request
{
    /**
     * Flags whether to include all attribute names if the right is meant for all attributes
     * @var bool
     */
    private $_expandAllAttrs;

    /**
     * Grantee
     * @var Grantee
     */
    private $_grantee;

    /**
     * Constructor method for GetAllEffectiveRights
     * @param  Grantee $grantee
     * @param  bool $expandAllAttrs
     * @return self
     */
    public function __construct(Grantee $grantee = null, $expandAllAttrs = null)
    {
        parent::__construct();
        if($grantee instanceof Grantee)
        {
            $this->_grantee = $grantee;
        }
        if(null !== $expandAllAttrs)
        {
            $this->_expandAllAttrs = (bool) $expandAllAttrs;
        }
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
     * Gets or sets expandAllAttrs
     *
     * @param  string $expandAllAttrs
     * @return string|self
     */
    public function expandAllAttrs($expandAllAttrs = null)
    {
        if(null === $expandAllAttrs)
        {
            return $this->_expandAllAttrs;
        }
        $this->_expandAllAttrs = (bool) $expandAllAttrs;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_grantee instanceof Grantee)
        {
            $this->array += $this->_grantee->toArray();
        }
        if(is_bool($this->_expandAllAttrs))
        {
            $this->array['expandAllAttrs'] = $this->_expandAllAttrs ? 1 : 0;
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
        if($this->_grantee instanceof Grantee)
        {
            $this->xml->append($this->_grantee->toXml());
        }
        if(!empty($this->_expandAllAttrs))
        {
            $this->xml->addAttribute('expandAllAttrs', $this->_expandAllAttrs ? 1 : 0);
        }
        return parent::toXml();
    }
}
