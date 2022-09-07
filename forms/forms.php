<?php

		$to = 'korinf2014@yandex.ru'; // АДРЕС ЗАКАЗЧИКА

		$name = htmlspecialchars($_POST['name']);
		$tel = htmlspecialchars($_POST['tel']);
		
		if (empty($name) or empty($tel)) {
			echo "Не введено одно или несколько обязательных значений. Форма не будет отправлена. Если вы считаете, что произошла ошибка, пожалуйста, обратитесь к администратору ресурса.";
			exit();
		}

	require 'PHPMailerAutoload.php';

	$mail = new PHPMailer;
	
	$mail->CharSet = 'UTF-8';
	$mail->isHTML(true); 
	$mail->setFrom('noreply@'.$_SERVER['HTTP_HOST'], 'УЦ Коринф'); // ОТ КОГО
	$mail->addAddress($to); // АДРЕС ЗАКАЗЧИКА
	$mail->addBCC('');  // ДУБЛИРУЕМ
	
	$mail->Subject = 'Коринф';
	$mail->Body    = '<!DOCTYPE html>
<html>
	<body>
		<h3>Была получена новая заявка с сайта franchise.korinf-centr.ru</h3>
		<table style="width: 100%;" border=1 cellpadding=5>
			<tbody>
				<tr>
					<th>Имя</th>
					<td>'.$name.'</td>
				</tr>
				<tr>
					<th>Телефон</th>
					<td>'.$tel.'</td>
				</tr>
			</tbody>
		</table>
		<hr>
		<p>С наилучшими пожеланиями, <br><b>УЦ Коринф</b><br><br><a href="http://'.$_SERVER['HTTP_HOST'].'">'.$_SERVER['HTTP_HOST'].'</a></p>
	<div id="scrollup" style="display:block;"></div></body>
</html>';	

	if(!$mail->send()) {
    	echo 'Ваше сообщение не принято по техническим причинам. Пожалуйста, свяжитесь с нами, это серьёзно.';
		echo 'Описание ошибки для технического отдела: ' . $mail->ErrorInfo;
	} else {
		echo '<html><head><meta charset="utf-8"></head><body><script>alert("Ваша заявка успешно принята! В ближайшее время с вами свяжется менеджер, чтобы уточнить детали. Спасибо!"); document.location.href="/";</script></body></html>';
	}

?>