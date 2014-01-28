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

use Zimbra\Soap\Request;
use Zimbra\Mail\Struct\FolderSpec;

/**
 * GetEffectiveFolderPerms request class
 * Returns the effective permissions of the specified folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetEffectiveFolderPerms extends Request
{
    /**
     * Constructor method for GetEffectiveFolderPerms
     * @param  FolderSpec $folder
     * @return self
     */
    public function __construct(FolderSpec $folder)
    {
        parent::__construct();
        $this->child('folder', $folder);
    }

    /**
     * Get or set folder
     * Folder specification
     *
     * @param  FolderSpec $folder
     * @return FolderSpec|self
     */
    public function folder(FolderSpec $folder = null)
    {
        if(null === $folder)
        {
            return $this->child('folder');
        }
        return $this->child('folder', $folder);
    }
}
