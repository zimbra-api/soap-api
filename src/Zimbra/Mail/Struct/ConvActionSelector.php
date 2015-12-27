<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Enum\ConvActionOp;

/**
 * ConvActionSelector struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConvActionSelector extends ActionSelector
{
    /**
     * Constructor method for ConvActionSelector
     * @param ConvActionOp $op
     * @param string $id
     * @param string $tcon
     * @param int    $tag
     * @param string $folder
     * @param string $rgb
     * @param int    $color
     * @param string $name
     * @param string $f
     * @param string $t
     * @param string $tn
     * @return self
     */
    public function __construct(
        ConvActionOp $op,
        $id = null,
        $tcon = null,
        $tag = null,
        $folder = null,
        $rgb = null,
        $color = null,
        $name = null,
        $f = null,
        $t = null,
        $tn = null
    )
    {
        parent::__construct(
            $op,
            $id,
            $tcon,
            $tag,
            $folder,
            $rgb,
            $color,
            $name,
            $f,
            $t,
            $tn
        );
    }

    /**
     * Gets operation
     *
     * @return ConvActionOp
     */
    public function getOperation()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operation
     *
     * @param  ConvActionOp $op
     * @return self
     */
    public function setOperation(ConvActionOp $op)
    {
        return $this->setProperty('op', $op);
    }
}
