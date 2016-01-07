<?php
namespace EasymedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Deal
 *
 * @ORM\Table(name="deal")
 * @ORM\Entity()
 */
class Deal extends Base
{
    const STAGE_INCOMING = 1;

    const STAGE_QUALIFIED = 2;

    const STAGE_QUOTE = 3;

    const STAGE_CLOSURE = 4;

    const STAGE_WON = 5;

    const STAGE_UNQUALIFIED = 6;

    const STAGE_LOST = 7;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $contact;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $stage;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $value;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $currency;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $source;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $tags;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param string $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * @param string $stage
     */
    public function setStage($stage)
    {
        $this->stage = $stage;
    }

    /**
     * Returns array of stages
     *
     * @return array
     */
    public static function valuesOfStage()
    {
        return array(
            self::STAGE_INCOMING => 'Incoming',
            self::STAGE_QUALIFIED => 'Qualified',
            self::STAGE_QUOTE => 'Quote',
            self::STAGE_CLOSURE => 'Closure',
            self::STAGE_WON => 'Won',
            self::STAGE_UNQUALIFIED => 'Unqualified',
            self::STAGE_LOST => 'Lost',
        );
    }
}