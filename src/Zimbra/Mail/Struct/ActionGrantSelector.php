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

use Zimbra\Enum\GranteeType;
use Zimbra\Struct\Base;

/**
 * ActionGrantSelector struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class ActionGrantSelector extends Base
{
    /**
     * Constructor method for ActionGrantSelector
     * @param string $perm Rights
     * @param GranteeType $gt Grantee Type - usr | grp | cos | dom | all | pub | guest | key
     * @param string $zid Zimbra ID
     * @param string $d Name or email address of the grantee. Not present if {grantee-type} is "all" or "pub"
     * @param string $args Retained for backwards compatibility. Old way of specifying password
     * @param string $pw Password when {grantee-type} is "gst" (not yet supported)
     * @param string $key Access key when {grantee-type} is "key"
     * @return self
     */
    public function __construct(
        $perm,
        GranteeType $gt,
        $zid = null,
        $d = null,
        $args = null,
        $pw = null,
        $key = null
    )
    {
        parent::__construct();
        $this->property('perm', trim($perm));
        $this->property('gt', $gt);

        if(null !== $zid)
        {
            $this->property('zid', trim($zid));
        }
        if(null !== $d)
        {
            $this->property('d', trim($d));
        }
        if(null !== $args)
        {
            $this->property('args', trim($args));
        }
        if(null !== $pw)
        {
            $this->property('pw', trim($pw));
        }
        if(null !== $key)
        {
            $this->property('key', trim($key));
        }
    }

    /**
     * Gets or sets perm
     *
     * @param  string $perm
     * @return string|self
     */
    public function perm($perm = null)
    {
        if(null === $perm)
        {
            return $this->property('perm');
        }
        return $this->property('perm', trim($perm));
    }

    /**
     * Gets or sets gt
     *
     * @param  GranteeType $gt
     * @return GranteeType|self
     */
    public function gt(GranteeType $gt = null)
    {
        if(null === $gt)
        {
            return $this->property('gt');
        }
        return $this->property('gt', $gt);
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
     * Gets or sets d
     *
     * @param  string $d
     * @return string|self
     */
    public function d($d = null)
    {
        if(null === $d)
        {
            return $this->property('d');
        }
        return $this->property('d', trim($d));
    }

    /**
     * Gets or sets args
     *
     * @param  string $args
     * @return string|self
     */
    public function args($args = null)
    {
        if(null === $args)
        {
            return $this->property('args');
        }
        return $this->property('args', trim($args));
    }

    /**
     * Gets or sets pw
     *
     * @param  string $pw
     * @return string|self
     */
    public function pw($pw = null)
    {
        if(null === $pw)
        {
            return $this->property('pw');
        }
        return $this->property('pw', trim($pw));
    }

    /**
     * Gets or sets key
     *
     * @param  string $key
     * @return string|self
     */
    public function key($key = null)
    {
        if(null === $key)
        {
            return $this->property('key');
        }
        return $this->property('key', trim($key));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'grant')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'grant')
    {
        return parent::toXml($name);
    }
}
