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

use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec as DataSource;
use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * SyncGalAccountSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SyncGalAccountSpec extends Base
{
    /**
     * SyncGalAccount data source specifications
     * @var TypedSequence<DataSource>
     */
    private $_dataSource;

    /**
     * Constructor method for SyncGalAccountSpec
     * @param string $id Account ID
     * @param array $dataSources SyncGalAccount data source specifications
     * @return self
     */
    public function __construct($id, array $dataSources = array())
    {
        parent::__construct();
        $this->property('id', trim($id));
        $this->_dataSource = new TypedSequence(
            'Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec', $dataSources
        );

        $this->addHook(function($sender)
        {
            $sender->child('datasource', $sender->dataSource()->all());
        });
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
     * Add a data source
     *
     * @param  DataSource $dataSource
     * @return self
     */
    public function addDataSource(DataSource $dataSource)
    {
        $this->_dataSource->add($dataSource);
        return $this;
    }

    /**
     * Gets data source equence
     *
     * @return Sequence
     */
    public function dataSource()
    {
        return $this->_dataSource;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'account')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'account')
    {
        return parent::toXml($name);
    }
}
