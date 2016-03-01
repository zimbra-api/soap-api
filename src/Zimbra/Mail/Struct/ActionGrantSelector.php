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
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ActionGrantSelector extends Base
{
    /**
     * Constructor method for ActionGrantSelector
     * @param string $rights Rights
     * @param GranteeType $gt Grantee Type - usr | grp | cos | dom | all | pub | guest | key
     * @param string $zimbraId Zimbra ID
     * @param string $displayName Name or email address of the grantee. Not present if {grantee-type} is "all" or "pub"
     * @param string $args Retained for backwards compatibility. Old way of specifying password
     * @param string $password Password when {grantee-type} is "gst" (not yet supported)
     * @param string $accessKey Access key when {grantee-type} is "key"
     * @return self
     */
    public function __construct(
        $rights,
        GranteeType $gt,
        $zimbraId = null,
        $displayName = null,
        $args = null,
        $password = null,
        $accessKey = null
    )
    {
        parent::__construct();
        $this->setProperty('perm', trim($rights));
        $this->setProperty('gt', $gt);

        if(null !== $zimbraId)
        {
            $this->setProperty('zid', trim($zimbraId));
        }
        if(null !== $displayName)
        {
            $this->setProperty('d', trim($displayName));
        }
        if(null !== $args)
        {
            $this->setProperty('args', trim($args));
        }
        if(null !== $password)
        {
            $this->setProperty('pw', trim($password));
        }
        if(null !== $accessKey)
        {
            $this->setProperty('key', trim($accessKey));
        }
    }

    /**
     * Gets rights
     *
     * @return string
     */
    public function getRights()
    {
        return $this->getProperty('perm');
    }

    /**
     * Sets rights
     *
     * @param  string $rights
     * @return self
     */
    public function setRights($rights)
    {
        return $this->setProperty('perm', trim($rights));
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
     * Gets args
     *
     * @return string
     */
    public function getArgs()
    {
        return $this->getProperty('args');
    }

    /**
     * Sets args
     *
     * @param  string $args
     * @return string|self
     */
    public function setArgs($args)
    {
        return $this->setProperty('args', trim($args));
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
