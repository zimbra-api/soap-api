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

use Zimbra\Soap\Request;
use Zimbra\Mail\Struct\MailImapDataSource;
use Zimbra\Mail\Struct\MailPop3DataSource;
use Zimbra\Mail\Struct\MailCaldavDataSource;
use Zimbra\Mail\Struct\MailYabDataSource;
use Zimbra\Mail\Struct\MailRssDataSource;
use Zimbra\Mail\Struct\MailGalDataSource;
use Zimbra\Mail\Struct\MailCalDataSource;
use Zimbra\Mail\Struct\MailUnknownDataSource;

/**
 * TestDataSource request class
 * Tests the connection to the specified data source.
 * Does not modify the data source or import data.
 * If the id is specified, uses an existing data source.
 * Any values specified in the request are used in the test instead of the saved values.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TestDataSource extends Request
{
    /**
     * Constructor method for TestDataSource
     * @param  MailImapDataSource $imap
     * @param  MailPop3DataSource $pop3
     * @param  MailCaldavDataSource $caldav
     * @param  MailYabDataSource $yab
     * @param  MailRssDataSource $rss
     * @param  MailGalDataSource $gal
     * @param  MailCalDataSource $cal
     * @param  MailUnknownDataSource $unknown
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
            $this->child('imap', $imap);
        }
        if($pop3 instanceof MailPop3DataSource)
        {
            $this->child('pop3', $pop3);
        }
        if($caldav instanceof MailCaldavDataSource)
        {
            $this->child('caldav', $caldav);
        }
        if($yab instanceof MailYabDataSource)
        {
            $this->child('yab', $yab);
        }
        if($rss instanceof MailRssDataSource)
        {
            $this->child('rss', $rss);
        }
        if($gal instanceof MailGalDataSource)
        {
            $this->child('gal', $gal);
        }
        if($cal instanceof MailCalDataSource)
        {
            $this->child('cal', $cal);
        }
        if($unknown instanceof MailUnknownDataSource)
        {
            $this->child('unknown', $unknown);
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
            return $this->child('imap');
        }
        return $this->child('imap', $imap);
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
            return $this->child('pop3');
        }
        return $this->child('pop3', $pop3);
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
            return $this->child('caldav');
        }
        return $this->child('caldav', $caldav);
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
            return $this->child('yab');
        }
        return $this->child('yab', $yab);
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
            return $this->child('rss');
        }
        return $this->child('rss', $rss);
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
            return $this->child('gal');
        }
        return $this->child('gal', $gal);
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
            return $this->child('cal');
        }
        return $this->child('cal', $cal);
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
            return $this->child('unknown');
        }
        return $this->child('unknown', $unknown);
    }
}
