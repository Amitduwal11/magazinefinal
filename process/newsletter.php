<?php 
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$Newsletter = new newsletter();
	//debugger($_POST, true);
	if ($_POST) {
		$act='Add';
		$data = array(
				'email'=>filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),

				'status' => 'Active',
			);
		 //debugger($data,true);

		if (isset($_POST['id']) && !empty($_POST['id'])) {
			//update
			$act = 'updat';
			$newsletter_id = (int)$_POST['id'];
		}else{
			//add
			$act = 'add';
			$newsletter_id= false;
		}

		if ($newsletter_id) {
			$newsletter_info = $Newsletter->getNewsletterbyId($newsletter_id);
			debugger($newsletter_info, true);
			if ($newsletter_info) {
				$success = $Newsletter->addNewsletter($data);
			}else{
				redirect('../index','error','Newsletter not Found');
			}
		}else{
			$success = $Newsletter->addNewsletter($data);
		}
		if ($success) {
			redirect('../index','success','Newsletter '.$act.'ed Successfully');
		}else{
			redirect('../index','error','Problem while '.$act.'ing Newsletter');
		}
	} 