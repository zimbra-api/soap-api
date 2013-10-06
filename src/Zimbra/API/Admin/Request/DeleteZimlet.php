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
 * DeleteZimlet class
 * Delete a Zimlet.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteZimlet extends Request
{
    /**
     * Search task information
     * @var Zimlet
     */
    private $_zimlet;

    /**
     * Constructor method for DeleteZimlet
     * @param Zimlet $zimlet
     * @return self
     */
    public function __construct(Zimlet $zimlet)
    {
        parent::__construct();
        $this->_zimlet = $zimlet;
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_zimlet->toArray('zimlet');
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
        return parent::toXml();
    }
}
