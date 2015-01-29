<?php

namespace Formation\Controller;

use Framework\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends Controller
{
    public function helloAction(Request $request, $name)
    {
        $query = 'SELECT * FROM blog_post
          WHERE published_at IS NULL OR published_at < NOW()
          ORDER BY id DESC';

        $stmt = $this->container->get('database')->getConnection()->query($query);

        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        die(var_dump($data));

        return $this->render('Home/hello.html.twig', array(
            'name' => $name,
        ));
    }

    public function byeAction(Request $request)
    {
        return new Response('Bye...');
    }
}
