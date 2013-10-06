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
use Zimbra\Soap\Enum\QueueAction;
use Zimbra\Soap\Enum\QueueActionBy;

/**
 * MailQueueAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.;
 */
class MailQueueAction
{
    /**
     * Operation
     * @var string
     */
    private $_op;

    /**
     * By selector
     * @var string
     */
    private $_by;

    /**
     * Query
     * @var QueueQuery
     */
    private $_query;

    /**
     * Constructor method for MailQueueAction
     * @param  QueueQuery $query
     * @param  string $op
     * @param  string $by
     * @return self
     */
    public function __construct(QueueQuery $query, $op, $by)
    {
        $this->_query = $query;
        if(QueueAction::isValid(trim($op)))
        {
            $this->_op = trim($op);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid operation');
        }
        if(QueueActionBy::isValid(trim($by)))
        {
            $this->_by = trim($by);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid by selector');
        }
    }

    /**
     * Gets or sets query
     *
     * @param  QueueQuery $query
     * @return QueueQuery|self
     */
    public function query($query = null)
    {
        if(null === $query)
        {
            return $this->_query;
        }
        $this->_query = $query;
        return $this;
    }

    /**
     * Gets or sets op
     *
     * @param  string $op
     * @return string|self
     */
    public function op($op = null)
    {
        if(null === $op)
        {
            return $this->_op;
        }
        if(QueueAction::isValid(trim($op)))
        {
            $this->_op = trim($op);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid operation');
        }
        return $this;
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
        if(QueueActionBy::isValid(trim($by)))
        {
            $this->_by = trim($by);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid by selector');
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $arr = array(
            'op' => $this->_op,
            'by' => $this->_by,
        );
        $arr += $this->_query->toArray('query');
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('op', $this->_op)
            ->addAttribute('by', $this->_by)
            ->append($this->_query->toXml('query'));
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
