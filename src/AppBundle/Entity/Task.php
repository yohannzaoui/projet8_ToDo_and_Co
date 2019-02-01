<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table("task")
 * @ORM\EntityListeners({"AppBundle\Listener\TaskListener"})
 */
class Task
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Vous devez saisir un titre.")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Vous devez saisir du contenu.")
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDone;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $dateIsDone;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="task")
     * @ORM\JoinColumn(onDelete="cascade")
     */
    private $user;

    /**
     * Task constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->createdAt = new \Datetime();
        $this->isDone = false;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \Datetime
     */
    public function getCreatedAt(): ? \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ? string
    {
        return $this->title;
    }

    /**
     * @param $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getContent(): ? string
    {
        return $this->content;
    }

    /**
     * @param $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return bool|null
     */
    public function isDone(): ? bool
    {
        return $this->isDone;
    }

    /**
     * @param $flag
     */
    public function toggle(bool $flag)
    {
        $this->isDone = $flag;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateIsDone(): ? \DateTime
    {
        return $this->dateIsDone;
    }

    /**
     * @param \DateTime $dateIsDone
     */
    public function setDateIsDone(\DateTime $dateIsDone)
    {
        $this->dateIsDone = $dateIsDone;
    }

    /**
     * @return User|null
     */
    public function getUser(): ? User
    {
        return $this->user;
    }

    /**
     * @param $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}
