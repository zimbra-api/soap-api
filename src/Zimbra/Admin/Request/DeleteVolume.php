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

/**
 * DeleteVolume request class
 * Delete a volume.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteVolume extends Base
{
    /**
     * Constructor method for DeleteVolume
     * @param  int $id Zimbra ID
     * @return self
     */
    public function __construct($id)
    {
        parent::__construct();
        $this->property('id', (int) $id);
    }

    /**
     * Gets or sets id
     *
     * @param  integer $id
     * @return integer|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', (int) $id);
    }
}
