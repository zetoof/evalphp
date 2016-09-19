<?php

    namespace Mods;

    use \FormationsQuery;

    class Repository {

        static function getAll() {
            /**
             * @TODO
             *
             * Mettre en place la requête Propel pour récupérer la liste de toutes les formations
             * à retourner dans la variable $formations (sous forme de tableau via la requête Propel).
             *
             */
			return FormationsQuery::create()->find();
        }

        static function get($id) {
            /**
             * @TODO
             *
             * Mettre en place la requête Propel pour récupérer la formation correspondant à l'ID passé en paramètre
             * à retourner dans la variable $formation (sous forme de tableau via la requête Propel).
             *
             */
			return FormationsQuery::create()->findPk($id);
        }

    }

?>
