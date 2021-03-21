<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

require '../includes/DbOperations.php';
$config = ['settings' => ['displayErrorDetails' => true]];
$app = new Slim\App($config);



$app->post('/createmedicament', function(Request $request , Response $response){
  if(!HaveEmptyParameters(array('Classe_Therapeutique', 'Nom_Commercial', 'Laboratoire', 'Denominateur_De_Medicament', 'Forme_Pharmaceutique', 'Duree_De_Conservation', 'Remborsable', 'Lot', 'Date_De_Fabrication', 'Date_Peremption', 'Description_De_Composant', 'Prix', 'Quantite_En_Stock', 'Code_a_Bare'),$request, $response)){

      $request_data = $request->getParsedBody();

      $Classe_Therapeutique=$request_data['Classe_Therapeutique'];
      $Nom_Commercial=$request_data['Nom_Commercial'];
      $Laboratoire=$request_data['Laboratoire'];
      $Denominateur_De_Medicament=$request_data['Denominateur_De_Medicament'];
      $Forme_Pharmaceutique=$request_data['Forme_Pharmaceutique'];
      $Duree_De_Conservation=$request_data['Duree_De_Conservation'];
      $Remborsable=$request_data['Remborsable'];
      $Lot=$request_data['Lot'];
      $Date_De_Fabrication=$request_data['Date_De_Fabrication'];
      $Date_Peremption=$request_data['Date_Peremption'];
      $Description_De_Composant=$request_data['Description_De_Composant'];
      $Prix=$request_data['Prix'];
      $Quantite_En_Stock=$request_data['Quantite_En_Stock'];
      $Code_a_Bare=$request_data['Code_a_Bare'];




      $db = new DbOperations;
      $result = $db->CreateMedicament($Classe_Therapeutique,$Nom_Commercial,$Laboratoire,$Denominateur_De_Medicament, $Forme_Pharmaceutique,$Duree_De_Conservation,$Remborsable, $Lot,$Date_De_Fabrication,$Date_Peremption,$Description_De_Composant,$Prix,$Quantite_En_Stock,$Code_a_Bare);
      if($result== MEDICAMENT_CREATED){
          $message = array();
          $message['error'] = false ;
          $message['message'] = '  MEDICAMENT craeted successfully ';
          $response->write(json_encode($message));
          return $response
                      ->withHeader('Content-type' , 'application/json')
                      ->withStatus(201);
      }else if($result== MEDICAMENT_FAILURE){

          $message = array();
          $message['error'] = true ;
          $message['message'] = '  Some error accured';
          $response->write(json_encode($message));
          return $response
                      ->withHeader('Content-type' , 'application/json')
                      ->withStatus(422);
      }else if($result== MEDICAMENT_EXISTS){
        $message = array();
        $message['error'] = true ;
        $message['message'] = '  Medicament already exists';
        $response->write(json_encode($message));
        return $response
                    ->withHeader('Content-type' , 'application/json')
                    ->withStatus(422);
      }

  }
});

$app->post('/GetOneMedicament', function(Request $request , Response $response){
        if(!HaveEmptyParameters(array('Nom_Commercial'),$request, $response)){
            $request_data = $request->getParsedBody();
            $Nom_Commercial=$request_data['Nom_Commercial'];

            $db = new DbOperations;
            $medicament=$db->getMedicamentByNomCommercial($Nom_Commercial);

            if($medicament==null){

                        $response_data = array();
                        $response_data['error'] = true ;
                        $response_data['message'] = ' MEDICAMENT not found';
                        $response->write(json_encode($response_data));
                        return $response
                                    ->withHeader('Content-type' , 'application/json')
                                    ->withStatus(404);//ONot found
                } else{

                  $response_data = array();
                  $response_data['error'] = false ;
                  $response_data['message'] = '  One MEDICAMENT ';
                  $response_data['user'] = $medicament;

                  $response->write(json_encode($response_data));
                  return $response
                              ->withHeader('Content-type' , 'application/json')
                              ->withStatus(200);//OK

                }
}});
$app->get('/GetAllMedicaments', function(Request $request , Response $response){



            $db = new DbOperations;
            $medicament=$db->getAllMedicaments();
            $response_data = array();
            $response_data['error'] =false ;

            $response_data['medicament'] = $medicament;

            $response->write(json_encode($response_data));
            return $response
                        ->withHeader('Content-type' , 'application/json')
                        ->withStatus(200);//OK

          });

$app->get('/GetAllLaboratoire', function(Request $request , Response $response){



                      $db = new DbOperations;
                      $medicament=$db->getAllLaboratoire();
                      $response_data = array();
                      $response_data['error'] =false ;

                      $response_data['medicament'] = $medicament;

                      $response->write(json_encode($response_data));
                      return $response
                                  ->withHeader('Content-type' , 'application/json')
                                  ->withStatus(200);//OK

                    });


 $app->post('/Search', function(Request $request , Response $response){
                  //echo "yh";
                 //Var_dump(HaveEmptyParameters(array('a'),$request, $response));

                  if(!HaveEmptyParameters(array('a'),$request, $response)){

                      $request_data = $request->getParsedBody();
                      $a=$request_data['a'];

                      $db = new DbOperations;
                      $medicament=$db->Search($a);
                      //Var_dump($medicament);

                      if($medicament== null){

                                  $response_data = array();
                                  $response_data['error'] = true ;
                                  $response_data['medicament'] = $medicament;
                                  $response->write(json_encode($response_data));
                                  return $response
                                              ->withHeader('Content-type' , 'application/json')
                                              ->withStatus(200);//ok 
                        } else{
                          //echo "tvgh";
                          $response_data = array();
                          $response_data['error'] = false ;
                           $response_data['medicament'] = $medicament;
                          //Var_dump($medicament);

                          $response->write(json_encode($response_data));
                          return $response
                                      ->withHeader('Content-type' , 'application/json')
                                      ->withStatus(200);//OK

                  }
          }
        });

$app-> put('/UpdateQuantiteStock/{Nom_Commercial}', function(Request $request , Response $response ,  array $args ){
                    $id = $args['Nom_Commercial'] ;

                    if(!HaveEmptyParameters(array('Nom_Commercial','Quantite_En_Stock'),$request,$response)){

                       $request_data = $request->getParsedBody();
                        $Nom_Commercial=$request_data['Nom_Commercial'];
                      $Quantite_En_Stock=$request_data['Quantite_En_Stock'];

                        $db = new DbOperations;
                        if($db->UpdateQuantite_En_Stock($Quantite_En_Stock , $Nom_Commercial)){
                          $response_data = array();
                          $response_data['error'] =false ;
                          $response_data['message'] = '  Quantite_En_Stock Updates successfully ';

                          $medicament=$db->getMedicamentByNomCommercial($Nom_Commercial);
                          $response_data['medicament'] =$medicament ;

                          $response->write(json_encode($response_data));
                          return $response
                                      ->withHeader('Content-type' , 'application/json')
                                      ->withStatus(201);
                        } else {
                          $response_data = array();
                          $response_data['error'] =true ;
                          $response_data['message'] = ' Please ty again later ';

                          $medicament=$db->getMedicamentByNomCommercial($Nom_Commercial);
                          $response_data['medicament'] =$medicament ;

                          $response->write(json_encode($response_data));
                          return $response
                                      ->withHeader('Content-type' , 'application/json')
                                      ->withStatus(404);
                        }
                    }



                    });


function HaveEmptyParameters($required_params,$request, $response){
    $error=false;
    $error_params='';
    $error_detail=array();
    $medicament=array();
    $request_params=$request->getParsedBody();
    //Var_dump($request_params);
    foreach ($required_params as $param) {
    if(!isset($request_params[$param]) ||  strlen($request_params[$param])<=0 ){
            $error=true;
            $error_params.=$param . ', ';
            $error_detail['error'] = $param;
          }

    }
    if($error){
      $error_detail=array();
      $error_detail['error'] = true;
      $error_detail['medicament']=$medicament;

      $response->write(json_encode($error_detail));
    }

    return $error;

}
/*$app->delete('/deletMedicament/{Nom_Commercial}', function(Request $request, Response $response, array $args){
    $id = $args['Nom_Commercial'];

    $db = new DbOperations;

    $response_data = array();

    if($db->deleteMedicament($id)){
        $response_data['error'] = false;
        $response_data['message'] = 'User has been deleted';
    }else{
        $response_data['error'] = true;
        $response_data['message'] = 'Plase try again later';
    }

    $response->write(json_encode($response_data));

    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});*/
$app->delete('/deletMedicament/{Nom_Commercial}', function(Request $request, Response $response, array $args){
    $id = $args['Nom_Commercial'];

    $db = new DbOperations;

    $response_data = array();


    $id = $args['Nom_Commercial'] ;
    if(!HaveEmptyParameters(array('Nom_Commercial'),$request,$response)){

        $db = new DbOperations;
        $response_data = array();
        Var_dump($db->deleteMedicament($id));
        if($db->deleteMedicament($id)){
            $response_data['error'] = false;
            $response_data['message'] = 'User has been deleeted';
        }else{
            $response_data['error'] = true;
            $response_data['message'] = 'Plase try again later';
        }
    }
    $response->write(json_encode($response_data));

        return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(200);


});

$app->run();
