<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Enum\GranteeType;
use Zimbra\Enum\GranteeBy;
use Zimbra\Struct\Base;

/**
 * GranteeSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GranteeSelector extends Base
{
    /**
     * Constructor method for GranteeSelector
     * @param string $value The key used to identify the grantee
     * @param GranteeType $type Grantee type
     * @param GranteeBy $by Grantee by
     * @param string $secret Password for guest grantee or the access key for key grantee For user right only
     * @param bool   $all For GetGrantsRequest, selects whether to include grants granted to groups the specified grantee belongs to. Default is 1 (true)
     * @return self
     */
    public function __construct(
        $value = null,
        GranteeType $type = null,
        GranteeBy $by = null,
        $secret = null,
        $all = null
    )
    {
        parent::__construct(trim($value));
        if($type instanceof GranteeType)
        {
            $this->property('type', $type);
        }
        if($by instanceof GranteeBy)
        {
            $this->property('by', $by);
        }
        if(null !== $secret)
        {
            $this->property('secret', trim($secret));
        }
        if(null !== $all)
        {
            $this->property('all', (bool) $all);
        }
    }

    /**
     * Gets or sets type
     *
     * @param  GranteeType $type
     * @return GranteeType|self
     */
    public function type(GranteeType $type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', $type);
    }

    /**
     * Gets or sets by
     *
     * @param  GranteeBy $by
     * @return GranteeBy|self
     */
    public function by(GranteeBy $by = null)
    {
        if(null === $by)
        {
            return $this->property('by');
        }
        return $this->property('by', $by);
    }

    /**
     * Gets or sets secret
     *
     * @param  string $secret
     * @return string|self
     */
    public function secret($secret = null)
    {
        if(null === $secret)
        {
            return $this->property('secret');
        }
        return $this->property('secret', trim($secret));
    }

    /**
     * Gets or sets all
     *
     * @param  bool $all
     * @return bool|self
     */
    public function all($all = null)
    {
        if(null === $all)
        {
            return $this->property('all');
        }
        return $this->property('all', (bool) $all);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'grantee')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'grantee')
    {
        return parent::toXml($name);
    }
}
