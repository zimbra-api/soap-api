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
use Zimbra\Soap\Struct\CalendarResourceSelector as Calendar;

/**
 * GetCalendarResource class
 * Get a calendar resource.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetCalendarResource extends Request
{
    /**
     * Flag whether to apply Class of Service (COS)
     * @var bool
     */
    private $_applyCos;

    /**
     * Comma separated list of attributes
     * @var string
     */
    private $_attrs;

    /**
     * Specify calendar resource
     * @var Calendar
     */
    private $_calResource;

    /**
     * Constructor method for GetCalendarResource
     * @param  Calendar $calResource
     * @param  bool $applyCos
     * @param  string $attrs
     * @return self
     */
    public function __construct(Calendar $calResource = null, $applyCos = null, $attrs = null)
    {
        parent::__construct();
        if($calResource instanceof Calendar)
        {
            $this->_calResource = $calResource;
        }
        if(null !== $applyCos)
        {
            $this->_applyCos = (bool) $applyCos;
        }
		$this->_attrs = trim($attrs);
    }

    /**
     * Gets or sets calResource
     *
     * @param  Calendar $calResource
     * @return Calendar|self
     */
    public function calResource(Calendar $calResource = null)
    {
        if(null === $calResource)
        {
            return $this->_calResource;
        }
        $this->_calResource = $calResource;
        return $this;
    }

    /**
     * Gets or sets applyCos
     *
     * @param  bool $applyCos
     * @return bool|self
     */
    public function applyCos($applyCos = null)
    {
        if(null === $applyCos)
        {
            return $this->_applyCos;
        }
        $this->_applyCos = (bool) $applyCos;
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
        if($this->_calResource instanceof Calendar)
        {
            $this->array += $this->_calResource->toArray();
        }
        if(is_bool($this->_applyCos))
        {
            $this->array['applyCos'] = $this->_applyCos ? 1 : 0;
        }
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
        if($this->_calResource instanceof Calendar)
        {
            $this->xml->append($this->_calResource->toXml());
        }
        if(is_bool($this->_applyCos))
        {
            $this->xml->addAttribute('applyCos', $this->_applyCos ? 1 : 0);
        }
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        return parent::toXml();
    }
}
