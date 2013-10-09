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
use Zimbra\Soap\Enum\GetSessionsSortBy;

/**
 * GetSessions class
 * Get Sessions.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetSessions extends Request
{
    /**
     * Type - valid values soap|imap|admin
     * @var string
     */
    private $_type;

    /**
     * The sortBy
     * @var string
     */
    private $_sortBy;

    /**
     * Offset - the starting offset (0, 25, etc)
     * @var long
     */
    private $_offset;

    /**
     * Limit - the number of sessions to return per page (0 is default and means all)
     * @var long
     */
    private $_limit;

    /**
     * Refresh. If 1 (true), ignore any cached results and start fresh.
     * @var bool
     */
    private $_refresh;

    /**
     * Constructor method for GetSessions
     * @param string $type
     * @param string $sortBy
     * @param int $limit
     * @param int $offset
     * @param bool $refresh
     * @return self
     */
    public function __construct(
        $type,
        $sortBy = null,
        $limit = null,
        $offset = null,
        $refresh = null
    )
    {
        parent::__construct();
        if(in_array(trim($type), array('soap', 'imap', 'admin')))
        {
            $this->_type = trim($type);
        }
        else
        {
            $this->_type = 'imap';
        }
        if(GetSessionsSortBy::isValid(trim($sortBy)))
        {
            $this->_sortBy = trim($sortBy);
        }
        if(null !== $limit)
        {
            $this->_limit = (int) $limit;
        }
        if(null !== $offset)
        {
            $this->_offset = (int) $offset;
        }
        if(null !== $refresh)
        {
            $this->_refresh = (bool) $refresh;
        }
    }

    /**
     * Gets or sets type
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        if(in_array(trim($type), array('soap', 'imap', 'admin')))
        {
            $this->_type = trim($type);
        }
        else
        {
            $this->_type = 'imap';
        }
        return $this;
    }

    /**
     * Gets or sets sortBy
     *
     * @param  string $sortBy
     * @return string|self
     */
    public function sortBy($sortBy = null)
    {
        if(null === $sortBy)
        {
            return $this->_sortBy;
        }
        if(GetSessionsSortBy::isValid(trim($sortBy)))
        {
            $this->_sortBy = trim($sortBy);
        }
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
     * Gets or sets refresh
     *
     * @param  bool $refresh
     * @return bool|self
     */
    public function refresh($refresh = null)
    {
        if(null === $refresh)
        {
            return $this->_refresh;
        }
        $this->_refresh = (bool) $refresh;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'type' => $this->_type,
        );
        if(!empty($this->_sortBy))
        {
            $this->array['sortBy'] = $this->_sortBy;
        }
        if(is_int($this->_limit))
        {
            $this->array['limit'] = $this->_limit;
        }
        if(is_int($this->_offset))
        {
            $this->array['offset'] = $this->_offset;
        }
        if(is_bool($this->_refresh))
        {
            $this->array['refresh'] = $this->_refresh ? 1 : 0;
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
        $this->xml->addAttribute('type', $this->_type);
        if(!empty($this->_sortBy))
        {
            $this->xml->addAttribute('sortBy', $this->_sortBy);
        }
        if(is_int($this->_limit))
        {
            $this->xml->addAttribute('limit', $this->_limit);
        }
        if(is_int($this->_offset))
        {
            $this->xml->addAttribute('offset', $this->_offset);
        }
        if(is_bool($this->_refresh))
        {
            $this->xml->addAttribute('refresh', $this->_refresh ? 1 : 0);
        }
        return parent::toXml();
    }
}
