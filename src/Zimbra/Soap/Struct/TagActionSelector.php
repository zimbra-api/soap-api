<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\TagActionOp;

/**
 * TagActionSelector struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TagActionSelector extends ActionSelector
{
    /**
     * Retention policy
     * @var RetentionPolicy
     */
    private $_retentionPolicy;

    /**
     * Constructor method for AccountACEInfo
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
     * @param RetentionPolicy $retentionPolicy
     * @return self
     */
    public function __construct(
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
        $tn = null,
        RetentionPolicy $retentionPolicy = null
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
            $this->_retentionPolicy = $retentionPolicy;
        }
    }

    /**
     * Gets or sets op
     *
     * @param  TagActionOp $op
     * @return TagActionOp|self
     */
    public function op(TagActionOp $op = null)
    {
        if(null === $op)
        {
            return $this->_op;
        }
        $this->_op = $op;
        return $this;
    }

    /**
     * Gets or sets retentionPolicy
     *
     * @param  RetentionPolicy $retentionPolicy
     * @return RetentionPolicy|self
     */
    public function retentionPolicy(RetentionPolicy $retentionPolicy = null)
    {
        if(null === $retentionPolicy)
        {
            return $this->_retentionPolicy;
        }
        $this->_retentionPolicy = $retentionPolicy;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $arr = parent::toArray($name);
        if($this->_retentionPolicy instanceof RetentionPolicy)
        {
            $arr[$name] += $this->_retentionPolicy->toArray('retentionPolicy');
        }

        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'action')
    {
        $name = !empty($name) ? $name : 'action';
        $xml = parent::toXml($name);
        if($this->_retentionPolicy instanceof RetentionPolicy)
        {
            $xml->append($this->_retentionPolicy->toXml('retentionPolicy'));
        }
        return $xml;
    }
}
