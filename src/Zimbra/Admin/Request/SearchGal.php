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
        $this->property('domain', trim($domain));
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if($type instanceof GalSearchType)
        {
            $this->property('type', $type);
        }
        if(null !== $galAcctId)
        {
            $this->property('galAcctId', trim($galAcctId));
        }
    }
    /**
     * Gets or sets domain
     *
     * @param  string $domain
     * @return string|self
     */
    public function domain($domain = null)
    {
        if(null === $domain)
        {
            return $this->property('domain');
        }
        return $this->property('domain', trim($domain));
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
            return $this->property('name');
        }
        return $this->property('name', trim($name));
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
     * Gets or sets type
     *
     * @param  GalSearchType $type
     * @return GalSearchType|self
     */
    public function type(GalSearchType $type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', $type);
    }

    /**
     * Gets or sets galAcctId
     *
     * @param  string $galAcctId
     * @return string|self
     */
    public function galAcctId($galAcctId = null)
    {
        if(null === $galAcctId)
        {
            return $this->property('galAcctId');
        }
        return $this->property('galAcctId', trim($galAcctId));
    }
}
