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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\NamedElement;

/**
 * GetAdminSavedSearches request class
 * Returns admin saved searches.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAdminSavedSearches extends Base
{
    /**
     * Search sequence
     * @var Sequence
     */
    private $_searches;

    /**
     * Constructor method for GetAdminSavedSearches
     * @param  array $searches Array of search information
     * @return self
     */
    public function __construct(array $searches = [])
    {
        parent::__construct();
        $this->setSearches($searches);

        $this->on('before', function(Base $sender)
        {
            if($sender->getSearches()->count())
            {
                $sender->setChild('search', $sender->getSearches()->all());
            }
        });
    }

    /**
     * Add search
     *
     * @param  NamedElement $search
     * @return self
     */
    public function addSearch(NamedElement $search)
    {
        $this->_searches->add($search);
        return $this;
    }

    /**
     * Sets search sequence
     *
     * @param array  $searches
     * @return self
     */
    public function setSearches(array $searches)
    {
        $this->_searches = new TypedSequence('Zimbra\Struct\NamedElement', $searches);
        return $this;
    }

    /**
     * Gets search sequence
     *
     * @return Sequence
     */
    public function getSearches()
    {
        return $this->_searches;
    }
}
