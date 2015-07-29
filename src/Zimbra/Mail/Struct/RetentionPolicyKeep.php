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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * RetentionPolicyKeep struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RetentionPolicyKeep extends Base
{
    /**
     * Keep policies
     * @var TypedSequence<Policy>
     */
    private $_policies;

    /**
     * Constructor method for RetentionPolicyKeep
     * @param array $policies Keep Policies
     * @return self
     */
    public function __construct(array $policies = array())
    {
    	parent::__construct();
        $this->setPolicies($policies);
        $this->on('before', function(Base $sender)
        {
            if($sender->getPolicies()->count())
            {
                $sender->setChild('policy', $sender->getPolicies()->all());
            }
        });
    }

    /**
     * Add policy
     *
     * @param  Policy $policy
     * @return self
     */
    public function addPolicy(Policy $policy)
    {
        $this->_policies->add($policy);
        return $this;
    }

    /**
     * Sets policy sequence
     *
     * @param  array $policies
     * @return self
     */
    public function setPolicies(array $policies)
    {
        $this->_policies = new TypedSequence('Zimbra\Mail\Struct\Policy', $policies);
        return $this;
    }

    /**
     * Gets policy sequence
     *
     * @return Sequence
     */
    public function getPolicies()
    {
        return $this->_policies;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'keep')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'keep')
    {
        return parent::toXml($name);
    }
}
