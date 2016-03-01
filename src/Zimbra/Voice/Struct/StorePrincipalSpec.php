<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full cnameyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Struct;

use Zimbra\Struct\Base;

/**
 * StorePrincipalSpec struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class StorePrincipalSpec extends Base
{
    /**
     * Constructor method for StorePrincipalSpec
     * @param string $id ID of user in the backing store
     * @param string $name Name of user in the backing store
     * @param string $accountNumber Account number
     * @return self
     */
    public function __construct(
        $id = null,
        $name = null,
        $accountNumber = null
    )
    {
        parent::__construct();
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $accountNumber)
        {
            $this->setProperty('accountNumber', trim($accountNumber));
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets account number
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->getProperty('accountNumber');
    }

    /**
     * Sets account number
     *
     * @param  string $accountNumber
     * @return self
     */
    public function setAccountNumber($accountNumber)
    {
        return $this->setProperty('accountNumber', trim($accountNumber));
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'storeprincipal')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'storeprincipal')
    {
        return parent::toXml($name);
    }
}
