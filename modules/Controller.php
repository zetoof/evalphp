<?php

    namespace Mods;

    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\JsonResponse;

	use Mods\Repository;
	
    class Controller {

        private $app = null;

        public function __construct($app) {
            $this->app = $app;
        }

        public function homePage() {
            $response = array("status" => "success", "message" => "Propel test for SAFIRE v3");
            return new JsonResponse($response);
        }

        public function getAll() {
			$rep = new Repository();
			$data = $rep->getAll();
            if (!$data) {
                $this->app->abort(204, "No content for this request");
            }
            return new JsonResponse($data);
        }

        public function get($id = null) {
            /**
             * @TODO
             *
             * 1. Appeler la methode "get" de la classe "Repository" en passant l'ID de la formation à récupérer
             * 2. Renseigner la variable $data avec les données reçus
             *
             */

			$rep = new Repository();
			$data = $rep->get($id);
            if (!$data) {
                $this->app->abort(204, "No content for this request");
            }
            return new JsonResponse($data);
        }
    }

?>
