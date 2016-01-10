<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Common\Text;
use Zimbra\Enum\SearchType;
use Zimbra\Struct\Base;

/**
 * NewMountpointSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class NewMountpointSpec extends Base
{
    /**
     * Constructor method for NewMountpointSpec
     * @param string $name Mountpoint name
     * @param SearchType $view Default type for the folder; used by web client to decide which view to use; possible values are the same as <SearchRequest>'s {types}: conversation|message|contact|etc
     * @param string $f Flags
     * @param int $color Color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @param string $rgb RGB color in format #rrggbb where r,g and b are hex digits
     * @param string $url URL (RSS, iCal, etc.) this folder reminders its contents to
     * @param string $l Parent folder ID
     * @param bool $fie If set, the server will fetch the folder if it already exists rather than throwing mail.ALREADY_EXISTS
     * @param bool $reminder If set, client should display reminders for shared appointments/tasks
     * @param string $zid Zimbra ID (guid) of the owner of the linked-to resource
     * @param string $owner Primary email address of the owner of the linked-to resource
     * @param int $rid Item ID of the linked-to resource in the remote mailbox
     * @param string $path Path to shared item
     * @return self
     */
    public function __construct(
        $name,
        SearchType $view = null,
        $f = null,
        $color = null,
        $rgb = null,
        $url = null,
        $l = null,
        $fie = null,
        $reminder = null,
        $zid = null,
        $owner = null,
        $rid = null,
        $path = null
    )
    {
        parent::__construct();
        $this->setProperty('name', trim($name));
        if($view instanceof SearchType)
        {
            $this->setProperty('view', $view);
        }
        if(null !== $f)
        {
            $this->setProperty('f', trim($f));
        }
        if(null !== $color)
        {
            $color = (int) $color;
            $this->setProperty('color', ($color > 0 && $color < 128) ? $color : 0);
        }
        if(null !== $rgb && Text::isRgb(trim($rgb)))
        {
            $this->setProperty('rgb', trim($rgb));
        }
        if(null !== $url)
        {
            $this->setProperty('url', trim($url));
        }
        if(null !== $l)
        {
            $this->setProperty('l', trim($l));
        }
        if(null !== $fie)
        {
            $this->setProperty('fie', (bool) $fie);
        }
        if(null !== $reminder)
        {
            $this->setProperty('reminder', (bool) $reminder);
        }
        if(null !== $zid)
        {
            $this->setProperty('zid', trim($zid));
        }
        if(null !== $owner)
        {
            $this->setProperty('owner', trim($owner));
        }
        if(null !== $rid)
        {
            $this->setProperty('rid', (int) $rid);
        }
        if(null !== $path)
        {
            $this->setProperty('path', trim($path));
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets default type for the folder
     *
     * @return SearchType
     */
    public function getView()
    {
        return $this->getProperty('view');
    }

    /**
     * Sets default type for the folder
     *
     * @param  SearchType $view
     * @return self
     */
    public function setView(SearchType $view)
    {
        return $this->setProperty('view', $view);
    }

    /**
     * Gets flags
     *
     * @return string
     */
    public function getFlags()
    {
        return $this->getProperty('f');
    }

    /**
     * Sets flags
     *
     * @param  string $f
     * @return self
     */
    public function setFlags($f)
    {
        return $this->setProperty('f', trim($f));
    }

    /**
     * Gets color
     *
     * @return int
     */
    public function getColor()
    {
        return $this->getProperty('color');
    }

    /**
     * Sets color
     *
     * @param  int $color
     * @return self
     */
    public function setColor($color)
    {
        $color = (int) $color;
        return $this->setProperty('color', ($color > 0 && $color < 128) ? $color : 0);
    }

    /**
     * Gets RGB color in format
     *
     * @return string
     */
    public function getRgb()
    {
        return $this->getProperty('rgb');
    }

    /**
     * Sets RGB color in format
     *
     * @param  string $rgb
     * @return self
     */
    public function setRgb($rgb)
    {
        return $this->setProperty('rgb', Text::isRgb(trim($rgb)) ? trim($rgb) : '');
    }

    /**
     * Gets url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->getProperty('url');
    }

    /**
     * Sets url
     *
     * @param  string $url
     * @return self
     */
    public function setUrl($url)
    {
        return $this->setProperty('url', trim($url));
    }

    /**
     * Gets parent folder ID
     *
     * @return string
     */
    public function getParentFolderId()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets parent folder ID
     *
     * @param  string $l
     * @return self
     */
    public function setParentFolderId($l)
    {
        return $this->setProperty('l', trim($l));
    }

    /**
     * Gets fetch if exists
     *
     * @return bool
     */
    public function getFetchIfExists()
    {
        return $this->getProperty('fie');
    }

    /**
     * Sets fetch if exists
     *
     * @param  bool $fie
     * @return self
     */
    public function setFetchIfExists($fie)
    {
        return $this->setProperty('fie', (bool) $fie);
    }

    /**
     * Gets reminder
     *
     * @return bool
     */
    public function getReminderEnabled()
    {
        return $this->getProperty('reminder');
    }

    /**
     * Sets reminder
     *
     * @param  bool $reminder
     * @return self
     */
    public function setReminderEnabled($reminder)
    {
        return $this->setProperty('reminder', (bool) $reminder);
    }

    /**
     * Gets owner zimbra ID
     *
     * @return string
     */
    public function getOwnerId()
    {
        return $this->getProperty('zid');
    }

    /**
     * Sets owner zimbra ID
     *
     * @param  string $zid
     * @return self
     */
    public function setOwnerId($zid)
    {
        return $this->setProperty('zid', trim($zid));
    }

    /**
     * Gets owner name
     *
     * @return string
     */
    public function getOwnerName()
    {
        return $this->getProperty('owner');
    }

    /**
     * Sets owner name
     *
     * @param  string $owner
     * @return self
     */
    public function setOwnerName($owner)
    {
        return $this->setProperty('owner', trim($owner));
    }

    /**
     * Gets id of shared item
     *
     * @return int
     */
    public function getRemoteId()
    {
        return $this->getProperty('rid');
    }

    /**
     * Sets id of shared item
     *
     * @param  int $rid
     * @return self
     */
    public function setRemoteId($rid)
    {
        return $this->setProperty('rid', (int) $rid);
    }

    /**
     * Gets path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getProperty('path');
    }

    /**
     * Sets path
     *
     * @param  string $path
     * @return self
     */
    public function setPath($path)
    {
        return $this->setProperty('path', trim($path));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'link')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'link')
    {
        return parent::toXml($name);
    }
}
