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
     * @param string $id
     * @param string $name
     * @param string $accountNumber
     * @return self
     */
    public function __construct(
        $id = null,
        $name = null,
        $accountNumber = null
    )
    {
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $accountNumber)
        {
            $this->property('accountNumber', trim($accountNumber));
        }
    }

    /**
     * Gets or sets id
     * ID of user in the backing store
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets name
     * Name of user in the backing store
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets accountNumber
     * Account Number
     *
     * @param  string $accountNumber
     * @return string|self
     */
    public function accountNumber($accountNumber = null)
    {
        if(null === $accountNumber)
        {
            return $this->property('accountNumber');
        }
        return $this->property('accountNumber', trim($accountNumber));
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
