<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Dosen;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DosenController extends Controller
{
  private $session;
  public function __construct()
  {
        $this->session = new Session();
  }
  /**
  *@Method({"GET","POST"})
  * @Route("/dosen/tambah/", name="dosen_tambah",requirements={"action": "tambah"})
  */
   public function tambahdosen(Request $request){
       if($this->session->has('akun') == false)
        return $this->redirectToRoute('login');
      $dosen = new Dosen();
      if($request->getMethod() == "POST"){
          $dosen->setNama($request->request->get('nama'))
                ->setNip($request->request->get('nip'));
          $validator = $this->get('validator');
          $errors = $validator->validate($dosen);
          if(count($errors) >0){
            return $this->render('dosen/tambah.html.twig',array('errors'=>$errors,
                                                                'page'  => 'dosen',
                                                                'dosen' =>$dosen));
          }else{
              $em = $this->getDoctrine()->getManager();
              $em->persist($dosen);
              $em->flush();
              return $this->redirectToRoute('dosen_list');
          }
      }
      return $this->render('dosen/tambah.html.twig',array('errors'=>null,
                                                          'dosen' =>$dosen,
                                                          'page'  => 'dosen'));
   }
   /**
   *@Method({"GET","POST"})
   * @Route("/dosen/", name="dosen_list")
   */
   public function tes(){
     if($this->session->has('akun') == false)
      return $this->redirectToRoute('login');
        $list = $this->getDoctrine()->getRepository('AppBundle:Dosen')->findAll();
        $data = array('page'=>'dosen','isi'=>$list);
        return $this->render('dosen/listdosen.html.twig',$data);
   }
   /**
   *@Method({"GET","POST"})
   * @Route("/dosen/hapus/{id}", name="dosen_hapus")
   */
   public function hapus(Dosen $dosen){
     $em = $this->getDoctrine()->getManager();
     $em->remove($dosen);
     $em->flush();
     return $this->redirectToRoute('dosen_list');
   }
   /**
   *@Method({"GET","POST"})
   * @Route("/dosen/edit/{id}", name="dosen_edit")
   */
   public function edit(Request $request,$id){
       if($this->session->has('akun') == false)
        return $this->redirectToRoute('login');

        $em = $this->getDoctrine()->getManager();
        $ds = $em->getRepository('AppBundle:Dosen')->find($id);
        if($request->getMethod() == "POST"){
              $ds->setNama($request->request->get('nama'))
                 ->setNip($id);
           $validator = $this->get('validator');
           $errors = $validator->validate($ds);
           if(count($errors) > 0){
             return $this->render('dosen/edit.html.twig',array(  'errors'=>$errors,
                                                                 'page'  => 'dosen',
                                                                 'id'     =>$id,
                                                                 'dosen' =>$ds));
           }else{
               $em = $this->getDoctrine()->getManager();
               $dosen = $em->getRepository('AppBundle:Dosen')->find($id);
               $dosen->setNama($ds->getNama());
               $em->flush();
               return $this->redirectToRoute('dosen_list');
           }
       }
       return $this->render('dosen/edit.html.twig',array(  'errors'=>null,
                                                           'id'     =>$id,
                                                           'dosen' =>$ds,
                                                           'page'  => 'dosen'));
   }
   /**
   *@Method({"GET"})
   * @Route("/jadwaldosen/", name="dosen_jadwal")
   */
   public function jadwaldosen(Request $request){
     if($this->session->has('akun') == false)
      return $this->redirectToRoute('login');
     $nip = $request->query->get('dosen');
     $dosen = $this->getDoctrine()->getRepository('AppBundle:Dosen')->findAll();
     $jadwal = $this->getDoctrine()->getRepository('AppBundle:Ajar')
                                   ->findBy(array('dosenNip'=>$nip),
                                            array('jam'=>'ASC'));
     $data = array('page' => 'jadwaldosen','dosen'=>$dosen,'jadwal'=>$jadwal
                  ,'selected' => $nip);
                  $encoders = array(new XmlEncoder(), new JsonEncoder());
                  $normalizers = array(new ObjectNormalizer());
                  $serializer = new Serializer($normalizers, $encoders);
                  $jsonContent = $serializer->serialize($jadwal, 'json');
    //return new Response($jsonContent);
     return $this->render('dosen/jadwaldosen.html.twig',$data);
   }

}
