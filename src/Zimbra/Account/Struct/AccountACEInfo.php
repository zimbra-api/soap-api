<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Enum\AceRightType;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\Base;

/**
 * AccountACEInfo struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AccountACEInfo extends Base
{
    /**
     * Constructor method for AccountACEInfo
     * @param GranteeType $gt
     * @param AceRightType $right
     * @param string $zid
     * @param string $d
     * @param string $key
     * @param string $pw
     * @param bool $deny
     * @param bool $chkgt
     * @return self
     */
    public function __construct(
        GranteeType $gt,
        AceRightType $right,
        $zid = null,
        $d = null,
        $key = null,
        $pw = null,
        $deny = null,
        $chkgt = null
    )
    {
        parent::__construct();
        $this->property('gt', $gt);
        $this->property('right', $right);
        if(null !== $zid)
        {
            $this->property('zid', trim($zid));
        }
        if(null !== $d)
        {
            $this->property('d', trim($d));
        }
        if(null !== $key)
        {
            $this->property('key', trim($key));
        }
        if(null !== $pw)
        {
            $this->property('pw', trim($pw));
        }
        if(null !== $deny)
        {
            $this->property('deny', (bool) $deny);
        }
        if(null !== $chkgt)
        {
            $this->property('chkgt', (bool) $chkgt);
        }
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
     * Gets or sets right
     *
     * @param  AceRightType $right
     * @return AceRightType|self
     */
    public function right(AceRightType $right = null)
    {
        if(null === $right)
        {
            return $this->property('right');
        }
        return $this->property('right', $right);
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
     * Gets or sets deny
     *
     * @param  bool $deny
     * @return bool|self
     */
    public function deny($deny = null)
    {
        if(null === $deny)
        {
            return $this->property('deny');
        }
        return $this->property('deny', (bool) $deny);
    }

    /**
     * Gets or sets chkgt
     *
     * @param  bool $chkgt
     * @return bool|self
     */
    public function chkgt($chkgt = null)
    {
        if(null === $chkgt)
        {
            return $this->property('chkgt');
        }
        return $this->property('chkgt', (bool) $chkgt);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'ace')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'ace')
    {
        return parent::toXml($name);
    }
}
