<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Enum\GalSearchType;

/**
 * SearchGal request class
 * Search Global Address Book (GAL).
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchGal extends Base
{
    /**
     * Constructor method for SearchGal
     * @param string $domain Domain name.
     * @param string $name Name
     * @param int $limit The maximum number of entries to return (0 is default and means all)
     * @param GalSearchType $type Type of addresses to search. Valid values: all|account|resource|group.
     * @param string $galAcctId GAL account ID.
     * @return self
     */
    public function __construct(
        $domain,
        $name = null,
        $limit = null,
        GalSearchType $type = null,
        $galAcctId = null
    )
    {
        parent::__construct();
        $this->setProperty('domain', trim($domain));
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
        }
        if($type instanceof GalSearchType)
        {
            $this->setProperty('type', $type);
        }
        if(null !== $galAcctId)
        {
            $this->setProperty('galAcctId', trim($galAcctId));
        }
    }


    /**
     * Gets domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->getProperty('domain');
    }

    /**
     * Sets domain
     *
     * @param  string $domain
     * @return self
     */
    public function setDomain($domain)
    {
        return $this->setProperty('domain', trim($domain));
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets limit
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->getProperty('limit');
    }

    /**
     * Sets limit
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit($limit)
    {
        return $this->setProperty('limit', (int) $limit);
    }

    /**
     * Gets type
     *
     * @return GalSearchType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type
     *
     * @param  GalSearchType $type
     * @return self
     */
    public function setType(GalSearchType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets galAcctId
     *
     * @return string
     */
    public function getGalAccounttId()
    {
        return $this->getProperty('galAcctId');
    }

    /**
     * Sets galAcctId
     *
     * @param  string $galAcctId
     * @return self
     */
    public function setGalAccounttId($galAcctId)
    {
        return $this->setProperty('galAcctId', trim($galAcctId));
    }
}
