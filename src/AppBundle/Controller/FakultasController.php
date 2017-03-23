<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Fakultas;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Session\Session;
class FakultasController extends Controller
{
  private $session;
  public function __construct()
  {
    $this->session = new Session();
  }
  /**
  *@Method({"GET"})
  * @Route("/fakultas", name="fakultas_list",requirements={"action": "tambah"})
  */
  public function fakultas(){
      if($this->session->has('akun') == false)
      return $this->redirectToRoute('login');

    $list = $this->getDoctrine()->getRepository('AppBundle:Fakultas')->findAll();
    $data = array('page'=>'fakultas','isi'=>$list);
    return $this->render('fakultas/list.html.twig',$data);
  }
  /**
  *@Method({"GET"})
  * @Route("/fakultas/hapus/{fk}", name="fakultas_hapus",requirements={"action": "tambah"})
  */
  public function hapus(Fakultas $fk){
      if($this->session->has('akun') == false)
       return $this->redirectToRoute('login');
       $data = $this->getDoctrine()->getRepository('AppBundle:ProgramStudi')->
                            findOneByfakultasfakultas($fk->getIdfakultas());
        if(count($data)>0){
          return new Response('gagal hapus');
        } else{
          $em = $this->getDoctrine()->getManager();
          $em->remove($fk);
          $em->flush();
        }
      return $this->redirectToRoute('fakultas_list');
  }
  /**
  *@Method({"GET","POST"})
  * @Route("/fakultas/tambah", name="fakultas_tambah",requirements={"action": "tambah"})
  */
  public function tambah(Request $request){
      if($this->session->has('akun') == false)
       return $this->redirectToRoute('login');

        $fk = new Fakultas();
        if($request->getMethod() == "POST"){
            $fk   ->setNamafakultas($request->request->get('namafakultas'))
                  ->setidfakultas($request->request->get('idfakultas'));
            $validator  = $this->get('validator');
            $errors     = $validator->validate($fk);
            if(count($errors) >0){
              return $this->render('fakultas/tambah.html.twig',array('errors'=>$errors,
                                                                  'page'  => 'fakultas',
                                                                  'data' =>$fk));
            }else{
                $em = $this->getDoctrine()->getManager();
                $em->persist($fk);
                $em->flush();
                return $this->redirectToRoute('fakultas_list');
            }
        }
        return $this->render('fakultas/tambah.html.twig',array('errors'=>null,
                                                            'data' =>$fk,
                                                            'page'  => 'fakultas'));
  }

     /**
     *@Method({"GET","POST"})
     * @Route("/fakultas/edit/{id}", name="fakultas_edit")
     */
  public function edit(Request $request,$id){
      if($this->session->has('akun') == false)
       return $this->redirectToRoute('login');

    $em = $this->getDoctrine()->getManager();
    $ds = $em->getRepository('AppBundle:Fakultas')->find($id);
    if($request->getMethod() == "POST"){
          $ds->setNamafakultas($request->request->get('namafakultas'))
             ->setidfakultas($id);
       $validator = $this->get('validator');
       $errors = $validator->validate($ds);
       if(count($errors) > 0){
         return $this->render('fakultas/edit.html.twig',array(  'errors'=>$errors,
                                                             'page'  => 'dosen',
                                                             'id'     =>$id,
                                                             'fk' =>$ds));
       }else{
           $em = $this->getDoctrine()->getManager();
           $fakultas = $em->getRepository('AppBundle:Fakultas')->find($id);
           $fakultas->setNamafakultas($ds->getNamafakultas());
           $em->flush();
           return $this->redirectToRoute('fakultas_list');
       }
   }
   return $this->render('fakultas/edit.html.twig',array(  'errors'=>null,
                                                       'id'     =>$id,
                                                       'fk' =>$ds,
                                                       'page'  => 'dosen'));
  }
}
