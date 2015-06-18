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

use Zimbra\Struct\Base;

/**
 * RightModifierInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RightModifierInfo extends Base
{
    /**
     * Constructor method for RightModifierInfo
     * @param string $value Value is of the form
     * @param bool $deny Deny flag - default is 0 (false)
     * @param bool $canDelegate Flag whether can delegate - default is 0 (false)
     * @param bool $disinheritSubGroups disinheritSubGroups flag - default is 0 (false)
     * @param bool $subDomain subDomain flag - default is 0 (false)
     * @return self
     */
    public function __construct(
        $value = null,
        $deny = null,
        $canDelegate = null,
        $disinheritSubGroups = null,
        $subDomain = null
    )
    {
        parent::__construct(trim($value));
        if($deny !== null)
        {
            $this->setProperty('deny', (bool) $deny);
        }
        if($canDelegate !== null)
        {
            $this->setProperty('canDelegate', (bool) $canDelegate);
        }
        if($disinheritSubGroups !== null)
        {
            $this->setProperty('disinheritSubGroups', (bool) $disinheritSubGroups);
        }
        if($subDomain !== null)
        {
            $this->setProperty('subDomain', (bool) $subDomain);
        }
    }

    /**
     * Gets the deny flag
     *
     * @return bool
     */
    public function getDeny()
    {
        return $this->getProperty('deny');
    }

    /**
     * Sets the deny flag
     *
     * @param  bool $deny
     * @return self
     */
    public function setDeny($deny)
    {
        return $this->setProperty('deny', (bool) $deny);
    }

    /**
     * Gets the can delegate flag
     *
     * @return bool
     */
    public function getCanDelegate()
    {
        return $this->getProperty('canDelegate');
    }

    /**
     * Sets the can delegate flag
     *
     * @param  bool $canDelegate
     * @return self
     */
    public function setCanDelegate($canDelegate)
    {
        return $this->setProperty('canDelegate', (bool) $canDelegate);
    }

    /**
     * Gets the disinheritSubGroups flag
     *
     * @return bool
     */
    public function getDisinheritSubGroups()
    {
        return $this->getProperty('disinheritSubGroups');
    }

    /**
     * Sets the disinheritSubGroups flag
     *
     * @param  bool $disinheritSubGroups
     * @return self
     */
    public function setDisinheritSubGroups($disinheritSubGroups)
    {
        return $this->setProperty('disinheritSubGroups', (bool) $disinheritSubGroups);
    }

    /**
     * Gets the sub domain flag
     *
     * @return bool
     */
    public function getSubDomain()
    {
        return $this->getProperty('subDomain');
    }

    /**
     * Sets the sub domain flag
     *
     * @param  bool $subDomain
     * @return self
     */
    public function setSubDomain($subDomain)
    {
        return $this->setProperty('subDomain', (bool) $subDomain);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'right')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'right')
    {
        return parent::toXml($name);
    }
}
