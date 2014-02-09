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
use Zimbra\Struct\NamedValue;

/**
 * ModifyAdminSavedSearches request class
 * Modifies admin saved searches.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyAdminSavedSearches extends Base
{
    /**
     * Searchs
     * @var TypedSequence<NamedValue>
     */
    private $_search;

    /**
     * Constructor method for ModifyAdminSavedSearches
     * @param  array $search
     * @return self
     */
    public function __construct(array $search = array())
    {
        parent::__construct();
        $this->_search = new TypedSequence('Zimbra\Struct\NamedValue', $search);

        $this->addHook(function($sender)
        {
            $sender->child('search', $sender->search()->all());
        });
    }

    /**
     * Add an search
     *
     * @param  NamedValue $search
     * @return self
     */
    public function addSearch(NamedValue $search)
    {
        $this->_search->add($search);
        return $this;
    }

    /**
     * Gets search sequence
     *
     * @return Sequence
     */
    public function search()
    {
        return $this->_search;
    }
}