<?php
class Noticia{
    private $conn;
    private $table_name = "noticias"; // nome da tabela

    public function __construct($db){
        $this->conn = $db;
    }

    public function adicionar($id, $idusu, $titulo, $noticia, $data){
        $query = "INSERT INTO " . $this->table_name . " (id, idusu, titulo, noticia, data) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id, $idusu, $titulo, $noticia, $data]);
        return $stmt;
    }

    public function criar($id, $idusu, $titulo, $noticia, $data){
        return $this->adicionar($id, $idusu, $titulo, $noticia, $data);
    }

    public function ler($search = '', $order_by = ''){
        $query = "SELECT * FROM noticias";
        $conditions = [];
        $params = [];

        if($search){
            $conditions[] = "(titulo LIKE :search OR noticia LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }

        if($order_by === 'nome'){
            $query .= " ORDER BY titulo ASC";
        }

        if(count($conditions) > 0){
            $query .= " WHERE " . implode(' AND ', $conditions);
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function atualizar($id, $idusu, $titulo, $noticia, $data){
        $query = "UPDATE " . $this->table_name . " SET titulo = ?, noticia = ?, data = ? WHERE id = ?";
        $stmt = $this->conn-> prepare($query);
        $stmt->execute([$id, $idusu, $titulo, $noticia, $data]);
        return $stmt;
    }

    public function deletar($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }

    public function lerPorId($id){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}