<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Enum\CSRType;
use Zimbra\Soap\Enum\CSRKeySize;

/**
 * GenCSR class
 * Request a certificate signing request (CSR).
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GenCSR extends Request
{
    /**
     * Server ID
     * @var string
     */
    private $_server;

    /**
     * If value is "1" then force to create a new CSR, the previous one will be overwrited
     * @var string
     */
    private $_isNew;

    /**
     * Type of CSR (required)
     * self|comm
     * @var CSRType
     */
    private $_type;

    /**
     * Key size - 1024 or 2048
     * @var CSRKeySize
     */
    private $_keysize;

    /**
     * Subject attr C
     * @var string
     */
    private $_c;

    /**
     * Subject attr ST
     * @var string
     */
    private $_sT;

    /**
     * Subject attr L
     * @var string
     */
    private $_l;

    /**
     * Subject attr O
     * @var string
     */
    private $_o;

    /**
     * Subject attr OU
     * @var string
     */
    private $_oU;

    /**
     * Subject attr CN
     * @var string
     */
    private $_cN;

    /**
     * Used to add the Subject Alt Name extension in the certificate, so multiple hosts can be supported
     * @var array
     */
    private $_subjectAltName = array();

    /**
     * Constructor method for GenCSR
     * @param string $server
     * @param bool $create
     * @param CSRType $type
     * @param CSRKeySize $keysize
     * @param string $c
     * @param string $sT
     * @param string $l
     * @param string $o
     * @param string $oU
     * @param string $cN
     * @param array $subjectAltName
     * @return self
     */
    public function __construct(
        $server,
        $isNew,
        CSRType $type,
        CSRKeySize $keysize,
        $c = null,
        $sT = null,
        $l = null,
        $o = null,
        $oU = null,
        $cN = null,
        array $subjectAltName = array())
    {
        parent::__construct();
        $this->_server = trim($server);
        $this->_isNew = (bool) $isNew;
        $this->_type = $type;
        $this->_keysize = $keysize;

		$this->_c = trim($c);
		$this->_sT = trim($sT);
		$this->_l = trim($l);
		$this->_o = trim($o);
		$this->_oU = trim($oU);
		$this->_cN = trim($cN);
        foreach ($subjectAltName as $subject)
        {
			$subject = trim($subject);
			if(!empty($subject))
			{
				$this->_subjectAltName[] = $subject;
			}
        }
    }

    /**
     * Gets or sets server
     *
     * @param  string $server
     * @return string|self
     */
    public function server($server = null)
    {
        if(null === $server)
        {
            return $this->_server;
        }
        $this->_server = trim($server);
        return $this;
    }

    /**
     * Gets or sets new
     *
     * @param  bool $isNew
     * @return bool|self
     */
    public function isNew($isNew = null)
    {
        if(null === $isNew)
        {
            return $this->_isNew;
        }
        $this->_isNew = (bool) $isNew;
        return $this;
    }

    /**
     * Gets or sets type
     *
     * @param  CSRType $type
     * @return CSRType|self
     */
    public function type(CSRType $type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $this->_type = $type;
        return $this;
    }

    /**
     * Gets or sets keysize
     *
     * @param  CSRKeySize $keysize
     * @return CSRKeySize|self
     */
    public function keysize(CSRKeySize $keysize = null)
    {
        if(null === $keysize)
        {
            return $this->_keysize;
        }
        $this->_keysize = $keysize;
        return $this;
    }

    /**
     * Gets or sets c
     *
     * @param  string $c
     * @return string|self
     */
    public function c($c = null)
    {
        if(null === $c)
        {
            return $this->_c;
        }
        $this->_c = trim($c);
        return $this;
    }

    /**
     * Gets or sets sT
     *
     * @param  string $sT
     * @return string|self
     */
    public function sT($sT = null)
    {
        if(null === $sT)
        {
            return $this->_sT;
        }
        $this->_sT = trim($sT);
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
     * Gets or sets o
     *
     * @param  string $o
     * @return string|self
     */
    public function o($o = null)
    {
        if(null === $o)
        {
            return $this->_o;
        }
        $this->_o = trim($o);
        return $this;
    }

    /**
     * Gets or sets oU
     *
     * @param  string $oU
     * @return string|self
     */
    public function oU($oU = null)
    {
        if(null === $oU)
        {
            return $this->_oU;
        }
        $this->_oU = trim($oU);
        return $this;
    }

    /**
     * Gets or sets cN
     *
     * @param  string $cN
     * @return string|self
     */
    public function cN($cN = null)
    {
        if(null === $cN)
        {
            return $this->_cN;
        }
        $this->_cN = trim($cN);
        return $this;
    }

    /**
     * Gets or sets subjectAltName
     *
     * @param  array $subjectAltName
     * @return array|self
     */
    public function subjectAltName(array $subjectAltName = null)
    {
        if(null === $subjectAltName)
        {
            return $this->_subjectAltName;
        }
        $this->_subjectAltName = array();
        foreach ($subjectAltName as $subject)
        {
			$subject = trim($subject);
			if(!empty($subject))
			{
				$this->_subjectAltName[] = $subject;
			}
        }
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
            'server' => $this->_server,
            'new' => $this->_isNew ? 1 : 0,
            'type' => (string) $this->_type,
            'keysize' => $this->_keysize->value(),
        );
        if(!empty($this->_c))
        {
            $this->array['C'] = $this->_c;
        }
        if(!empty($this->_sT))
        {
            $this->array['ST'] = $this->_sT;
        }
        if(!empty($this->_l))
        {
            $this->array['L'] = $this->_l;
        }
        if(!empty($this->_o))
        {
            $this->array['O'] = $this->_o;
        }
        if(!empty($this->_oU))
        {
            $this->array['OU'] = $this->_oU;
        }
        if(!empty($this->_cN))
        {
            $this->array['CN'] = $this->_cN;
        }
        if(count($this->_subjectAltName))
        {
            $this->array['SubjectAltName'] = array();
            foreach ($this->_subjectAltName as $subject)
            {
                $this->array['SubjectAltName'][] = $subject;
            }
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
        $this->xml->addAttribute('server', $this->_server)
                  ->addAttribute('new', $this->_isNew ? 1 : 0)
                  ->addAttribute('type', (string) $this->_type)
                  ->addAttribute('keysize', (string) $this->_keysize);
        if(!empty($this->_c))
        {
            $this->xml->addChild('C', $this->_c);
        }
        if(!empty($this->_sT))
        {
            $this->xml->addChild('ST', $this->_sT);
        }
        if(!empty($this->_l))
        {
            $this->xml->addChild('L', $this->_l);
        }
        if(!empty($this->_o))
        {
            $this->xml->addChild('O', $this->_o);
        }
        if(!empty($this->_oU))
        {
            $this->xml->addChild('OU', $this->_oU);
        }
        if(!empty($this->_cN))
        {
            $this->xml->addChild('CN', $this->_cN);
        }
        foreach ($this->_subjectAltName as $subject)
        {
            $this->xml->addChild('SubjectAltName', $subject);
        }
        return parent::toXml();
    }
}
