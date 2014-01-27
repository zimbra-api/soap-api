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

use Zimbra\Struct\Base;

/**
 * ModifySearchFolderSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class ModifySearchFolderSpec extends Base
{
    /**
     * Constructor method for ModifySearchFolderSpec
     * @param string $id ID
     * @param string $query Query
     * @param string $types Search types
     * @param string $sortBy Sort by
     * @return self
     */
    public function __construct(
        $id,
        $query,
        $types = null,
        $sortBy = null
    )
    {
        parent::__construct();
        $this->property('id', trim($id));
        $this->property('query', trim($query));
        if(null !== $types)
        {
            $this->property('types', trim($types));
        }
        if(null !== $sortBy)
        {
            $this->property('sortBy', trim($sortBy));
        }
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets query
     *
     * @param  string $query
     * @return string|self
     */
    public function query($query = null)
    {
        if(null === $query)
        {
            return $this->property('query');
        }
        return $this->property('query', trim($query));
    }

    /**
     * Gets or sets types
     *
     * @param  bool $types
     * @return bool|self
     */
    public function types($types = null)
    {
        if(null === $types)
        {
            return $this->property('types');
        }
        return $this->property('types', trim($types));
    }

    /**
     * Gets or sets sortBy
     *
     * @param  int $sortBy
     * @return int|self
     */
    public function sortBy($sortBy = null)
    {
        if(null === $sortBy)
        {
            return $this->property('sortBy');
        }
        return $this->property('sortBy', trim($sortBy));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'search')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'search')
    {
        return parent::toXml($name);
    }
}
