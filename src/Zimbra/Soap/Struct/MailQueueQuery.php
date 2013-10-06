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
 * MailQueueQuery class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.;
 */
class MailQueueQuery
{
    /**
     * Queue name
     * @var string
     */
    private $_name;

    /**
     * To fora a queue scan, set this to 1 (true)
     * @var bool
     */
    private $_scan;

    /**
     * Maximum time to wait for the scan to complete in seconds (default 3)
     * @var int
     */
    private $_wait;

    /**
     * Query
     * @var QueueQuery
     */
    private $_query;

    /**
     * Constructor method for MailQueueQuery
     * @param  QueueQuery $query
     * @param  string $name
     * @param  bool $scan
     * @param  int $wait
     * @return self
     */
    public function __construct(QueueQuery $query, $name, $scan = null, $wait = null)
    {
        $this->_query = $query;
        $this->_name = trim($name);
        if(null !== $scan)
        {
            $this->_scan = (bool) $scan;
        }
        if(null !== $wait)
        {
            $this->_wait = (int) $wait;
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
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets or sets scan
     *
     * @param  bool $scan
     * @return bool|self
     */
    public function scan($scan = null)
    {
        if(null === $scan)
        {
            return $this->_scan;
        }
        $this->_scan = (bool) $scan;
        return $this;
    }

    /**
     * Gets or sets wait
     *
     * @param  int $wait
     * @return int|self
     */
    public function wait($wait = null)
    {
        if(null === $wait)
        {
            return $this->_wait;
        }
        $this->_wait = (int) $wait;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'queue')
    {
        $name = !empty($name) ? $name : 'queue';
        $arr = array(
            'name' => $this->_name,
        );
        $arr += $this->_query->toArray('query');
        if(is_bool($this->_scan))
        {
            $arr['scan'] = $this->_scan ? 1 : 0;
        }
        if(is_int($this->_wait))
        {
            $arr['wait'] = $this->_wait;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'queue')
    {
        $name = !empty($name) ? $name : 'queue';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('name', $this->_name)
            ->append($this->_query->toXml('query'));
        if(is_bool($this->_scan))
        {
            $xml->addAttribute('scan', $this->_scan ? 1 : 0);
        }
        if(is_int($this->_wait))
        {
            $xml->addAttribute('wait', $this->_wait);
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
