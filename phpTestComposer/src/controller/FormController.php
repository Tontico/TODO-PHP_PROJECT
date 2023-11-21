<?php

namespace Keha\Test\Controller;

use Keha\Test\App\AbstractController;
use Keha\Test\App\Model;
use Keha\Test\App\UrlGenerator;
use Keha\Test\views\Head;
use Keha\Test\Views\Header;
use Keha\Test\views\Body;

class FormController extends AbstractController
{
    public $error;

    public function __construct()
    {
        //$this->datas = $datas;
        $this->error = false;
    }
    public function constructProjectForm()
    {

        echo "<form action='" . UrlGenerator::generateUrl('ProjectController', 'createProject') . "' method='POST'>";

        if ($this->error !== false) {
            echo "<div class='alert alert-danger' role='alert'>$this->error</div>";
        }
        echo "<label for='nom'>Nom du projet </label>
            <input type='text' name='Titre_projet' required>

            <label for='description'>Description</label>
            <input type='text' name='Description_projet' id='prenom' required>

            <input type='submit' name='submit' value='créer un projet'>
                
            </input>
        </form>";

        if (isset($_POST["submit"])) {
            return UrlGenerator::redirect('ProjectController', 'displayProjet');
        }
    }
    function validateDeleteForm()
    {
        $form = "<form action='http://localhost/phpobjet/phpTestComposer/index.php?controller=AbonneController&method=deleteAbonne&id=" . $_GET['id'] . "' method='POST'>
            <p>L'abonné selectionné a un emprunt, voulez vous quand même le supprimer?</p>
            <button type='submit' name='submit'>
                Supprimer l'abonne
            </button>
        </form>
        <br><li><a href='http://localhost/phpobjet/phpTestComposer/index.php'>Revenir à la page d'acceuil </a> </li><br>";
        $this->render('form.php', ['form' => $form,]);
    }

    public function updateAbonneForm()
    {
        $abonne = Model::getInstance()->getById('abonne', $_GET['id']);
        $form = "<form action='http://localhost/phpobjet/phpTestComposer/index.php?controller=AbonneController&method=UpdateByIdAbonne&id=" . $abonne->getId() . "' method='POST'>
            <label for='nom'>Nom </label>
            <input type='text' name='nom' value='" . $abonne->getNom() . "'>

            <label for='prenom'>Prenom</label>
            <input type='text' name='prenom' id='prenom' value='" . $abonne->getPrenom() . "'>

            <label for='date_naissance'>Date de naissance (AAAA-MM-DD)</label>
            <input type='text' name='date_naissance' id='date_naissance' value='" . $abonne->getDateNaissance() . "'>

            <label for='adresse'>adresse</label>
            <input type='text' name='adresse' id='adresse' value='" . $abonne->getAdresse() . "'>
            
            <label for='code_postal'>code postal</label>
            <input type='text' name='code_postal' id='code_postal' value='" . $abonne->getCodePostal() . "'>

            <label for='ville'>ville</label>
            <input type='text' name='ville' id='ville' value='" . $abonne->getVille() . "'>
            <button type='submit' name='submit'>
                modifier un abonné
            </button>
        </form>";


        $this->render('form.php', ['form' => $form, 'abonne' => $abonne,]);
    }

    public function constructLivreForm()
    {

        $form = "<form action='http://localhost/phpobjet/phpTestComposer/index.php?controller=livreController&method=createLivre' method='POST'>
            <label for='titre'>Titre </label>
            <input type='text' name='titre'>

            <label for='genre'>Genre</label>
            <input type='text' name='genre' id='genre'>

            <label for='categorie'>Catégorie</label>
            <input type='text' name='categorie' id='categorie'>

            <label for='id_auteur'>Id auteur</label>
            <input type='text' name='id_auteur' id='id_auteur'>
            
            <label for='id_editeur'>Id editeur</label>
            <input type='text' name='id_editeur' id='id_editeur'>

            <button type='submit' name='submit'>
                créer un livre
            </button>
        </form>";


        $this->render('form.php', ['form' => $form,]);
    }

    public function updateLivreForm()
    {
        $livre = Model::getInstance()->getById('livre', $_GET['id']);
        $form = "<form action='http://localhost/phpobjet/phpTestComposer/index.php?controller=livreController&method=updateLivre" . $livre->getId() . "' method='POST'>
            <label for='titre'>Titre </label>
            <input type='text' name='titre' value='" . $livre->getTitre() . "'>

            <label for='genre'>Genre</label>
            <input type='text' name='genre' id='genre' value='" . $livre->getGenre() . "'>

            <label for='categorie'>Catégorie</label>
            <input type='text' name='categorie' id='categorie' value='" . $livre->getCategorie() . "'>

            <label for='id_auteur'>Id auteur</label>
            <input type='text' name='id_auteur' id='id_auteur' value='" . $livre->getAuteurID() . "'>
            
            <label for='id_editeur'>Id editeur</label>
            <input type='text' name='id_editeur' id='id_editeur' value='" . $livre->getEditeurID() . "'>

            <button type='submit' name='submit'>
                modifier un livre
            </button>
        </form>";


        $this->render('form.php', ['form' => $form,]);
    }
}
