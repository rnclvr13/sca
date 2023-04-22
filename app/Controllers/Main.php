<?php

namespace App\Controllers;
require __DIR__ . '\twilio-php-main\src\Twilio\autoload.php';
use Twilio\Rest\Client;

use App\Models\Package_model;
use App\Models\Post_model;
use App\Models\Comment_model;
use App\Models\Payment_model;

class Main extends BaseController
{
	public function index(){

		$packagemodel = new Package_model();
		$postmodel = new Post_model();

		$data = [

			'packages' => $packagemodel->orderBy('rating', 'DESC')->limit(4)->find(),
			'featured' => $packagemodel->where('featured', '1')->limit(8)->find(),
			'posts' => $postmodel->orderBy('id', 'DESC')->limit(8)->find(),


		];

		echo view('templates/header');
		echo view('nav');
		echo view('title');
		echo view('map');
		echo view('packages', $data);
		echo view('blogs', $data);
		echo view('about');
		echo view('book',$data);
		echo view('templates/footer');
	}

	function bookConfirm(){

		$checkout = $this->request->getPost('checkout_date');
		$checkin = $this->request->getPost('checkin_date');
		$datediff = strtotime($checkout) - strtotime($checkin);
		$package_id = array();
		$package_data = $this->request->getPost('package_data');
		foreach($package_data as $check) {
            $package_id[] = $check; //echoes the value set in the HTML form for each checked checkbox.
                         //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
                         //in your case, it would echo whatever $row['Report ID'] is equivalent to.
    }


		$data = [

			'schedule' => $datediff,
			'pax' => $this->request->getPost('cust_qty'),
			'price' => $this->request->getPost('package_price'),
			'image' => $this->request->getPost('package_image'),
			'checkin' => $checkin,
			'checkout' => $checkout,
			'package_data' => $package_id,
			'contact_no' => $this->request->getPost('contact_no')
		];

		echo view('confirm', $data);


	}

	function savePayerDetails(){

		$paymentmodel = new Payment_model();
		$account_sid = 'AC6fa892fda30ed4702491d35048e8866c';
		$auth_token = 'cadac9babf081246673da7cbd3b5d8ec';
		$twilio_number = "+18565796109";
		$client = new Client($account_sid, $auth_token);


		$data = [

			'transaction_id' => $this->request->getPost('transaction_id'),
			'amount_paid' => $this->request->getPost('payment'),
			'customer_id' => $this->request->getPost('payer_id'),
			'customer_name' => $this->request->getPost('fullname'),
			'customer_email' => $this->request->getPost('payer_email'),
			'customer_contact' => $this->request->getPost('contact_no'),
			'status' => $this->request->getPost('status')
		];

		$paymentmodel->insert($data);

		$client->messages->create(
		    // Where to send a text message (your cell phone?)
		    $this->request->getPost('contact_no'),
		    array(
		        'from' => $twilio_number,
		        'body' => 'I sent this message in under 10 minutes!'
		    )
		);

	}

	public function test()
	{
		helper(['url', 'form']);
		echo view('index');
	}

	public function paypal()
	{
		echo view('paypal');
	}

	public function notify_url()
	{

		echo view('notify_url');
	}

	public function success(){

		echo view('success');
	}

	public function paypal_test(){



		echo view('paypal_test');
	}

	function send_mail(){

		$email = \Config\Services::email();
		$email->setFrom('clevermonteros@gmail.com', 'Clever Monteros');
		$email->setTo('pedromatikas@gmail.com');
		$email->setSubject('Email Test');
		$email->setMessage('katong niaging gabie, giinvite mo ug birthday, sa party may handang butete');
		$email->send();

	}

	public function test_email(){



	  $comment_model = new Comment_model();
	  $ID = 0;
	  $i = 1;
		$o = 1;
		$result = "";
	  $email = \Config\Services::email();

	$email->setFrom('clevermonteros@gmail.com', 'SouthernCebuAdventure');



	$email->setSubject('Comment Posted');

	$body = "You're comment has been posted!";
	$email->setMessage($body);
	$action_data = ['40','41','42','43','44'];


	  $comment_id = $action_data;



		foreach($comment_id as $id){

	    $testemail[$i++] = $comment_model->select("email")->where("id", $id)->findAll();

	  }



		foreach($testemail as $v){

			var_dump(explode(',',$testemail[$o][0]['email']));

			$o++;

		}

		exit();
	  $email->setTo('someone@example.com');
	  $email->send();

	  echo "updated";
	}

	//--------------------------------------------------------------------

}
