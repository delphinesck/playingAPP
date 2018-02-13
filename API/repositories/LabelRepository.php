<?php

class LabelRepository extends Repository {

    /* GET ALL LABELS */
    public function getAllLabels(){
        $query = "SELECT * FROM labels ORDER BY name";
        $result = $this->connection->query($query);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $labels = [];
        foreach($result as $data){
            $labels[] = new Label($data);
        }
        return $labels;
    }

    /* GET A GAME'S LABELS */
    public function getLabelsByGameId($id){
        $pdo = $this->connection->prepare("SELECT label_id FROM games_labels WHERE game_id=:id");
        $pdo->execute(array(
            'id' => $id
        ));
        $labels_ids = $pdo->fetchAll(PDO::FETCH_ASSOC);

        return $labels_ids;
    }

    /* GET A LABEL WITH ITS ID */
    public function getLabelById($label_id){
        $pdo = $this->connection->prepare("SELECT * FROM labels WHERE id=:label_id");
        $pdo->execute(array(
            'label_id' => $label_id
        ));
        $result = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $label = [];
        foreach($result as $data){
            array_push($label, new Label($data));
        }
        
        return $label[0];
    }

    /* CREATE A NEW LABEL */
    public function createLabel(Label $label){
        $query = "INSERT INTO labels SET    name=:name, 
                                            description=:description";
        $pdo = $this->connection->prepare($query);
        $pdo->execute(array(
            'name' => $label->getName(),
            'description' => $label->getDescription()
        ));
    }

    /* CHECK IF ALREADY EXISTS */
    public function checkName(Label $label){
        $pdo = $this->connection->prepare("SELECT name FROM labels WHERE name=:name");
        $pdo->execute(array(
            'name' => $label->getName()
        ));
        $result = $pdo->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
            return true;
        }
        else{
            return false;
        }
    }
}