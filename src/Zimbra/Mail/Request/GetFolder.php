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
class GetFolder extends Base
{
    /**
     * Constructor method for GetFolder
     * @param  bool $isVisible
     * @param  bool $needGranteeName
     * @param  string $viewConstraint
     * @param  int $treeDepth
     * @param  bool $traverseMountpoints
     * @param  GetFolderSpec $folder
     * @return self
     */
    public function __construct(
        $isVisible = null,
        $needGranteeName = null,
        $viewConstraint = null,
        $treeDepth = null,
        $traverseMountpoints = null,
        GetFolderSpec $folder = null
    )
    {
        parent::__construct();
        if(null !== $isVisible)
        {
            $this->setProperty('visible', (bool) $isVisible);
        }
        if(null !== $needGranteeName)
        {
            $this->setProperty('needGranteeName', (bool) $needGranteeName);
        }
        if(null !== $viewConstraint)
        {
            $this->setProperty('view', trim($viewConstraint));
        }
        if(null !== $treeDepth)
        {
            $this->setProperty('depth', (int) $treeDepth);
        }
        if(null !== $traverseMountpoints)
        {
            $this->setProperty('tr', (bool) $traverseMountpoints);
        }
        if($folder instanceof GetFolderSpec)
        {
            $this->setChild('folder', $folder);
        }
    }

    /**
     * Gets is visible
     *
     * @return bool
     */
    public function getIsVisible()
    {
        return $this->getProperty('visible');
    }

    /**
     * Sets is visible
     *
     * @param  bool $isVisible
     * @return self
     */
    public function setIsVisible($isVisible)
    {
        return $this->setProperty('visible', (bool) $isVisible);
    }

    /**
     * Gets need grantee name
     *
     * @return bool
     */
    public function getNeedGranteeName()
    {
        return $this->getProperty('needGranteeName');
    }

    /**
     * Sets is need grantee name
     *
     * @param  bool $needGranteeName
     * @return self
     */
    public function setNeedGranteeName($needGranteeName)
    {
        return $this->setProperty('needGranteeName', (bool) $needGranteeName);
    }

    /**
     * Gets view constraint
     *
     * @return string
     */
    public function getViewConstraint()
    {
        return $this->getProperty('view');
    }

    /**
     * Sets view constraint
     *
     * @param  string $viewConstraint
     * @return self
     */
    public function setViewConstraint($viewConstraint)
    {
        return $this->setProperty('view', trim($viewConstraint));
    }

    /**
     * Gets treeDepth
     *
     * @return int
     */
    public function getTreeDepth()
    {
        return $this->getProperty('depth');
    }

    /**
     * Sets treeDepth
     *
     * @param  int $treeDepth
     * @return self
     */
    public function setTreeDepth($treeDepth)
    {
        return $this->setProperty('depth', (int) $treeDepth);
    }

    /**
     * Gets traverse mountpoints
     *
     * @return bool
     */
    public function getTraverseMountpoints()
    {
        return $this->getProperty('tr');
    }

    /**
     * Sets traverse mountpoints
     *
     * @param  bool $traverseMountpoints
     * @return self
     */
    public function setTraverseMountpoints($traverseMountpoints)
    {
        return $this->setProperty('tr', (bool) $traverseMountpoints);
    }

    /**
     * Gets folder specification
     *
     * @return GetFolderSpec
     */
    public function getFolder()
    {
        return $this->getChild('folder');
    }

    /**
     * Sets folder specification
     *
     * @param  GetFolderSpec $folder
     * @return self
     */
    public function setFolder(GetFolderSpec $folder)
    {
        return $this->setChild('folder', $folder);
    }
}
