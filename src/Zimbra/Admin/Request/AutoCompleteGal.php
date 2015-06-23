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
 * AutoCompleteGal request class
 * Perform an autocomplete for a name against the Global Address List.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AutoCompleteGal extends Base
{
    /**
     * Constructor method for AutoCompleteGal
     * @param  string $domain The domain.
     * @param  string $name The name to test for autocompletion
     * @param  SearchType $type Type of addresses to auto-complete on
     * @param  string $galAcctId GAL Account ID
     * @param  int    $limit An integer specifying the maximum number of results to return
     * @return self
     */
    public function __construct(
        $domain,
        $name,
        GalSearchType $type = null,
        $galAcctId = null,
        $limit = null
    )
    {
        parent::__construct();
        $this->setProperty('domain', trim($domain));
        $this->setProperty('name', trim($name));
        if($type instanceof GalSearchType)
        {
            $this->setProperty('type', $type);
        }
        if(null !== $galAcctId)
        {
            $this->setProperty('galAcctId', trim($galAcctId));
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', (int) $limit);
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
     * Gets type of addresses
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type of addresses
     *
     * @param  string $type
     * @return self
     */
    public function setAlias($type)
    {
        return $this->setProperty('type', trim($type));
    }

    /**
     * Gets type of addresses
     *
     * @return GalSearchType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type of addresses
     *
     * @param  string $type
     * @return self
     */
    public function setType(GalSearchType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets GAL account Id
     *
     * @return string
     */
    public function getGalAccountId()
    {
        return $this->getProperty('galAcctId');
    }

    /**
     * Sets GAL account Id
     *
     * @param  string $galAcctId
     * @return self
     */
    public function setGalAccountId($galAcctId)
    {
        return $this->setProperty('galAcctId', trim($galAcctId));
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
}
