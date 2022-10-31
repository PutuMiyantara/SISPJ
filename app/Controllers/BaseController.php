<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use App\Models\ModelUrl;
use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'database', 'request', 'fungsi'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		$this->validator =  \Config\Services::validation();

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
	}
	public function
	default()
	{
		$myfile = fopen('F:\WEBPROJECT\laragon\www\lipsum.txt', "r") or die("Unable to open file!");
		$echo = fread($myfile, filesize('F:\WEBPROJECT\laragon\www\lipsum.txt'));
		fclose($myfile);

		$this->response->setContentType('application/json');
		return json_encode([
			'text' => $echo
		], JSON_PRETTY_PRINT);
	}
	public function masterView($page, array $data)
	{
		echo view('templates/header', $data);
		echo view('templates/sidebar', $data);
		echo view($page, $data);
		echo view('templates/footer');
	}

	public function manageUrl(){
        $mUrl = new ModelUrl();
        $levelUrl = 'main';

        $url = $mUrl->getUrl(null, $levelUrl);
        $dataUrl = [];

        foreach ($url as $main) {
            # code...
            $sub_menu = [];
            $data_sub_menu = $mUrl->getUrl(['tb_sub_menu.id_main_menu' => $main['id']], 'sub');
            foreach ($data_sub_menu as $sub) {
                # code...
                $sub_sub_menu = [];
                $data_sub_sub_menu = $mUrl->getUrl(['id_sub_menu' => $sub['id']], 'subsub');
                foreach ($data_sub_sub_menu as $subsub) {
                    # code...
                    array_push($sub_sub_menu,[
                        'id_sub_sub_menu' => $subsub['id'],
                        'name_sub_sub_menu' => $subsub['name_sub_sub_menu'],
                        'sub_sub_url' => $subsub['sub_sub_url'],
                        'no_urut_sub_sub_menu' => $subsub['no_urut_sub_sub_menu'],
                        'kategori' => $mUrl->getUrl(['id_sub_sub_menu' => $subsub['id']], 'kategori'),
                    ]);
                }
                array_push($sub_menu,[
                    'id_sub_menu' => $sub['id'],
                    'name_sub_menu' => $sub['name_sub_menu'],
                    'sub_url' => $sub['sub_url'],
                    'no_urut_sub_menu' => $sub['no_urut_sub_menu'],
                    'subsub_menu' => $sub_sub_menu,
                ]);
            }
            
            array_push($dataUrl, [
                'id_main_menu' => $main['id'],
                'name_main_menu' => $main['name_main_menu'],
                'no_urut_main_menu' => $main['no_urut_main_menu'],
                'sub_menu' => $sub_menu,
            ]);
        }
		return $dataUrl;
    }

	// public function urlKategori(){
	// 	$mUrl = new ModelUrl();

    //     $url = $mUrl->getUrl(null, 'kategori');
    //     $dataUrl = [];

	// 	foreach ($url as $main) {
	// 		# code...
	// 		$sub_menu = [];
	// 		$sub_sub_menu = [];
	// 		$data_sub_menu = $mUrl->getUrl(['tb_sub_menu.id_main_menu' => $main['id']], 'sub');
	// 		foreach ($data_sub_menu as $sub) {
	// 			# code...
	// 			array_push($sub_menu,[
	// 				'id_sub_menu' => $sub['id'],
	// 				'name_sub_menu' => $sub['name_sub_menu'],
	// 				'sub_url' => $sub['sub_url'],
	// 				'no_urut_sub_menu' => $sub['no_urut_sub_menu'],
	// 				'subsub_menu' => $mUrl->getUrl(['id_sub_menu' => $sub['id']], 'subsub'),
	// 			]);
	// 		}
			
	// 		array_push($dataUrl, [
	// 			'id_main_menu' => $main['id'],
	// 			'name_main_menu' => $main['name_main_menu'],
	// 			'no_urut_main_menu' => $main['no_urut_main_menu'],
	// 			'sub_menu' => $sub_menu,
	// 		]);
	// 	}
		
	// 	return $dataUrl;
	// }

	public function error404()
	{
		$this->response->setContentType('application/json');
		$this->response->setStatusCode(404);
		echo json_encode([
			'error' => [
				'code' => 404,
				'message' => 'Page Not Found.'
			]
		], JSON_PRETTY_PRINT);
	}

	public function checkAlreadyLogin()
	{
		// return header("Location: /user/pegawai");
		return redirect()->to(base_url('/user/admin'));
	}
}