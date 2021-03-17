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
   public function CreateMedicament($Classe_Therapeutique,$Nom_Commercial,$Laboratoire,$Denominateur_De_Medicament, $Forme_Pharmaceutique,$Duree_De_Conservation,$Remborsable, $Lot,$Date_De_Fabrication,$Date_Peremption,$Description_De_Composant,$Prix,$Quantite_En_Stock){

       if(!$this->IsNomCommercialExist($Nom_Commercial)) {
            $stmt= $this->con->prepare("INSERT INTO medicaments (Classe_Therapeutique, Nom_Commercial, Laboratoire, Denominateur_De_Medicament, Forme_Pharmaceutique, Duree_De_Conservation, Remborsable, Lot, Date_De_Fabrication, Date_Peremption, Description_De_Composant, Prix, Quantite_En_Stock)
            VALUES ('$Classe_Therapeutique','$Nom_Commercial', '$Laboratoire', '$Denominateur_De_Medicament', '$Forme_Pharmaceutique', '$Duree_De_Conservation', '$Remborsable', '$Lot', '$Date_De_Fabrication', '$Date_Peremption', '$Description_De_Composant', '$Prix', '$Quantite_En_Stock')");

              if($stmt->execute()){
                    return MEDICAMENT_CREATED;
              }else {
                    return MEDICAMENT_FAILURE;
              }
      }
      return MEDICAMENT_EXISTS;

  }

    public function getMedicamentByNomCommercial($Nom_Commercial){

      $stmt = $this->con->prepare("SELECT Classe_Therapeutique, Nom_Commercial, Laboratoire, Denominateur_De_Medicament, Forme_Pharmaceutique, Duree_De_Conservation, Remborsable, Lot, Date_De_Fabrication, Date_Peremption, Description_De_Composant, Prix, Quantite_En_Stock FROM medicaments WHERE Nom_Commercial = ?");
      $stmt->bind_param('s', $Nom_Commercial);
      $stmt->execute();
      if(!$this->IsNomCommercialExist($Nom_Commercial)){
            $stmt->bind_result($Classe_Therapeutique,$Nom_Commercial,$Laboratoire,$Denominateur_De_Medicament, $Forme_Pharmaceutique,$Duree_De_Conservation,$Remborsable, $Lot,$Date_De_Fabrication,$Date_Peremption,$Description_De_Composant,$Prix,$Quantite_En_Stock);
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
              array_push($medicaments, $medicament);
              return $medicaments;
            }



      }

    }
    public function getAllMedicaments(){

      $stmt = $this->con->prepare("SELECT Classe_Therapeutique, Nom_Commercial, Laboratoire, Denominateur_De_Medicament, Forme_Pharmaceutique, Duree_De_Conservation, Remborsable, Lot, Date_De_Fabrication, Date_Peremption, Description_De_Composant, Prix, Quantite_En_Stock FROM medicaments ORDER BY Nom_Commercial DESC;");
      $stmt->execute();
            $stmt->bind_result($Classe_Therapeutique,$Nom_Commercial,$Laboratoire,$Denominateur_De_Medicament, $Forme_Pharmaceutique,$Duree_De_Conservation,$Remborsable, $Lot,$Date_De_Fabrication,$Date_Peremption,$Description_De_Composant,$Prix,$Quantite_En_Stock);
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
              array_push($medicaments, $medicament);

      }
      return $medicaments;

    }
    public function getAllLaboratoire(){

      $stmt = $this->con->prepare("SELECT Classe_Therapeutique, Nom_Commercial, Laboratoire, Denominateur_De_Medicament, Forme_Pharmaceutique, Duree_De_Conservation, Remborsable, Lot, Date_De_Fabrication, Date_Peremption, Description_De_Composant, Prix, Quantite_En_Stock FROM medicaments GROUP BY Laboratoire ORDER BY Nom_Commercial DESC;");
      $stmt->execute();
            $stmt->bind_result($Classe_Therapeutique,$Nom_Commercial,$Laboratoire,$Denominateur_De_Medicament, $Forme_Pharmaceutique,$Duree_De_Conservation,$Remborsable, $Lot,$Date_De_Fabrication,$Date_Peremption,$Description_De_Composant,$Prix,$Quantite_En_Stock);
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

            $stmt = $this->con->prepare("SELECT Classe_Therapeutique, Nom_Commercial, Laboratoire, Denominateur_De_Medicament, Forme_Pharmaceutique, Duree_De_Conservation, Remborsable, Lot, Date_De_Fabrication, Date_Peremption, Description_De_Composant, Prix, Quantite_En_Stock FROM medicaments WHERE
             Nom_Commercial LIKE '%$a%'
            OR Classe_TherapeutiqueLIKE '%$a%'
            OR Laboratoire LIKE '%$a%'
            OR Denominateur_De_Medicament LIKE '%$a%'
            ORDER BY Nom_Commercial DESC");
            Var_dump($stmt);
            $stmt->bind_param("s", $a);
             if($stmt){

               $stmt->execute();
               $stmt->bind_result($Classe_Therapeutique,$Nom_Commercial,$Laboratoire,$Denominateur_De_Medicament, $Forme_Pharmaceutique,$Duree_De_Conservation,$Remborsable, $Lot,$Date_De_Fabrication,$Date_Peremption,$Description_De_Composant,$Prix,$Quantite_En_Stock);
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
