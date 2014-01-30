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

use Zimbra\Struct\Base;

/**
 * RetentionPolicy struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RetentionPolicy extends Base
{
    /**
     * Constructor method for RetentionPolicy
     * @param RetentionPolicyKeep $keep
     * @param RetentionPolicyPurge $purge
     * @return self
     */
    public function __construct(RetentionPolicyKeep $keep, RetentionPolicyPurge $purge)
    {
        parent::__construct();
        $this->child('keep', $keep);
        $this->child('purge', $purge);
    }


    /**
     * Gets or sets keep
     *
     * @param  RetentionPolicyKeep $keep
     * @return RetentionPolicyKeep|self
     */
    public function keep(RetentionPolicyKeep $keep = null)
    {
        if(null === $keep)
        {
            return $this->child('keep');
        }
        return $this->child('keep', $keep);
    }

    /**
     * Gets or sets purge
     *
     * @param  RetentionPolicyPurge $purge
     * @return RetentionPolicyPurge|self
     */
    public function purge(RetentionPolicyPurge $purge = null)
    {
        if(null === $purge)
        {
            return $this->child('purge');
        }
        return $this->child('purge', $purge);
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'retentionPolicy')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'retentionPolicy')
    {
        return parent::toXml($name);
    }
}
