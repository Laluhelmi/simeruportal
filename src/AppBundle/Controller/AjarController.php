<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Ajar;
use AppBundle\Entity\Dosen;
use AppBundle\Entity\Matakuliah;
use AppBundle\Entity\Ruang;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Session\Session;
class AjarController extends Controller
{
  private $session;
  public function __construct()
  {
    $this->session = new Session();
  }
  /**
   *@Method({"GET", "POST"})
   * @Route("/jadwalajar/", name="jadwalajar")
   */
  public function jadwalajar(){
    $hasil = null;
    foreach ($this->session->getFlashBag()->get('hasil', array()) as $message) {
      $hasil = $message;
    }
    $data = $this->getDoctrine()->getRepository("AppBundle:Ajar")
                  ->findBy(array(),array('matakuliahmatkul'=>'ASC','kelas'=>'ASC'));
    $data = array('page' => '',
                  'hasil'=>$hasil,
                  'isi' => $data);
    return $this->render('ajar/list.html.twig',$data);
  }
  /**
   *@Method({"GET", "POST"})
   * @Route("/jadwalajar/tambah/", name="jadwalajar_tambah")
   */
  public function tambah(Request $request){
      if($this->session->has('akun') == false)
      return $this->redirect('admin');
      $ds = $this->getDoctrine()->getRepository("AppBundle:Dosen");
      $mk = $this->getDoctrine()->getRepository("AppBundle:Matakuliah");
      $r  = $this->getDoctrine()->getRepository("AppBundle:Ruang");
      $matakuliah = $mk->findAll();
      $dosen      = $ds->findAll();
      $ruang      = $r->findAll();
      $ajar       = new Ajar();
      $data       = array('page' => '','matakuliah'=>$matakuliah,'dosen'=>$dosen,
                    'ruang'=>$ruang,
                    'errors'=> null,'data'=>$ajar);

      if($request->getMethod() == "POST"){
          $validator = $this->get('validator');
          $dosenip  = $ds->find($request->request->get('dosen'));
          $matkulid = $mk->find($request->request->get('matkul'));
          $ruangid  = $r ->find($request->request->get('ruang'));
          $ajar->setDosenNip($dosenip);
          $ajar->setMatakuliahmatkul($matkulid);
          $ajar->setRuangruang($ruangid);
          $ajar->setKelas($request->request->get('kelas'));
          $ajar->setJam($request->request->get('jam'));
          $ajar->setHari($request->request->get('hari'));
          $error = $validator->validate($ajar);
          if(count($error) > 0){
            $data['errors'] = $error;
            return $this->render('ajar/tambah.html.twig',$data);
          }else{
            $bundelajar = $this->getDoctrine()->getRepository("AppBundle:Ajar");
            $cekdata = array('matakuliahmatkul'=>$matkulid,
                             'kelas'=>$ajar->getKelas());
            $cekmatkulkelas  = $bundelajar->findOneBy($cekdata);
            $cekruangharijam = $bundelajar->findOneBy(array('jam'=>$ajar->getJam()
                                                           ,'hari'=>$ajar->getHari()
                                                           ,'ruangruang'=>$ajar->getRuangruang()));
            if(count($cekmatkulkelas)>0){
              $data['errors'] = array(array('message'=>'matakuliah dengan kelas tersebut sudah ada'));
              return $this->render('ajar/tambah.html.twig',$data);
            }else if(count($cekruangharijam)>0){
              $data['errors'] = array(array('message'=>'Jam dengan Hari dan ruang tersebut sudah ada'));
              return $this->render('ajar/tambah.html.twig',$data);
            }else{
              $em = $this->getDoctrine()->getManager();
              $this->session->getFlashBag()->add('hasil','Berhasi menambah data');
              $em->persist($ajar);
              $em->flush();
              return $this->redirectToRoute('jadwalajar');
            }
          }
      }
      return $this->render('ajar/tambah.html.twig',$data);
  }
  /**
   *@Method({"GET", "POST"})
   * @Route("/jadwalajar/hapus/{akun}", name="jadwalajar_hapus")
   */
     public function hapus(Ajar $akun)
     {
       $hasil = 'Data Berhasil Menghapus';
       $this->session->getFlashBag()->add('hasil',$hasil);
       $em = $this->getDoctrine()->getManager();
       $em->remove($akun);
       $em->flush();
       return $this->redirectToRoute('jadwalajar');
     }
     /**
       *@Method({"GET","POST"})
       * @Route("/jadwalajar/edit/{id}", name="jadwalajar_edit")
       */
     public function edit(Request $request,$id){
       if($this->session->has('akun') == false)
       return $this->redirect('admin');
       $ds = $this->getDoctrine()->getRepository("AppBundle:Dosen");
       $mk = $this->getDoctrine()->getRepository("AppBundle:Matakuliah");
       $r  = $this->getDoctrine()->getRepository("AppBundle:Ruang");
       $matakuliah = $mk->findAll();
       $dosen      = $ds->findAll();
       $ruang      = $r->findAll();
       $ajar       = $this->getDoctrine()->getRepository('AppBundle:Ajar')->find($id);
       $data       = array('page' => '','matakuliah'=>$matakuliah,'dosen'=>$dosen,
                     'ruang'=>$ruang,
                     'errors'=> null,'data'=>$ajar);

       if($request->getMethod() == "POST"){
           $validator = $this->get('validator');
           $dosenip  = $ds->find($request->request->get('dosen'));
           $matkulid = $mk->find($request->request->get('matkul'));
           $ruangid  = $r ->find($request->request->get('ruang'));
           $ajar->setDosenNip($dosenip);
           $ajar->setMatakuliahmatkul($matkulid);
           $ajar->setRuangruang($ruangid);
           $ajar->setKelas($request->request->get('kelas'));
           $ajar->setJam($request->request->get('jam'));
           $ajar->setHari($request->request->get('hari'));
           $error = $validator->validate($ajar);
           if(count($error) > 0){
             $data['errors'] = $error;
             return $this->render('ajar/edit.html.twig',$data);
           }else{
             $bundelajar = $this->getDoctrine()->getRepository("AppBundle:Ajar");
             $cekdata = array('matakuliahmatkul'=>$matkulid,
                              'kelas'=>$ajar->getKelas());
             $cekmatkulkelas  = $bundelajar->findOneBy($cekdata);
             $cekruangharijam = $bundelajar->findOneBy(array('jam'=>$ajar->getJam()
                                                            ,'hari'=>$ajar->getHari()
                                                            ,'ruangruang'=>$ajar->getRuangruang()));
              $cekdosenjamhari = $bundelajar->findOneBy(array('jam'=>$ajar->getJam(),
                                                              'hari'=>$ajar->getHari(),
                                                              'dosenNip' => $ajar->getDosenNip()));
             if(count($cekmatkulkelas)>0 && $cekmatkulkelas != $ajar){
               $data['errors'] = array(array('message'=>'matakuliah dengan kelas tersebut sudah ada'));
               return $this->render('ajar/edit.html.twig',$data);
             }else if(count($cekruangharijam)>0 && $cekruangharijam != $ajar){
               $data['errors'] = array(array('message'=>'Jam dengan Hari dan ruang tersebut sudah ada'));
               return $this->render('ajar/edit.html.twig',$data);
                 }
            else if(count($cekdosenjamhari) > 0 && $cekdosenjamhari != $ajar){
              $data['errors'] = array(array('message'=>'Dosen Sudah memilik jadwal pada jam tersebut'));
              return $this->render('ajar/edit.html.twig',$data);
            }
            else{
               $em = $this->getDoctrine()->getManager();
               $this->session->getFlashBag()->add('hasil','Berhasi Mengubah data');
               $em->flush();
               return $this->redirectToRoute('jadwalajar');
             }
           }
       }
       return $this->render('ajar/edit.html.twig',$data);

       }
       /**
         *@Method({"GET","POST"})
         * @Route("/tesdoang/{ruang}", name="tesdoang")
         */
         public function tesdoang($ruang){
           $getruang = $this->getDoctrine()->getRepository("AppBundle:Ruang")
                        ->findBy(array('idruang' => $ruang ));
           $ruang = $this->getDoctrine()->getRepository("AppBundle:Ajar")
                        ->findBy(array("ruangruang"=>$getruang ));
        //  return new Response(count($ruang));
          $data = array('page' => 'admin','ruang'=>$ruang);
          return $this->render('ruang.html.twig',$data);
         }
}
