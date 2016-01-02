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

use Zimbra\Enum\AceRightType;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\Base;

/**
 * AccountACEinfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AccountACEinfo extends Base
{
    /**
     * Constructor method for AccountACEinfo
     * @param GranteeType $gt The type of grantee
     * @param AceRightType $right The right
     * @param string $zimbraId Zimbra ID of the grantee
     * @param string $displayName Name or email address of the grantee.
     * @param string $accessKey Optional access key when {grantee-type} is "key"
     * @param string $password Password when {grantee-type} is "gst" (not yet supported)
     * @param bool $deny "1" if a right is specifically denied or "0" (default)
     * @return self
     */
    public function __construct(
        GranteeType $gt,
        AceRightType $right,
        $zimbraId = null,
        $displayName = null,
        $accessKey = null,
        $password = null,
        $deny = null
    )
    {
        parent::__construct();
        $this->setProperty('gt', $gt);
        $this->setProperty('right', $right);

        if(null !== $zimbraId)
        {
            $this->setProperty('zid', trim($zimbraId));
        }
        if(null !== $displayName)
        {
            $this->setProperty('d', trim($displayName));
        }
        if(null !== $accessKey)
        {
            $this->setProperty('key', trim($accessKey));
        }
        if(null !== $password)
        {
            $this->setProperty('pw', trim($password));
        }
        if(null !== $deny)
        {
            $this->setProperty('deny', (bool) $deny);
        }
    }

    /**
     * Gets the type of grantee
     *
     * @return GranteeType
     */
    public function getGranteeType()
    {
        return $this->getProperty('gt');
    }

    /**
     * Sets the type of grantee
     *
     * @param  GranteeType $granteeType
     * @return self
     */
    public function setGranteeType(GranteeType $granteeType)
    {
        return $this->setProperty('gt', $granteeType);
    }

    /**
     * Gets the right
     *
     * @return AceRightType
     */
    public function getRight()
    {
        return $this->getProperty('right');
    }

    /**
     * Sets the right
     *
     * @param  AceRightType $right
     * @return self
     */
    public function setRight(AceRightType $right)
    {
        return $this->setProperty('right', $right);
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
     * @param  string $zimbraId
     * @return self
     */
    public function setZimbraId($zimbraId)
    {
        return $this->setProperty('zid', trim($zimbraId));
    }

    /**
     * Gets display name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty('d');
    }

    /**
     * Sets display name
     *
     * @param  string $displayName
     * @return string|self
     */
    public function setDisplayName($displayName)
    {
        return $this->setProperty('d', trim($displayName));
    }

    /**
     * Gets access key
     *
     * @return string
     */
    public function getAccessKey()
    {
        return $this->getProperty('key');
    }

    /**
     * Sets access key
     *
     * @param  string $accessKey
     * @return self
     */
    public function setAccessKey($accessKey)
    {
        return $this->setProperty('key', trim($accessKey));
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getProperty('pw');
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        return $this->setProperty('pw', trim($password));
    }

    /**
     * Gets deny
     *
     * @return bool
     */
    public function getDeny()
    {
        return $this->getProperty('deny');
    }

    /**
     * Sets deny
     *
     * @param  bool $deny
     * @return self
     */
    public function setDeny($deny)
    {
        return $this->setProperty('deny', (bool) $deny);
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
