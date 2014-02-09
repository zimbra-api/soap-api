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

/**
 * CreateVolume request class
 * Create a volume.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateVolume extends Base
{
    /**
     * Constructor method for CreateVolume
     * @param Volume $volume Volume information
     * @return self
     */
    public function __construct(Volume $volume)
    {
        parent::__construct();
        $this->child('volume', $volume);
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
