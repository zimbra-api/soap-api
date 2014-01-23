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
class GetAdminSavedSearches extends Request
{
    /**
     * Constructor method for GetAdminSavedSearches
     * @param  NamedElement $search Search information
     * @return self
     */
    public function __construct(NamedElement $search = null)
    {
        parent::__construct();
        if($search instanceof NamedElement)
        {
            $this->child('search', $search);
        }
    }

    /**
     * Gets or sets search
     *
     * @param  NamedElement $search
     * @return NamedElement|self
     */
    public function search(NamedElement $search = null)
    {
        if(null === $search)
        {
            return $this->child('search');
        }
        return $this->child('search', $search);
    }
}
