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
     * @var QueueAction
     */
    private $_op;

    /**
     * By selector
     * @var QueueActionBy
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
     * @param  QueueAction $op
     * @param  QueueActionBy $by
     * @return self
     */
    public function __construct(QueueQuery $query, QueueAction $op, QueueActionBy $by)
    {
        $this->_query = $query;
        $this->_op = $op;
        $this->_by = $by;
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
     * @param  QueueAction $op
     * @return QueueAction|self
     */
    public function op(QueueAction $op = null)
    {
        if(null === $op)
        {
            return $this->_op;
        }
        $this->_op = $op;
        return $this;
    }

    /**
     * Gets or sets by
     *
     * @param  QueueActionBy $by
     * @return QueueActionBy|self
     */
    public function by(QueueActionBy $by = null)
    {
        if(null === $by)
        {
            return $this->_by;
        }
        $this->_by = $by;
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
            'op' => (string) $this->_op,
            'by' => (string) $this->_by,
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
        $xml->addAttribute('op', (string) $this->_op)
            ->addAttribute('by', (string) $this->_by)
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
