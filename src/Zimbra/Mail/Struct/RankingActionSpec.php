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

use Zimbra\Enum\RankingActionOp;
use Zimbra\Struct\Base;

/**
 * RankingActionSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RankingActionSpec extends Base
{
    /**
     * Constructor method for RankingActionSpec
     * @param RankingActionOp $op Action to perform - reset|delete.
     * @param string $email Email address. Required if action is "delete"
     * @return self
     */
    public function __construct(
        RankingActionOp $op,
        $email = null
    )
    {
        parent::__construct();
        $this->setProperty('op', $op);
        if(null !== $email)
        {
            $this->setProperty('email', trim($email));
        }
    }

    /**
     * Gets operation
     *
     * @return RankingActionOp
     */
    public function getOperation()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operation
     *
     * @param  RankingActionOp $op
     * @return self
     */
    public function setOperation(RankingActionOp $op)
    {
        return $this->setProperty('op', $op);
    }

    /**
     * Gets email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getProperty('email');
    }

    /**
     * Sets email
     *
     * @param  string $email
     * @return self
     */
    public function setEmail($email)
    {
        return $this->setProperty('email', trim($email));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        return parent::toXml($name);
    }
}
