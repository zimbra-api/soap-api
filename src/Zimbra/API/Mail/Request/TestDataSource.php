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
use Zimbra\Soap\Struct\MailImapDataSource;
use Zimbra\Soap\Struct\MailPop3DataSource;
use Zimbra\Soap\Struct\MailCaldavDataSource;
use Zimbra\Soap\Struct\MailYabDataSource;
use Zimbra\Soap\Struct\MailRssDataSource;
use Zimbra\Soap\Struct\MailGalDataSource;
use Zimbra\Soap\Struct\MailCalDataSource;
use Zimbra\Soap\Struct\MailUnknownDataSource;

/**
 * TestDataSource request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TestDataSource extends Request
{
    /**
     * Imap data source
     * @var MailImapDataSource
     */
    private $_imap;

    /**
     * Pop3 data source
     * @var MailPop3DataSource
     */
    private $_pop3;

    /**
     * Caldav data source
     * @var MailCaldavDataSource
     */
    private $_caldav;

    /**
     * Yab data source
     * @var MailYabDataSource
     */
    private $_yab;

    /**
     * Rss data source
     * @var MailRssDataSource
     */
    private $_rss;

    /**
     * Gal data source
     * @var MailGalDataSource
     */
    private $_gal;

    /**
     * Cal data source
     * @var MailCalDataSource
     */
    private $_cal;

    /**
     * Unknown data source
     * @var MailUnknownDataSource
     */
    private $_unknown;

    /**
     * Constructor method for TestDataSource
     * @param  MailImapDataSource $imap
     * @return self
     */
    public function __construct(
        MailImapDataSource $imap = null,
        MailPop3DataSource $pop3 = null,
        MailCaldavDataSource $caldav = null,
        MailYabDataSource $yab = null,
        MailRssDataSource $rss = null,
        MailGalDataSource $gal = null,
        MailCalDataSource $cal = null,
        MailUnknownDataSource $unknown = null
    )
    {
        parent::__construct();
        if($imap instanceof MailImapDataSource)
        {
            $this->_imap = $imap;
        }
        if($pop3 instanceof MailPop3DataSource)
        {
            $this->_pop3 = $pop3;
        }
        if($caldav instanceof MailCaldavDataSource)
        {
            $this->_caldav = $caldav;
        }
        if($yab instanceof MailYabDataSource)
        {
            $this->_yab = $yab;
        }
        if($rss instanceof MailRssDataSource)
        {
            $this->_rss = $rss;
        }
        if($gal instanceof MailGalDataSource)
        {
            $this->_gal = $gal;
        }
        if($cal instanceof MailCalDataSource)
        {
            $this->_cal = $cal;
        }
        if($unknown instanceof MailUnknownDataSource)
        {
            $this->_unknown = $unknown;
        }
    }

    /**
     * Get or set imap
     *
     * @param  MailImapDataSource $imap
     * @return MailImapDataSource|self
     */
    public function imap(MailImapDataSource $imap = null)
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
     * @param  MailPop3DataSource $pop3
     * @return MailPop3DataSource|self
     */
    public function pop3(MailPop3DataSource $pop3 = null)
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
     * @param  MailCaldavDataSource $caldav
     * @return MailCaldavDataSource|self
     */
    public function caldav(MailCaldavDataSource $caldav = null)
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
     * @param  MailYabDataSource $yab
     * @return MailYabDataSource|self
     */
    public function yab(MailYabDataSource $yab = null)
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
     * @param  MailRssDataSource $rss
     * @return MailRssDataSource|self
     */
    public function rss(MailRssDataSource $rss = null)
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
     * @param  MailGalDataSource $gal
     * @return MailGalDataSource|self
     */
    public function gal(MailGalDataSource $gal = null)
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
     * @param  MailCalDataSource $cal
     * @return MailCalDataSource|self
     */
    public function cal(MailCalDataSource $cal = null)
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
     * @param  MailUnknownDataSource $unknown
     * @return MailUnknownDataSource|self
     */
    public function unknown(MailUnknownDataSource $unknown = null)
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
        if($this->_imap instanceof MailImapDataSource)
        {
            $this->array += $this->_imap->toArray('imap');
        }
        if($this->_pop3 instanceof MailPop3DataSource)
        {
            $this->array += $this->_pop3->toArray('pop3');
        }
        if($this->_caldav instanceof MailCaldavDataSource)
        {
            $this->array += $this->_caldav->toArray('caldav');
        }
        if($this->_yab instanceof MailYabDataSource)
        {
            $this->array += $this->_yab->toArray('yab');
        }
        if($this->_rss instanceof MailRssDataSource)
        {
            $this->array += $this->_rss->toArray('rss');
        }
        if($this->_gal instanceof MailGalDataSource)
        {
            $this->array += $this->_gal->toArray('gal');
        }
        if($this->_cal instanceof MailCalDataSource)
        {
            $this->array += $this->_cal->toArray('cal');
        }
        if($this->_unknown instanceof MailUnknownDataSource)
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
        if($this->_imap instanceof MailImapDataSource)
        {
            $this->xml->append($this->_imap->toXml('imap'));
        }
        if($this->_pop3 instanceof MailPop3DataSource)
        {
            $this->xml->append($this->_pop3->toXml('pop3'));
        }
        if($this->_caldav instanceof MailCaldavDataSource)
        {
            $this->xml->append($this->_caldav->toXml('caldav'));
        }
        if($this->_yab instanceof MailYabDataSource)
        {
            $this->xml->append($this->_yab->toXml('yab'));
        }
        if($this->_rss instanceof MailRssDataSource)
        {
            $this->xml->append($this->_rss->toXml('rss'));
        }
        if($this->_gal instanceof MailGalDataSource)
        {
            $this->xml->append($this->_gal->toXml('gal'));
        }
        if($this->_cal instanceof MailCalDataSource)
        {
            $this->xml->append($this->_cal->toXml('cal'));
        }
        if($this->_unknown instanceof MailUnknownDataSource)
        {
            $this->xml->append($this->_unknown->toXml('unknown'));
        }
        return parent::toXml();
    }
}
