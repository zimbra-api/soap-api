<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;

/**
 * SendDeliveryReport request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SendDeliveryReport extends Request
{
    /**
     * Message ID
     * @var string
     */
    private $_mid;

    /**
     * Constructor method for SendDeliveryReport
     * @param  string $mid
     * @return self
     */
    public function __construct($mid)
    {
        parent::__construct();
        $this->_mid = trim($mid);
    }

    /**
     * Get or set mid
     *
     * @param  string $mid
     * @return string|self
     */
    public function mid($mid = null)
    {
        if(null === $mid)
        {
            return $this->_mid;
        }
        $this->_mid = trim($mid);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array['mid'] = $this->_mid;
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
    	$this->xml->addAttribute('mid', $this->_mid);
        return parent::toXml();
    }
}
