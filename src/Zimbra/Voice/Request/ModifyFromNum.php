<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Request;

use Zimbra\Voice\Struct\ModifyFromNumSpec;
use Zimbra\Voice\Struct\StorePrincipalSpec;

/**
 * ModifyFromNum request class
 * Modify the phone num and label. 
 *  NOTE: UI should insert empty values for oldPhone, phone label in-case the user wants to leave them empty. 
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyFromNum extends Base
{
    /**
     * Constructor method for ModifyFromNum
     * @param  StorePrincipalSpec $storeprincipal
     * @param  ModifyFromNumSpec $phone
     * @return self
     */
    public function __construct(
        StorePrincipalSpec $storeprincipal = null,
        ModifyFromNumSpec $phone = null
    )
    {
        parent::__construct();
        if($storeprincipal instanceof StorePrincipalSpec)
        {
            $this->setChild('storeprincipal', $storeprincipal);
        }
        if($phone instanceof ModifyFromNumSpec)
        {
            $this->setChild('phone', $phone);
        }
    }

    /**
     * Gets the storeprincipal.
     *
     * @return StorePrincipalSpec
     */
    public function getStorePrincipal()
    {
        return $this->getChild('storeprincipal');
    }

    /**
     * Sets the storeprincipal.
     *
     * @param  StorePrincipalSpec $storeprincipal
     * @return self
     */
    public function setStorePrincipal(StorePrincipalSpec $storeprincipal)
    {
        return $this->setChild('storeprincipal', $storeprincipal);
    }

    /**
     * Gets the phone.
     *
     * @return ModifyFromNumSpec
     */
    public function getPhone()
    {
        return $this->getChild('phone');
    }

    /**
     * Sets the phone.
     *
     * @param  ModifyFromNumSpec $phone
     * @return self
     */
    public function setPhone(ModifyFromNumSpec $phone)
    {
        return $this->setChild('phone', $phone);
    }
}
