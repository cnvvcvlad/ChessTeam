<?php

namespace Democvidev\ChessTeam\Form;

use Democvidev\ChessTeam\Classes\Messages;
use Democvidev\ChessTeam\Model\MessagesManager;
use Democvidev\ChessTeam\Service\ValidatorHandler;

class ContactForm
{
    private $validator;
    private $messages;
    private $messagesManager;

    public function __construct()
    {
        $this->validator = new ValidatorHandler();
        $this->messages = new Messages([
            'author_name' => '',
            'mess_author' => '',
            'mess_subject' => '',
            'mess_content' => '',
            'mess_date_creation' => '',
        ]);
        $this->messagesManager = new MessagesManager();
    }

    // public function getForm()
    // {
    //     if (isset($_POST['submit'])) {
    //         $this->validator->validateForm();
    //         $this->messages->setMessages($this->validator->getErrors());
    //         $this->messagesManager->addMessages($this->messages);
    //     }
    // }

    public function contactForm()
    {        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // on vérifie la validité du reCAPTHCHA, si le champ 'recaptcha-response' contient une valeur
            if (empty($_POST['recaptcha-response'])) {
                // require '../vue/vueContact.php';
                header('location:index.php?action=contact&alert=errorContact');
                exit();
            } else {
                // on prépare l'URL , on injecte la reponse donnée avec les 2 parametres obligatoires
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=6LcgZ-oUAAAAAJbnWEAXwODWIOxgSYKAZAr08WhV&response={$_POST['recaptcha-response']}";

                // on vérifie si curl est installé , si oui, on l'utilisera
                //            if (function_exists('curl_version')) {
                //                $curl = curl_init($url);
                //                curl_setopt($curl, CURLOPT_HEADER, false);
                //                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                //                curl_setopt($curl, CURLOPT_TIMEOUT, 1);
                //                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                //                $response = curl_exec($curl);
                //            } else {
                //             on utlisera  file_get_contents
                $response = file_get_contents($url);
                //            }

                // on doit avoir une reponse (soit vide, soit null), donc on verifie qu'on a une reponse

                if (empty($response) || is_null($response)) {
                    header(
                        'location:index.php?action=contact&alert=errorContact'
                    );
                    exit();
                } else {
                    // on recupere la reponse dans un objet
                    $data = json_decode($response);

                    // on peut tester un seul parametre
                    //        $param = $data->success;
                    //        echo "<pre>";
                    //        var_dump(json_decode($response));
                    //        var_dump(json_decode($param));
                    //        echo"</pre>";

                    if ($data->success) {
                        //                    var_dump($_POST);
                        // on fait notre traitement de formulaire
                        if (
                            // on verifie que tous les champs sont remplis
                            isset($_POST['author_name']) &&
                            !empty($_POST['author_name']) &&
                            isset($_POST['mess_subject']) &&
                            !empty($_POST['mess_subject']) &&
                            isset($_POST['mess_author']) &&
                            !empty($_POST['mess_author']) &&
                            isset($_POST['mess_content']) &&
                            !empty($_POST['mess_content'])
                        ) {
                            extract($_POST);

                            //on nettoie le contenu, contre les failles xss et autre
                            $author_name = $this->validator->valid($author_name);
                            $mess_subject = $this->validator->valid($mess_subject);
                            $mess_author = $this->validator->validateEmail(
                                $mess_author
                            );
                            // on garde les balises html, mais on les desactive
                            $mess_content = htmlspecialchars($mess_content);

                            // Traitement des données
                            /**************Traitment du formulaire de contact *************/

                            if (isset($_POST['contact'])) {
                                $this->messagesManager->insertMessage(
                                    new Messages([
                                        'author_name' => $author_name,
                                        'mess_author' => $mess_author,
                                        'mess_subject' => $mess_subject,
                                        'mess_content' => $mess_content,
                                    ])
                                );

                                header(
                                    'location:index.php?action=home&alert=contact'
                                );
                                exit();
                            } else {
                                throw new \Exception(
                                    "Veuillez rééssayer. Une erreur c'est produite."
                                );
                            }
                        } else {
                            throw new \Exception(
                                'Veuillez renseigner tous les champs du formulaire'
                            );
                        }
                    } else {
                        header(
                            'location:index.php?action=contact&alert=errorContact'
                        );
                        exit();
                    }
                }
            }
        } else {
            http_response_code(405);
            echo 'Methode non autorisé';
        }
    }
}
