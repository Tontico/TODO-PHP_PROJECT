<?php

namespace Keha\Test\views\forms;



use Keha\Test\App\UrlGenerator;
use Keha\Test\Model\GetUser;

// Function to display the connection form
class ConnexionForm
{
    public $datas;
    public $error;

    public function __construct($datas)
    {
        $this->datas = $datas;
        $this->error = null;
    }

    // Method to display the connection form
    public function displayConnexionForm()
    {
        echo "<form action='" . UrlGenerator::generateUrl('ConnexionController', 'connexion') . "' method='POST' style='width: 25%; margin: auto; margin-top: 150px;'>";
        // Show the error message if not null
        if ($this->error !== null) {
            echo "<div class='alert alert-danger' role='alert'>$this->error</div>";
        }
        echo "
        <label for='username'>Username</label>
        <input type='text' name='username' class='form-control' autocomplete='username' required autofocus style='margin-bottom: 20px;'>
        <label for='password'>Password</label>
        <input type='password' name='password' id='password' class='form-control' style='margin-bottom: 20px;'>
        <button class='btn btn-lg btn-primary' type='submit' name='submit'>
            Log in
        </button>
    </form>";
    }

    // Method to process the login form
    public function processFormLogin()
    {
        $this->error = false;
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            // Check if the user exists and get the password
            if (($password = GetUser::getUser($username, $this->datas)) !== false) {
                // Verify if passwords matches
                if (strcasecmp($_POST['password'], $password) === 0) {
                    //The password is correct => set session variables
                    $_SESSION['connected'] = 'connected';
                    $_SESSION['username'] = $_POST['username'];
                    return true;
                } else {
                    $this->error = 'Identifiants invalide';
                }
            } else {
                $this->error = 'Identifiants invalide';
            }
        }
        return $this->error;
    }
}
