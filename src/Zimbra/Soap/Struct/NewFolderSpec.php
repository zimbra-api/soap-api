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
use Zimbra\Utils\TypedSequence;

/**
 * NewFolderSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class NewFolderSpec
{
    /**
     * If "l" is unset, name is the full path of the new folder; otherwise, name may not contain the folder separator '/'
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
     * URL (RSS, iCal, etc.) this folder syncs its contents to
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
     * If set (default) then if "url" is set, synchronize folder content on folder creation
     * @var bool
     */
    private $_sync;

    /**
     * Action grant selectors
     * @var TypedSequence<ActionGrantSelector>
     */
    private $_grant;

    /**
     * Constructor method for NewFolderSpec
     * @param string $name
     * @param SearchType $view
     * @param string $f
     * @param int $color
     * @param string $rgb
     * @param string $url
     * @param string $l
     * @param bool $fie
     * @param bool $sync
     * @param array $grant
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
        $sync = null,
        array $grant = array()
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
        if(null !== $sync)
        {
            $this->_sync = (bool) $sync;
        }
        $this->_grant = new TypedSequence('Zimbra\Soap\Struct\ActionGrantSelector', $grant);
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
     * Gets or sets sync
     *
     * @param  bool $sync
     * @return bool|self
     */
    public function sync($sync = null)
    {
        if(null === $sync)
        {
            return $this->_sync;
        }
        $this->_sync = (bool) $sync;
        return $this;
    }

    /**
     * Add grant
     *
     * @param  ActionGrantSelector $grant
     * @return self
     */
    public function addGrant(ActionGrantSelector $grant)
    {
        $this->_grant->add($grant);
        return $this;
    }

    /**
     * Gets grant sequence
     *
     * @return Sequence
     */
    public function grant()
    {
        return $this->_grant;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'folder')
    {
        $name = !empty($name) ? $name : 'folder';
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
        if(is_bool($this->_sync))
        {
            $arr['sync'] = $this->_sync ? 1 : 0;
        }
        $arr['acl'] = array();
        if(count($this->_grant))
        {
            $arr['acl']['grant'] = array();
            foreach ($this->_grant as $grant)
            {
                $grantArr = $grant->toArray('grant');
                $arr['acl']['grant'][] = $grantArr['grant'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'folder')
    {
        $name = !empty($name) ? $name : 'folder';
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
        if(is_bool($this->_sync))
        {
            $xml->addAttribute('sync', $this->_sync ? 1 : 0);
        }
        $acl = $xml->addChild('acl');
        foreach ($this->_grant as $grant)
        {
            $acl->append($grant->toXml('grant'));
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
