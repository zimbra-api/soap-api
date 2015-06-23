<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use PhpCollection\Sequence;
use Zimbra\Struct\Base;

/**
 * ConstraintInfoValues struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConstraintInfoValues extends Base
{
    /**
     * Values
     * @var Sequence
     */
    private $_values;

    /**
     * Constructor method for ConstraintInfoValues
     * @param  array $values
     * @return self
     */
    public function __construct(array $values = [])
    {
        parent::__construct();
        $this->setValues($values);

        $this->on('before', function(Base $sender)
        {
            if($sender->getValues()->count())
            {
                $sender->setChild('v', $sender->getValues()->all());
            }
        });
    }

    /**
     * Adds a values
     *
     * @param  string $values
     * @return self
     */
    public function addValue($values)
    {
        if(!empty($values) && !$this->_values->contains($values))
        {
            $this->_values->add($values);
        }
        return $this;
    }

    /**
     * Sets values sequence
     *
     * @param  array $values
     * @return self
     */
    public function setValues(array $values)
    {
        $arrValue = [];
        foreach ($values as $value)
        {
            $value = trim($value);
            if(!empty($value) && !in_array($value, $arrValue))
            {
                $arrValue[] = $value;
            }
        }
        $this->_values = new Sequence($arrValue);
        return $this;
    }

    /**
     * Gets values sequence
     *
     * @return Sequence
     */
    public function getValues()
    {
        return $this->_values;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'values')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'values')
    {
        return parent::toXml($name);
    }
}
