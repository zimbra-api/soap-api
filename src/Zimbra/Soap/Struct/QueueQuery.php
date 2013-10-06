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
 * QueueQuery class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class QueueQuery
{
    /**
     * Queue query field
     * @var array
     */
    private $_fields = array();

    /**
     * Limit the number of queue items to return in the response
     * @var int
     */
    private $_limit;

    /**
     * Offset
     * @var int
     */
    private $_offset;

    /**
     * Constructor method for QueueQuery
     * @param  array $fields
     * @param  int $limit
     * @param  int $offset
     * @return self
     */
    public function __construct(array $fields = array(), $limit = null, $offset = null)
    {
        $this->fields($fields);
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
        if(null !== $offset)
        {
            $this->_offset = (int) $offset;
        }
    }

    /**
     * Add a field
     *
     * @param  QueueQueryField $field
     * @return self
     */
    public function addField(QueueQueryField $field)
    {
        $this->_fields[] = $field;
        return $this;
    }

    /**
     * Gets or sets fields array
     *
     * @param  array $fields
     * @return array|self
     */
    public function fields(array $fields = null)
    {
        if(null === $fields)
        {
            return $this->_fields;
        }
        $this->_fields = array();
        foreach ($fields as $field)
        {
            if($field instanceof QueueQueryField)
            {
                $this->_fields[] = $field;
            }
        }
        return $this;
    }

    /**
     * Gets or sets limit
     *
     * @param  int $limit
     * @return int|self
     */
    public function limit($limit = null)
    {
        if(null === $limit)
        {
            return $this->_limit;
        }
        $this->_limit = (int) $limit;
        return $this;
    }

    /**
     * Gets or sets offset
     *
     * @param  int $offset
     * @return int|self
     */
    public function offset($offset = null)
    {
        if(null === $offset)
        {
            return $this->_offset;
        }
        $this->_offset = (int) $offset;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'query')
    {
        $name = !empty($name) ? $name : 'query';
        $arr = array();
        if(count($this->_fields))
        {
            $arr['field'] = array();
            foreach ($this->_fields as $field)
            {
                $fieldArr = $field->toArray('field');
                $arr['field'][] = $fieldArr['field'];
            }
        }
        if(is_int($this->_limit))
        {
            $arr['limit'] = $this->_limit;
        }
        if(is_int($this->_offset))
        {
            $arr['offset'] = $this->_offset;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'query')
    {
        $name = !empty($name) ? $name : 'query';
        $xml = new SimpleXML('<'.$name.' />');
        foreach ($this->_fields as $field)
        {
            $xml->append($field->toXml('field'));
        }
        if(is_int($this->_limit))
        {
            $xml->addAttribute('limit', $this->_limit);
        }
        if(is_int($this->_offset))
        {
            $xml->addAttribute('offset', $this->_offset);
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