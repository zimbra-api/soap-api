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

/**
 * GetCos request class
 * Get Class Of Service (COS).
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetCos extends Base
{
    /**
     * Constructor method for GetCos
     * @param  Cos $cos Specify Class Of Service (COS)
     * @param  string $attrs Comma separated list of attributes
     * @return self
     */
    public function __construct(Cos $cos = null, $attrs = null)
    {
        parent::__construct();
        if($cos instanceof Cos)
        {
            $this->child('cos', $cos);
        }
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
        }
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

    /**
     * Gets or sets attrs
     *
     * @param  string $attrs
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->property('attrs');
        }
        return $this->property('attrs', trim($attrs));
    }
}
