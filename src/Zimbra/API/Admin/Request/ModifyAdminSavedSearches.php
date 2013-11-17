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
use Zimbra\Soap\Struct\NamedValue;
use Zimbra\Utils\TypedSequence;

/**
 * ModifyAdminSavedSearches class
 * Modifies admin saved searches.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyAdminSavedSearches extends Request
{
    /**
     * Searchs
     * @var array
     */
    private $_searchs = array();

    /**
     * Constructor method for ModifyAdminSavedSearches
     * @param  array $searchs
     * @return self
     */
    public function __construct(array $searchs = array())
    {
        parent::__construct();
        $this->_searchs = new TypedSequence('Zimbra\Soap\Struct\NamedValue', $searchs);
    }

    /**
     * Add an search
     *
     * @param  NamedValue $search
     * @return self
     */
    public function addSearch(NamedValue $search)
    {
        $this->_searchs->add($search);
        return $this;
    }

    /**
     * Gets search sequence
     *
     * @return Sequence
     */
    public function searchs()
    {
        return $this->_searchs;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_searchs))
        {
            $this->array['search'] = array();
            foreach ($this->_searchs as $search)
            {
                $searchArr = $search->toArray('search');
                $this->array['search'][] = $searchArr['search'];
            }
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
        foreach ($this->_searchs as $search)
        {
            $this->xml->append($search->toXml('search'));
        }
        return parent::toXml();
    }
}