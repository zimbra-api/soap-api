<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Enum\FolderActionOp;

/**
 * FolderActionSelector struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FolderActionSelector extends ActionSelector
{
    /**
     * Constructor method for FolderActionSelector
     * @param FolderActionOp $op
     * @param string $id
     * @param string $tcon
     * @param int    $tag
     * @param string $folder
     * @param string $rgb
     * @param int    $color
     * @param string $name
     * @param string $flags
     * @param string $tags
     * @param string $tn

     * @param ActionGrantSelector $grant
     * @param FolderActionSelectorAcl $acl
     * @param RetentionPolicy $retentionPolicy
     * @param bool $recursive
     * @param string $url
     * @param bool $excludeFreeBusy
     * @param string $zid
     * @param string $gt
     * @param string $view
     * @param string $tn
     * @param int $numDays
     * @return self
     */
    public function __construct(
        FolderActionOp $op,
        $id = null,
        $tcon = null,
        $tag = null,
        $folder = null,
        $rgb = null,
        $color = null,
        $name = null,
        $flags = null,
        $tags = null,
        $tagNames = null,
        ActionGrantSelector $grant = null,
        FolderActionSelectorAcl $acl = null,
        RetentionPolicy $retentionPolicy = null,
        $recursive = null,
        $url = null,
        $excludeFreeBusy = null,
        $zid = null,
        $gt = null,
        $view = null,
        $numDays = null
    )
    {
        parent::__construct(
            $op,
            $id,
            $tcon,
            $tag,
            $folder,
            $rgb,
            $color,
            $name,
            $flags,
            $tags,
            $tagNames
        );
        if($grant instanceof ActionGrantSelector)
        {
            $this->setChild('grant', $grant);
        }
        if($acl instanceof FolderActionSelectorAcl)
        {
            $this->setChild('acl', $acl);
        }
        if($retentionPolicy instanceof RetentionPolicy)
        {
            $this->setChild('retentionPolicy', $retentionPolicy);
        }
        if(null !== $recursive)
        {
            $this->setProperty('recursive', (bool) $recursive);
        }
        if(null !== $url)
        {
            $this->setProperty('url', trim($url));
        }
        if(null !== $excludeFreeBusy)
        {
            $this->setProperty('excludeFreeBusy', (bool) $excludeFreeBusy);
        }
        if(null !== $zid)
        {
            $this->setProperty('zid', trim($zid));
        }
        if(null !== $gt)
        {
            $this->setProperty('gt', trim($gt));
        }
        if(null !== $view)
        {
            $this->setProperty('view', trim($view));
        }
        if(null !== $numDays)
        {
            $this->setProperty('numDays', (int) $numDays);
        }
    }

    /**
     * Gets operation
     *
     * @return string
     */
    public function getOperation()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operation
     *
     * @param  string $op
     * @return self
     */
    public function setOperation(FolderActionOp $op)
    {
        return $this->setProperty('op', $op);
    }

    /**
     * Gets grant
     *
     * @return ActionGrantSelector
     */
    public function getGrant()
    {
        return $this->getChild('grant');
    }

    /**
     * Sets grant
     *
     * @param  ActionGrantSelector $grant
     * @return self
     */
    public function setGrant(ActionGrantSelector $grant)
    {
        return $this->setChild('grant', $grant);
    }

    /**
     * Gets acl
     *
     * @return FolderActionSelectorAcl
     */
    public function getAcl()
    {
        return $this->getChild('acl');
    }

    /**
     * Sets acl
     *
     * @param  FolderActionSelectorAcl $acl
     * @return self
     */
    public function setAcl(FolderActionSelectorAcl $acl)
    {
        return $this->setChild('acl', $acl);
    }

    /**
     * Gets retention policy
     *
     * @return RetentionPolicy
     */
    public function getRetentionPolicy()
    {
        return $this->getChild('retentionPolicy');
    }

    /**
     * Sets retention policy
     *
     * @param  RetentionPolicy $retentionPolicy
     * @return self
     */
    public function setRetentionPolicy(RetentionPolicy $retentionPolicy)
    {
        return $this->setChild('retentionPolicy', $retentionPolicy);
    }

    /**
     * Gets recursive
     *
     * @return bool
     */
    public function getRecursive()
    {
        return $this->getProperty('recursive');
    }

    /**
     * Sets recursive
     *
     * @param  bool $recursive
     * @return self
     */
    public function setRecursive($recursive)
    {
        return $this->setProperty('recursive', (bool) $recursive);
    }

    /**
     * Gets url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->getProperty('url');
    }

    /**
     * Sets url
     *
     * @param  string $url
     * @return self
     */
    public function setUrl($url)
    {
        return $this->setProperty('url', trim($url));
    }

    /**
     * Gets excludeFreeBusy
     *
     * @return bool
     */
    public function getExcludeFreeBusy()
    {
        return $this->getProperty('excludeFreeBusy');
    }

    /**
     * Sets excludeFreeBusy
     *
     * @param  bool $excludeFreeBusy
     * @return self
     */
    public function setExcludeFreeBusy($excludeFreeBusy)
    {
        return $this->setProperty('excludeFreeBusy', (bool) $excludeFreeBusy);
    }

    /**
     * Gets Zimbra Id
     *
     * @return string
     */
    public function getZimbraId()
    {
        return $this->getProperty('zid');
    }

    /**
     * Sets Zimbra Id
     *
     * @param  string $zid
     * @return self
     */
    public function setZimbraId($zid)
    {
        return $this->setProperty('zid', trim($zid));
    }

    /**
     * Gets grant type
     *
     * @return string
     */
    public function getGrantType()
    {
        return $this->getProperty('gt');
    }

    /**
     * Sets grant type
     *
     * @param  string $gt
     * @return self
     */
    public function setGrantType($gt)
    {
        return $this->setProperty('gt', trim($gt));
    }

    /**
     * Gets view
     *
     * @return string
     */
    public function getView()
    {
        return $this->getProperty('view');
    }

    /**
     * Sets view
     *
     * @param  string $view
     * @return self
     */
    public function setView($view)
    {
        return $this->setProperty('view', trim($view));
    }

    /**
     * Gets numDays
     *
     * @return int
     */
    public function getNumDays()
    {
        return $this->getProperty('numDays');
    }

    /**
     * Sets numDays
     *
     * @param  int $numDays
     * @return self
     */
    public function setNumDays($numDays)
    {
        return $this->setProperty('numDays', (int) $numDays);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        return parent::toXml($name);
    }
}
