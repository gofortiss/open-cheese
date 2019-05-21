<?php
class Alert {

    // Constructeur par défaut
    public function __construct(){
        $this->success      = "";
        $this->warning      = "";
        $this->error        = "";
    }

    // Succès
    public function success($title,$text){
        return 'swal("'.$title.'", "'.$text.'", "success", {button: "Continuer",}).catch(swal.noop);';
    }

    // Attention
    public function warning($title,$text){
        return 'swal("'.$title.'", "'.$text.'", "warning", {button: "Continuer",}).catch(swal.noop);';
    }

    // Erreur
    public function error($title,$text){
        return 'swal("'.$title.'", "'.$text.'", "error", {button: "Continuer",}).catch(swal.noop);';
    }

    // Retour des données
    public function alert(){
        return (object) [
            'success'   => $this->success,
            'warning'   => $this->warning,
            'error'     => $this->error
        ];
    }

}
