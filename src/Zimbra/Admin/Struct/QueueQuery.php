<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * QueueQuery struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class QueueQuery extends Base
{
    /**
     * Queue query field
     * @var TypedSequence
     */
    private $_fields;

    /**
     * Constructor method for QueueQuery
     * @param  array $fields Queue query field
     * @param  int $limit Limit the number of queue items to return in the response
     * @param  int $offset Offset
     * @return self
     */
    public function __construct(array $fields = [], $limit = null, $offset = null)
    {
        parent::__construct();
        $this->setFields($fields);
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->setProperty('offset', (int) $offset);
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->getFields()->count())
            {
                $sender->setChild('field', $sender->getFields()->all());
            }
        });
    }

    /**
     * Add a field
     *
     * @param  QueueQueryField $field
     * @return self
     */
    public function addField(QueueQueryField $field)
    {
        $this->_fields->add($field);
        return $this;
    }

    /**
     * Sets field sequence
     *
     * @param  array $fields
     * @return self
     */
    public function setFields(array $fields)
    {
        $this->_fields = new TypedSequence('Zimbra\Admin\Struct\QueueQueryField', $fields);
        return $this;
    }

    /**
     * Gets field sequence
     *
     * @return Sequence
     */
    public function getFields()
    {
        return $this->_fields;
    }

    /**
     * Gets the limit
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->getProperty('limit');
    }

    /**
     * Sets the limit
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit($limit)
    {
        return $this->setProperty('limit', (int) $limit);
    }

    /**
     * Gets the offset
     *
     * @return int
     */
    public function getOffset()
    {
        return $this->getProperty('offset');
    }

    /**
     * Sets the offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset($offset)
    {
        return $this->setProperty('offset', (int) $offset);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'query')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'query')
    {
        return parent::toXml($name);
    }
}