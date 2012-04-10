<?php
function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
     // Constantes
  define ('TARGET', $destination);    // Repertoire cible
  define ('MAX_SIZE', $maxsize);    // Taille max en octets du fichier
  define ('WIDTH_MAX', 800);    // Largeur max de l'image en pixels
  define ('HEIGHT_MAX', 800);    // Hauteur max de l'image en pixels
   
  // Tableaux de donnees
  $tabExt = $extensions;    // Extensions autorisees
  $infosImg = array ();
   
  // Variables
  $extension = '';
  $nomImage = '';
   
  /************************************************************
   * Creation du repertoire cible si inexistant
   *************************************************************/
  if( !is_dir (TARGET) ) {
    if( !mkdir (TARGET, 0755) ) {
      exit ('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
    }
  }
   
  /************************************************************
   * Script d'upload
   *************************************************************/
  if(!empty ($_POST))
  {
    // On verifie si le champ est rempli
    if( !empty ($_FILES[$index]['name']) )
    {
      // Recuperation de l'extension du fichier
      $extension  = pathinfo ($_FILES[$index]['name'], PATHINFO_EXTENSION);
   
      // On verifie l'extension du fichier
      if(in_array (strtolower ($extension),$tabExt))
      {
        // On recupere les dimensions du fichier
        $infosImg = getimagesize ($_FILES[$index]['tmp_name']);
   
        // On verifie le type de l'image
        if($infosImg[2] >= 1 && $infosImg[2] <= 14)
        {
          // On verifie les dimensions et taille de l'image
          if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize ($_FILES[$index]['tmp_name']) <= MAX_SIZE))
          {
            // Parcours du tableau d'erreurs
            if(isset ($_FILES[$index]['error']) 
              && UPLOAD_ERR_OK === $_FILES[$index]['error'])
            {
              // On renomme le fichier
              $nomImage = md5 (uniqid ()) .'.'. $extension;
   
              // Si c'est OK, on teste l'upload
              if(move_uploaded_file ($_FILES[$index]['tmp_name'], TARGET.$nomImage))
              {
                $dest['filename'] = $nomImage;
                $dest['dir'] = TARGET;
                $dest['type'] = "IMG";
                $_SESSION['dest'] = $dest;
                return true;
              }
              else
              {
                // Sinon on affiche une erreur systeme
                return 'Problème lors de l\'upload !';
              }
            }
            else
            {
              return 'Une erreur interne a empêché l\'uplaod de l\'image';
            }
          }
          else
          {
            // Sinon erreur sur les dimensions et taille de l'image
            return 'Erreur dans les dimensions de l\'image !';
          }
        }
        else
        {
          // Sinon erreur sur le type de l'image
          return 'Le fichier à uploader n\'est pas une image !';
        }
      }
      else
      {
        // Sinon on affiche une erreur pour l'extension
        return 'L\'extension du fichier est incorrecte !';
      }
    }
    else
    {
      // Sinon on affiche une erreur pour le champ vide
      return 'Veuillez remplir le formulaire svp !';
    }
  }
}

?>