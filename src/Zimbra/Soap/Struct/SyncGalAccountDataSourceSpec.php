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
 * SyncGalAccountDataSourceSpec class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SyncGalAccountDataSourceSpec
{
    /**
     * The by
     * @var string
     */
    private $_by;

    /**
     * The value
     * @var string
     */
    private $_value;

    /**
     * If fullSync is set to 0 (false) or unset the default behavior is trickle sync which will pull in any new contacts or modified contacts since last sync.
     * If fullSync is set to 1 (true), then the server will go through all the contacts that appear in GAL, and resolve deleted contacts in addition to new or modified ones.
     * @var boolean
     */
    private $_fullSync;

    /**
     * Reset flag.
     * If set, then all the contacts will be populated again, regardless of the status since last sync.
     * Reset needs to be done when there is a significant change in the configuration, such as filter, attribute map, or search base.
     * @var boolean
     */
    private $_reset;

    /**
     * Constructor method for SyncGalAccountDataSourceSpec
     * @param string $by
     * @param string $value
     * @param bool $fullSync
     * @param bool $reset
     * @return self
     */
    public function __construct(
        $by,
        $value = null,
        $fullSync = null,
        $reset = null
    )
    {
        if(in_array(trim($by), array('id', 'name')))
        {
            $this->_by = trim($by);
        }
        $this->_value = trim($value);
        if(null !== $fullSync)
        {
            $this->_fullSync = (bool) $fullSync;
        }
        if(null !== $fullSync)
        {
            $this->_reset = (bool) $reset;
        }
    }

    /**
     * Gets or sets by
     *
     * @param  string $by
     * @return string|self
     */
    public function by($by = null)
    {
        if(null === $by)
        {
            return $this->_by;
        }
        if(in_array(trim($by), array('id', 'name')))
        {
            $this->_by = trim($by);
        }
        return $this;
    }

    /**
     * Gets or sets value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->_value;
        }
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Gets or sets fullSync
     *
     * @param  bool $fullSync
     * @return bool|self
     */
    public function fullSync($fullSync = null)
    {
        if(null === $fullSync)
        {
            return $this->_fullSync;
        }
        $this->_fullSync = (bool) $fullSync;
        return $this;
    }

    /**
     * Gets or sets reset
     *
     * @param  bool $reset
     * @return bool|self
     */
    public function reset($reset = null)
    {
        if(null === $reset)
        {
            return $this->_reset;
        }
        $this->_reset = (bool) $reset;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'datasource')
    {
        $name = !empty($name) ? $name : 'datasource';
        $arr = array(
            'by' => $this->_by,
            '_' => $this->_value,
        );
        if(is_bool($this->_fullSync))
        {
            $arr['fullSync'] = $this->_fullSync ? 1: 0;
        }
        if(is_bool($this->_reset))
        {
            $arr['reset'] = $this->_reset ? 1: 0;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'datasource')
    {
        $name = !empty($name) ? $name : 'datasource';
        $xml = new SimpleXML('<'.$name.'>'.$this->_value.'</'.$name.'>');
        $xml->addAttribute('by', $this->_by);
        if(is_bool($this->_fullSync))
        {
            $xml->addAttribute('fullSync', $this->_fullSync ? 1: 0);
        }
        if(is_bool($this->_reset))
        {
            $xml->addAttribute('reset', $this->_reset ? 1: 0);
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
