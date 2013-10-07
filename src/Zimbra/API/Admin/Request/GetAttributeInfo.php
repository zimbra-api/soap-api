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
     * Valid entry types
     * @var array
     */
    private static $_validTypes = array(
        'account',
        'alias',
        'distributionList',
        'cos',
        'globalConfig',
        'domain',
        'server',
        'mimeEntry',
        'zimletEntry',
        'calendarResource',
        'identity,dataSource',
        'pop3DataSource',
        'imapDataSource',
        'rssDataSource',
        'liveDataSource',
        'galDataSource',
        'signature',
        'xmppComponent',
        'aclTarget'
    );

    /**
     * Constructor method for GetAttributeInfo
     * @param  string $attrs
     * @param  string $entryTypes
     * @return self
     */
    public function __construct($attrs = null, $entryTypes = null)
    {
        parent::__construct();
        $this->_attrs = trim($attrs);
        if(null !== $entryTypes)
        {
            $entryTypes = explode(',', $entryTypes);
            $types = array();
            foreach ($entryTypes as $type)
            {
                if(in_array(trim($type), self::$_validTypes))
                {
                    $types[] = trim($type);
                }
            }
            $this->_entryTypes = implode(',', $types);
        }
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
     * Gets or sets entryTypes
     *
     * @param  string $entryTypes
     * @return string|self
     */
    public function entryTypes($entryTypes = null)
    {
        if(null === $entryTypes)
        {
            return $this->_entryTypes;
        }
        $entryTypes = explode(',', $entryTypes);
        $types = array();
        foreach ($entryTypes as $type)
        {
            if(in_array(trim($type), self::$_validTypes))
            {
                $types[] = trim($type);
            }
        }
		$this->_entryTypes = implode(',', $types);
        return $this;
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
        if(!empty($this->_entryTypes))
        {
            $this->array['entryTypes'] = $this->_entryTypes;
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
        if(!empty($this->_entryTypes))
        {
            $this->xml->addAttribute('entryTypes', $this->_entryTypes);
        }
        return parent::toXml();
    }
}
