<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * DistributionListRightSpec class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DistributionListRightSpec
{
    /**
     * The right
     * - use : required
     * @var string
     */
    private $_right;
    /**
     * The array of grantee
     * - minOccurs : 0
     * @var array
     */
    private $_grantees = array();

    /**
     * Constructor method for DistributionListRightSpec
     * @param string $right
     * @param array $grantees
     * @return self
     */
    public function __construct($right, array $grantees = array())
    {
        $this->_right = trim($right);
        $this->grantees($grantees);
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
            return $this->_right;
        }
        $this->_right = trim($right);
        return $this;
    }

    /**
     * Add a grantee
     *
     * @param  DistributionListGranteeSelector $grantee
     * @return DistributionListRightSpec
     */
    public function addGrantee(DistributionListGranteeSelector $grantee)
    {
        $this->_grantees[] = $grantee;
        return $this;
    }

    /**
     * Get grantee array
     *
     * @return array
     */
    public function grantees(array $grantees = null)
    {
        if(null === $grantees)
        {
            return $this->_grantees;
        }
        $this->_grantees = array();
        foreach ($grantees as $grantee)
        {
            if($grantee instanceof DistributionListGranteeSelector)
            {
                $this->_grantees[] = $grantee;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $arr = array(
            'right' => $this->_right,
        );
        if(count($this->_grantees))
        {
            $arr['grantee'] = array();
            foreach ($this->_grantees as $grantee)
            {
                $granteeArr = $grantee->toArray('grantee');
                $arr['grantee'][] = $granteeArr['grantee'];
            }
        }
        return array('right' => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<right />');
        $xml->addAttribute('right', $this->_right);
        if(count($this->_grantees))
        {
            foreach ($this->_grantees as $grantee)
            {
                $xml->append($grantee->toXml('grantee'));
            }
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
