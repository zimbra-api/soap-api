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
 * CopyCos request class
 * Copy Class of service (COS).
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CopyCos extends Base
{
    /**
     * Constructor method for CopyCos
     * @param string $name Destination name for COS
     * @param Cos $cos Source COS
     * @return self
     */
    public function __construct($name = null, Cos $cos = null)
    {
        parent::__construct();
        if(null !== $name)
        {
            $this->setChild('name', trim($name));
        }
        if($cos instanceof Cos)
        {
            $this->setChild('cos', $cos);
        }
    }

    /**
     * Gets new name
     *
     * @return string
     */
    public function getNewName()
    {
        return $this->getChild('name');
    }

    /**
     * Sets new name
     *
     * @param  string $name new name
     * @return self
     */
    public function setNewName($name)
    {
        return $this->setChild('name', trim($name));
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
