<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];
	//--------------------------------------------------------------------
	// Rules LOGIN
	//--------------------------------------------------------------------
	public $login = [
		'email'     => 'required|trim',
		'password' => 'required|trim',

	];
	public $login_errors  = [
		'email' => [
			'required' => 'Email Masih Kosong',
		],
		'password' => [
			'required' => 'Password Masih Kosong'
		]
	];

	//--------------------------------------------------------------------
	// Rules USER
	//--------------------------------------------------------------------
	public $userfoto = [
		'foto' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg,image/png]'
	];
	public $userfoto_errors = [
		'foto' => [
			'uploaded' => 'Foto Belum Dipilih',
			'max_size' => 'Max Size [1Mb]',
			'mime_in' => 'Format Foto Didukung[jpg/jpeg]'
		]
	];
	public $usertext = [
		'email' => 'required|valid_email',
		'password' => 'required|min_length[8]',
		'repass' => 'required|matches[password]',
		'nama' => 'required',
	];
	public $usertext_errors = [
		'email' => [
			'required' => 'Verifikasi Email Masih Kosong', 'valid_email' => 'Masukan Email Dengan Benar'
		],
		'password' => [
			'required' => 'Password Masih Kosong', 'min_length' => 'Password Minimal 8 Karakter'
		],
		'repass' => [
			'required' => 'Verifikasi Password Masih Kosong', 'matches' => 'Password dan Repeat Password Berbeda'
		],
		'nama' => [
			'required' => 'Verifikasi Nama Masih Kosong'
		]
	];

	public $usertextEdit = [
		'email' => 'required|valid_email',
		'status' => 'required'
	];
	public $usertextEdit_errors = [
		'email' => [
			'required' => 'Email Masih Kosong', 'valid_email' => 'Masukan Email Dengan Benar'
		],
		'status' => [
			'required' => 'Status Pegawai Masih Kosong'
		]
	];
	public $uploaded = [
		'foto' => 'uploaded[foto]'
	];
	public $userfotoEdit = [
		'foto' => 'max_size[foto,1024]|mime_in[foto,image/jpg,image/jpeg]'
	];
	public $userfotoEdit_errors = [
		'foto' => [
			'max_size' => 'Max Size [1Mb]',
			'mime_in' => 'Format Foto Didukung[jpg/jpeg]'
		]
	];

	//--------------------------------------------------------------------
	// Rules Kode Rekening Dasar
	//--------------------------------------------------------------------
	public $koderekening = [
		'kode_rek' => 'required',
		'uraian' => 'required',
		'jumlah_anggaran' => 'required',
	];
	public $koderekening_errors = [
		'kode_rek' => [
			'required' => 'Kode Rekening Belum Terisi'
		],
		'uraian' => [
			'required' => 'Uraian Rekening Belum Terisi'
		],
		'jumlah_anggaran' => [
			'required' => 'Jumlah Anngaran Belum Terisi',
		]
	];
}