<?php

namespace App\Controller;
use App\Entity\Produit;
use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\ProduitRepository;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function search(Request $req){
        // dd($req->get('search'));
        $prod = $this->getDoctrine()->getRepository(Produit::class)->findBy(['nom_produit'=>$req->get('search')]);
        return $this->render('produit/search.html.twig', [
            'produits' => $prod,
        ]);

    }
    /**
     * @Route("/searchCat")
     */
    public function searchcat(Request $req){
        $cat = $this->getDoctrine()->getRepository(Categorie::class)->findOneBy(['nom_categorie'=>$req->get('search')]);
        $prod =$this->getDoctrine()->getRepository(Produit::class)->findBy(['id_categorie'=>$cat->getId()]);
        // dd($prod);
        return $this->render('categorie/search.html.twig',[
            'produits'=>$prod,'cat'=>$cat
        ]);
    }
}
