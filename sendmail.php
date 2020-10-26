?php
	use PHPMailer\PHPMailer;
	use PHPMailer\Exception;

	require 'phpmailer/rsc/PHPMailer.php';
	require 'phpmailer/rsc/Exception.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	//От кого письмо
	$mail->setFrom('nikitka.jack@gmail.com', 'От кого письмо');
	//Кому отправить
	$mail->addAddress('nikitka.jack@gmail.com');
	//Тема письма
	$mail->Subject = 'Привет!Заказ';

	//тело письма
	$body = '<h1>Письмо на заявку </h1>';

	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
	}
	if(trim(!empty($_POST['phone']))){
		$body.='<p><strong>Телефон:</strong> '.$_POST['phone'].'</p>';
	}
	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
	}
	if(trim(!empty($_POST['message']))){
		$body.='<p><strong>Сообщение:</strong> '.$_POST['message'].'</p>';
	}

	$mail->Body = $body;

	//Отправка
	if (!$mail->send()) {
		$message = 'ошибка';
	} else {
		$message = 'Данные отправлены!';		
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>