<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdRepository")
 */
class Ad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $category;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $isPro;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $prix;
    
    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;
    
    /**
     * @ORM\Column(type="array")
     */
    private $imagesThumbs;
    
    /**
     * @ORM\Column(type="array")
     */
    private $images;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $nbImage;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placement;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $cp;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeDeBien;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $pieces;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $surface;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ges;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $classeEnergie;
    
    /**
     * @ORM\Column(type="text")
     */
    private $description;
}
