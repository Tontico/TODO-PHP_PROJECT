public function updateTaskForm()
{
$task = Model::getInstance()->getByAttribute('taches', 'Id_taches', $_GET['Id_taches']);
echo "<main class='main_project'>
    <div class='update_form_container'>
        <form id='project_form' action='" . UrlGenerator::generateUrl(' ProjectController', 'updateTask' ) . "&Id_Projet=" . $task[0]->getProjet()[0]->getId_projet() . "&Id_taches=" . $task[0]->getId_taches() . "' method='POST'>
            <div class='mb-3'>
                <label for='Titre_task' class='form-label'>Nom de la tâche*</label>
                <input type='text' class='form-control' name='Titre_task' required>
            </div>

            <div class='mb-3'>
                <label for='Description_task' class='form-label'>Description de la tâche*</label>
                <input type='text' class='form-control' name='Description_task' required>
            </div>

            <div class='mb-3'>
                <label for='Date_fin' class='form-label'>Date butoire de la tâche</label>
                <input type='date' class='form-control' name='Date_fin' id='date_fin'>
            </div>
            <div class='radioStateAndPriority'>
                <div class='mb-3'>
                    <h6>Sélectionnez l'état de la charge :</h6>
                    <div>
                        <input type='radio' name='charge' value='Légère' />
                        <label for='Légère'>Légère</label>
                    </div>

                    <div>
                        <input type='radio' name='charge' value='Modérée' />
                        <label for='Modérée'>Modérée</label>
                    </div>

                    <div>
                        <input type='radio' name='charge' value='Élevée' />
                        <label for='Élevée'>Élevée</label>
                    </div>
                </div>

                <div class='mb-3'>
                    <h6>Sélectionnez la priorité de la tâche :</h6>
                    <div>
                        <input type='radio' name='priorite' value='Basse' />
                        <label for='Basse'>Basse</label>
                    </div>

                    <div>
                        <input type='radio' name='priorite' value='Moyenne' />
                        <label for='Moyenne'>Moyenne</label>
                    </div>

                    <div>
                        <input type='radio' name='priorite' value='Haute' />
                        <label for='Haute'>Haute</label>
                    </div>
                </div>
            </div>

            <div class='mb-3'>
                <h6>Sélectionnez le statut de la tâche :</h6>
                <div>
                    <input type='radio' name='status' value='Non débuté' />
                    <label for='Non débuté'>Non débuté</label>
                </div>

                <div>
                    <input type='radio' name='status' value='En cours' />
                    <label for='En cours'>En cours</label>
                </div>

                <div>
                    <input type='radio' name='status' value='Terminé' />
                    <label for='Terminé'>Terminé</label>
                </div>
            </div>

            <button type='submit' name='submit' class='btn btn-primary'>Modifier une tâche</button>
        </form>
    </div>
</main>";

if (isset($_POST["submit"])) {
return UrlGenerator::redirect('ProjectController', 'displayTask');
}
}
}