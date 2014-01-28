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
use Zimbra\Mail\Struct\GetFolderSpec;

/**
 * GetFolder request class
 * Get Folder
 * A {base-folder-id}, a {base-folder-uuid} or a {fully-qualified-path} can optionally be specified in the folder element; if none is present, the descent of the folder hierarchy begins at the mailbox's root folder (id 1). 
 * If {fully-qualified-path} is present and {base-folder-id} or {base-folder-uuid} is also present, the path is treated as relative to the folder that was specified by id/uuid. {base-folder-id} is ignored if {base-folder-uuid} is present.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetFolder extends Request
{
    /**
     * Constructor method for GetFolder
     * @param  GetFolderSpec $folder
     * @param  bool $visible
     * @param  bool $needGranteeName
     * @param  string $view
     * @param  int $depth
     * @param  bool $tr
     * @return self
     */
    public function __construct(
        GetFolderSpec $folder = null,
        $visible = null,
        $needGranteeName = null,
        $view = null,
        $depth = null,
        $tr = null
    )
    {
        parent::__construct();
        if($folder instanceof GetFolderSpec)
        {
            $this->child('folder', $folder);
        }
        if(null !== $visible)
        {
            $this->property('visible', (bool) $visible);
        }
        if(null !== $needGranteeName)
        {
            $this->property('needGranteeName', (bool) $needGranteeName);
        }
        if(null !== $view)
        {
            $this->property('view', trim($view));
        }
        if(null !== $depth)
        {
            $this->property('depth', (int) $depth);
        }
        if(null !== $tr)
        {
            $this->property('tr', (bool) $tr);
        }
    }

    /**
     * Get or set folder
     *
     * @param  GetFolderSpec $folder
     * @return GetFolderSpec|self
     */
    public function folder(GetFolderSpec $folder = null)
    {
        if(null === $folder)
        {
            return $this->child('folder');
        }
        return $this->child('folder', $folder);
    }

    /**
     * Get or set visible
     * If set we include all visible subfolders of the specified folder.
     * When you have full rights on the mailbox, this is indistinguishable from the normal <GetFolderResponse> 
     * When you don't:
     *   - folders you can see appear normally,
     *   - folders you can't see (and can't see any subfolders) are omitted
     *   - folders you can't see (but *can* see >=1 subfolder) appear as <folder id="{id}" name="{name}"> hierarchy placeholders
     *
     * @param  bool $visible
     * @return bool|self
     */
    public function visible($visible = null)
    {
        if(null === $visible)
        {
            return $this->property('visible');
        }
        return $this->property('visible', (bool) $visible);
    }

    /**
     * Get or set needGranteeName
     * If set then grantee names are supplied in the d attribute in <grant>.
     * Default: unset
     *
     * @param  bool $needGranteeName
     * @return bool|self
     */
    public function needGranteeName($needGranteeName = null)
    {
        if(null === $needGranteeName)
        {
            return $this->property('needGranteeName');
        }
        return $this->property('needGranteeName', (bool) $needGranteeName);
    }

    /**
     * Get or set view
     * If "view" is set then only the folders with matching view will be returned.
     * Otherwise folders with any default views will be returned.
     *
     * @param  string $view
     * @return string|self
     */
    public function view($view = null)
    {
        if(null === $view)
        {
            return $this->property('view');
        }
        return $this->property('view', trim($view));
    }

    /**
     * Get or set depth
     * If "depth" is set to a non-negative number, we include that many levels of subfolders in the response.
     * (so if depth="1", we'll include only the folder and its direct subfolders)
     * If depth is missing or negative, the entire folder hierarchy is returned
     *
     * @param  int $depth
     * @return int|self
     */
    public function depth($depth = null)
    {
        if(null === $depth)
        {
            return $this->property('depth');
        }
        return $this->property('depth', (int) $depth);
    }

    /**
     * Get or set tr
     * If true, one level of mountpoints are traversed and the target folder's counts are applied to the local mountpoint.
     * If the root folder as referenced by {base-folder-id} and/or {fully-qualified-path} is a mountpoint, "tr" is regarded as being automatically set.
     * Mountpoints under mountpoints are not themselves expanded.
     *
     * @param  bool $tr
     * @return bool|self
     */
    public function tr($tr = null)
    {
        if(null === $tr)
        {
            return $this->property('tr');
        }
        return $this->property('tr', (bool) $tr);
    }
}
