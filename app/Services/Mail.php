<?php

namespace App\Services;

class Mail
{
    /**
     * Campos de envio de email
     */
    public $camps = [];
    /**
     * Assunto do email
     */
    public $subject;
    /**
     * Destinatários
     */
    public $recipients = [];
    /**
     * Nome de quem está enviando
     */
    public $from_name;
    /**
     * Email de quem está enviando
     */
    public $from_email;
    /**
     * Corpo do email
     */
    public $email_content = '';
    /**
     * Cabeçalho do email
     */
    public $email_headers;
    /**
     * Responsável por enviar email
     */
    public function send()
    {

        $this->setHeaders();
        $this->setEmailContent();
        
        if (mail(implode(',', $this->recipients), $this->subject, $this->email_content, $this->email_headers, ini_set('smtp_port', 25))){
            return true;
        } else {
            return false;
        }
    }
    /**
     * Responsável por setar o header
     */
    private function setHeaders()
    {
        $this->email_headers = "From: $this->from_name <$this->from_email>";
    }
    /**
     * Responsável por setar o copor do email
     */
    private function setEmailContent()
    {
        $body = '';

        foreach ($this->camps as $key => $camp) {
            $body .= "$key: $camp\n";
        }
        $this->email_content = $body;
    }
}
