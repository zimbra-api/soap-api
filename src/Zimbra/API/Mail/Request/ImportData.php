<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\ImapDataSourceNameOrId;
use Zimbra\Soap\Struct\Pop3DataSourceNameOrId;
use Zimbra\Soap\Struct\CaldavDataSourceNameOrId;
use Zimbra\Soap\Struct\YabDataSourceNameOrId;
use Zimbra\Soap\Struct\RssDataSourceNameOrId;
use Zimbra\Soap\Struct\GalDataSourceNameOrId;
use Zimbra\Soap\Struct\CalDataSourceNameOrId;
use Zimbra\Soap\Struct\UnknownDataSourceNameOrId;

/**
 * ImportData request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ImportData extends Request
{
    /**
     * Imap data source
     * @var ImapDataSourceNameOrId
     */
    private $_imap;

    /**
     * Pop3 data source
     * @var Pop3DataSourceNameOrId
     */
    private $_pop3;

    /**
     * Caldav data source
     * @var CaldavDataSourceNameOrId
     */
    private $_caldav;

    /**
     * Yab data source
     * @var YabDataSourceNameOrId
     */
    private $_yab;

    /**
     * Rss data source
     * @var RssDataSourceNameOrId
     */
    private $_rss;

    /**
     * Gal data source
     * @var GalDataSourceNameOrId
     */
    private $_gal;

    /**
     * Cal data source
     * @var CalDataSourceNameOrId
     */
    private $_cal;

    /**
     * Unknown data source
     * @var UnknownDataSourceNameOrId
     */
    private $_unknown;

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
            $this->_imap = $imap;
        }
        if($pop3 instanceof Pop3DataSourceNameOrId)
        {
            $this->_pop3 = $pop3;
        }
        if($caldav instanceof CaldavDataSourceNameOrId)
        {
            $this->_caldav = $caldav;
        }
        if($yab instanceof YabDataSourceNameOrId)
        {
            $this->_yab = $yab;
        }
        if($rss instanceof RssDataSourceNameOrId)
        {
            $this->_rss = $rss;
        }
        if($gal instanceof GalDataSourceNameOrId)
        {
            $this->_gal = $gal;
        }
        if($cal instanceof CalDataSourceNameOrId)
        {
            $this->_cal = $cal;
        }
        if($unknown instanceof UnknownDataSourceNameOrId)
        {
            $this->_unknown = $unknown;
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
            return $this->_imap;
        }
        $this->_imap = $imap;
        return $this;
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
            return $this->_pop3;
        }
        $this->_pop3 = $pop3;
        return $this;
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
            return $this->_caldav;
        }
        $this->_caldav = $caldav;
        return $this;
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
            return $this->_yab;
        }
        $this->_yab = $yab;
        return $this;
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
            return $this->_rss;
        }
        $this->_rss = $rss;
        return $this;
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
            return $this->_gal;
        }
        $this->_gal = $gal;
        return $this;
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
            return $this->_cal;
        }
        $this->_cal = $cal;
        return $this;
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
            return $this->_unknown;
        }
        $this->_unknown = $unknown;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_imap instanceof ImapDataSourceNameOrId)
        {
            $this->array += $this->_imap->toArray('imap');
        }
        if($this->_pop3 instanceof Pop3DataSourceNameOrId)
        {
            $this->array += $this->_pop3->toArray('pop3');
        }
        if($this->_caldav instanceof CaldavDataSourceNameOrId)
        {
            $this->array += $this->_caldav->toArray('caldav');
        }
        if($this->_yab instanceof YabDataSourceNameOrId)
        {
            $this->array += $this->_yab->toArray('yab');
        }
        if($this->_rss instanceof RssDataSourceNameOrId)
        {
            $this->array += $this->_rss->toArray('rss');
        }
        if($this->_gal instanceof GalDataSourceNameOrId)
        {
            $this->array += $this->_gal->toArray('gal');
        }
        if($this->_cal instanceof CalDataSourceNameOrId)
        {
            $this->array += $this->_cal->toArray('cal');
        }
        if($this->_unknown instanceof UnknownDataSourceNameOrId)
        {
            $this->array += $this->_unknown->toArray('unknown');
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if($this->_imap instanceof ImapDataSourceNameOrId)
        {
            $this->xml->append($this->_imap->toXml('imap'));
        }
        if($this->_pop3 instanceof Pop3DataSourceNameOrId)
        {
            $this->xml->append($this->_pop3->toXml('pop3'));
        }
        if($this->_caldav instanceof CaldavDataSourceNameOrId)
        {
            $this->xml->append($this->_caldav->toXml('caldav'));
        }
        if($this->_yab instanceof YabDataSourceNameOrId)
        {
            $this->xml->append($this->_yab->toXml('yab'));
        }
        if($this->_rss instanceof RssDataSourceNameOrId)
        {
            $this->xml->append($this->_rss->toXml('rss'));
        }
        if($this->_gal instanceof GalDataSourceNameOrId)
        {
            $this->xml->append($this->_gal->toXml('gal'));
        }
        if($this->_cal instanceof CalDataSourceNameOrId)
        {
            $this->xml->append($this->_cal->toXml('cal'));
        }
        if($this->_unknown instanceof UnknownDataSourceNameOrId)
        {
            $this->xml->append($this->_unknown->toXml('unknown'));
        }
        return parent::toXml();
    }
}
