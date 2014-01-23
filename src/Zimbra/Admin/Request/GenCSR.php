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
use Zimbra\Soap\Request;

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
class GenCSR extends Request
{
    /**
     * Used to add the Subject Alt Name extension in the certificate, so multiple hosts can be supported
     * @var array
     */
    private $_subjectAltName = array();

    /**
     * Constructor method for GenCSR
     * @param string $server Server ID
     * @param bool $new If value is "1" then force to create a new CSR, the previous one will be overwrited
     * @param CSRType $type Type of CSR (self|comm)
     * @param CSRKeySize $keysize Key size - 1024 or 2048
     * @param string $C Subject attr C
     * @param string $ST Subject attr ST
     * @param string $L Subject attr L
     * @param string $O Subject attr O
     * @param string $OU Subject attr OU
     * @param string $CN Subject attr CN
     * @param array $subjectAltName Used to add the Subject Alt Name extension in the certificate, so multiple hosts can be supported
     * @return self
     */
    public function __construct(
        $server,
        $new,
        CSRType $type,
        CSRKeySize $keysize,
        $C = null,
        $ST = null,
        $L = null,
        $O = null,
        $OU = null,
        $CN = null,
        array $subjectAltName = array()
    )
    {
        parent::__construct();
        $this->property('server', trim($server));
        $this->property('new', (bool) $new);
        $this->property('type', $type);
        $this->property('keysize', $keysize);

        if(null !== $C)
        {
            $this->child('C', trim($C));
        }
        if(null !== $ST)
        {
            $this->child('ST', trim($ST));
        }
        if(null !== $L)
        {
            $this->child('L', trim($L));
        }
        if(null !== $O)
        {
            $this->child('O', trim($O));
        }
        if(null !== $OU)
        {
            $this->child('OU', trim($OU));
        }
        if(null !== $CN)
        {
            $this->child('CN', trim($CN));
        }

        $this->_subjectAltName = new Sequence();
        foreach ($subjectAltName as $subject)
        {
            $subject = trim($subject);
            if(!empty($subject) && !$this->_subjectAltName->contains($subject))
            {
                $this->_subjectAltName->add($subject);
            }
        }

        $this->addHook(function($sender)
        {
            $sender->child('SubjectAltName', $sender->subjectAltName()->all());
        });
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
            return $this->property('server');
        }
        return $this->property('server', trim($server));
    }

    /**
     * Gets or sets new
     *
     * @param  bool $new
     * @return bool|self
     */
    public function new_($new = null)
    {
        if(null === $new)
        {
            return $this->property('new');
        }
        return $this->property('new', (bool) $new);
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
            return $this->property('type');
        }
        return $this->property('type', $type);
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
            return $this->property('keysize');
        }
        return $this->property('keysize', $keysize);
    }

    /**
     * Gets or sets C
     *
     * @param  string $C
     * @return string|self
     */
    public function C($C = null)
    {
        if(null === $C)
        {
            return $this->child('C');
        }
        return $this->child('C', trim($C));
    }

    /**
     * Gets or sets ST
     *
     * @param  string $ST
     * @return string|self
     */
    public function ST($ST = null)
    {
        if(null === $ST)
        {
            return $this->child('ST');
        }
        return $this->child('ST', trim($ST));
    }

    /**
     * Gets or sets L
     *
     * @param  string $L
     * @return string|self
     */
    public function L($L = null)
    {
        if(null === $L)
        {
            return $this->child('L');
        }
        return $this->child('L', trim($L));
    }

    /**
     * Gets or sets O
     *
     * @param  string $O
     * @return string|self
     */
    public function O($O = null)
    {
        if(null === $O)
        {
            return $this->child('O');
        }
        return $this->child('O', trim($O));
    }

    /**
     * Gets or sets OU
     *
     * @param  string $OU
     * @return string|self
     */
    public function OU($OU = null)
    {
        if(null === $OU)
        {
            return $this->child('OU');
        }
        return $this->child('OU', trim($OU));
    }

    /**
     * Gets or sets CN
     *
     * @param  string $CN
     * @return string|self
     */
    public function CN($CN = null)
    {
        if(null === $CN)
        {
            return $this->child('CN');
        }
        return $this->child('CN', trim($CN));
    }


    /**
     * Add a subjectAltName
     *
     * @param  string $subject
     * @return self
     */
    public function addSubjectAltName($subject)
    {
        if(!empty($subject) && !$this->_subjectAltName->contains($subject))
        {
            $this->_subjectAltName->add(trim($subject));
        }
        return $this;
    }

    /**
     * Gets subjectAltName sequence
     *
     * @return Sequence
     */
    public function subjectAltName()
    {
        return $this->_subjectAltName;
    }
}
