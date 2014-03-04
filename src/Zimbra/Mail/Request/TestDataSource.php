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
class TestDataSource extends Base
{
    /**
     * Constructor method for TestDataSource
     * @param  MailDataSource $ds
     * @return self
     */
    public function __construct(MailDataSource $ds = null)
    {
        parent::__construct();
        if($ds instanceof MailImapDataSource)
        {
            $this->child('imap', $ds);
        }
        if($ds instanceof MailPop3DataSource)
        {
            $this->child('pop3', $ds);
        }
        if($ds instanceof MailCaldavDataSource)
        {
            $this->child('caldav', $ds);
        }
        if($ds instanceof MailYabDataSource)
        {
            $this->child('yab', $ds);
        }
        if($ds instanceof MailRssDataSource)
        {
            $this->child('rss', $ds);
        }
        if($ds instanceof MailGalDataSource)
        {
            $this->child('gal', $ds);
        }
        if($ds instanceof MailCalDataSource)
        {
            $this->child('cal', $ds);
        }
        if($ds instanceof MailUnknownDataSource)
        {
            $this->child('unknown', $ds);
        }
    }

    /**
     * Gets or sets child
     *
     * @param  string $name
     * @param  mix $value
     * @return string|self
     */
    public function child($name, $value = null)
    {
        if($value instanceof MailDataSource)
        {
            $dataSources = array('imap', 'pop3', 'caldav', 'yab', 'rss', 'gal', 'cal', 'unknown');
            foreach ($dataSources as $ds)
            {
                $this->removeChild($ds);
            }
        }
        return parent::child($name, $value);
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
