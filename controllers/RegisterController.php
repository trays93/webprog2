<?php

class RegisterController
{
    /**
     * Regisztrációs űrlapot megjelenít és feldolgoz.
     *
     * @return void
     */
    public function indexAction()
    {
        $data = $this->sanitizeData($_POST);

        if (count($data) > 0) {
            $validationErrors = $this->validateData($data);
            if (count($validationErrors) > 0) {
                return new View('register', 'index', [
                    'data' => $data,
                    'errors' => $validationErrors,
                ]);
            } else {
                $register = new Register($data['email'], $data['firstname'], $data['lastname'], $data['password']);

                try {
                    $conn = Database::getConnection();
                    $stmt = $conn->prepare("INSERT INTO user (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)");
                    $stmt->bindValue(':firstName', $register->getFirstName());
                    $stmt->bindValue(':lastName', $register->getLastName());
                    $stmt->bindValue(':email', $register->getEmail());
                    $stmt->bindValue(':password', $register->getPassword());
                    $stmt->execute();
                    
                } catch(PDOException $e) {
                    return new View('error', 'error', [
                        'error' => $e->getMessage()
                    ]);
                } finally {
                    $conn = null;
                }

                return new View('register', 'index', [
                    'data' => $data,
                    'success' => 'Sikeres regisztráció!',
                ]);
            }
        } else {
            return new View('register', 'index');
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

    /**
     * A paraméterben megkapott adatokat validálja.
     *
     * @param array $data
     * @return array
     */
    private function validateData($data)
    {
        $validationErrors = [];

        // E-mail ellenőrzése
        if (empty($data['email'])) {
            $validationErrors['email'] = 'Az Email kötelező!';
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $validationErrors['email'] = 'Hibás e-mail!';
        }

        // Vezetéknév ellenőrzése
        if (empty($data['firstname'])) {
            $validationErrors['firstname'] = 'A vezetéknév nem lehet üres!';
        } else if (!preg_match('/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/', $data['firstname'])) {
            $validationErrors['firstname'] = 'A vezetéknév csak betűket és szóközt tartalmazhat';
        }

        // Keresztnév ellenőrzése
        if (empty($data['lastname'])) {
            $validationErrors['lastname'] = 'A keresztnév nem lehet üres!';
        } else if (!preg_match('/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ]+$/', $data['lastname'])) {
            $validationErrors['lastname'] = 'A keresztnév csak betűket és szóközt tartalmazhat';
        }

        // Jelszó ellenőrzése
        if (empty($data['password'])) {
            $validationErrors['password'] = 'A jelszó nem lehet üres!';
        } else if ($data['password'] !== $data['password-confirm']) {
            $validationErrors['password'] = 'A megadott jelszavak nem egyeznek!';
        }

        return $validationErrors;
    }
}
