<?php
namespace app\app;

use app\model; // Make sure to import the model class

class app {
    public function __construct(string $method = "", string $parameter = "") {
  
        if (!empty($method) && method_exists($this, $method)) {
            try {
                $this->$method($parameter);
            } catch (\Exception $e) {
                \lib\response::errorJSON("Error: " . $e->getMessage());
            }
        } else {
            \lib\response::errorJSON('error 001'); // Fixed syntax here
        }
    }


public function setStufe($nummer){
    $_SESSION['stife'] = $nummer;
}

public function login(){
    $_SESSION['user']='admin';
    $_SESSION['stufe']= 1;

    // 1 = afmins (delete)
    // 2 = powerUser (editieren)
    // 3 = user angemekdet (lesen)
    // 0 = nichts
}

public function logout(){
    $_SESSION['user']='';
    $_SESSION['stufe']= 0;
}

public function status() {
    $data['session'] = [
        'user' => $_SESSION['user'] ?? null, // Expose only necessary data
        'stufe' => $_SESSION['stufe'] ?? 0
    ];
    \lib\response::successJSON($data); // Call the newly added method
}

}