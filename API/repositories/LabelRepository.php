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

    /* GET ALL LABELS ORDERED BY ID */
    public function getAllLabelsOrderedById(){
        $query = "SELECT * FROM labels ORDER BY id";
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

    /* CHECK IF A LABEL ALREADY EXISTS IN THE DATABASE */
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

    /* DELETE ALL LABELS WITH THIS GAME ID */
    public function deleteLabelsByGameId(Game $game){
        $prepared = $this->connection->prepare("DELETE FROM games_labels WHERE game_id=:game_id");
        $prepared->execute(array(
            'game_id' => $game->getId()
        ));
    }

    /* CHECK LABELS IN (games_labels) */
    public function checkLabels(Game $game){
        $labels_ids = $game->getLabels();
        
        /* SELECT ALL THE LABEL_IDS ASSOCIATED TO THE GAME ID FROM THE TABLE */
        foreach($labels_ids as $key=>$label_id){
            $pdo = $this->connection->prepare("SELECT * FROM games_labels WHERE game_id=:game_id AND label_id=:label_id");
            $pdo->execute(array(
                'game_id' => $game->getId(),
                'label_id' => $label_id
            ));
            $result = $pdo->fetch(PDO::FETCH_ASSOC);
            /* IF THEY DON'T ALREADY EXIST, INSERT THE LABEL_IDS INTO THE TABLE */
            if(empty($result)){
                $query = "INSERT INTO games_labels SET game_id=:game_id, label_id=:label_id";
                $pdo = $this->connection->prepare($query);
                $pdo->execute(array(
                    'game_id' => $game->getId(),
                    'label_id' => $label_id
                ));
            }
        }

        /* SELECT ALL THE LABEL_IDS ASSOCIATED TO THE GAME ID */
        $pdo = $this->connection->prepare("SELECT * FROM games_labels WHERE game_id=:game_id");
        $pdo->execute(array(
            'game_id' => $game->getId()
        ));
        $content = $pdo->fetchAll(PDO::FETCH_ASSOC);

        /* IF THERE ARE LABEL_IDS */
        if(isset($content)){
            foreach($content as $lab){
                $flag = false;
                /* DO NOTHING IF THE LABEL HAS BEEN CHECKED */
                foreach($labels_ids as $key=>$label_id){
                    if($lab["label_id"] == $label_id){
                        $flag = true;
                    }
                }
                /* DELETE IT FROM THE TABLE IF IT WASN'T CHECKED */
                if($flag == false){
                    $prepared = $this->connection->prepare("DELETE FROM games_labels WHERE label_id=:label_id AND game_id=:game_id");
                    $prepared->execute(array(
                        'label_id' => $lab["label_id"],
                        'game_id' => $game->getId()
                    ));
                }
            }
        }
    }

    /* EDIT A LABEL */
    public function editLabel(Label $label){
        $prepared = $this->connection->prepare("UPDATE labels 
                                                SET name=:name,
                                                description=:description 
                                                WHERE id=:id");
        $prepared->execute(array(
            'id' => $label->getId(),
            'name' => $label->getName(),
            'description' => $label->getDescription()
        ));
    }

    /* DELETE A LABEL */
    public function deleteLabel(Label $label){
        $prepared = $this->connection->prepare("DELETE FROM labels WHERE id=:id");
        $prepared->execute(array(
            'id' => $label->getId()
        ));
    }
}