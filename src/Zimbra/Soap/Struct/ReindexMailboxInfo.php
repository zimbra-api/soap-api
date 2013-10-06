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
 * ReindexMailboxInfo class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ReindexMailboxInfo
{
    /**
     * Account ID
     * @var string
     */
    private $_id;

    /**
     * Comma separated list of types. Legal values are:
     * conversation|message|contact|appointment|task|note|wiki|document
     * @var string
     */
    private $_types;

    /**
     * Comma separated list of IDs to re-index
     * @var string
     */
    private $_ids;

    /**
     * Valid types
     * @var array
     */
    private static $_validTypes = array(
        'conversation',
        'message',
        'contact',
        'appointment',
        'task',
        'note',
        'wiki',
        'document'
    );

    /**
     * Constructor method for ReindexMailboxInfo
     * @param string $id
     * @param string $types
     * @param string $ids
     * @return self
     */
    public function __construct($id, $types = null, $ids = null)
    {
        $this->_id = trim($id);
        if(null !== $types)
        {
            $arrType = array();
            foreach (explode(',', trim($types)) as $value)
            {
                if(in_array(trim($value), self::$_validTypes))
                {
                    $arrType[] = trim($value);
                }
            }
            $this->_types = implode(',', $arrType);
        }
        $this->_ids = trim($ids);
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets or sets types
     *
     * @param  string $types
     * @return string|self
     */
    public function types($types = null)
    {
        if(null === $types)
        {
            return $this->_types;
        }
        $arrType = array();
        foreach (explode(',', trim($types)) as $value)
        {
            if(in_array(trim($value), self::$_validTypes))
            {
                $arrType[] = trim($value);
            }
        }
        $this->_types = implode(',', $arrType);
        return $this;
    }

    /**
     * Gets or sets ids
     *
     * @param  string $ids
     * @return string|self
     */
    public function ids($ids = null)
    {
        if(null === $ids)
        {
            return $this->_ids;
        }
        $this->_ids = trim($ids);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'mbox')
    {
        $name = !empty($name) ? $name : 'mbox';
        $arr = array(
            'id' => $this->_id,
        );
        if(!empty($this->_types))
        {
            $arr['types'] = $this->_types;
        }
        if(!empty($this->_ids))
        {
            $arr['ids'] = $this->_ids;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'mbox')
    {
        $name = !empty($name) ? $name : 'mbox';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id);
        if(!empty($this->_types))
        {
            $xml->addAttribute('types', $this->_types);
        }
        if(!empty($this->_ids))
        {
            $xml->addAttribute('ids', $this->_ids);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
