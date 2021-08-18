<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/{page}",name="blog_list",requirements={"page"="\d+"})
     */
    public function list($page=1,Request $request){
        $limit = $request->get('limit',10);
        $repository = $this->getDoctrine()->getRepository(BlogPost::class);
        $items = $repository->findAll();
        return $this->json([
            'page'=>$page,
            'limit' => $limit,
            'data'=>array_map(function(BlogPost $item){$this->generateUrl('blog_by_slug',['slug'=>$item->getSlug()]);},$items)
        ]);
    }
    /**
     * @Route("/post/{id}",name="blog_by_id",requirements={"id"="\d+"})
     */
    public function post(BlogPost $post){
        return $this->json($post);
    }
    /**
     * @Route("/post/{slug}",name="blog_by_slug")
     */

    public function postBySlug(BlogPost $slug){
        return $this->json($slug);
    }
    /**
     * @Route("/add",name="blog_add",methods={"POST"})
     */
    public function add(Request $request){
        $serializer = $this->get('serializer');
        $blogPost=$serializer->deserialize($request->getContent(),BlogPost::class,'json');
        $dm=$this->getDoctrine()->getManager();
        $dm->persist($blogPost);
        $dm->flush();
        return $this->json($blogPost);
    }
}