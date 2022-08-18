<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Admin\Struct\TestResultInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * RunUnitTestsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RunUnitTestsResponse extends SoapResponse
{
    /**
     * Information about test results
     * 
     * @Accessor(getter="getResults", setter="setResults")
     * @SerializedName("results")
     * @Type("Zimbra\Admin\Struct\TestResultInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var TestResultInfo
     */
    #[Accessor(getter: 'getResults', setter: 'setResults')]
    #[SerializedName('results')]
    #[Type(TestResultInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $results;

    /**
     * Number of executed tests
     * 
     * @Accessor(getter="getNumExecuted", setter="setNumExecuted")
     * @SerializedName("numExecuted")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getNumExecuted', setter: 'setNumExecuted')]
    #[SerializedName('numExecuted')]
    #[Type('int')]
    #[XmlAttribute]
    private $numExecuted;

    /**
     * Number of failed tests
     * 
     * @Accessor(getter="getNumFailed", setter="setNumFailed")
     * @SerializedName("numFailed")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getNumFailed', setter: 'setNumFailed')]
    #[SerializedName('numFailed')]
    #[Type('int')]
    #[XmlAttribute]
    private $numFailed;

    /**
     * Constructor
     * 
     * @param TestResultInfo $results
     * @param int $numExecuted
     * @param int $numFailed
     * @return self
     */
    public function __construct(
        ?TestResultInfo $results = NULL,
        int $numExecuted = 0,
        int $numFailed = 0
    )
    {
        $this->setNumExecuted($numExecuted)
             ->setNumFailed($numFailed);
        if ($results instanceof TestResultInfo) {
            $this->setResults($results);
        }
    }

    /**
     * Get results
     *
     * @return TestResultInfo
     */
    public function getResults(): ?TestResultInfo
    {
        return $this->results;
    }

    /**
     * Set results
     *
     * @param  TestResultInfo $results
     * @return self
     */
    public function setResults(TestResultInfo $results): self
    {
        $this->results = $results;
        return $this;
    }

    /**
     * Get numExecuted
     *
     * @return int
     */
    public function getNumExecuted(): int
    {
        return $this->numExecuted;
    }

    /**
     * Set numExecuted
     *
     * @param  int $numExecuted
     * @return self
     */
    public function setNumExecuted(int $numExecuted): self
    {
        $this->numExecuted = $numExecuted;
        return $this;
    }

    /**
     * Get numFailed
     *
     * @return int
     */
    public function getNumFailed(): int
    {
        return $this->numFailed;
    }

    /**
     * Set numFailed
     *
     * @param  int $numFailed
     * @return self
     */
    public function setNumFailed(int $numFailed): self
    {
        $this->numFailed = $numFailed;
        return $this;
    }
}
