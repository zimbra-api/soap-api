<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use PhpCollection\Sequence;

/**
 * AttributeSelectorImpl struct trait
 *
 * @package    Zimbra
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
trait AttributeSelectorTrait
{

    /**
     * Attributes sequence
     * @var Sequence
     */
    private $_attrs;

    /**
     * Gets attributes
     *
     * @return string
     */
    public function getAttrs()
    {
        return implode(',', $this->_attrs->all());
    }

    /**
     * Add attribute
     *
     * @param  string $attr
     * @return self
     */
    public function addAttr($attr)
    {
        $attr = trim($attr);
        if ($this->_attrs instanceof Sequence)
        {
            if (!$this->_attrs->contains($attr))
            {
                $this->_attrs->add($attr);
            }
        }
        else
        {
            $this->_attrs = new Sequence([$attr]);
        }
        return $this;
    }

    /**
     * Sets attribute sequence
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs)
    {
        $this->_attrs = new Sequence();
        foreach ($attrs as $attr)
        {
            $attr = trim($attr);
            if (!$this->_attrs->contains($attr))
            {
                $this->_attrs->add($attr);
            }
        }
        return $this;
    }
}
