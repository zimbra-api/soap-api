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

use Zimbra\Common\TypedSequence;
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
 * ImportData request class
 * Triggers the specified data sources to kick off their import processes.
 * Data import runs asynchronously, so the response immediately returns.
 * Status of an import can be queried via the <GetImportStatusRequest> message.
 * If the server receives an <ImportDataRequest> while an import is already running for a given data source, the second request is ignored.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ImportData extends Base
{
    /**
     * Data sources
     * @var TypedSequence<DataSourceNameOrId>
     */
    private $_dataSources;

    /**
     * Constructor method for ImportData
     * @param  array $dataSources
     * @return self
     */
    public function __construct(array $dataSources = [])
    {
        parent::__construct();
        $this->setDataSources($dataSources);
        $this->on('before', function(Base $sender)
        {
            if($sender->getDataSources()->count())
            {
                foreach ($sender->getDataSources()->all() as $dataSource)
                {
                    if($dataSource instanceof ImapDataSourceNameOrId)
                    {
                        $this->setChild('imap', $dataSource);
                    }
                    if($dataSource instanceof Pop3DataSourceNameOrId)
                    {
                        $this->setChild('pop3', $dataSource);
                    }
                    if($dataSource instanceof CaldavDataSourceNameOrId)
                    {
                        $this->setChild('caldav', $dataSource);
                    }
                    if($dataSource instanceof YabDataSourceNameOrId)
                    {
                        $this->setChild('yab', $dataSource);
                    }
                    if($dataSource instanceof RssDataSourceNameOrId)
                    {
                        $this->setChild('rss', $dataSource);
                    }
                    if($dataSource instanceof GalDataSourceNameOrId)
                    {
                        $this->setChild('gal', $dataSource);
                    }
                    if($dataSource instanceof CalDataSourceNameOrId)
                    {
                        $this->setChild('cal', $dataSource);
                    }
                    if($dataSource instanceof UnknownDataSourceNameOrId)
                    {
                        $this->setChild('unknown', $dataSource);
                    }
                }
            }
        });
    }

    /**
     * Add a data source
     *
     * @param  DataSourceInfo $dataSource
     * @return self
     */
    public function addDataSource(DataSourceNameOrId $dataSource)
    {
        $this->_dataSources->add($dataSource);
        return $this;
    }

    /**
     * Sets data sources
     *
     * @param  array $dataSources
     * @return self
     */
    public function setDataSources(array $dataSources)
    {
        $this->_dataSources = new TypedSequence('Zimbra\Mail\Struct\DataSourceNameOrId', $dataSources);
        return $this;
    }

    /**
     * Gets data sources
     *
     * @return Sequence
     */
    public function getDataSources()
    {
        return $this->_dataSources;
    }
}
