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

use Zimbra\Admin\Struct\DataSourceSpecifier as DataSource;

/**
 * CreateDataSource request class
 * Count number of objects.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateDataSource extends Base
{
    /**
     * Id for an existing Account
     * @var string
     */
    private $_id;

    /**
     * Details of data source
     * @var DataSource
     */
    private $_dataSource;

    /**
     * Constructor method for CreateDataSource
     * @param string $id
     * @param DataSource $dataSource
     * @return self
     */
    public function __construct($id, DataSource $dataSource)
    {
        parent::__construct();
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
     * @return DataSource
     */
    public function getDataSource()
    {
        return $this->getChild('dataSource');
    }

    /**
     * Sets the dataSource.
     *
     * @param  DataSource $dataSource
     * @return self
     */
    public function setDataSource(DataSource $dataSource)
    {
        return $this->setChild('dataSource', $dataSource);
    }
}
