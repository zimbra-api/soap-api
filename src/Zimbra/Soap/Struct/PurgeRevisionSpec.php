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

use Zimbra\Utils\SimpleXML;

/**
 * PurgeRevisionSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class PurgeRevisionSpec
{
    /**
     * Item ID
     * @var string
     */
    private $_id;

    /**
     * Revision
     * @var int
     */
    private $_ver;

    /**
     * When set, the server will purge all the old revisions inclusive of the revision specified in the request.
     * @var bool
     */
    private $_includeOlderRevisions;

    /**
     * Constructor method for PurgeRevisionSpec
     * @param string $id
     * @param int    $ver
     * @param bool   $includeOlderRevisions
     * @return self
     */
    public function __construct(
        $id,
        $ver,
        $includeOlderRevisions = null
    )
    {
        $this->_id = trim($id);
        $this->_ver = (int) $ver;
        if(null !== $includeOlderRevisions)
        {
            $this->_includeOlderRevisions = (bool) $includeOlderRevisions;
        }
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets or sets ver
     *
     * @param  int $ver
     * @return int|self
     */
    public function ver($ver = null)
    {
        if(null === $ver)
        {
            return $this->_ver;
        }
        $this->_ver = (int) $ver;
        return $this;
    }

    /**
     * Gets or sets includeOlderRevisions
     *
     * @param  bool $includeOlderRevisions
     * @return bool|self
     */
    public function includeOlderRevisions($includeOlderRevisions = null)
    {
        if(null === $includeOlderRevisions)
        {
            return $this->_includeOlderRevisions;
        }
        $this->_includeOlderRevisions = (bool) $includeOlderRevisions;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'revision')
    {
        $name = !empty($name) ? $name : 'revision';
        $arr = array(
            'id' => $this->_id,
            'ver' => $this->_ver,
        );
        if(is_bool($this->_includeOlderRevisions))
        {
            $arr['includeOlderRevisions'] = $this->_includeOlderRevisions ? 1 : 0;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'revision')
    {
        $name = !empty($name) ? $name : 'revision';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id)
            ->addAttribute('ver', $this->_ver);
        if(is_bool($this->_includeOlderRevisions))
        {
            $xml->addAttribute('includeOlderRevisions', $this->_includeOlderRevisions ? 1 : 0);
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
