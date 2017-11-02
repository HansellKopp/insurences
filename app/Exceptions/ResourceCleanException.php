<?php

namespace App\Exceptions;

use Exception;

class ResourceCleanException extends Exception
{
    protected $id;
    protected $details;
     
    public function __construct()
    {
        parent::__construct('resource has no changes');
    }
 
    protected function create(array $args)
    {
        $this->id = array_shift($args);
        $error = $this->errors($this->id);
        $this->details = vsprintf($error['context'], $args);
        return $this->details;
    }
 
    private function errors($id)
    {
        $data= [
            'nothing_to_update' => [
                'context'  => 'The resource has no changes to update.',
            ]
            //   ...
        ];
        return $data[$id];
    }
}