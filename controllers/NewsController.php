<?php

class NewsController
{
    public function indexAction()
    {

        //A küldött komment adatbázisba való rögzítése, szűrés után
        $data = $this->sanitizeData($_POST);
        if (count($data) > 0 && isset($data['comment']) && isset($_SESSION['user'])) {
            $validationErrors = $this->validateData($data);
            if ($validationErrors != null) {
                $news = [ 
                    'data' => [ 'comment' => $data['comment'],
                                'errors' => $validationErrors ]];
            }
            else
            {
                $date = new DateTime();
                $users_news = new News($_SESSION['user']->getUserId(), $_SESSION['user']->getFirstName()." ".$_SESSION['user']->getLastName() , $date, $data['comment']);
                //Elsőnek ellőnőrizzük, hogy az üzenet el lett-e már küldve valamikor, nem ismételjük-e meg?
                try {
                    $conn = Database::getConnection();
                    $stmt = $conn->prepare("SELECT user_id, comment FROM news WHERE user_id = :user_id AND comment = :comment");
                    $stmt->bindValue(':user_id', $users_news->getUserId());
                    $stmt->bindValue(':comment', $users_news->getComment());
                    $stmt->execute();

                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    if ($stmt->rowCount() > 0)
                    {
                        $news = [ 
                            'data' => ['data' => 'Ezt az üzenetet a már egyszer elküldte nekünk!']];
                    }
                    else
                    {
                        //Ha nincs még az adatbázisban, rögzítjük benne
                        try {
                            $conn = Database::getConnection();
                                $stmt = $conn->prepare("INSERT INTO news (user_id, date_time, comment) VALUES (:user_id, :date_time, :comment)");
                                $stmt->bindValue(':user_id', $users_news->getUserId());
                                $stmt->bindValue(':date_time', $users_news->getDate()->format('Y.m.d H:i:s'));
                                
                                $stmt->bindValue(':comment', $users_news->getComment());
                                $stmt->execute();
                                
                            }
                        catch(PDOException $e) {
                            return new View('error', 'error', [
                                'error' => $e->getMessage()
                            ]);
                        } finally {
                            $conn = null;
                        }
                    }
                } 
                catch(PDOException $e) {
                    return new View('error', 'error', [
                        'error' => $e->getMessage()
                    ]);
                } finally {
                    $conn = null;
                }
            }
        }


        //Meglévő kommentek kiolvasása az adatbázisból
        try {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT user_id, firstName, lastName, date_time, comment
                                    FROM user INNER JOIN news on (user.id=news.user_id)
                                    ORDER BY date_time DESC;");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    if ($stmt->rowCount() > 0)
                    {
                        $stmt->setFetchMode(PDO::FETCH_BOTH);
                        $back_date = new DateTime();
                        foreach ($stmt->fetchAll() as $stmt_data) {
                            $news[] = new News($stmt_data[0], $stmt_data[1].' '.$stmt_data[2], $back_date->createFromFormat('Y.m.d H:i:s', $stmt_data[3]), $stmt_data[4]);
            
                        }
                    }
                    else {
                        $news = [
                            'data' => ['data' => 'Nincs megjelenítendő hír!']
                        ];
                    }
        }
        catch (PDOException $e) {
            return new View('error', 'error', [
                'error' => $e->getMessage()
            ]);
        }
        finally {$conn = null;}
        
        return new View('news', 'index', $news);

        
    }

    /**
     * A paraméterben beérkező adatokat feldolgozhatóvá alakítja.
     * A szkript-injektálást akadályozzuk meg vele.
     *
     * @param mixed $data
     * @return mixed
     */
    private function sanitizeData($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = htmlspecialchars(stripslashes(trim($data[$key])));
            }
        } else {
            $data = htmlspecialchars(stripslashes(trim($data)));
        }

        return $data;
    }

    /**
     * A paraméterben megkapott adatokat validálja.
     *
     * @param array $data
     * @return string
     */
    private function validateData($data)
    {
        $validationErrors = null;
        // Comment ellenőrzése
        if (empty($data['comment'])) {
            $validationErrors = 'A komment mező nem lehet üres';
        } else if (!preg_match('/^[!.:,0-9a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/', $data['comment'])) {
            $validationErrors = 'A komment csak betűket, számokat, szóközt, valamint a következő halmaz elemeit { !.:, } tartalmazhatja';
        }

        return $validationErrors;
    }

}