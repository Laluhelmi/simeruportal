<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\ProgramStudi;
use AppBundle\Entity\Matakuliah;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
class MatakuliahController extends Controller
{
  private $session;
  public function __construct()
  {
    $this->session = new Session();
  }
  /**
  *@Method({"GET"})
  * @Route("/matakuliah", name="matakuliah_list",requirements={"action": "tambah"})
  */
  public function matakuliah(){
        if($this->session->has('akun') == false)
        return $this->redirectToRoute('login');
        $data  = $this->getDoctrine()->getRepository("AppBundle:Matakuliah");
        $matakuliah = $data->findAll();
        $data = array('isi'=>$matakuliah,
                      'page'=>'matakuliah');

        return $this->render('matakuliah/list.html.twig',$data);
  }
  /**
  *@Method({"GET","POST"})
  * @Route("/matakuliah/tambah/", name="matakuliah_tambah",requirements={"action": "tambah"})
  */
  public function tambah(Request $request){
        if($this->session->has('akun') == false)
        return $this->redirectToRoute('login');
        $prodi = $this->getDoctrine()->getRepository('AppBundle:ProgramStudi')
                      ->findAll();
        $matakuliah = new Matakuliah();
        $data = array('page'  => 'matakuliah',
                      'errors'=> null,
                      'prodi' => $prodi,
                      'data'  => $matakuliah);
        if($request->getMethod() == "POST"){
            $validator = $this->get('validator');
            $prodi2 = $this->getDoctrine()->getRepository('AppBundle:ProgramStudi')
                           ->find($request->request->get('prodi'));
            $prodi2->setIdprogramStudi($request->request->get('prodi'));
            $matakuliah->setIdmatkul($request->request->get('idmatkul'));
            $matakuliah->setSks($request->request->get('sks'));
            $matakuliah->setProgramStudiprogramStudi($prodi2);
            $matakuliah->setSemester($request->request->get('semester'));
            $matakuliah->setNamaMatkul($request->request->get('namaMatkul'));
            $errors    = $validator->validate($matakuliah);
            if(count($errors) > 0){
                $data['errors'] = $errors;
                return $this->render('matakuliah/tambah.html.twig',$data);
            }else{
                $em = $this->getDoctrine()->getManager();
                $em->persist($matakuliah);
                $em->flush();
                return $this->redirectToRoute('matakuliah_list');
            }
        }
        return $this->render('matakuliah/tambah.html.twig',$data);
  }
    /**
    *@Method({"GET","POST"})
    * @Route("/matakuliah/hapus/{mk}", name="matakuliah_hapus",requirements={"action": "tambah"})
    */
    public function hapus(Matakuliah $mk){
        $m = $this->getDoctrine()->getManager();
        $m->remove($mk);
        $m->flush();
        return $this->redirectToRoute('matakuliah_list');
    }
    /**
    *@Method({"GET","POST"})
    * @Route("/matakuliah/edit/{mk}", name="matakuliah_edit",requirements={"action": "tambah"})
    */
    public function edit(Request $request,$mk){
      if($this->session->has('akun') == false)
      return $this->redirectToRoute('login');
      $prodi = $this->getDoctrine()->getRepository('AppBundle:ProgramStudi')
                    ->findAll();
      $matakuliah = $this->getDoctrine()->getRepository("AppBundle:Matakuliah")
                    ->find($mk);
      $data = array('page'  => 'matakuliah',
                    'errors'=> null,
                    'selected' => $matakuliah->getProgramStudiprogramStudi()->getNamaProdi(),
                    'prodi' => $prodi,
                    'data'  => $matakuliah);
      if($request->getMethod() == "POST"){
          $validator = $this->get('validator');
          $prodi2 = $this->getDoctrine()->getRepository('AppBundle:ProgramStudi')
                         ->find($request->request->get('prodi'));
          $prodi2    ->setIdprogramStudi($request->request->get('prodi'));
          $matakuliah->setIdmatkul($request->request->get('idmatkul'));
          $matakuliah->setSks($request->request->get('sks'));
          $matakuliah->setProgramStudiprogramStudi($prodi2);
          $matakuliah->setSemester($request->request->get('semester'));
          $matakuliah->setNamaMatkul($request->request->get('namaMatkul'));
          $errors    = $validator->validate($matakuliah);
          if(count($errors) > 0){
              $data['errors'] = $errors;
              return $this->render('matakuliah/edit.html.twig',$data);
          }else{
              $em = $this->getDoctrine()->getManager();
              $em->persist($matakuliah);
              $em->flush();
              return $this->redirectToRoute('matakuliah_list');
          }
      }
      return $this->render('matakuliah/edit.html.twig',$data);
    }
    /**
    *@Method({"GET","POST"})
    * @Route("/jadwalkuliah", name="jadwalkuliah",requirements={"action": "tambah"})
    */
    public function jadwalkuliah(){
      $fakultas = $this->getDoctrine()->getRepository("AppBundle:Fakultas")->findAll();
      $data = array('page'=>'jadwalkuliah','fakultas'=>$fakultas);
      return $this->render('matakuliah/jadwal.html.twig',$data);
    }
    /**
    *@Method({"GET","POST"})
    * @Route("/getprodi/{id}", name="getprodi",requirements={"action": "tambah"})
    */
    public function getProdi($id){
      $prodi = $this->getDoctrine()->getRepository("AppBundle:ProgramStudi")
                                ->findBy(array('fakultasfakultas'=>$id));
      $encoders = array(new XmlEncoder(), new JsonEncoder());
      $normalizers = array(new ObjectNormalizer());
      $serializer = new Serializer($normalizers, $encoders);
      $jsonContent = $serializer->serialize($prodi, 'json');
      return new Response($jsonContent);
    }
    /**
    *@Method({"GET","POST"})
    * @Route("/getjadwal/{id}", name="getjadwal",requirements={"action": "tambah"})
    */
    public function getjadwal($id){
    //  $idprodi = $request->request->get('idprodi');
      $matkul = $this->getDoctrine()->getRepository("AppBundle:Matakuliah")
                    ->findBy(array('programStudiprogramStudi'=>$id));
      $jadwal = $this->getDoctrine()->getRepository("AppBundle:Ajar")
                                    ->findBy(array('matakuliahmatkul'=>$matkul)
                                            ,array('jam'=>'ASC'));
                                    $encoders = array(new XmlEncoder(), new JsonEncoder());
                                    $normalizers = array(new ObjectNormalizer());
                                    $serializer = new Serializer($normalizers, $encoders);
                                    $jsonContent = $serializer->serialize($jadwal, 'json');
      return new Response($jsonContent) ;
    }

}
