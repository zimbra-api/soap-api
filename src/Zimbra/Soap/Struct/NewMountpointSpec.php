<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\SearchType;
use Zimbra\Utils\SimpleXML;
use Zimbra\Utils\Text;

/**
 * NewMountpointSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class NewMountpointSpec
{
    /**
     * Mountpoint name
     * @var string
     */
    private $_name;

    /**
     * Default type for the folder; used by web client to decide which view to use;
     * possible values are the same as <SearchRequest>'s {types}: conversation|message|contact|etc
     * @var SearchType
     */
    private $_view;

    /**
     * Flags
     * @var string
     */
    private $_f;

    /**
     * Color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @var int
     */
    private $_color;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     * @var string
     */
    private $_rgb;

    /**
     * URL (RSS, iCal, etc.) this folder reminders its contents to
     * @var string
     */
    private $_url;

    /**
     * Parent folder ID
     * @var string
     */
    private $_l;

    /**
     * If set, the server will fetch the folder if it already exists rather than throwing mail.ALREADY_EXISTS
     * @var bool
     */
    private $_fie;

    /**
     * If set, client should display reminders for shared appointments/tasks
     * @var bool
     */
    private $_reminder;

    /**
     * Zimbra ID (guid) of the owner of the linked-to resource
     * @var string
     */
    private $_zid;

    /**
     * Primary email address of the owner of the linked-to resource
     * @var string
     */
    private $_owner;

    /**
     * Item ID of the linked-to resource in the remote mailbox
     * @var int
     */
    private $_rid;

    /**
     * Path to shared item
     * @var string
     */
    private $_path;

    /**
     * Constructor method for NewMountpointSpec
     * @param string $name
     * @param SearchType $view
     * @param string $f
     * @param int $color
     * @param string $rgb
     * @param string $url
     * @param string $l
     * @param bool $fie
     * @param bool $reminder
     * @param string $zid
     * @param string $owner
     * @param int $rid
     * @param string $path
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
        $this->_name = trim($name);
        if($view instanceof SearchType)
        {
            $this->_view = $view;
        }
        $this->_f = trim($f);
        if(null !== $color)
        {
            $color = (int) $color;
            $this->_color = ($color > 0 && $color < 128) ? $color : 0;
        }
        $this->_rgb = Text::isRgb(trim($rgb)) ? trim($rgb) : '';
        $this->_url = trim($url);
        $this->_l = trim($l);
        if(null !== $fie)
        {
            $this->_fie = (bool) $fie;
        }
        if(null !== $reminder)
        {
            $this->_reminder = (bool) $reminder;
        }
        $this->_zid = trim($zid);
        $this->_owner = trim($owner);
        if(null !== $rid)
        {
            $this->_rid = (int) $rid;
        }
        $this->_path = trim($path);
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets or sets view
     *
     * @param  SearchType $view
     * @return SearchType|self
     */
    public function view(SearchType $view = null)
    {
        if(null === $view)
        {
            return $this->_view;
        }
        $this->_view = $view;
        return $this;
    }

    /**
     * Gets or sets f
     *
     * @param  string $f
     * @return string|self
     */
    public function f($f = null)
    {
        if(null === $f)
        {
            return $this->_f;
        }
        $this->_f = trim($f);
        return $this;
    }

    /**
     * Gets or sets color
     *
     * @param  int $color
     * @return int|self
     */
    public function color($color = null)
    {
        if(null === $color)
        {
            return $this->_color;
        }
        $color = (int) $color;
        $this->_color = ($color > 0 && $color < 128) ? $color : 0;
        return $this;
    }

    /**
     * Gets or sets rgb
     *
     * @param  string $rgb
     * @return string|self
     */
    public function rgb($rgb = null)
    {
        if(null === $rgb)
        {
            return $this->_rgb;
        }
        $this->_rgb = Text::isRgb(trim($rgb)) ? trim($rgb) : '';
        return $this;
    }

    /**
     * Gets or sets url
     *
     * @param  string $url
     * @return string|self
     */
    public function url($url = null)
    {
        if(null === $url)
        {
            return $this->_url;
        }
        $this->_url = trim($url);
        return $this;
    }

    /**
     * Gets or sets l
     *
     * @param  string $l
     * @return string|self
     */
    public function l($l = null)
    {
        if(null === $l)
        {
            return $this->_l;
        }
        $this->_l = trim($l);
        return $this;
    }

    /**
     * Gets or sets fie
     *
     * @param  bool $fie
     * @return bool|self
     */
    public function fie($fie = null)
    {
        if(null === $fie)
        {
            return $this->_fie;
        }
        $this->_fie = (bool) $fie;
        return $this;
    }

    /**
     * Gets or sets reminder
     *
     * @param  bool $reminder
     * @return bool|self
     */
    public function reminder($reminder = null)
    {
        if(null === $reminder)
        {
            return $this->_reminder;
        }
        $this->_reminder = (bool) $reminder;
        return $this;
    }

    /**
     * Gets or sets zid
     *
     * @param  string $zid
     * @return string|self
     */
    public function zid($zid = null)
    {
        if(null === $zid)
        {
            return $this->_zid;
        }
        $this->_zid = trim($zid);
        return $this;
    }

    /**
     * Gets or sets owner
     *
     * @param  string $owner
     * @return string|self
     */
    public function owner($owner = null)
    {
        if(null === $owner)
        {
            return $this->_owner;
        }
        $this->_owner = trim($owner);
        return $this;
    }

    /**
     * Gets or sets rid
     *
     * @param  int $rid
     * @return int|self
     */
    public function rid($rid = null)
    {
        if(null === $rid)
        {
            return $this->_rid;
        }
        $this->_rid = (int) $rid;
        return $this;
    }

    /**
     * Gets or sets path
     *
     * @param  string $path
     * @return string|self
     */
    public function path($path = null)
    {
        if(null === $path)
        {
            return $this->_path;
        }
        $this->_path = trim($path);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'link')
    {
        $name = !empty($name) ? $name : 'link';
        $arr = array(
            'name' => $this->_name,
        );
        if($this->_view instanceof SearchType)
        {
            $arr['view'] = (string) $this->_view;
        }
        if(!empty($this->_f))
        {
            $arr['f'] = $this->_f;
        }
        if(is_int($this->_color))
        {
            $arr['color'] = $this->_color;
        }
        if(!empty($this->_rgb))
        {
            $arr['rgb'] = $this->_rgb;
        }
        if(!empty($this->_url))
        {
            $arr['url'] = $this->_url;
        }
        if(!empty($this->_l))
        {
            $arr['l'] = $this->_l;
        }
        if(is_bool($this->_fie))
        {
            $arr['fie'] = $this->_fie ? 1 : 0;
        }
        if(is_bool($this->_reminder))
        {
            $arr['reminder'] = $this->_reminder ? 1 : 0;
        }
        if(!empty($this->_zid))
        {
            $arr['zid'] = $this->_zid;
        }
        if(!empty($this->_owner))
        {
            $arr['owner'] = $this->_owner;
        }
        if(is_int($this->_rid))
        {
            $arr['rid'] = $this->_rid;
        }
        if(!empty($this->_path))
        {
            $arr['path'] = $this->_path;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'link')
    {
        $name = !empty($name) ? $name : 'link';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('name', $this->_name);
        if($this->_view instanceof SearchType)
        {
            $xml->addAttribute('view', (string) $this->_view);
        }
        if(!empty($this->_f))
        {
            $xml->addAttribute('f', $this->_f);
        }
        if(is_int($this->_color))
        {
            $xml->addAttribute('color', $this->_color);
        }
        if(!empty($this->_rgb))
        {
            $xml->addAttribute('rgb', $this->_rgb);
        }
        if(!empty($this->_url))
        {
            $xml->addAttribute('url', $this->_url);
        }
        if(!empty($this->_l))
        {
            $xml->addAttribute('l', $this->_l);
        }
        if(is_bool($this->_fie))
        {
            $xml->addAttribute('fie', $this->_fie ? 1 : 0);
        }
        if(is_bool($this->_reminder))
        {
            $xml->addAttribute('reminder', $this->_reminder ? 1 : 0);
        }
        if(!empty($this->_zid))
        {
            $xml->addAttribute('zid', $this->_zid);
        }
        if(!empty($this->_owner))
        {
            $xml->addAttribute('owner', $this->_owner);
        }
        if(is_int($this->_rid))
        {
            $xml->addAttribute('rid', $this->_rid);
        }
        if(!empty($this->_path))
        {
            $xml->addAttribute('path', $this->_path);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
