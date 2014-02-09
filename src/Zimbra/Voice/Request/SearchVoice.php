<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Request;

use Zimbra\Enum\VoiceSortBy;
use Zimbra\Voice\Struct\ResetPhoneVoiceFeaturesSpec;
use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * SearchVoice request class
 * Search voice messages and call logs.
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SearchVoice extends Base
{
    /**
     * Constructor method for SearchVoice
     * @param  string $query
     * @param  StorePrincipalSpec $storeprincipal
     * @return self
     */
    public function __construct(
    	$query,
        StorePrincipalSpec $storeprincipal = null,
        $limit = null,
        $offset = null,
        $types = null,
        VoiceSortBy $sortBy = null
    )
    {
        parent::__construct();
        $this->property('query', trim($query));
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->child('storeprincipal', $storeprincipal);
        }
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
        }
        if(null !== $types)
        {
            $this->property('types', trim($types));
        }
        if($sortBy instanceof VoiceSortBy)
        {
            $this->property('sortBy', $sortBy);
        }
    }

    /**
     * Gets or sets query
     *
     * @param  string $query
     * @return string|self
     */
    public function query($query = null)
    {
        if(null === $query)
        {
            return $this->property('query');
        }
        return $this->property('query', trim($query));
    }

    /**
     * Gets or sets storeprincipal
     * Store Principal specification
     *
     * @param  StorePrincipalSpec $storeprincipal
     * @return StorePrincipalSpec|self
     */
    public function storeprincipal(StorePrincipalSpec $storeprincipal = null)
    {
        if(null === $storeprincipal)
        {
            return $this->child('storeprincipal');
        }
        return $this->child('storeprincipal', $storeprincipal);
    }

    /**
     * Gets or sets limit
     * The maximum number of results to return. It defaults to 10 if not specified, and is capped by 1000
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
     * Specifies the 0-based offset into the results list to return as the first result for this search operation. 
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
     * Gets or sets types
     * Comma-separated list of search types. Legal values are: voicemail|calllog
     * (default is "voicemail")
     *
     * @param  string $types
     * @return string|self
     */
    public function types($types = null)
    {
        if(null === $types)
        {
            return $this->property('types');
        }
        return $this->property('types', trim($types));
    }

    /**
     * Gets or sets sortBy
     * Sort by: dateDesc|dateAsc|durDesc|durAsc|nameDesc|nameAsc [default:"dateDesc"] 
     *
     * @param  VoiceSortBy $sortBy
     * @return VoiceSortBy|self
     */
    public function sortBy(VoiceSortBy $sortBy = null)
    {
        if(null === $sortBy)
        {
            return $this->property('sortBy');
        }
        return $this->property('sortBy', $sortBy);
    }
}
