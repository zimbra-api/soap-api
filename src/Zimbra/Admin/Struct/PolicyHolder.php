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
 * PolicyHolder struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class PolicyHolder extends Base
{
    /**
     * Constructor method for PolicyHolder
     * @param  Policy $policy
     * @return self
     */
    public function __construct(Policy $policy = null)
    {
        parent::__construct();
        if($policy instanceof Policy)
        {
            $this->setChild('policy', $policy);
        }
    }

    /**
     * Gets the policy.
     *
     * @return Policy
     */
    public function getPolicy()
    {
        return $this->getChild('policy');
    }

    /**
     * Sets the policy.
     *
     * @param  Policy $policy
     * @return self
     */
    public function setPolicy(Policy $policy)
    {
        return $this->setChild('policy', $policy);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'holder')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'holder')
    {
        return parent::toXml($name);
    }
}
