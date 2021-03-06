<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $repository): Response
    {   
        $articles = $repository->findAll();
        
        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
        ]);
    }
    
    /**
     * @Route("/categories", name="categories")
     */
    public function categories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();
        return $this->render('blog/categories.html.twig', [
            'categories' => $categories
        ]);
    }
    
    /**
     * @Route("/article/{permalink}", name="article")
     */
    public function post(Article $article): Response
    {
        return $this->render('blog/article.html.twig', [
            "article"=>$article,
        ]);
    }
    
    /**
     * @Route("/category/{id}", name="category")
     */
    public function category(Category $category): Response
    {

        return $this->render('blog/category.html.twig', [
            "category"=>$category
        ]);
    }
    
    
    
    
}
