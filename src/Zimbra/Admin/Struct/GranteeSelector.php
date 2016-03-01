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
     * @param string $value The key used to secretentify the grantee
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
            $this->setProperty('type', $type);
        }
        if($by instanceof GranteeBy)
        {
            $this->setProperty('by', $by);
        }
        if(null !== $secret)
        {
            $this->setProperty('secret', trim($secret));
        }
        if(null !== $all)
        {
            $this->setProperty('all', (bool) $all);
        }
    }

    /**
     * Gets type enum
     *
     * @return Zimbra\Enum\GranteeType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type enum
     *
     * @param  Zimbra\Enum\GranteeType $type
     * @return self
     */
    public function setType(GranteeType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets by enum
     *
     * @return Zimbra\Enum\GranteeBy
     */
    public function getBy()
    {
        return $this->getProperty('by');
    }

    /**
     * Sets by enum
     *
     * @param  Zimbra\Enum\GranteeBy $by
     * @return self
     */
    public function setBy(GranteeBy $by)
    {
        return $this->setProperty('by', $by);
    }

    /**
     * Gets timezone ID
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->getProperty('secret');
    }

    /**
     * Sets timezone ID
     *
     * @param  string $secret
     * @return self
     */
    public function setSecret($secret)
    {
        return $this->setProperty('secret', trim($secret));
    }

    /**
     * Gets all flag
     *
     * @return bool
     */
    public function getAll()
    {
        return $this->getProperty('all');
    }

    /**
     * Sets all flag
     *
     * @param  bool $all
     * @return self
     */
    public function setAll($all)
    {
        return $this->setProperty('all', (bool) $all);
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
