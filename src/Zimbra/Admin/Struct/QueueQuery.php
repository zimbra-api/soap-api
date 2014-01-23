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
    private $_field;

    /**
     * Constructor method for QueueQuery
     * @param  array $fields Queue query field
     * @param  int $limit Limit the number of queue items to return in the response
     * @param  int $offset Offset
     * @return self
     */
    public function __construct(array $fields = array(), $limit = null, $offset = null)
    {
        parent::__construct();
        $this->_field = new TypedSequence('Zimbra\Admin\Struct\QueueQueryField', $fields);
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
        }

        $this->addHook(function($sender)
        {
            $sender->child('field', $sender->field()->all());
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
        $this->_field->add($field);
        return $this;
    }

    /**
     * Gets field sequence
     *
     * @return Sequence
     */
    public function field()
    {
        return $this->_field;
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
            return $this->property('limit');
        }
        return $this->property('limit', (int) $limit);
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
            return $this->property('offset');
        }
        return $this->property('offset', (int) $offset);
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