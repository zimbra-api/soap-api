<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\DataSourceNameOrId;
use Zimbra\Mail\Struct\ImapDataSourceNameOrId;
use Zimbra\Mail\Struct\Pop3DataSourceNameOrId;
use Zimbra\Mail\Struct\CaldavDataSourceNameOrId;
use Zimbra\Mail\Struct\YabDataSourceNameOrId;
use Zimbra\Mail\Struct\RssDataSourceNameOrId;
use Zimbra\Mail\Struct\GalDataSourceNameOrId;
use Zimbra\Mail\Struct\CalDataSourceNameOrId;
use Zimbra\Mail\Struct\UnknownDataSourceNameOrId;

/**
 * DeleteDataSource request class
 * Deletes the given data sources.
 * The name or id of each data source must be specified.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteDataSource extends Base
{
    /**
     * Specify the datasources to delete
     * @var  DataSourceNameOrId
     */
    private $_dataSource;

    /**
     * Constructor method for DeleteDataSource
     * @param  DataSourceNameOrId $ds
     * @return self
     */
    public function __construct(DataSourceNameOrId $ds = null)
    {
        parent::__construct();
        if ($ds instanceof DataSourceNameOrId)
        {
            $this->_dataSource = $ds;
        }
        $this->on('before', function(Base $sender)
        {
            if($this->_dataSource instanceof ImapDataSourceNameOrId)
            {
                $this->setChild('imap', $this->_dataSource);
            }
            if($this->_dataSource instanceof Pop3DataSourceNameOrId)
            {
                $this->setChild('pop3', $this->_dataSource);
            }
            if($this->_dataSource instanceof CaldavDataSourceNameOrId)
            {
                $this->setChild('caldav', $this->_dataSource);
            }
            if($this->_dataSource instanceof YabDataSourceNameOrId)
            {
                $this->setChild('yab', $this->_dataSource);
            }
            if($this->_dataSource instanceof RssDataSourceNameOrId)
            {
                $this->setChild('rss', $this->_dataSource);
            }
            if($this->_dataSource instanceof GalDataSourceNameOrId)
            {
                $this->setChild('gal', $this->_dataSource);
            }
            if($this->_dataSource instanceof CalDataSourceNameOrId)
            {
                $this->setChild('cal', $this->_dataSource);
            }
            if($this->_dataSource instanceof UnknownDataSourceNameOrId)
            {
                $this->setChild('unknown', $this->_dataSource);
            }
        });
    }

    /**
     * Gets data source
     *
     * @return DataSourceNameOrId
     */
    public function getDataSource()
    {
        return $this->_dataSource;
    }

    /**
     * Sets data source
     *
     * @param  DataSourceNameOrId $ds
     * @return self
     */
    public function setDataSource(DataSourceNameOrId $ds)
    {
        $this->_dataSource = $ds;
        return $this;
    }
}
