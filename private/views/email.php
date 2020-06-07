<?php $this->layout('email_layout', ['message' =>$message]); ?>
<?php
                                function sendConfirmationEmail($email, $code){


                                    $url = url('bevestigenEmailCode', ['code' =>$code]);
                                    $absolute_url = absolute_url($url);
                                    
                                    $mailer = getSwiftMailer();
                                    $message = createEmailMessage($email, 'Bevestig je account', 'website', 'buneya2001@gmail.com');
                                    $email_text ='Hallo, bevestig nu je account: <a href="' . $absolute_url . '">Klik Hier </a>';
                                    $message->setBody($email_text, 'text/html');
                                    
                                    $mailer->send($message);
                                    
                                    }
                                ?>