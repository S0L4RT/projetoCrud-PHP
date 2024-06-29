<?php
class Noticia{
    private $conn;
    private $table_name = "noticias"; // nome da tabela

    public function __construct($db){
        $this->conn = $db;
    }

    public function registrar($idusu, $titulo, $noticia, $data){
        $query = "INSERT INTO " . $this->table_name . " (idusu, data, titulo, noticia) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idusu, $titulo, $noticia, $data]);
        return $stmt;
    }

    
    public function lerNot($search = '', $order_by = ''){
        $query = "SELECT * FROM noticias ";
        $conditions = [];
        $params = [];

        if($search){
            $conditions[] = "(titulo LIKE :search OR noticia LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }

        if($order_by === 'titulo'){
            $query .= " ORDER BY titulo ASC ";
        }

        if(count($conditions) > 0){
            $query .= " WHERE " . implode(' AND ', $conditions);
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function atualizar($id, $data, $titulo, $noticia){
        $query = "UPDATE " . $this->table_name . " SET titulo = ?, noticia = ?, data = ? WHERE idnot = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$titulo, $noticia, $data, $id]);
        return $stmt;
    }

    public function deletar($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE idnot = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }

    public function lerPorId($id){
        $query = "SELECT * FROM " . $this->table_name . " WHERE idnot = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function lerTodasComAutor(){
        $query = "SELECT n.*, u.nome AS nome_autor FROM " . $this->table_name . " n LEFT JOIN tbusuario u ON n.idusu = u.id ORDER BY n.data DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para ler todas as notícias ordenadas por título ou data
    public function lerTodasOrdenadas($ordenacao){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY ";
        switch ($ordenacao){
            case 'titulo':
                $query .= "titulo ASC";
                break;
            case 'data':
                $query .= "data DESC";
                break;
            default:
            $query .= "data DESC"; // Ordenação padrão por data DESC
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para buscar notícias por título
    public function buscarPorTitulo($termo){
        $query = "SELECT * FROM " . $this->table_name . " WHERE titulo LIKE ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(["%termo%"]);
        return $stmt;
    }
}