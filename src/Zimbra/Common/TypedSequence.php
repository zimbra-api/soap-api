<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common;

use PhpCollection\Sequence;

/**
 * TypedSequence class
 *
 * @package   Zimbra
 * @category  Common
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TypedSequence extends Sequence
{
    /**
     * Class type
     * @var string
     */
    private $_type;

    /**
     * Constructor method for TypedSequence
     * @param string $type
     * @param array $elements
     * @return self
     */
    public function __construct($type, array $elements = [])
    {
        parent::__construct();
        $this->_type = $type;
        $this->addAll($elements);
    }

    /**
     * Appends an element at the end of the sequence.
     * @param T $element
     * @return self
     */
    public function add($element)
    {
        if($element instanceof $this->_type)
        {
            parent::add($element);
        }
        else
        {
            throw new \UnexpectedValueException(
                "TypedSequence<$this->_type> can only hold objects of $this->_type class."
            );
        }
        return $this;
    }

    /**
     * Appends elements at the end of the sequence.
     * @param array $elements
     * @return self
     */
    public function addAll(array $elements)
    {
        foreach ($elements as $element)
        {
            $this->add($element);
        }
        return $this;
    }

    /**
     * Updates the element at the given index (0-based).
     *
     * @param int $index
     * @param T $value
     */
    public function update($index, $value)
    {
        if (!isset($this->elements[$index]))
        {
            throw new \InvalidArgumentException(
                sprintf('There is no element at index "%d".', $index)
            );
        }
        if($value instanceof $this->_type)
        {
            $this->elements[$index] = $value;
        }
        return $this;
    }

    /**
     * Remove the element from sequence.
     *
     * @param T $element
     * @param int
     */
    public function removeElement($element)
    {
        if(($index = $this->indexOf($element)) >= 0)
        {
            $this->remove($index);
            return $index;
        }
        else
            return false;
    }
}
