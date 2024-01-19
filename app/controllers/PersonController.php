<?php
namespace App\Controllers;

use App\Models\Person;
use Ds\Foundations\Connection\Db;
use Ds\Foundations\Controller\Controller;
use Ds\Foundations\Network\Request;
use Ds\Foundations\Routing\Attributes\Get;
use Ds\Foundations\Routing\Attributes\Post;

class PersonController extends Controller {

  #[Get('/user/all')]
  public function index(Request $request){
    $personModel = new Person();
    $summary = $personModel->getSummary();
    $data = $personModel->getAll();
    return response(true, [
      'summary' => $summary,
      'list' => $data
    ]);
  }

  public function savePerson(Request $request){
    $data = $request->json();
    $data->timestamp = date('Y-m-d h:i:s.u');
    $person = Person::save($data);
    return ['status' => 'success', 'data' => $person];
  }
  
  public function deletePerson(Request $request){
    $id = $request->id;
    Person::remove($id);
    return ['status' => 'success'];
  }
}