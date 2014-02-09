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

use Zimbra\Enum\VolumeType;

/**
 * SetCurrentVolume request class
 * Set current volume. 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SetCurrentVolume extends Base
{
    /**
     * Constructor method for SetCurrentVolume
     * @param int $id ID
     * @param string $type Volume type: 1 (primary message), 2 (secondary message) or 10 (index)
     * @return self
     */
    public function __construct($id, VolumeType $type)
    {
        parent::__construct();
        $this->property('id', (int) $id);
        $this->property('type', $type);
    }

    /**
     * Gets or sets id
     *
     * @param  int $id
     * @return int|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', (int) $id);
    }

    /**
     * Gets or sets type
     *
     * @param  VolumeType $type
     * @return VolumeType|self
     */
    public function type(VolumeType $type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', $type);
    }
}
