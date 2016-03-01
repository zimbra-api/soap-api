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
        $this->setProperty('id', (int) $id);
        $this->setProperty('type', $type);
    }

    /**
     * Gets ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets ID
     *
     * @param  int $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', (int) $id);
    }

    /**
     * Gets type
     *
     * @return VolumeType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type
     *
     * @param  VolumeType $type
     * @return self
     */
    public function setType(VolumeType $type)
    {
        return $this->setProperty('type', $type);
    }
}
