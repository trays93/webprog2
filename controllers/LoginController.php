<?php

class LoginController
{
    public function indexAction()
    {
        $data = $this->sanitizeData($_POST);

        if (count($data) > 0) {
            $login = new Login($data['email'], $data['password']);

            try {
                $conn = Database::getConnection();
                $stmt = $conn->prepare("SELECT email, firstName, lastName FROM user WHERE email = :email AND password = :password");
                $stmt->bindValue(':email', $login->getEmail());
                $stmt->bindValue(':password', $login->getPassword());
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                if ($stmt->rowCount() === 1) {
                    // siker
                    $result = $stmt->fetch();
                    $user = new User($result['email'], $result['firstName'], $result['lastName']);
                    $_SESSION['user'] = $user;

                    header("Location: {$_SERVER['HTTP_ORIGIN']}/beadando");
                } else {
                    return new View('login', 'index', [
                        'error' => 'Hibás email vagy jelszó!',
                    ]);
                }

            } catch (PDOException $e) {
                return new View('error', 'error', [
                    'error' => $e->getMessage()
                ]);
            } finally {
                $conn = null;
            }
        } else {
            return new View('login', 'index');
        }
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
}
