<?php

namespace Keha\Test\views\forms;



use Keha\Test\App\UrlGenerator;
use Keha\Test\Views\Forms\AbstractForm;

// Function to display the connection form
class InscriptionForm extends AbstractForm
{

    // Method to display the connection form
    public function displayInscriptionForm()
    {
?>
        <form id="form" action="<?= UrlGenerator::generateUrl('UserController', 'handleSubmit', 'inscription') ?>" method="POST" style="width: 20%; margin: auto; margin-top: 150px; border: 1px solid #007BFF; border-radius: 20px; padding: 20px;">

            <div class="mb-3">
                <?php if (!empty($this->error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($this->error as $key => $value) {
                            echo $value . "</br>";
                        } ?></div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstname">Prénom </label>
                    <input type="text" class="form-control" name="firstname" required placeholder="Prénom" style="border-color: #007BFF;" onfocus="addShadow()" onblur="removeShadow()">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="lastname">Nom <small>(facultatif)</small></label>
                    <input type="text" class="form-control" name="lastname" placeholder="Nom" autofocus style="border-color: #007BFF;" onfocus="addShadow()" onblur="removeShadow()">
                </div>
            </div>

            <div class="mb-3">
                <label for="email">Adresse e-mail</label>
                <input type="text" class="form-control" name="email" required placeholder="E-mail" style="border-color: #007BFF;" onfocus="addShadow()" onblur="removeShadow()">
            </div>

            <div class="mb-3">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" name="password" required placeholder="Mot de passe" style="border-color: #007BFF;" onfocus="addShadow()" onblur="removeShadow()">
            </div>

            <div class="mb-3">
                <label for="confirm_password">Vérification de mot de passe</label>
                <input type="password" class="form-control" name="confirm_password" required placeholder="Vérification de mot de passe" style="border-color: #007BFF;" onfocus="addShadow()" onblur="removeShadow()">
            </div>

            <button class="btn btn-xl btn-primary form-control" type="submit" name="submit">S'inscrire</button>
            <!-- Add of some js for to add/remove the blur because it's freacking bling bling :D -->
            <script>
                function addShadow() {
                    //Look for the ID loginForm + Add class focused
                    document.getElementById('form').classList.add('focused');
                }

                function removeShadow() {
                    //Look for the ID loginForm + Remove class focused
                    document.getElementById('form').classList.remove('focused');
                }
            </script>
        </form>
<?php
    }

    // Method to process the registration form
    public function processForm()
    {
        $this->error = [];
        if (isset($_POST['submit'])) {
            $formDatas = ['lastname' => ucfirst(strtolower($_POST['lastname'])), 'firstname' => ucfirst(strtolower($_POST['firstname'])), "email" => strtolower($_POST['email']), 'password' => $_POST['password'], 'confirm_password' => $_POST['confirm_password']];
            // Call the sanitize method
            $sanitizedDatas = $this->sanitizeFormInputs($formDatas);
            // Update the formDatas & error value with the sanitized ones
            $formDatas = $sanitizedDatas['formDatas'];
            $this->error = $sanitizedDatas['error'];
            // Call the validate password method
            $this->validatePassword($formDatas['password'], $formDatas['confirm_password']);
            // Call the validate firstname method
            $this->validateFirstname($formDatas['firstname']);
            // Call the validate lastname method
            $this->validateLastname($formDatas['lastname']);
            // If error still empty, form is valide
            if (empty($this->error)) {
                return true;
            }
        }
        return $this->error;
    }

    // Method that check the validity of the password
    private function validatePassword($password, $confirm_password)
    {
        // Check for the length of the password
        if (strlen($password) < 8) {
            $this->error['erreurPasswordLength'] = "Le mot de passe doit faire au moins 8 caractères";
        }
        // Check for the presence of at least 1 lowercase in the password
        if (!preg_match('/[a-z]/', $password)) {
            $this->error['erreurPasswordLower'] = "Le mot de passe doit contenir au moins une lettre minuscule";
        }
        // Check for the presence of at least 1 uppercase in the password
        if (!preg_match('/[A-Z]/', $password)) {
            $this->error['erreurPasswordUpper'] = "Le mot de passe doit contenir au moins une lettre majuscule";
        }
        // Check for the presence of at least 1 number in the password
        if (!preg_match('/\d/', $password)) {
            $this->error['erreurPasswordNumber'] = "Le mot de passe doit contenir au moins un chiffre";
        }
        // Check for the presence of at least 1 scpecial char in the password
        if (!preg_match('/[!@#$%^&*()-_=+{};:,<.>]/', $password)) {
            $this->error['erreurPasswordSpecialchar'] = "Le mot de passe doit contenir au moins un caractère spécial";
        }
        // Check if the password and the connfirm_password are the same
        if ($password !== $confirm_password) {
            $this->error['erreurPasswordConfirmPwd'] = "Les mots de passe doivent être identique";
        }
    }

    // Method that check the validity of the password
    private function validateFirstname($firstname)
    {
        // Check for the length of the firstname
        if (strlen($firstname) < 2) {
            $this->error['erreurFirstnameLength'] = "Le prénom doit faire au moins 2 caractères";
        }
        // Check if a number is in the firstname
        if (preg_match('/\d/', $firstname) || preg_match('/[!@#$%^&*()-_=+{};:,<.>]/', $firstname)) {
            $this->error['erreurFirstnameNumber'] = "Le prénom ne doit pas contenir de chiffre  ou de caractère spécial";
        }
    }

    // Method that check the validity of the password
    private function validateLastname($lastname)
    {
        // Check if a number is in the lastname
        if (preg_match('/\d/', $lastname) || preg_match('/[!@#$%^&*()-_=+{};:,<.>]/', $lastname)) {
            $this->error['erreurLastnameNumber'] = "Le nom ne doit pas contenir de chiffre ou de caractère spécial";
        }
    }
}
