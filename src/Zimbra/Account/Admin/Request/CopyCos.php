<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\CosSelector as Cos;
use Zimbra\Soap\Request;

/**
 * CopyCos request class
 * Copy Class of service (COS).
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CopyCos extends Request
{
    /**
     * Constructor method for CopyCos
     * @param string $name Destination name for COS
     * @param Cos $cos Source COS
     * @return self
     */
    public function __construct($name = null, Cos $cos = null)
    {
        parent::__construct();
        if(null !== $name)
        {
            $this->child('name', trim($name));
        }
        if($cos instanceof Cos)
        {
            $this->child('cos', $cos);
        }
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->child('name');
        }
        return $this->child('name', trim($name));
    }

    /**
     * Gets or sets cos
     *
     * @param  Cos $cos
     * @return Cos|self
     */
    public function cos(Cos $cos = null)
    {
        if(null === $cos)
        {
            return $this->child('cos');
        }
        return $this->child('cos', $cos);
    }
}
