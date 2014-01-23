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
use Zimbra\Soap\Request;

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
class CreateDataSource extends Request
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
        $this->property('id', trim($id));
        $this->child('dataSource', $dataSource);
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
     * Gets or sets dataSource
     *
     * @param  DataSource $dataSource
     * @return DataSource|self
     */
    public function dataSource(DataSource $dataSource = null)
    {
        if(null === $dataSource)
        {
            return $this->child('dataSource');
        }
        return $this->child('dataSource', $dataSource);
    }
}
