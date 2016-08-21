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

use Zimbra\Admin\Struct\CosSelector;

/**
 * GetClearTwoFactorAuthDataStatus request class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetClearTwoFactorAuthDataStatus extends Base
{
    /**
     * Constructor method for GetClearTwoFactorAuthDataStatus
     * @param  CosSelector $cos
     * @return self
     */
    public function __construct(CosSelector $cos = null)
    {
        parent::__construct();
        if($cos instanceof CosSelector)
        {
            $this->setChild('cos', $cos);
        }
    }

    /**
     * Gets the cos.
     *
     * @return CosSelector
     */
    public function getCos()
    {
        return $this->getChild('cos');
    }

    /**
     * Sets the cos.
     *
     * @param  CosSelector $cos
     * @return self
     */
    public function setCos(CosSelector $cos)
    {
        return $this->setChild('cos', $cos);
    }
}
