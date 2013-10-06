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
use Zimbra\Soap\Struct\NamedElement as Search;

/**
 * GetAdminSavedSearches class
 * Returns admin saved searches.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAdminSavedSearches extends Request
{
    /**
     * Search information
     * @var Search
     */
    private $_search;

    /**
     * Constructor method for GetAdminSavedSearches
     * @param  Search $search
     * @return self
     */
    public function __construct(Search $search = null)
    {
        parent::__construct();
        if($search instanceof Search)
        {
            $this->_search = $search;
        }
    }

    /**
     * Gets or sets search
     *
     * @param  Search $search
     * @return Search|self
     */
    public function search(Search $search = null)
    {
        if(null === $search)
        {
            return $this->_search;
        }
        $this->_search = $search;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_search instanceof Search)
        {
            $this->array += $this->_search->toArray('search');
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
        if($this->_search instanceof Search)
        {
            $this->xml->append($this->_search->toXml('search'));
        }
        return parent::toXml();
    }
}
