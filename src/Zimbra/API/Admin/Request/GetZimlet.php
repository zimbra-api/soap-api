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
use Zimbra\Soap\Struct\NamedElement as Zimlet;

/**
 * GetZimlet class
 * Get Zimlet.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetZimlet extends Request
{
    /**
     * Zimlet selector
     * @var Zimlet
     */
    private $_zimlet;

    /**
     * Comma separated list of attributes
     * @var string
     */
    private $_attrs;

    /**
     * Constructor method for GetZimlet
     * @param  Zimlet $zimlet
     * @param  string $attrs
     * @return self
     */
    public function __construct(Zimlet $zimlet, $attrs = null)
    {
        parent::__construct();
        $this->_zimlet = $zimlet;
		$this->_attrs = trim($attrs);
    }

    /**
     * Gets or sets zimlet
     *
     * @param  Zimlet $zimlet
     * @return Zimlet|self
     */
    public function zimlet(Zimlet $zimlet = null)
    {
        if(null === $zimlet)
        {
            return $this->_zimlet;
        }
        $this->_zimlet = $zimlet;
        return $this;
    }

    /**
     * Gets or sets attrs
     *
     * @param  string $attrs
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->_attrs;
        }
        $this->_attrs = trim($attrs);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_zimlet->toArray('zimlet');
        if(!empty($this->_attrs))
        {
            $this->array['attrs'] = $this->_attrs;
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
        $this->xml->append($this->_zimlet->toXml('zimlet'));
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        return parent::toXml();
    }
}
