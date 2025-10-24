#!/usr/bin/env php
<?php
// Bootstrap für CLI laden
require(__DIR__ . '/../humhub/config/cli.php');

echo "===== ONCEADAY TASK START: " . date('Y-m-d H:i:s') . " =====\n";

// 1️⃣ Modul "autoage" ausführen
if (\Yii::$app->hasModule('autoage')) {
    echo "→ Updating user ages...\n";
    \Yii::$app->runAction('autoage/age/update');
} else {
    echo "⚠️ Modul 'autoage' ist nicht aktiv oder fehlt.\n";
}

// 2️⃣ Platz für zukünftige Erweiterungen:
// \Yii::$app->runAction('autoclean/cache/flush');
// \Yii::$app->runAction('autobackup/run');

echo "===== ONCEADAY TASK END =====\n";
