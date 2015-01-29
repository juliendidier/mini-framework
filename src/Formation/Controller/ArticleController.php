<?php

namespace Formation\Controller;

use Framework\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends Controller
{
    public function listAction(Request $request)
    {
        $articles = $this->container->get('article_xmascard_repository')->findAll();

        return $this->render('Article/list.html.twig', array(
            'articles' => $articles,
        ));
    }

    public function showAction(Request $request, $name)
    {
        $article = $this->container->get('article_xmascard_repository')->find($name);

        if ($article === false) {
            throw new NotFoundHttpException(sprintf('Article with name "%s" does not exists', $name));
        }

        return $this->render('Article/show.html.twig', array(
            'article' => $article,
        ));
    }
}
