<?php
 /**
  *
  */
 class DbOperations{

    private $con;

   function __construct(){

     require_once dirname(__FILE__) . '/DbConnect.php';

     $db= new DbConnect;
     $this->con=$db->connect();

   }
   public function CreateMedicament($Classe_Therapeutique,$Nom_Commercial,$Laboratoire,$Denominateur_De_Medicament, $Forme_Pharmaceutique,$Duree_De_Conservation,$Remborsable, $Lot,$Date_De_Fabrication,$Date_Peremption,$Description_De_Composant,$Prix,$Quantite_En_Stock,$Code_a_Bare){

       if(!$this->IsNomCommercialExist($Nom_Commercial)) {
         /*
         $target_dir = "uploads/";
         $target_file = $target_dir . basename($_FILES["$Image"]["name"]);
         $uploadOk = 1;
         $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

         if (move_uploaded_file($_FILES["$Image"]["tmp_name"], $target_file)) {
              echo "The file ". basename( $_FILES["$Image"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
              }

              $Image=basename( $_FILES["$Image"]["name"],".jpg"); // used to store the filename in a variable

            */$stmt= $this->con->prepare("INSERT INTO medicaments (Classe_Therapeutique, Nom_Commercial, Laboratoire, Denominateur_De_Medicament, Forme_Pharmaceutique, Duree_De_Conservation, Remborsable, Lot, Date_De_Fabrication, Date_Peremption, Description_De_Composant, Prix, Quantite_En_Stock,Code_a_Bare)
            VALUES ('$Classe_Therapeutique','$Nom_Commercial', '$Laboratoire', '$Denominateur_De_Medicament', '$Forme_Pharmaceutique', '$Duree_De_Conservation', '$Remborsable', '$Lot', '$Date_De_Fabrication', '$Date_Peremption', '$Description_De_Composant', '$Prix', '$Quantite_En_Stock','$Code_a_Bare')");

              if($stmt->execute()){
                    return MEDICAMENT_CREATED;
              }else {
                    return MEDICAMENT_FAILURE;
              }
      }
      return MEDICAMENT_EXISTS;

  }

    public function getMedicamentByNomCommercial($Nom_Commercial){

      $stmt = $this->con->prepare("SELECT Classe_Therapeutique, Nom_Commercial, Laboratoire, Denominateur_De_Medicament, Forme_Pharmaceutique, Duree_De_Conservation, Remborsable, Lot, Date_De_Fabrication, Date_Peremption, Description_De_Composant, Prix, Quantite_En_Stock , Code_a_Bare FROM medicaments WHERE Nom_Commercial = ?");
      $stmt->bind_param('s', $Nom_Commercial);
      $stmt->execute();
      if(!$this->IsNomCommercialExist($Nom_Commercial)){
            $stmt->bind_result($Classe_Therapeutique,$Nom_Commercial,$Laboratoire,$Denominateur_De_Medicament, $Forme_Pharmaceutique,$Duree_De_Conservation,$Remborsable, $Lot,$Date_De_Fabrication,$Date_Peremption,$Description_De_Composant,$Prix,$Quantite_En_Stock, $Code_a_Bare);
            $medicaments=array();
            while ($stmt->fetch()) {
              $medicament=array();
              $medicament['Classe_Therapeutique']=$Classe_Therapeutique;
              $medicament['Nom_Commercial']=$Nom_Commercial;
              $medicament['Laboratoire']=$Laboratoire;
              $medicament['Denominateur_De_Medicament']=$Denominateur_De_Medicament;
              $medicament['Forme_Pharmaceutique']=$Forme_Pharmaceutique;
              $medicament['Duree_De_Conservation']=$Duree_De_Conservation;
              $medicament['Remborsable']=$Remborsable;
              $medicament['Lot']=$Lot;
              $medicament['Date_De_Fabrication']=$Date_De_Fabrication;
              $medicament['Date_Peremption']=$Date_Peremption;
              $medicament['Description_De_Composant']=$Description_De_Composant;
              $medicament['Prix']=$Prix;
              $medicament['Quantite_En_Stock']=$Quantite_En_Stock;
              $medicament['Code_a_Bare']=$Code_a_Bare;
              //$medicament['Image']=$Image;

              array_push($medicaments, $medicament);
              return $medicaments;
            }



      }

    }
    public function getAllMedicaments(){

      $stmt = $this->con->prepare("SELECT Classe_Therapeutique, Nom_Commercial, Laboratoire, Denominateur_De_Medicament, Forme_Pharmaceutique, Duree_De_Conservation, Remborsable, Lot, Date_De_Fabrication, Date_Peremption, Description_De_Composant, Prix, Quantite_En_Stock , Code_a_Bare FROM medicaments ORDER BY Nom_Commercial DESC;");
      $stmt->execute();
            $stmt->bind_result($Classe_Therapeutique,$Nom_Commercial,$Laboratoire,$Denominateur_De_Medicament, $Forme_Pharmaceutique,$Duree_De_Conservation,$Remborsable, $Lot,$Date_De_Fabrication,$Date_Peremption,$Description_De_Composant,$Prix,$Quantite_En_Stock, $Code_a_Bare );
            $medicaments=array();
            while ($stmt->fetch()) {
              $medicament=array();
              $medicament['Classe_Therapeutique']=$Classe_Therapeutique;
              $medicament['Nom_Commercial']=$Nom_Commercial;
              $medicament['Laboratoire']=$Laboratoire;
              $medicament['Denominateur_De_Medicament']=$Denominateur_De_Medicament;
              $medicament['Forme_Pharmaceutique']=$Forme_Pharmaceutique;
              $medicament['Duree_De_Conservation']=$Duree_De_Conservation;
              $medicament['Remborsable']=$Remborsable;
              $medicament['Lot']=$Lot;
              $medicament['Date_De_Fabrication']=$Date_De_Fabrication;
              $medicament['Date_Peremption']=$Date_Peremption;
              $medicament['Description_De_Composant']=$Description_De_Composant;
              $medicament['Prix']=$Prix;
              $medicament['Quantite_En_Stock']=$Quantite_En_Stock;
              $medicament['Code_a_Bare']=$Code_a_Bare;
              //$medicament['Image']=$Image;
              array_push($medicaments, $medicament);

      }
      return $medicaments;

    }
    public function getAllLaboratoire(){

      $stmt = $this->con->prepare("SELECT Classe_Therapeutique, Nom_Commercial, Laboratoire, Denominateur_De_Medicament, Forme_Pharmaceutique, Duree_De_Conservation, Remborsable, Lot, Date_De_Fabrication, Date_Peremption, Description_De_Composant, Prix, Quantite_En_Stock , Code_a_Bare  FROM medicaments GROUP BY Laboratoire ORDER BY Nom_Commercial DESC;");
      $stmt->execute();
            $stmt->bind_result($Classe_Therapeutique,$Nom_Commercial,$Laboratoire,$Denominateur_De_Medicament, $Forme_Pharmaceutique,$Duree_De_Conservation,$Remborsable, $Lot,$Date_De_Fabrication,$Date_Peremption,$Description_De_Composant,$Prix,$Quantite_En_Stock,$Code_a_Bare );
            $medicaments=array();
            while ($stmt->fetch()) {
              $medicament=array();
              $medicament['Classe_Therapeutique']=$Classe_Therapeutique;
              $medicament['Nom_Commercial']=$Nom_Commercial;
              $medicament['Laboratoire']=$Laboratoire;
              $medicament['Denominateur_De_Medicament']=$Denominateur_De_Medicament;
              $medicament['Forme_Pharmaceutique']=$Forme_Pharmaceutique;
              $medicament['Duree_De_Conservation']=$Duree_De_Conservation;
              $medicament['Remborsable']=$Remborsable;
              $medicament['Lot']=$Lot;
              $medicament['Date_De_Fabrication']=$Date_De_Fabrication;
              $medicament['Date_Peremption']=$Date_Peremption;
              $medicament['Description_De_Composant']=$Description_De_Composant;
              $medicament['Prix']=$Prix;
              $medicament['Quantite_En_Stock']=$Quantite_En_Stock;
              $medicament['Code_a_Bare']=$Code_a_Bare;
              //$medicament['Image']=$Image;
              array_push($medicaments, $medicament);

      }
      return $medicaments;

    }

    public function IsNomCommercialExist($Nom_Commercial){

            $stmt = $this->con->prepare("SELECT id FROM medicaments WHERE Nom_Commercial = ?");
             if($stmt){
               $stmt->bind_param("s", $Nom_Commercial);
               $stmt->execute();
               $stmt->store_result();
               return $stmt->num_rows > 0;
             }

    }
    public function Search($a){

            $stmt = $this->con->prepare("SELECT Classe_Therapeutique, Nom_Commercial, Laboratoire, Denominateur_De_Medicament, Forme_Pharmaceutique, Duree_De_Conservation, Remborsable, Lot, Date_De_Fabrication, Date_Peremption, Description_De_Composant, Prix, Quantite_En_Stock, Code_a_Bare FROM medicaments WHERE
             Nom_Commercial LIKE '%$a%'
            OR Classe_TherapeutiqueLIKE '%$a%'
            OR Laboratoire LIKE '%$a%'
            OR Denominateur_De_Medicament LIKE '%$a%'
            ORDER BY Nom_Commercial DESC");
            Var_dump($stmt);
            $stmt->bind_param("s", $a);
             if($stmt){

               $stmt->execute();
               $stmt->bind_result($Classe_Therapeutique,$Nom_Commercial,$Laboratoire,$Denominateur_De_Medicament, $Forme_Pharmaceutique,$Duree_De_Conservation,$Remborsable, $Lot,$Date_De_Fabrication,$Date_Peremption,$Description_De_Composant,$Prix,$Quantite_En_Stock, $Code_a_Bare );
                     $medicaments=array();
                     while ($stmt->fetch()) {
                       $medicament=array();
                       $medicament['Classe_Therapeutique']=$Classe_Therapeutique;
                       $medicament['Nom_Commercial']=$Nom_Commercial;
                       $medicament['Laboratoire']=$Laboratoire;
                       $medicament['Denominateur_De_Medicament']=$Denominateur_De_Medicament;
                       $medicament['Forme_Pharmaceutique']=$Forme_Pharmaceutique;
                       $medicament['Duree_De_Conservation']=$Duree_De_Conservation;
                       $medicament['Remborsable']=$Remborsable;
                       $medicament['Lot']=$Lot;
                       $medicament['Date_De_Fabrication']=$Date_De_Fabrication;
                       $medicament['Date_Peremption']=$Date_Peremption;
                       $medicament['Description_De_Composant']=$Description_De_Composant;
                       $medicament['Prix']=$Prix;
                       $medicament['Quantite_En_Stock']=$Quantite_En_Stock;
                       $medicament['Code_a_Bare']=$Code_a_Bare;
                       //$medicament['Image']=$Image;
                       array_push($medicaments, $medicament);

                       return $medicaments;
                     }




             }

    }

    public function UpdateQuantite_En_Stock($Quantite_En_Stock , $Nom_Commercial){


            if($this->IsNomCommercialExist($Nom_Commercial)){
              $stmt = $this->con->prepare("UPDATE medicaments SET Quantite_En_Stock=?  WHERE Nom_Commercial = ?");
              $stmt->bind_param('is',$Quantite_En_Stock, $Nom_Commercial);
              $stmt->execute();
              if($stmt->execute()) return true;
              return false;
                  }
              return false;



    }

    public function deleteMedicament($Nom_Commercial){


          if($this->IsNomCommercialExist($Nom_Commercial)){
            $stmt = $this->con->prepare("DELETE FROM medicaments WHERE Nom_Commercial = ?");
             if($stmt){
               $stmt->bind_param("s", $Nom_Commercial);
               $stmt->execute();
                return true;

          }
          return false;
                }
            return false;
        }

}
