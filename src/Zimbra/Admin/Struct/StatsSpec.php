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
     * Stats value wrapper
     * @var StatsValueWrapper
     */
    private $_values;

    /**
     * Name
     * @var string
     */
    private $_name;

    /**
     * if limit="true" is specified, attempt to reduce result set to under 500 records
     * @var string
     */
    private $_limit;

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
        $this->child('values', $values);
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $limit)
        {
            $this->property('limit', trim($limit));
        }
    }

    /**
     * Gets or sets values
     *
     * @param  StatsValueWrapper $values
     * @return StatsValueWrapper|self
     */
    public function values(StatsValueWrapper $values = null)
    {
        if(null === $values)
        {
            return $this->child('values');
        }
        return $this->child('values', $values);
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets limit
     *
     * @param  string $limit
     * @return string|self
     */
    public function limit($limit = null)
    {
        if(null === $limit)
        {
            return $this->property('limit');
        }
        return $this->property('limit', trim($limit));
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
