<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\FolderAction;
use Zimbra\Utils\TypedSequence;

/**
 * FolderActionSelector struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FolderActionSelector extends ActionSelector
{
    /**
     * Action grant selector
     * @var ActionGrantSelector
     */
    private $_grant;

    /**
     * Access control list
     * @var TypedSequence<ActionGrantSelector>
     */
    private $_acl;

    /**
     * Retention policy
     * @var RetentionPolicy
     */
    private $_retentionPolicy;

    /**
     * For op="empty" - hard-delete all items in the folder (and all the folder's subfolders if "recursive" is set)
     * @var bool
     */
    private $_recursive;

    /**
     * Target URL
     * @var string
     */
    private $_url;

    /**
     * For op="fb" - set the excludeFreeBusy boolean for this folder (must specify {exclude-free-busy-boolean} for op="fb")
     * @var bool
     */
    private $_excludeFreeBusy;

    /**
     * Grantee Zimbra ID
     * @var string
     */
    private $_zid;

    /**
     * Grantee Type
     * @var string
     */
    private $_gt;

    /**
     * Use with op="update" to change folder's default view (useful for migration)
     * @var string
     */
    private $_view;

    /**
     * Constructor method for AccountACEInfo
     * @param FolderAction $op
     * @param string $id
     * @param string $tcon
     * @param int    $tag
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
        FolderAction $op,
        $id = null,
        $tcon = null,
        $tag = null,
        $l = null,
        $rgb = null,
        $color = null,
        $name = null,
        $f = null,
        $t = null,
        $tn = null,
        ActionGrantSelector $grant = null,
        array $acl = array(),
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
            $tag,
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
            $this->_grant = $grant;
        }
        $this->_acl = new TypedSequence('Zimbra\Soap\Struct\ActionGrantSelector', $acl);
        if($retentionPolicy instanceof RetentionPolicy)
        {
            $this->_retentionPolicy = $retentionPolicy;
        }
        if(null !== $recursive)
        {
            $this->_recursive = (bool) $recursive;
        }
        $this->_url = trim($url);
        if(null !== $excludeFreeBusy)
        {
            $this->_excludeFreeBusy = (bool) $excludeFreeBusy;
        }
        $this->_zid = trim($zid);
        $this->_gt = trim($gt);
        $this->_view = trim($view);
    }

    /**
     * Gets or sets op
     *
     * @param  FolderAction $op
     * @return FolderAction|self
     */
    public function op(FolderAction $op = null)
    {
        if(null === $op)
        {
            return $this->_op;
        }
        $this->_op = $op;
        return $this;
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
            return $this->_grant;
        }
        $this->_grant = $grant;
        return $this;
    }

    /**
     * Add acl
     *
     * @param  ActionGrantSelector $acl
     * @return self
     */
    public function addAcl(ActionGrantSelector $acl)
    {
        $this->_acl->add($acl);
        return $this;
    }

    /**
     * Gets acl sequence
     *
     * @return Sequence
     */
    public function acl()
    {
        return $this->_acl;
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
            return $this->_retentionPolicy;
        }
        $this->_retentionPolicy = $retentionPolicy;
        return $this;
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
            return $this->_recursive;
        }
        $this->_recursive = (bool) $recursive;
        return $this;
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
            return $this->_url;
        }
        $this->_url = trim($url);
        return $this;
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
            return $this->_excludeFreeBusy;
        }
        $this->_excludeFreeBusy = (bool) $excludeFreeBusy;
        return $this;
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
            return $this->_zid;
        }
        $this->_zid = trim($zid);
        return $this;
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
            return $this->_gt;
        }
        $this->_gt = trim($gt);
        return $this;
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
            return $this->_view;
        }
        $this->_view = trim($view);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $arr = parent::toArray($name);
        if(is_bool($this->_recursive))
        {
            $arr[$name]['recursive'] = $this->_recursive ? 1 : 0;
        }
        if(!empty($this->_url))
        {
            $arr[$name]['url'] = $this->_url;
        }
        if(is_bool($this->_excludeFreeBusy))
        {
            $arr[$name]['excludeFreeBusy'] = $this->_excludeFreeBusy ? 1 : 0;
        }
        if(!empty($this->_zid))
        {
            $arr[$name]['zid'] = $this->_zid;
        }
        if(!empty($this->_gt))
        {
            $arr[$name]['gt'] = $this->_gt;
        }
        if(!empty($this->_view))
        {
            $arr[$name]['view'] = $this->_view;
        }
        if($this->_grant instanceof ActionGrantSelector)
        {
            $arr[$name] += $this->_grant->toArray('grant');
        }
        $arr[$name]['acl'] = array();
        if(count($this->_acl))
        {
            $arr[$name]['acl']['grant'] = array();
            foreach ($this->_acl as $grant)
            {
                $grantArr = $grant->toArray('grant');
                $arr[$name]['acl']['grant'][] = $grantArr['grant'];
            }
        }
        if($this->_retentionPolicy instanceof RetentionPolicy)
        {
            $arr[$name] += $this->_retentionPolicy->toArray('retentionPolicy');
        }

        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $xml = parent::toXml($name);
        if(is_bool($this->_recursive))
        {
            $xml->addAttribute('recursive', $this->_recursive ? 1 : 0);
        }
        if(!empty($this->_url))
        {
            $xml->addAttribute('url', $this->_url);
        }
        if(is_bool($this->_excludeFreeBusy))
        {
            $xml->addAttribute('excludeFreeBusy', $this->_excludeFreeBusy ? 1 : 0);
        }
        if(!empty($this->_zid))
        {
            $xml->addAttribute('zid', $this->_zid);
        }
        if(!empty($this->_gt))
        {
            $xml->addAttribute('gt', $this->_gt);
        }
        if(!empty($this->_view))
        {
            $xml->addAttribute('view', $this->_view);
        }
        if($this->_grant instanceof ActionGrantSelector)
        {
            $xml->append($this->_grant->toXml('grant'));
        }
        $acl = $xml->addChild('acl');
        foreach ($this->_acl as $grant)
        {
            $acl->append($grant->toXml('grant'));
        }
        if($this->_retentionPolicy instanceof RetentionPolicy)
        {
            $xml->append($this->_retentionPolicy->toXml('retentionPolicy'));
        }
        return $xml;
    }
}
