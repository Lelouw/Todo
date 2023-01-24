<?php
try {
    require_once("todo.controller.php");
    
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = explode( '/', $uri);
    $requestType = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');
    $pathCount = count($path);

    $controller = new TodoController();
    
    switch($requestType) {
        case 'GET':
            if ($path[$pathCount - 2] == 'todo' && isset($path[$pathCount - 1]) && strlen($path[$pathCount - 1])) {
                $id = $path[$pathCount - 1];
                $todo = $controller->load($id);
                if ($todo) {
                    http_response_code(200);
                    die(json_encode($todo));
                }
                http_response_code(404);
                die();
            } else {
                http_response_code(200);
                die(json_encode($controller->loadAll()));
            }
            break;
        case 'POST':
            //implement your code here
			 $todo = $_POST;
			 if (empty($todo))  {
               //
                http_response_code(404);
                die();
            } else {
				$controller->create($todo)
                http_response_code(200);
                die();
            }
            break;
        case 'PUT':
            //implement your code here
			$todo = $_POST;
			$id = $path[$pathCount - 1]
			//$id = $request->getQueryParam('id'); get id by parameter
			 if (empty($todo))  {
               //
                http_response_code(404);
                die();
            } else {
				$controller->update($id,$todo)
                http_response_code(200);
                die();
            }
            break;
        case 'DELETE':
            //implement your code here
			$id = $path[$pathCount - 1]
			//$id = $request->getQueryParam('id');
			 if (empty($id))  {
               //
                http_response_code(404);
                die();
            } else {
				$controller->delete($id)
                http_response_code(200);
                die();
            }
            break;
        default:
            http_response_code(501);
            die();
            break;
    }
} catch(Throwable $e) {
    error_log($e->getMessage());
    http_response_code(500);
    die();
}
