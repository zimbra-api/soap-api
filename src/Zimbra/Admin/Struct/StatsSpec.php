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

use Zimbra\Struct\Base;

/**
 * StatsSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class StatsSpec extends Base
{
    /**
     * Constructor method for StatsSpec
     * @param  StatsValueWrapper $values
     * @param  string $name
     * @param  string $limit
     * @return self
     */
    public function __construct(StatsValueWrapper $values, $name = null, $limit = null)
    {
        parent::__construct();
        $this->setChild('values', $values);
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $limit)
        {
            $this->setProperty('limit', trim($limit));
        }
    }

    /**
     * Gets the values.
     *
     * @return StatsValueWrapper
     */
    public function getValues()
    {
        return $this->getChild('values');
    }

    /**
     * Sets the values.
     *
     * @param  StatsValueWrapper $values
     * @return self
     */
    public function setValues(StatsValueWrapper $values)
    {
        return $this->setChild('values', $values);
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets the limit
     *
     * @return string
     */
    public function getLimit()
    {
        return $this->getProperty('limit');
    }

    /**
     * Sets the limit
     *
     * @param  string $limit
     * @return self
     */
    public function setLimit($limit)
    {
        return $this->setProperty('limit', trim($limit));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'stats')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'stats')
    {
        return parent::toXml($name);
    }
}
