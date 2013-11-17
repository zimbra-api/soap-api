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
use Zimbra\Soap\Enum\EntryType;
use Zimbra\Utils\TypedSequence;

/**
 * GetAttributeInfo class
 * Get attribute information.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAttributeInfo extends Request
{
    /**
     * Comma separated list of attributes to return
     * @var string
     */
    private $_attrs;

    /**
     * Comma separated list of entry types
     * Attributes on the specified entry types will be returned.
     * @var string
     */
    private $_entryTypes;

    /**
     * Constructor method for GetAttributeInfo
     * @param  string $attrs
     * @param  string $entryTypes
     * @return self
     */
    public function __construct($attrs = null, array $entryTypes = array())
    {
        parent::__construct();
        $this->_attrs = trim($attrs);
        $this->_entryTypes = new TypedSequence('Zimbra\Soap\Enum\EntryType', $entryTypes);
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
     * Add an EntryType
     *
     * @param  EntryType $entryType
     * @return self
     */
    public function addEntryType(EntryType $entryType)
    {
        $this->_entryTypes->add($entryType);
        return $this;
    }

    /**
     * Gets entryType sequence
     *
     * @return Sequence
     */
    public function entryTypes()
    {
        return $this->_entryTypes;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_attrs))
        {
            $this->array['attrs'] = $this->_attrs;
        }
        if(count($this->_entryTypes))
        {
            $entryTypes = implode(',', $this->_entryTypes->all());
            $this->array['entryTypes'] = $entryTypes;
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
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        if(count($this->_entryTypes))
        {
            $entryTypes = implode(',', $this->_entryTypes->all());
            $this->xml->addAttribute('entryTypes', $entryTypes);
        }
        return parent::toXml();
    }
}
