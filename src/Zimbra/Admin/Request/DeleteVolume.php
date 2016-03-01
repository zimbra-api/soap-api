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
        $this->setProperty('id', (int) $id);
    }

    /**
     * Gets id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  int $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', (int) $id);
    }
}
