<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Akun;
use AppBundle\Entity\Dosen;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class AdminController extends Controller
{
        private $session;

        public function __construct()
        {
            $this->session = new Session();
        }
     /**
      *@Method({"GET", "POST"})
      * @Route("/login", name="login")
      */
     public function login(Request $request){
        if($this->session->has('akun') == true)
        return $this->redirect('admin');
        $akun = new Akun();
        if($request->getMethod() == "POST"){
            $akun->setNama($request->request->get('username'));
            $akun->setPassword($request->request->get('password'));
            $validator = $this->get('validator');
            $errors = $validator->validate($akun);
            if (count($errors) > 0) {
              return $this->render('admin/login.html.twig',
                                    array('errors' => $errors,
                                          'salahlogin'=> null));
            }else {
              $hasillogin = $this->getDoctrine()->getRepository('AppBundle:Akun')
                                  ->findOneBy(array('nama'    =>$akun->getNama(),
                                                    'password'=>$akun->getPassword()));
              if(count($hasillogin) > 0){
                $this->session->set('akun',$akun);
                return $this->redirect('admin');
              } else {
                $data = "username dan password tidak cocok";
                return $this->render('admin/login.html.twig',array('salahlogin'=> $data,
                                                                    'errors'   => null));
              }
            }
        }
        return $this->render('admin/login.html.twig',array('errors'=>null,'salahlogin'=>null));
     }
     /**
     * @Route("/admin",name="admin")
     */
     public function admin(){
       if($this->session->has('akun') == false)
        return $this->redirect('login');
        $data = array('page'=>'beranda');
        return $this->render('admin/beranda.html.twig',$data);
     }
     /**
     * @Route("/masuk",name="masuk")
     */
     public function masuk(){
       if($this->session->has('akun') == false)
        return $this->redirect('login');
        $data = array('page'=>'beranda');
        return $this->render('admin/beranda.html.twig',$data);
     }
     /**
     * @Route("/keluaraja",name="keluaraja")
     */
    public function keluaraja(){
        return new Response();
    }
     /**
     * @Route("/form",name="blog")
     */
     public function tes(Request $request){
        $akun = new Akun();

        $form = $this->createFormBuilder($akun)
                    ->add('nama',TextType::class,array('attr'=> array('placeholder'=>'nama','class'=>
                  'form-control','value'=>'hores')))
                    ->add('simpan', SubmitType::class,array('label' => 'Create Post',))
                    ->getForm();
                    $form->handleRequest($request);
                    if ($form->isSubmitted() && $form->isValid()) {
                        $task = $form->getData();
                        return $this->redirectToRoute('task_success');
    }
        return $this->render('login.html.twig',array('form' => $form->createView(),
              'page'=>'beranda'));
     }
        /**
        *@Method({"GET"})
        * @Route("/logout", name="logout")
        */
        public function keluar(){
              $this->session->remove('akun');
              $this->session->clear();
              $this->session->invalidate();
              return $this->redirectToRoute('login');
        }
        /**
        *@Method({"GET"})
        * @Route("/email", name="email")
        */
    public function email(){
      $message = \Swift_Message::newInstance()
       ->setSubject('Apa Kabar Bro')
       ->setFrom('send@example.com')
       ->setTo('laluhilmifadli@icloud.com')
       ->setBody(
           $this->renderView(
               // app/Resources/views/Emails/registration.html.twig
               'tes.html.php'
           ),
           'text/html'
       )
       ->attach(\Swift_Attachment::fromPath('favicon.ico'))
       /*
        * If you also want to include a plaintext version of the message
       ->addPart(
           $this->renderView(
               'Emails/registration.txt.twig',
               array('name' => $name)
           ),
           'text/plain'
       )
       */
   ;
   $this->get('mailer')->send($message);
   return new Response('sudah');
    }
}
