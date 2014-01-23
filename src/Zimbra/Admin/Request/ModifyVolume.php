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

use Zimbra\Admin\Struct\VolumeInfo as Volume;
use Zimbra\Soap\Request;

/**
 * ModifyVolume request class
 * Modify volume.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyVolume extends Request
{
    /**
     * Constructor method for ModifyVolume
     * @param int $id Volume ID
     * @param Volume $volume Volume information
     * @return self
     */
    public function __construct($id, Volume $volume)
    {
        parent::__construct();
        $this->property('id', (int) $id);
        $this->child('volume', $volume);
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
     * Gets or sets volume
     *
     * @param  Volume $volume
     * @return Volume|self
     */
    public function volume(Volume $volume = null)
    {
        if(null === $volume)
        {
            return $this->child('volume');
        }
        return $this->child('volume', $volume);
    }
}
