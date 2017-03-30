<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Akun;
use AppBundle\Entity\Dosen;
use AppBundle\Entity\ProgramStudi;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
       $prodi = $this->getDoctrine()->getRepository('AppBundle:ProgramStudi')
                     ->findAll();
        foreach ($prodi as $value) {
            $pilihan[$value->getNamaProdi()] = $value->getIdprogramStudi();
        }
        $akun = new Akun();
        $akun->setNama('Tulis nama anda');
        $akun->setPassword('Tulis password Anda');
        $form = $this->createFormBuilder($akun)
                ->add('password', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Create Post'))
                ->add('nama',ChoiceType::class, array(
                      'choices' => array(
                        $pilihan
                      )))->getForm();

            return $this->render('login.html.twig', array(
                'form' => $form->createView(),
            ));
     }
         /**
         * @Route("/belajarlagi",name="belajarlagi")
         */
      public function belajarlagi(Request $Request)
      {
                    $authenticationUtils = $this->get('security.authentication_utils');
               // get the login error if there is one
               $error = $authenticationUtils->getLastAuthenticationError();
               // last username entered by the user
               $lastUsername = $authenticationUtils->getLastUsername();
               return $this->render('security/login.html.twig', array(
                   'last_username' => $lastUsername,
                   'error'         => $error,
               ));
      }
     /**
     *@Route("/enkripsi",name="enkripsi")
     **/
     public function enkripsi(){
       $akun = new Akun();
       $plainPassword = "inicontoh";
       $contoh = '$2y$13$zCgCqWJw94Y837tvHiVqluZpTEB9LiSetrlgjo55VpunnU6MujFtC';
       $cek = "$2y$13$2A.ak16FvtR0jCe9m6wbNujixwbkdWJU2UnWhDAj1VpBAlzbcXPs6";
       $encoder = $this->container->get('security.password_encoder');
       $akun->setPassword($contoh);
       $encoded = $encoder->encodePassword($akun, $plainPassword);
       $tes = $encoder->isPasswordValid($t[0],$plainPassword);
       return new Response(var_dump($t));
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
