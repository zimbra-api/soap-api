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
     * Constructor method for ImportData
     * @param  ImapDataSourceNameOrId $imap
     * @param  Pop3DataSourceNameOrId $pop3
     * @param  CaldavDataSourceNameOrId $caldav
     * @param  YabDataSourceNameOrId $yab
     * @param  RssDataSourceNameOrId $rss
     * @param  GalDataSourceNameOrId $gal
     * @param  CalDataSourceNameOrId $cal
     * @param  UnknownDataSourceNameOrId $unknown
     * @return self
     */
    public function __construct(
        ImapDataSourceNameOrId $imap = null,
        Pop3DataSourceNameOrId $pop3 = null,
        CaldavDataSourceNameOrId $caldav = null,
        YabDataSourceNameOrId $yab = null,
        RssDataSourceNameOrId $rss = null,
        GalDataSourceNameOrId $gal = null,
        CalDataSourceNameOrId $cal = null,
        UnknownDataSourceNameOrId $unknown = null
    )
    {
        parent::__construct();
        if($imap instanceof ImapDataSourceNameOrId)
        {
            $this->child('imap', $imap);
        }
        if($pop3 instanceof Pop3DataSourceNameOrId)
        {
            $this->child('pop3', $pop3);
        }
        if($caldav instanceof CaldavDataSourceNameOrId)
        {
            $this->child('caldav', $caldav);
        }
        if($yab instanceof YabDataSourceNameOrId)
        {
            $this->child('yab', $yab);
        }
        if($rss instanceof RssDataSourceNameOrId)
        {
            $this->child('rss', $rss);
        }
        if($gal instanceof GalDataSourceNameOrId)
        {
            $this->child('gal', $gal);
        }
        if($cal instanceof CalDataSourceNameOrId)
        {
            $this->child('cal', $cal);
        }
        if($unknown instanceof UnknownDataSourceNameOrId)
        {
            $this->child('unknown', $unknown);
        }
    }

    /**
     * Get or set imap
     *
     * @param  ImapDataSourceNameOrId $imap
     * @return ImapDataSourceNameOrId|self
     */
    public function imap(ImapDataSourceNameOrId $imap = null)
    {
        if(null === $imap)
        {
            return $this->child('imap');
        }
        return $this->child('imap', $imap);
    }

    /**
     * Get or set pop3
     *
     * @param  Pop3DataSourceNameOrId $pop3
     * @return Pop3DataSourceNameOrId|self
     */
    public function pop3(Pop3DataSourceNameOrId $pop3 = null)
    {
        if(null === $pop3)
        {
            return $this->child('pop3');
        }
        return $this->child('pop3', $pop3);
    }

    /**
     * Get or set caldav
     *
     * @param  CaldavDataSourceNameOrId $caldav
     * @return CaldavDataSourceNameOrId|self
     */
    public function caldav(CaldavDataSourceNameOrId $caldav = null)
    {
        if(null === $caldav)
        {
            return $this->child('caldav');
        }
        return $this->child('caldav', $caldav);
    }

    /**
     * Get or set yab
     *
     * @param  YabDataSourceNameOrId $yab
     * @return YabDataSourceNameOrId|self
     */
    public function yab(YabDataSourceNameOrId $yab = null)
    {
        if(null === $yab)
        {
            return $this->child('yab');
        }
        return $this->child('yab', $yab);
    }

    /**
     * Get or set rss
     *
     * @param  RssDataSourceNameOrId $rss
     * @return RssDataSourceNameOrId|self
     */
    public function rss(RssDataSourceNameOrId $rss = null)
    {
        if(null === $rss)
        {
            return $this->child('rss');
        }
        return $this->child('rss', $rss);
    }

    /**
     * Get or set gal
     *
     * @param  GalDataSourceNameOrId $gal
     * @return GalDataSourceNameOrId|self
     */
    public function gal(GalDataSourceNameOrId $gal = null)
    {
        if(null === $gal)
        {
            return $this->child('gal');
        }
        return $this->child('gal', $gal);
    }

    /**
     * Get or set cal
     *
     * @param  CalDataSourceNameOrId $cal
     * @return CalDataSourceNameOrId|self
     */
    public function cal(CalDataSourceNameOrId $cal = null)
    {
        if(null === $cal)
        {
            return $this->child('cal');
        }
        return $this->child('cal', $cal);
    }

    /**
     * Get or set unknown
     *
     * @param  UnknownDataSourceNameOrId $unknown
     * @return UnknownDataSourceNameOrId|self
     */
    public function unknown(UnknownDataSourceNameOrId $unknown = null)
    {
        if(null === $unknown)
        {
            return $this->child('unknown');
        }
        return $this->child('unknown', $unknown);
    }
}
