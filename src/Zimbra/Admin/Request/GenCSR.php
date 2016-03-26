<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use PhpCollection\Sequence;
use Zimbra\Enum\CSRType;
use Zimbra\Enum\CSRKeySize;

/**
 * GenCSR request class
 * Request a certificate signing request (CSR).
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GenCSR extends Base
{
    /**
     * Used to add the Subject Alt Name extension in the certificate, so multiple hosts can be supported
     * @var array
     */
    private $_subjectAltNames;

    /**
     * Constructor method for GenCSR
     * @param string $server Server ID
     * @param bool $new If value is "1" then force to create a new CSR, the previous one will be overwrited
     * @param CSRType $type Type of CSR (self|comm)
     * @param string $digest Digest. Default value "sha1"
     * @param CSRKeySize $keysize Key size - 1024 or 2048
     * @param string $c Subject attr C
     * @param string $st Subject attr ST
     * @param string $L Subject attr L
     * @param string $O Subject attr O
     * @param string $OU Subject attr OU
     * @param string $CN Subject attr CN
     * @param array $subjectAltNames Used to add the Subject Alt Name extension in the certificate, so multiple hosts can be supported
     * @return self
     */
    public function __construct(
        $server,
        $new,
        CSRType $type = null,
        $digest = null,
        CSRKeySize $keysize = null,
        $c = null,
        $st = null,
        $l = null,
        $o = null,
        $ou = null,
        $cn = null,
        array $subjectAltNames = []
    )
    {
        parent::__construct();
        $this->setProperty('server', trim($server));
        $this->setProperty('new', (bool) $new);

        if ($type instanceof CSRType)
        {
            $this->setProperty('type', $type);
        }

        if(null !== $digest)
        {
            $this->setProperty('digest', trim($digest));
        }

        if ($keysize instanceof CSRKeySize)
        {
            $this->setProperty('keysize', $keysize);
        }

        if(null !== $c)
        {
            $this->setChild('C', trim($c));
        }
        if(null !== $st)
        {
            $this->setChild('ST', trim($st));
        }
        if(null !== $l)
        {
            $this->setChild('L', trim($l));
        }
        if(null !== $o)
        {
            $this->setChild('O', trim($o));
        }
        if(null !== $ou)
        {
            $this->setChild('OU', trim($ou));
        }
        if(null !== $cn)
        {
            $this->setChild('CN', trim($cn));
        }
        $this->setSubjectAltNames($subjectAltNames);

        $this->on('before', function(Base $sender)
        {
            if($sender->getSubjectAltNames()->count())
            {
                $sender->setChild('SubjectAltName', $sender->getSubjectAltNames()->all());
            }
        });
    }

    /**
     * Gets server
     *
     * @return string
     */
    public function getServer()
    {
        return $this->getProperty('server');
    }

    /**
     * Sets server
     *
     * @param  string $server
     * @return self
     */
    public function setServer($server)
    {
        return $this->setProperty('server', trim($server));
    }

    /**
     * Gets new flag
     *
     * @return bool
     */
    public function getNewCSR()
    {
        return $this->getProperty('new');
    }

    /**
     * Sets new flag
     *
     * @param  bool $new
     * @return self
     */
    public function setNewCSR($new)
    {
        return $this->setProperty('new', (bool) $new);
    }

    /**
     * Gets type
     *
     * @return CSRType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type
     *
     * @param  CSRType $type
     * @return self
     */
    public function setType(CSRType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets digest
     *
     * @return string
     */
    public function getDigest()
    {
        return $this->getProperty('digest');
    }

    /**
     * Sets digest
     *
     * @param  string $digest
     * @return self
     */
    public function setDigest($digest)
    {
        return $this->setProperty('digest', trim($digest));
    }

    /**
     * Gets keysize
     *
     * @return CSRKeySize
     */
    public function getKeySize()
    {
        return $this->getProperty('keysize');
    }

    /**
     * Sets keysize
     *
     * @param  CSRKeySize $keysize
     * @return self
     */
    public function setKeySize(CSRKeySize $keysize)
    {
        return $this->setProperty('keysize', $keysize);
    }

    /**
     * Gets C attribute
     *
     * @return string
     */
    public function getC()
    {
        return $this->getChild('C');
    }

    /**
     * Sets C attribute
     *
     * @param  string $c
     * @return self
     */
    public function setC($c)
    {
        return $this->setChild('C', trim($c));
    }

    /**
     * Gets ST attribute
     *
     * @return string
     */
    public function getSt()
    {
        return $this->getChild('ST');
    }

    /**
     * Sets ST attribute
     *
     * @param  string $st
     * @return self
     */
    public function setSt($st)
    {
        return $this->setChild('ST', trim($st));
    }

    /**
     * Gets L attribute
     *
     * @return string
     */
    public function getL()
    {
        return $this->getChild('L');
    }

    /**
     * Sets L attribute
     *
     * @param  string $l
     * @return self
     */
    public function setL($l)
    {
        return $this->setChild('L', trim($l));
    }

    /**
     * Gets O attribute
     *
     * @return string
     */
    public function getO()
    {
        return $this->getChild('O');
    }

    /**
     * Sets O attribute
     *
     * @param  string $o
     * @return self
     */
    public function setO($o)
    {
        return $this->setChild('O', trim($o));
    }

    /**
     * Gets OU attribute
     *
     * @return string
     */
    public function getOu()
    {
        return $this->getChild('OU');
    }

    /**
     * Sets OU attribute
     *
     * @param  string $ou
     * @return self
     */
    public function setOu($ou)
    {
        return $this->setChild('OU', trim($ou));
    }

    /**
     * Gets CN attribute
     *
     * @return string
     */
    public function getCn()
    {
        return $this->getChild('CN');
    }

    /**
     * Sets CN attribute
     *
     * @param  string $cn
     * @return self
     */
    public function setCn($cn)
    {
        return $this->setChild('CN', trim($cn));
    }

    /**
     * Add a subjectAltName
     *
     * @param  string $subject
     * @return self
     */
    public function addSubjectAltName($subject)
    {
        if(!empty($subject) && !$this->_subjectAltNames->contains($subject))
        {
            $this->_subjectAltNames->add(trim($subject));
        }
        return $this;
    }

    /**
     * Sets subjectAltName sequence
     *
     * @param array $subjectAltNames
     * @return self
     */
    public function setSubjectAltNames(array $subjectAltNames)
    {
        $this->_subjectAltNames = new Sequence();
        foreach ($subjectAltNames as $subject)
        {
            $subject = trim($subject);
            if(!empty($subject) && !$this->_subjectAltNames->contains($subject))
            {
                $this->_subjectAltNames->add($subject);
            }
        }
        return $this;
    }

    /**
     * Gets subjectAltName sequence
     *
     * @return Sequence
     */
    public function getSubjectAltNames()
    {
        return $this->_subjectAltNames;
    }
}
