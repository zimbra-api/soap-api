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

use Zimbra\Soap\Request;
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
class ModifyFromNum extends Request
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
            $this->child('storeprincipal', $storeprincipal);
        }
        if($phone instanceof ModifyFromNumSpec)
        {
            $this->child('phone', $phone);
        }
    }

    /**
     * Gets or sets storeprincipal
     * Store Principal specification
     *
     * @param  StorePrincipalSpec $storeprincipal
     * @return StorePrincipalSpec|self
     */
    public function storeprincipal(StorePrincipalSpec $storeprincipal = null)
    {
        if(null === $storeprincipal)
        {
            return $this->child('storeprincipal');
        }
        return $this->child('storeprincipal', $storeprincipal);
    }

    /**
     * Gets or sets phone
     * Phone specification
     *
     * @param  ModifyFromNumSpec $phone
     * @return ModifyFromNumSpec|self
     */
    public function phone(ModifyFromNumSpec $phone = null)
    {
        if(null === $phone)
        {
            return $this->child('phone');
        }
        return $this->child('phone', $phone);
    }
}
