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
            $this->property('deny', (bool) $deny);
        }
        if($canDelegate !== null)
        {
            $this->property('canDelegate', (bool) $canDelegate);
        }
        if($disinheritSubGroups !== null)
        {
            $this->property('disinheritSubGroups', (bool) $disinheritSubGroups);
        }
        if($subDomain !== null)
        {
            $this->property('subDomain', (bool) $subDomain);
        }
    }

    /**
     * Gets or sets pw
     *
     * @param  bool $pw
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
     * Gets or sets canDelegate
     *
     * @param  bool $canDelegate
     * @return bool|self
     */
    public function canDelegate($canDelegate = null)
    {
        if(null === $canDelegate)
        {
            return $this->property('canDelegate');
        }
        return $this->property('canDelegate', (bool) $canDelegate);
    }

    /**
     * Gets or sets disinheritSubGroups
     *
     * @param  bool $disinheritSubGroups
     * @return bool|self
     */
    public function disinheritSubGroups($disinheritSubGroups = null)
    {
        if(null === $disinheritSubGroups)
        {
            return $this->property('disinheritSubGroups');
        }
        return $this->property('disinheritSubGroups', (bool) $disinheritSubGroups);
    }

    /**
     * Gets or sets subDomain
     *
     * @param  bool $subDomain
     * @return bool|self
     */
    public function subDomain($subDomain = null)
    {
        if(null === $subDomain)
        {
            return $this->property('subDomain');
        }
        return $this->property('subDomain', (bool) $subDomain);
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
