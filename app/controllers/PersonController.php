<?php
namespace App\Controllers;

use App\Models\Person;
use Ds\Foundations\Controller\Controller;
use Ds\Foundations\Network\Request;

class PersonController extends Controller {
  public function index(){
    $data = Person::select()->orderBy('name')->get_assoc();
    return ['data' => $data];
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