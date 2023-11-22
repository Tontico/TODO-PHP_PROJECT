<?php

namespace Keha\Test\views\forms;



use Keha\Test\App\UrlGenerator;
use Keha\Test\App\Model;
use Keha\Test\Views\Forms\AbstractForm;

// Function to display the connection form
class ConnexionForm extends AbstractForm
{

    // Method to display the connection form
    public function displayConnexionForm()
    {
?>
        <main>
            <form id="security_form" action="<?= UrlGenerator::generateUrl('UserController', 'handleSubmit', 'connexion') ?>" method="POST">
                <?php if (!empty($this->error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($this->error as $key => $value) {
                            echo $value . "</br>";
                        } ?></div>
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
        </main>
<?php
    }
    // Method to process the login form
    public function processForm()
    {
        $this->error = [];
        if (isset($_POST['submit'])) {
            $formDatas = ['email' => $_POST['email'], 'password' => $_POST['password']];
            // Call the sanitize method
            $sanitizedDatas = $this->sanitizeFormInputs($formDatas);
            // Update the formDatas & error value with the sanitized ones
            $this->error = $sanitizedDatas['error'];
            $username = $sanitizedDatas['formDatas']['email'];
            $password = $sanitizedDatas['formDatas']['password'];
            $utilisateur = Model::getInstance()->getByAttribute('Utilisateur', 'Nom_utilisateur', $username);
            // Look if login is empty OR if password doesn't match with the DB
            if (empty($utilisateur) || $utilisateur[0]->getMdp_utilisateur() !== $password) {
                $this->error[] = 'Identifiants invalides';
                return $this->error;
            } else {

                // Stock the user data in SESSION
                $_SESSION['connected'] = 'connected';
                $_SESSION['userId'] = $utilisateur[0]->getId_utilisateur();
                $_SESSION['username'] = $utilisateur[0]->getPrenom_utilisateur();
                return [true, $formDatas];
            }
        }
    }
}
