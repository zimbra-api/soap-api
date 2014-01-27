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
 * @copyright  Copyright © 2013 op Nguyen Van Nguyen.
 */
class FolderActionSelector extends ActionSelector
{
    /**
     * Constructor method for FolderActionSelector
     * @param FolderActionOp $op
     * @param string $id
     * @param string $tcon
     * @param int    $recursive
     * @param string $l
     * @param string $rgb
     * @param int    $color
     * @param string $name
     * @param string $f
     * @param string $t
     * @param string $tn
     * @return self
     */
    public function __construct(
        FolderActionOp $op,
        $id = null,
        $tcon = null,
        $recursive = null,
        $l = null,
        $rgb = null,
        $color = null,
        $name = null,
        $f = null,
        $t = null,
        $tn = null,
        ActionGrantSelector $grant = null,
        FolderActionSelectorAcl $acl = null,
        RetentionPolicy $retentionPolicy = null,
        $recursive = null,
        $url = null,
        $excludeFreeBusy = null,
        $zid = null,
        $gt = null,
        $view = null
    )
    {
        parent::__construct(
            $op,
            $id,
            $tcon,
            $recursive,
            $l,
            $rgb,
            $color,
            $name,
            $f,
            $t,
            $tn
        );
        if($grant instanceof ActionGrantSelector)
        {
            $this->child('grant', $grant);
        }
        if($acl instanceof FolderActionSelectorAcl)
        {
            $this->child('acl', $acl);
        }
        if($retentionPolicy instanceof RetentionPolicy)
        {
            $this->child('retentionPolicy', $retentionPolicy);
        }
        if(null !== $recursive)
        {
            $this->property('recursive', (bool) $recursive);
        }
        if(null !== $url)
        {
            $this->property('url', trim($url));
        }
        if(null !== $excludeFreeBusy)
        {
            $this->property('excludeFreeBusy', (bool) $excludeFreeBusy);
        }
        if(null !== $zid)
        {
            $this->property('zid', trim($zid));
        }
        if(null !== $gt)
        {
            $this->property('gt', trim($gt));
        }
        if(null !== $view)
        {
            $this->property('view', trim($view));
        }
    }

    /**
     * Gets or sets op
     *
     * @param  FolderActionOp $op
     * @return FolderActionOp|self
     */
    public function op(FolderActionOp $op = null)
    {
        if(null === $op)
        {
            return $this->property('op');
        }
        return $this->property('op', $op);
    }

    /**
     * Gets or sets grant
     *
     * @param  ActionGrantSelector $grant
     * @return ActionGrantSelector|self
     */
    public function grant(ActionGrantSelector $grant = null)
    {
        if(null === $grant)
        {
            return $this->child('grant');
        }
        return $this->child('grant', $grant);
    }


    /**
     * Gets or sets acl
     *
     * @param  FolderActionSelectorAcl $acl
     * @return FolderActionSelectorAcl|self
     */
    public function acl(FolderActionSelectorAcl $acl = null)
    {
        if(null === $acl)
        {
            return $this->child('acl');
        }
        return $this->child('acl', $acl);
    }

    /**
     * Gets or sets retentionPolicy
     *
     * @param  RetentionPolicy $retentionPolicy
     * @return RetentionPolicy|self
     */
    public function retentionPolicy(RetentionPolicy $retentionPolicy = null)
    {
        if(null === $retentionPolicy)
        {
            return $this->child('retentionPolicy');
        }
        return $this->child('retentionPolicy', $retentionPolicy);
    }

    /**
     * Gets or sets recursive
     *
     * @param  bool $recursive
     * @return bool|self
     */
    public function recursive($recursive = null)
    {
        if(null === $recursive)
        {
            return $this->property('recursive');
        }
        return $this->property('recursive', (bool) $recursive);
    }

    /**
     * Gets or sets url
     *
     * @param  string $url
     * @return string|self
     */
    public function url($url = null)
    {
        if(null === $url)
        {
            return $this->property('url');
        }
        return $this->property('url', trim($url));
    }

    /**
     * Gets or sets excludeFreeBusy
     *
     * @param  bool $excludeFreeBusy
     * @return bool|self
     */
    public function excludeFreeBusy($excludeFreeBusy = null)
    {
        if(null === $excludeFreeBusy)
        {
            return $this->property('excludeFreeBusy');
        }
        return $this->property('excludeFreeBusy', (bool) $excludeFreeBusy);
    }

    /**
     * Gets or sets zid
     *
     * @param  string $zid
     * @return string|self
     */
    public function zid($zid = null)
    {
        if(null === $zid)
        {
            return $this->property('zid');
        }
        return $this->property('zid', trim($zid));
    }

    /**
     * Gets or sets gt
     *
     * @param  string $gt
     * @return string|self
     */
    public function gt($gt = null)
    {
        if(null === $gt)
        {
            return $this->property('gt');
        }
        return $this->property('gt', trim($gt));
    }

    /**
     * Gets or sets view
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
