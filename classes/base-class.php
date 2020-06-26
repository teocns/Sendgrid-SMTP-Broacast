<?php
class baseClass{
    public function __construct($arr = null)
    {
        if ($arr && is_array($arr))
            foreach ($arr as $key => $value){
                if (property_exists($this,$key))
                    $this->$key = $value;
            }
    }

    protected function GetVars() : array{
        return get_object_vars($this);
    }
}
