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

use Zimbra\Mail\Struct\ModifySearchFolderSpec;

/**
 * ModifySearchFolder request class
 * Modify Search Folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifySearchFolder extends Base
{
    /**
     * Constructor method for ModifySearchFolder
     * @param  ModifySearchFolderSpec $search
     * @return self
     */
    public function __construct(ModifySearchFolderSpec $search)
    {
        parent::__construct();
        $this->child('search', $search);
    }

    /**
     * Get or set search
     *
     * @param  ModifySearchFolderSpec $search
     * @return ModifySearchFolderSpec|self
     */
    public function search(ModifySearchFolderSpec $search = null)
    {
        if(null === $search)
        {
            return $this->child('search');
        }
        return $this->child('search', $search);
    }
}
