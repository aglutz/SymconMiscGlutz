<?
    // Klassendefinition
    class GlutzModTest1 extends IPSModule {

        private $VarChangeCounter = 0;

        // Der Konstruktor des Moduls
        // Überschreibt den Standard Kontruktor von IPS
        public function __construct($InstanceID) {
            // Diese Zeile nicht löschen
            parent::__construct($InstanceID);

            // Selbsterstellter Code
            // var change timestamp
            $this->VarChangeCounter = json_decode(IPS_GetSnapshotChanges(0), True)[0]["TimeStamp"];

        }

        // Überschreibt die interne IPS_Create($id) Funktion
        public function Create() {
            // Diese Zeile nicht löschen.
            parent::Create();

            $this->RegisterPropertyInteger("Interval", 10);
            $this->RegisterTimer("UpdateTimer", 0, 'GLUTZ_UpdateInstance($_IPS[\'TARGET\']);');

        }

        // Überschreibt die intere IPS_ApplyChanges($id) Funktion
        public function ApplyChanges() {
            // Diese Zeile nicht löschen
            parent::ApplyChanges();

            $this->SetTimerInterval("UpdateTimer", $this->ReadPropertyInteger("Interval")*1000);
            json_decode(IPS_GetSnapshotChanges(0), True)[0]["TimeStamp"];
        }

        /**
        * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
        * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
        *
        * ABC_MeineErsteEigeneFunktion($id);
        *
        */
        public function MeineErsteEigeneFunktion(int $id) {
            // Selbsterstellter Code
            echo $id;
        }

        public function UpdateInstance() {
            // Selbsterstellter Code
            echo $this->VarChangeCounter;
        }



    }
?>
