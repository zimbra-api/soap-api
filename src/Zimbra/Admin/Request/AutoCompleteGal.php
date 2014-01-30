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

use Zimbra\Soap\Request;
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
class AutoCompleteGal extends Request
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
        $this->property('domain', trim($domain));
        $this->property('name', trim($name));
        if($type instanceof GalSearchType)
        {
            $this->property('type', $type);
        }
        if(null !== $galAcctId)
        {
            $this->property('galAcctId', trim($galAcctId));
        }
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
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
}
