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

use Zimbra\Soap\Enum\ZimletStatus;
use Zimbra\Utils\SimpleXML;

/**
 * ZimletPrefsSpec class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ZimletPrefsSpec
{
    /**
     * Zimlet name
     * @var string
     */
    private $_name;

    /**
     * Zimlet presence setting
     * Valid values : "enabled" | "disabled"
     * @var ZimletStatus
     */
    private $_presence;

    /**
     * Constructor method for ZimletPrefsSpec
     * @param  string $name
     * @param  ZimletStatus $presence
     * @return self
     */
    public function __construct($name, ZimletStatus $presence)
    {
        $this->_name = trim($name);
        $this->_presence = $presence;
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets or sets presence
     *
     * @param  ZimletStatus $presence
     * @return ZimletStatus|self
     */
    public function presence(ZimletStatus $presence = null)
    {
        if(null === $presence)
        {
            return $this->_presence;
        }
        $this->_presence = $presence;
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
            'name' => $this->_name,
            'presence' => (string) $this->_presence,
        );
        return array('zimlet' => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<zimlet />');
        $xml->addAttribute('name', $this->_name)
            ->addAttribute('presence', (string) $this->_presence);
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
