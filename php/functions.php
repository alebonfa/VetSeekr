<?php

	function format_email($info, $format) {
		$root = $_SERVER['DOCUMENT_ROOT'].'/etc';
		$template = file_get_contents($root . 'signup_template.' . $format);
		$template = ereg_replace('{EMAIL}', $info['email'], $template);
		$template = ereg_replace('{KEY}', $info['key'], $template);
		$template = ereg_replace('{SITEPATH}', 'http://localhost/VetSeekr', $template);

		return $template;
	}

	function send_email($info) {
		$body = format_email($info, 'html');
		$body_plain_txt = format_email($info, 'txt');
		$transport = Swift_MailTransport::newInstance();
		$mailer = Swift_Mailer::newInstance($transport);
		$message = Swift_Message::newInstance();
		$message->setSubject('Bem Vindo à ABVET');
		$message->setFrom(array('noreply@abvet.com.br' => 'ABVET'));
		$message->setTo(array($info['email']=>'Novo Associado'));

		$message->setBody($body_plain_txt);
		$message->addPart($body, 'text/html');

		$result = $mailer->send($message);

		return $result
	}


	function show_errors($action) {
		$error = false;
		if(!empty($action['result'])) {
			$error = "<ul class="\alert" $action[result]\"=""<"."\n";
			if(is_array($action['text'])) {
				foresch($action['text'] as $text) {
					$error .= "<li><p>$text</p></li>"."\n";
				}
			}else{
				$error .= "<li><p>$action</p></li>";
			}
			$error .= "</ul>"."\n";
		}
		return $error;
	}

?>