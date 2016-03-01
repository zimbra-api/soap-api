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

use Zimbra\Struct\Id;

/**
 * DeleteDataSource request class
 * Deletes the given data source.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteDataSource extends BaseAttr
{
    /**
     * Constructor method for DeleteDataSource
     * @param  string $id Id for an existing Account
     * @param  Id     $dataSource Data source ID
     * @param  array  $attrs
     * @return self
     */
    public function __construct($id, Id $dataSource, array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setProperty('id', trim($id));
        $this->setChild('dataSource', $dataSource);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets the dataSource.
     *
     * @return Id
     */
    public function getDataSource()
    {
        return $this->getChild('dataSource');
    }

    /**
     * Sets the dataSource.
     *
     * @param  Id $dataSource
     * @return self
     */
    public function setDataSource(Id $dataSource)
    {
        return $this->setChild('dataSource', $dataSource);
    }
}
