<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\OperateSerializer;
use App\Service\CurlService;
use App\Entity\Article;

class ArticleController extends AbstractController
{
    /**
     * @var CurlService
     */
    private $curl;

    /**
     * @var OperateSerializer
     */
    private $serializer;

    public function __construct(
        OperateSerializer   $serializer,
        CurlService         $curl
    )
    {
        $this->serializer   = $serializer;
        $this->curl         = $curl;
    }

    /**
     * @Route("/article")
     */
    public function showAll()
    {
        $json = $this->curl->setUrl("localhost:8000/api/articles")->send();
        $articles = $this->serializer->decodeMany($json, 'App\Entity\Article[]');

        return $this->render("blop.html.twig", [
            'article' => $articles
        ]);
        
    }

    /**
     * @Route("/article/{id}", name ="article.details")
     */
    public function showOne($id)
    {
        $json = $this->curl->setUrl("localhost:8000/api/articles/$id")->send();
        $article = $this->serializer->decodeOne($json, Article::class);

        return $this->render("blop.html.twig", [
            'article' => $article
        ]);

    }

    /**
     * @Route("/article/new", name= "article.new")
     */
    public function new()
    {
        
    }
}