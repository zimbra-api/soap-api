<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\NewSearchFolderSpec;

/**
 * CreateSearchFolder request class
 * Create a search folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateSearchFolder extends Base
{
    /**
     * Constructor method for CreateSearchFolder
     * @param  NewSearchFolderSpec $search
     * @return self
     */
    public function __construct(NewSearchFolderSpec $search)
    {
        parent::__construct();
        $this->child('search', $search);
    }

    /**
     * Get or set search
     * New search folder specification
     *
     * @param  NewSearchFolderSpec $search
     * @return NewSearchFolderSpec|self
     */
    public function search(NewSearchFolderSpec $search = null)
    {
        if(null === $search)
        {
            return $this->child('search');
        }
        return $this->child('search', $search);
    }
}
