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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbImage;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pieces;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
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
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $honoraires;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reference;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;
    
    public function getId() {
        return $this->id;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getIsPro() {
        return $this->isPro;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getImagesThumbs() {
        return $this->imagesThumbs;
    }

    public function getImages() {
        return $this->images;
    }

    public function getNbImage() {
        return $this->nbImage;
    }

    public function getPlacement() {
        return $this->placement;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getCp() {
        return $this->cp;
    }

    public function getTypeDeBien() {
        return $this->typeDeBien;
    }

    public function getPieces() {
        return $this->pieces;
    }

    public function getSurface() {
        return $this->surface;
    }

    public function getGes() {
        return $this->ges;
    }

    public function getClasseEnergie() {
        return $this->classeEnergie;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setIsPro($isPro) {
        $this->isPro = $isPro;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function setImagesThumbs($imagesThumbs) {
        $this->imagesThumbs = $imagesThumbs;
    }

    public function setImages($images) {
        $this->images = $images;
    }

    public function setNbImage($nbImage) {
        $this->nbImage = $nbImage;
    }

    public function setPlacement($placement) {
        $this->placement = $placement;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function setCp($cp) {
        $this->cp = $cp;
    }

    public function setTypeDeBien($typeDeBien) {
        $this->typeDeBien = $typeDeBien;
    }

    public function setPieces($pieces) {
        $this->pieces = $pieces;
    }

    public function setSurface($surface) {
        $this->surface = $surface;
    }

    public function setGes($ges) {
        $this->ges = $ges;
    }

    public function setClasseEnergie($classeEnergie) {
        $this->classeEnergie = $classeEnergie;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
    
    public function getHonoraires() {
        return $this->honoraires;
    }

    public function getReference() {
        return $this->reference;
    }

    public function setHonoraires($honoraires) {
        $this->honoraires = $honoraires;
    }

    public function setReference($reference) {
        $this->reference = $reference;
    }
    
    public function getUrl() {
        return $this->url;
    }

    public function setUrl($url) {
        $this->url = $url;
    }
}
