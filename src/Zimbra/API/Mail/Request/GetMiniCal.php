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
use Zimbra\Soap\Struct\CalTZInfo;
use Zimbra\Soap\Struct\Id;
use Zimbra\Utils\TypedSequence;

/**
 * GetMiniCal request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetMiniCal extends Request
{
    /**
     * Range start in milliseconds
     * @var int
     */
    private $_s;

    /**
     * Range end in milliseconds
     * @var int
     */
    private $_e;

    /**
     * Range start in milliseconds
     * @var TypedSequence<Id>
     */
    private $_folder;

    /**
     * Range start in milliseconds
     * @var CalTZInfo
     */
    private $_tz;

    /**
     * Constructor method for GetMiniCal
     * @param  int $s
     * @param  int $e
     * @param  array $folder
     * @param  CalTZInfo $tz
     * @return self
     */
    public function __construct(
        $s,
        $e,
        array $folder = array(),
        CalTZInfo $tz = null
    )
    {
        parent::__construct();
        $this->_s = (int) $s;
        $this->_e = (int) $e;
        $this->_folder = new TypedSequence('Zimbra\Soap\Struct\Id', $folder);
        if($tz instanceof CalTZInfo)
        {
            $this->_tz = $tz;
        }
    }

    /**
     * Get or set s
     *
     * @param  int $s
     * @return int|self
     */
    public function s($s = null)
    {
        if(null === $s)
        {
            return $this->_s;
        }
        $this->_s = (int) $s;
        return $this;
    }

    /**
     * Get or set e
     *
     * @param  int $e
     * @return int|self
     */
    public function e($e = null)
    {
        if(null === $e)
        {
            return $this->_e;
        }
        $this->_e = (int) $e;
        return $this;
    }

    /**
     * Add folder
     *
     * @param  Id $folder
     * @return self
     */
    public function addFolder(Id $folder)
    {
        $this->_folder->add($folder);
        return $this;
    }

    /**
     * Gets folder sequence
     *
     * @return Sequence
     */
    public function folder()
    {
        return $this->_folder;
    }

    /**
     * Get or set tz
     *
     * @param  CalTZInfo $tz
     * @return CalTZInfo|self
     */
    public function tz(CalTZInfo $tz = null)
    {
        if(null === $tz)
        {
            return $this->_tz;
        }
        $this->_tz = $tz;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            's' => $this->_s,
            'e' => $this->_e,
        );
        if(count($this->_folder))
        {
            $this->array['folder'] = array();
            foreach ($this->_folder as $folder)
            {
                $folderArr = $folder->toArray('folder');
                $this->array['folder'][] = $folderArr['folder'];
            }
        }
        if($this->_tz instanceof CalTZInfo)
        {
            $this->array += $this->_tz->toArray('tz');
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
        $this->xml->addAttribute('s', $this->_s)
                  ->addAttribute('e', $this->_e);
        foreach ($this->_folder as $folder)
        {
            $this->xml->append($folder->toXml('folder'));
        }
        if($this->_tz instanceof CalTZInfo)
        {
            $this->xml->append($this->_tz->toXml('tz'));
        }
        return parent::toXml();
    }
}
