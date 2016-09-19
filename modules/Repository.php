<?php

    namespace Mods;

    use \FormationsQuery;

    class Repository {

        static function getAll() {
			return FormationsQuery::create()->find();
        }

        static function get($id) {
			return FormationsQuery::create()->findPk($id);
        }

    }

?>
