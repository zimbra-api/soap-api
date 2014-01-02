<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\GetFolderSpec;

/**
 * GetFolder request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetFolder extends Request
{
    /**
     * Metadata section selector.
     * @var GetFolderSpec
     */
    private $_folder;

    /**
     * If set we include all visible subfolders of the specified folder.
     * When you have full rights on the mailbox, this is indistinguishable from the normal <GetFolderResponse> 
     * When you don't:
     *   - folders you can see appear normally,
     *   - folders you can't see (and can't see any subfolders) are omitted
     *   - folders you can't see (but *can* see >=1 subfolder) appear as <folder id="{id}" name="{name}"> hierarchy placeholders
     * @var bool
     */
    private $_visible;

    /**
     * If set then grantee names are supplied in the d attribute in <grant>.
     * Default: unset
     * @var bool
     */
    private $_needGranteeName;

    /**
     * If "view" is set then only the folders with matching view will be returned.
     * Otherwise folders with any default views will be returned.
     * @var string
     */
    private $_view;

    /**
     * If "depth" is set to a non-negative number, we include that many levels of subfolders in the response.
     * (so if depth="1", we'll include only the folder and its direct subfolders)
     * If depth is missing or negative, the entire folder hierarchy is returned
     * @var int
     */
    private $_depth;

    /**
     * If true, one level of mountpoints are traversed and the target folder's counts are applied to the local mountpoint.
     * If the root folder as referenced by {base-folder-id} and/or {fully-qualified-path} is a mountpoint, "tr" is regarded as being automatically set.
     * Mountpoints under mountpoints are not themselves expanded.
     * @var bool
     */
    private $_tr;

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
            $this->_folder = $folder;
        }
        if(null !== $visible)
        {
            $this->_visible = (bool) $visible;
        }
        if(null !== $needGranteeName)
        {
            $this->_needGranteeName = (bool) $needGranteeName;
        }
        $this->_view = trim($view);
        if(null !== $depth)
        {
            $this->_depth = (int) $depth;
        }
        if(null !== $tr)
        {
            $this->_tr = (bool) $tr;
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
            return $this->_folder;
        }
        $this->_folder = $folder;
        return $this;
    }

    /**
     * Get or set visible
     *
     * @param  bool $visible
     * @return bool|self
     */
    public function visible($visible = null)
    {
        if(null === $visible)
        {
            return $this->_visible;
        }
        $this->_visible = (bool) $visible;
        return $this;
    }

    /**
     * Get or set needGranteeName
     *
     * @param  bool $needGranteeName
     * @return bool|self
     */
    public function needGranteeName($needGranteeName = null)
    {
        if(null === $needGranteeName)
        {
            return $this->_needGranteeName;
        }
        $this->_needGranteeName = (bool) $needGranteeName;
        return $this;
    }

    /**
     * Get or set view
     *
     * @param  string $view
     * @return string|self
     */
    public function view($view = null)
    {
        if(null === $view)
        {
            return $this->_view;
        }
        $this->_view = trim($view);
        return $this;
    }

    /**
     * Get or set depth
     *
     * @param  int $depth
     * @return int|self
     */
    public function depth($depth = null)
    {
        if(null === $depth)
        {
            return $this->_depth;
        }
        $this->_depth = (int) $depth;
        return $this;
    }

    /**
     * Get or set tr
     *
     * @param  bool $tr
     * @return bool|self
     */
    public function tr($tr = null)
    {
        if(null === $tr)
        {
            return $this->_tr;
        }
        $this->_tr = (bool) $tr;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_visible))
        {
            $this->array['visible'] = $this->_visible ? 1 : 0;
        }
        if(is_bool($this->_needGranteeName))
        {
            $this->array['needGranteeName'] = $this->_needGranteeName ? 1 : 0;
        }
        if(!empty($this->_view))
        {
            $this->array['view'] = $this->_view;
        }
        if(is_int($this->_depth))
        {
            $this->array['depth'] = $this->_depth;
        }
        if(is_bool($this->_tr))
        {
            $this->array['tr'] = $this->_tr ? 1 : 0;
        }
        if($this->_folder instanceof GetFolderSpec)
        {
            $this->array += $this->_folder->toArray('folder');
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
        if(is_bool($this->_visible))
        {
            $this->xml->addAttribute('visible', $this->_visible ? 1 : 0);
        }
        if(is_bool($this->_needGranteeName))
        {
            $this->xml->addAttribute('needGranteeName', $this->_needGranteeName ? 1 : 0);
        }
        if(!empty($this->_view))
        {
            $this->xml->addAttribute('view', $this->_view);
        }
        if(is_int($this->_depth))
        {
            $this->xml->addAttribute('depth', $this->_depth);
        }
        if(is_bool($this->_tr))
        {
            $this->xml->addAttribute('tr', $this->_tr ? 1 : 0);
        }
        if($this->_folder instanceof GetFolderSpec)
        {
            $this->xml->append($this->_folder->toXml('folder'));
        }
        return parent::toXml();
    }
}
