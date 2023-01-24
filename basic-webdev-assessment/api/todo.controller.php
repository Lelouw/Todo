<?php
require_once("todo.class.php");

class TodoController {
    private const PATH = __DIR__."/todo.json";
    private array $todos = [];

    public function __construct() {
        $content = file_get_contents(self::PATH);
        if ($content === false) {
            throw new Exception(self::PATH . " does not exist");
        }  
        $dataArray = json_decode($content);
        if (!json_last_error()) {
            foreach($dataArray as $data) {
                if (isset($data->id) && isset($data->title))
                $this->todos[] = new Todo($data->id, $data->title, $data->description, $data->done);
            }
        }
    }

    public function loadAll() : array {
        return $this->todos;
    }

    public function load(string $id) : Todo | bool {
        foreach($this->todos as $todo) {
            if ($todo->id == $id) {
                return $todo;
            }
        }
        return false;
    }

    public function create(Todo $todo) : bool {
        // implement your code here
		$title = 'Create Todo';
        
        $errors = [];
		public string $id, 
        public string $title, 
        public string $description = '',
        public bool $done = false

        $todoTitle = '';
        $todoDescription = '';
        if (!empty($todo)) {
           
            try {
				
                
				$new = array_push($this->todos, $todo);
               
				return true;
            } 
			catch (InvalidTodoException $exception) {
                $errors = $exception->getErrors();
				
            }
        }

       
		
		//end of code
        
    }

    public function update(string $id, Todo $todo) : bool {
        // implement your code here
		

        $todoFind = $this->loadAll();

        $errors = [];
      

        if (!empty($todo)&& !empty($id)) {
            try {
				//update by
			
                //update everything
				
				   
               array_splice($todoFind,$id-1,$id,$todo);
			      return true;
            } catch (InvalidTodoException $exception) {
                $errors = $exception->getErrors();
            }
        }

       
		//end
     
    }

    public function delete(string $id) : bool {
        // implement your code here
		$todoFind = $this->loadAll();
		  if (!empty($id)) {
            try {
				
				
				   
               array_splice($todoFind,$id,1);
			      return true;
            } catch (InvalidTodoException $exception) {
                $errors = $exception->getErrors();
            }
        }

		  
        return true;
    }

    // add any additional functions you need below
}