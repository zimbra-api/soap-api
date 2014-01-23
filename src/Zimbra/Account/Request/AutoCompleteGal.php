<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Enum\GalSearchType as SearchType;
use Zimbra\Soap\Request;

/**
 * AutoCompleteGal request class
 * Perform an autocomplete for a name against the Global Address List.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AutoCompleteGal extends Request
{
    /**
     * Constructor method for AutoCompleteGal
     * @param  string $name The name to test for autocompletion
     * @param  bool   $needExp Flag whether the {exp} flag is needed in the response for group entries.
     * @param  string $type Type of addresses to auto-complete on
     * @param  string $galAcctId GAL Account ID
     * @param  int    $limit An integer specifying the maximum number of results to return
     * @return self
     */
    public function __construct(
        $name,
        $needExp = null,
        SearchType $type = null,
        $galAcctId = null,
        $limit = null)
    {
        parent::__construct();
        $this->property('name', trim($name));
        if(null !== $needExp)
        {
            $this->property('needExp', (bool) $needExp);
        }
        if($type instanceof SearchType)
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
     * Gets or sets needExp
     *
     * @param  bool $needExp
     * @return bool|self
     */
    public function needExp($needExp = null)
    {
        if(null === $needExp)
        {
            return $this->property('needExp');
        }
        return $this->property('needExp', (bool) $needExp);
    }

    /**
     * Gets or sets type
     *
     * @param  SearchType $type
     * @return SearchType|self
     */
    public function type(SearchType $type = null)
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
     * Gets or sets int
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
