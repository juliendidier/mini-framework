<?php

namespace Formation\Controller;

use Framework\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function listAction(Request $request)
    {
        $query = 'SELECT * FROM article_xmascard';
        $stmt = $this->container->get('database')->getConnection()->query($query);
        $articles = $stmt->fetchAll(\PDO::FETCH_CLASS, 'Formation\Model\XmasCard');

        return $this->render('Article/list.html.twig', array(
            'articles' => $articles,
        ));
    }
}
