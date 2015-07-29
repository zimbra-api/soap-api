<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * CalendarAttach struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CalendarAttach extends Base
{
    /**
     * Constructor method for CalendarAttach
     * @param  string $uri URI
     * @param  string $ct Content Type
     * @param  string $value Value. Base64 encoded binary alarrm attach data
     * @return self
     */
    public function __construct($uri = null, $ct = null, $value = null)
    {
        parent::__construct(trim($value));
        if(null !== $uri)
        {
            $this->setProperty('uri', trim($uri));
        }
        if(null !== $ct)
        {
            $this->setProperty('ct', trim($ct));
        }
    }

    /**
     * Gets uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->getProperty('uri');
    }

    /**
     * Sets uri
     *
     * @param  string $uri
     * @return self
     */
    public function setUri($uri)
    {
        return $this->setProperty('uri', trim($uri));
    }

    /**
     * Gets content type
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->getProperty('ct');
    }

    /**
     * Sets content type
     *
     * @param  string $ct
     * @return self
     */
    public function setContentType($ct)
    {
        return $this->setProperty('ct', trim($ct));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'attach')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'attach')
    {
        return parent::toXml($name);
    }
}
