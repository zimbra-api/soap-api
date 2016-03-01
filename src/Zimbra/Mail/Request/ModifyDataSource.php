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

use Zimbra\Mail\Struct\MailDataSource;
use Zimbra\Mail\Struct\MailImapDataSource;
use Zimbra\Mail\Struct\MailPop3DataSource;
use Zimbra\Mail\Struct\MailCaldavDataSource;
use Zimbra\Mail\Struct\MailYabDataSource;
use Zimbra\Mail\Struct\MailRssDataSource;
use Zimbra\Mail\Struct\MailGalDataSource;
use Zimbra\Mail\Struct\MailCalDataSource;
use Zimbra\Mail\Struct\MailUnknownDataSource;

/**
 * ModifyDataSource request class
 * Changes attributes of the given data source.
 * Only the attributes specified in the request are modified.
 * If the username, host or leaveOnServer settings are modified, the server wipes out saved state for this data source.
 * As a result, any previously downloaded messages that are still stored on the remote server will be downloaded again.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyDataSource extends Base
{
    /**
     * Specify the datasources to create
     * @var  MailDataSource
     */
    private $_dataSource;

    /**
     * Constructor method for ModifyDataSource
     * @param  MailDataSource $dataSource
     * @return self
     */
    public function __construct(MailDataSource $dataSource = null)
    {
        parent::__construct();
        if ($dataSource instanceof MailDataSource)
        {
            $this->_dataSource = $dataSource;
        }
        $this->on('before', function(Base $sender)
        {
            if($this->_dataSource instanceof MailImapDataSource)
            {
                $this->setChild('imap', $this->_dataSource);
            }
            if($this->_dataSource instanceof MailPop3DataSource)
            {
                $this->setChild('pop3', $this->_dataSource);
            }
            if($this->_dataSource instanceof MailCaldavDataSource)
            {
                $this->setChild('caldav', $this->_dataSource);
            }
            if($this->_dataSource instanceof MailYabDataSource)
            {
                $this->setChild('yab', $this->_dataSource);
            }
            if($this->_dataSource instanceof MailRssDataSource)
            {
                $this->setChild('rss', $this->_dataSource);
            }
            if($this->_dataSource instanceof MailGalDataSource)
            {
                $this->setChild('gal', $this->_dataSource);
            }
            if($this->_dataSource instanceof MailCalDataSource)
            {
                $this->setChild('cal', $this->_dataSource);
            }
            if($this->_dataSource instanceof MailUnknownDataSource)
            {
                $this->setChild('unknown', $this->_dataSource);
            }
        });
    }

    /**
     * Gets data source
     *
     * @return MailDataSource
     */
    public function getDataSource()
    {
        return $this->_dataSource;
    }

    /**
     * Sets data source
     *
     * @param  MailDataSource $dataSource
     * @return self
     */
    public function setDataSource(MailDataSource $dataSource)
    {
        $this->_dataSource = $dataSource;
        return $this;
    }
}
