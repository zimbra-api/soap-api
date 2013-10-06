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

/**
 * GetRight class
 * Get definition of a right.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetRight extends Request
{
    /**
     * Domain - the domain name to limit the search to
     * @var string
     */
    private $_right;

    /**
     * Whether to include all attribute names in the <attrs> elements in the response if the right is meant for all attributes
     * @var bool
     */
    private $_expandAllAttrs;

    /**
     * Constructor method for GetRight
     * @param string $right
     * @param bool $expandAllAttrs
     * @return self
     */
    public function __construct($right, $expandAllAttrs = null)
    {
        parent::__construct();
        $this->_right = trim($right);
        if(null !== $expandAllAttrs)
        {
            $this->_expandAllAttrs = (bool) $expandAllAttrs;
        }
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
     * Gets or sets expandAllAttrs
     *
     * @param  bool $expandAllAttrs
     * @return bool|self
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
        $this->array = array(
            'right' => $this->_right,
        );
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
        $this->xml->addAttribute('right', $this->_right);
        if(is_bool($this->_expandAllAttrs))
        {
            $this->xml->addAttribute('expandAllAttrs', $this->_expandAllAttrs ? 1 : 0);
        }
        return parent::toXml();
    }
}
