<?php
namespace app\modules\autoage\commands;

use humhub\components\console\Controller;
use humhub\modules\user\models\Profile;

/**
 * Berechnet das Alter aller Benutzer neu.
 * Führt die Berechnung anhand des gespeicherten Geburtstags aus.
 */
class AgeController extends Controller
{
    public function actionUpdate()
    {
        $profiles = Profile::find()->all();
        $count = 0;

        foreach ($profiles as $profile) {
            if (!empty($profile->birthday)) {
                $birthDate = new \DateTime($profile->birthday);
                $today = new \DateTime();
                $age = $today->diff($birthDate)->y;

                // Feld "age" muss als Profilfeld existieren!
                $profile->age = $age;
                $profile->save(false, ['age']);
                $count++;
            }
        }

        echo "✔ Alter für {$count} Benutzer aktualisiert um " . date('Y-m-d H:i:s') . "\n";
    }
}
