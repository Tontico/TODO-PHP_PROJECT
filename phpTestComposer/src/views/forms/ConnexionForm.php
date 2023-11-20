<?php

namespace Keha\Test\views\forms;



use Keha\Test\App\UrlGenerator;
use Keha\Test\App\Model;

// Function to display the connection form
class ConnexionForm
{
    public $datas;
    public $error;

    public function __construct()
    {
        //$this->datas = $datas;
        $this->error = [];
    }

    // Method to display the connection form
    public function displayConnexionForm()
    {
?>
        <form id="form" action="<?= UrlGenerator::generateUrl('UserController', 'handleSubmit', 'connexion') ?>" method="POST" style="width: 20%; margin: auto; margin-top: 150px; border: 1px solid #007BFF; border-radius: 20px; padding: 20px;">

            <?php if (!empty($this->error)) : ?>
                <div class="alert alert-danger" role="alert"><?= $this->error ?></div>
            <?php endif; ?>

            <label for="email">Username</label>
            <input type="text" name="email" class="form-control" placeholder="Adresse mail" required autofocus style="margin-bottom: 20px;" onfocus="addShadow()" onblur="removeShadow()"><!-- Ajoute les listener onfocus et onblur -->
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" required style="margin-bottom: 20px;" onfocus="addShadow()" onblur="removeShadow()"><!-- Ajoute les listener onfocus et onblur -->

            <button class="btn btn-xl btn-primary form-control" type="submit" name="submit">
                Log in
            </button>

            <!-- Add of some js for to add/remove the blur because it's freacking bling bling :D -->
            <script>
                function addShadow() {
                    //Look for the ID loginForm + Add class focused
                    document.getElementById("form").classList.add("focused");
                }

                function removeShadow() {
                    //Look for the ID loginForm + Remove class focused
                    document.getElementById("form").classList.remove("focused");
                }
            </script>

        </form>

<?php
    }
    // Method to process the login form
    public function processForm()
    {
        $this->error = false;
        if (isset($_POST['submit'])) {
            $username = $_POST['email'];
            $utilisateur = Model::getInstance()->getByAttribute('Utilisateur', 'Nom_utilisateur', $username);
            //var_dump($utilisateur);
            if (empty($utilisateur)) {
                $this->error = 'Identifiants invalide';
                return $this->error;
            }
            if ($utilisateur[0]->getMdp_utilisateur() !== $_POST['password']) {
                $this->error = 'Identifiants invalide';
                return $this->error;
            }
            $_SESSION['connected'] = 'connected';
            $_SESSION['userId'] = $utilisateur[0]->getId_utilisateur();
            $_SESSION['username'] = $utilisateur[0]->getPrenom_utilisateur();
            return true;
        }
    }
}
