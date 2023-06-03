<?php

class Orders extends DBTools
{
    public function getOrders($data)
    {
        $query = "SELECT * FROM orders WHERE 1 ";
        
        if (isset($data['origen']) && $data['origen']) {
            $query .= " AND origen LIKE '%{$data['origen']}%'";
        }

        if (isset($data['destino']) && $data['destino']) {
            $query .= " AND destino LIKE '%{$data['destino']}%'";
        }

        if (isset($data['salida']) && $data['salida']) {
            $query .= " AND salida LIKE '%{$data['salida']}%'";
        }

        if (isset($data['retorno']) && $data['retorno']) {
            $query .= " AND retorno LIKE '%{$data['retorno']}%'";
        }

        if (isset($data['total']) && $data['total']) {
            $query .= " AND total LIKE '%{$data['total']}%'";
        }

        if (isset($data['fecha']) && $data['fecha']) {
            $query .= " AND fecha LIKE '%{$data['fecha']}%'";
        }

        if (isset($data['hora']) && $data['hora']) {
            $query .= " AND hora LIKE '%{$data['hora']}%'";
        }
        if (isset($data['estado']) && $data['estado']) {
            $query .= " AND estado LIKE '%{$data['estado']}%'";
        }

        return $this->exec($query);
    }

    public function getTime($data) {
        $PHPSESSID = $data['PHPSESSID'];
        $PHP_SELF = $data['PHP_SELF'];
        $PURE_PHP_SELF = $data['PURE_PHP_SELF'];
        $QUERY_STRING = $data['QUERY_STRING'];
        $HTTP_USER_AGENT = $data['HTTP_USER_AGENT'];
        $HTTP_ACCEPT_ENCODING = $data['HTTP_ACCEPT_ENCODING'];
        $type = $data['type'];
        
    }
    
    
}
