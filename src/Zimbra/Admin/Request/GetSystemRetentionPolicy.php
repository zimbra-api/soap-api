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
 * GetSystemRetentionPolicy request class
 * Get System Retention Policy.
 * The system retention policy SOAP APIs allow the administrator to edit named system retention policies that users can apply to folders and tags.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetSystemRetentionPolicy extends Base
{
    /**
     * Cos
     * @var Cos
     */
    private $_cos;

    /**
     * Constructor method for GetSystemRetentionPolicy
     * @param  Cos $cos
     * @return self
     */
    public function __construct(Cos $cos = null)
    {
        parent::__construct();
        if($cos instanceof Cos)
        {
            $this->child('cos', $cos);
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
}
