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

use Zimbra\Soap\Struct\DistributionListGranteeSelector as GranteeSelector;
use Zimbra\Utils\SimpleXML;
use Zimbra\Utils\TypedSequence;

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
     * @var string
     */
    private $_right;
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
        $this->_right = trim($right);
        $this->_grantee = new TypedSequence(
            'Zimbra\Soap\Struct\DistributionListGranteeSelector', $grantees
        );
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
     * @return array
     */
    public function toArray($name = 'right')
    {
        $name = !empty($name) ? $name : 'right';
        $arr = array(
            'right' => $this->_right,
        );
        if(count($this->_grantee))
        {
            $arr['grantee'] = array();
            foreach ($this->_grantee as $grantee)
            {
                $granteeArr = $grantee->toArray('grantee');
                $arr['grantee'][] = $granteeArr['grantee'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'right')
    {
        $name = !empty($name) ? $name : 'right';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('right', $this->_right);
        foreach ($this->_grantee as $grantee)
        {
            $xml->append($grantee->toXml('grantee'));
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
