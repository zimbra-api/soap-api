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

use Zimbra\Enum\TagActionOp;

/**
 * TagActionSelector struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TagActionSelector extends ActionSelector
{
    /**
     * Constructor method for AccountACEInfo
     * @param RetentionPolicy $retentionPolicy Retention policy
     * @param TagActionOp $op
     * @param string $id
     * @param string $tcon
     * @param int    $tag
     * @param string $l
     * @param string $rgb
     * @param int    $color
     * @param string $name
     * @param string $f
     * @param string $t
     * @param string $tn
     * @return self
     */
    public function __construct(
        RetentionPolicy $retentionPolicy = null,
        TagActionOp $op,
        $id = null,
        $tcon = null,
        $tag = null,
        $l = null,
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
            $l,
            $rgb,
            $color,
            $name,
            $f,
            $t,
            $tn
        );
        if($retentionPolicy instanceof RetentionPolicy)
        {
            $this->setChild('retentionPolicy', $retentionPolicy);
        }
    }

    /**
     * Gets operation
     *
     * @return TagActionOp
     */
    public function getOperation()
    {
        return $this->getProperty('op');
    }

    /**
     * Sets operation
     *
     * @param  TagActionOp $op
     * @return self
     */
    public function setOperation(TagActionOp $op)
    {
        return $this->setProperty('op', $op);
    }

    /**
     * Gets retention policy
     *
     * @return RetentionPolicy
     */
    public function getRetentionPolicy()
    {
        return $this->getChild('retentionPolicy');
    }

    /**
     * Sets retention policy
     *
     * @param  RetentionPolicy $retentionPolicy
     * @return self
     */
    public function setRetentionPolicy(RetentionPolicy $retentionPolicy)
    {
        return $this->setChild('retentionPolicy', $retentionPolicy);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        return parent::toXml($name);
    }
}
