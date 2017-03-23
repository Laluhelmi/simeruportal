<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\ProgramStudi;
use AppBundle\Entity\Fakultas;
use AppBundle\Entity\Matakuliah;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\DBAL\DriverManager;
class ProdiController extends Controller
{
  private $session;
  public function __construct()
  {
    $this->session = new Session();

  }
  /**
  *@Method({"GET"})
  * @Route("/prodi", name="prodi_list",requirements={"action": "tambah"})
  */
  public function prodi(){
      if($this->session->has('akun') == false)
      return $this->redirectToRoute('login');

      $db = $this->get('database_connection');
      $query = $db->fetchAll('select * from Program_Studi,Fakultas where
                            Program_Studi.fakultas_idfakultas
                            = Fakultas.idfakultas');
      $data = array('page'=>'prodi','isi'=>$query);
      return $this->render('prodi/list.html.twig',$data);
  }
  /**
  *@Method({"GET","POST"})
  * @Route("/prodi/tambah", name="prodi_tambah",requirements={"action": "tambah"})
  */
  public function tambah(Request $request)
  {
    if($this->session->has('akun') == false)
     return $this->redirectToRoute('login');
      $listfakultas = $this->getDoctrine()->getRepository('AppBundle:Fakultas')
                                          ->findAll();
      $fk = new ProgramStudi();
      if($request->getMethod() == "POST"){
          $fakultas = $this->getDoctrine()->getRepository('AppBundle:Fakultas')
                                          ->findOneBy(array('idfakultas'=>
                                          $request->request->get('fakultas')));
          $fk   ->setNamaProdi($request->request->get('namaprodi'))
                ->setKampus($request->request->get('kampus'))
                ->setFakultasfakultas($fakultas)
                ->setIdprogramStudi($request->request->get('idprodi'));
          $validator  = $this->get('validator');
          $errors     = $validator->validate($fk);
          if(count($errors) >0){
            return $this->render('prodi/tambah.html.twig',
                                array('errors'=>$errors,
                                    'fakultas'=>$listfakultas,
                                      'page'  => 'fakultas',
                                       'data' =>$fk));
          }else{
              $em = $this->getDoctrine()->getManager();
              $em->persist($fk);
              $em->flush();
              return $this->redirectToRoute('prodi_list');
          }
      }
      return $this->render('prodi/tambah.html.twig',array('errors'  =>null,
                                                          'data'    =>$fk,
                                                          'fakultas'=>$listfakultas,
                                                          'page'    => 'fakultas'));
  }
  /**
  *@Method({"GET","POST"})
  * @Route("/prodi/edit/{pr}", name="prodi_edit",requirements={"action": "tambah"})
  */
  public function edit(Request $request,$pr)
  {
      if($this->session->has('akun') == false)
       return $this->redirectToRoute('login');
        $listfakultas = $this->getDoctrine()->getRepository('AppBundle:Fakultas')
                                            ->findAll();
        $em = $this->getDoctrine()->getManager();
        $fk = $em->getRepository('AppBundle:ProgramStudi')->find($pr);
        if($request->getMethod() == "POST"){
            $fakultas = $this->getDoctrine()->getRepository('AppBundle:Fakultas')
                                            ->findOneBy(array('idfakultas'=>
                                            $request->request->get('fakultas')));
            $fk   ->setNamaProdi($request->request->get('namaprodi'))
                  ->setKampus($request->request->get('kampus'))
                  ->setFakultasfakultas($fakultas)
                  ->setIdprogramStudi($request->request->get('idprodi'));
            $validator  = $this->get('validator');
            $errors     = $validator->validate($fk);
            if(count($errors) >0){
              return $this->render('prodi/edit.html.twig',
                                  array('errors'=>$errors,
                                       'fakultas'=>$listfakultas,
                                        'id'    => $pr,
                                        'selected'=>$fk->getFakultasfakultas()->getNamafakultas(),
                                        'page'  => 'fakultas',
                                        'data' =>$fk));
            }else{
                $em = $this->getDoctrine()->getManager();
                $em->persist($fk);
                $em->flush();
                return $this->redirectToRoute('prodi_list');
            }
        }
        return $this->render('prodi/edit.html.twig',array(  'errors'  =>null,
                                                            'data'    =>$fk,
                                                            'id'      =>$pr,
                                                            'selected'=>$fk->getFakultasfakultas()->getNamafakultas(),
                                                            'fakultas'=>$listfakultas,
                                                            'page'    => 'fakultas'));

  }
  /**
  *@Method({"GET"})
  * @Route("/prodi/hapus/{fk}", name="prodi_hapus",requirements={"action": "tambah"})
  */
  public function hapus($fk)
  {
      $em = $this->getDoctrine()->getManager();

      $em->getConnection()->prepare("delete from matakuliah where program_studi_idprogram_studi = $fk")
          ->execute();
      $em->getConnection()->prepare("delete from program_studi where idprogram_studi = $fk")
          ->execute();


      return $this->redirectToRoute('prodi_list');
  }
}
