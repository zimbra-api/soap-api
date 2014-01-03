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
 * ICalReply request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ICalReply extends Request
{
    /**
     * iCalendar text containing components with method REPLY
     * @var string
     */
    private $_ical;

    /**
     * Constructor method for ICalReply
     * @param  string $ical
     * @return self
     */
    public function __construct($ical)
    {
        parent::__construct();
        $this->_ical = trim($ical);
    }

    /**
     * Gets or sets ical
     *
     * @param  string $ical
     * @return string|self
     */
    public function ical($ical = null)
    {
        if(null === $ical)
        {
            return $this->_ical;
        }
        $this->_ical = trim($ical);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array['ical'] = $this->_ical;
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addChild('ical', $this->_ical);
        return parent::toXml();
    }
}
