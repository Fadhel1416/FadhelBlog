<?php

namespace App\Controller;

use App\Entity\Blog;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Notifier\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    /**
     * @Route("/email/send",name="sendMail")
     */
    public function sendEmail(Request $request,MailerInterface $mailer)
    {
        //dd($request->request->get('name'));

        $email = (new Email())
        ->from(''.$request->get('email'))
        ->to('alifadhel619@gmail.com')
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('Message from : '.$request->get('name'))
        ->text(''.$request->get('message'))
        ->html('<p>'.$request->get('message').'!</p>');
      

       if(!$mailer->send($email)){
        return new JsonResponse('email sent');

       }
      
     
    }
     /**
     * @Route("/partageRRRRRssource",name="partageRessource")
     */
    public function Partage(Request $request,ManagerRegistry $doctriner)
    {
        //dd($request->request->get('name'));
        $em=$doctriner->getManager();
        $url = $request->get('url');
        $content=$request->get('content');
        $blog=new Blog();
        $blog->setTitle($url);
        $blog->setContent($content);
        $em->persist($blog);
        $em->flush();

        return new JsonResponse('ok'); 
     
    }
}
