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
     * Constructor method for GetSystemRetentionPolicy
     * @param  Cos $cos
     * @return self
     */
    public function __construct(Cos $cos = null)
    {
        parent::__construct();
        if($cos instanceof Cos)
        {
            $this->setChild('cos', $cos);
        }
    }

    /**
     * Gets the cos.
     *
     * @return Cos
     */
    public function getCos()
    {
        return $this->getChild('cos');
    }

    /**
     * Sets the cos.
     *
     * @param  Cos $cos
     * @return self
     */
    public function setCos(Cos $cos)
    {
        return $this->setChild('cos', $cos);
    }
}
