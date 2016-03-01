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
 * ModifyVolume request class
 * Modify volume.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyVolume extends Base
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
        $this->setProperty('id', (int) $id);
        $this->setChild('volume', $volume);
    }

    /**
     * Gets Volume ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets Volume ID
     *
     * @param  int $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', (int) $id);
    }

    /**
     * Gets the volume.
     *
     * @return Volume
     */
    public function getVolume()
    {
        return $this->getChild('volume');
    }

    /**
     * Sets the volume.
     *
     * @param  Volume $volume
     * @return self
     */
    public function setVolume(Volume $volume)
    {
        return $this->setChild('volume', $volume);
    }
}
