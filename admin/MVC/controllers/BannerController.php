<?php
require_once("MVC/Models/banner.php");
class BannerController {
	var $banner_model;
	function __construct() {
		$this->banner_model = new Banner();
	}

	public function list() {
		$data = array();
		$data = $this->banner_model->All(); 
		require_once("MVC/Views/Admin/index.php");
		//require_once('MVC/views/categories/list.php');
	}

	public function add() {
		require_once("MVC/Views/Admin/index.php");
		//require_once('MVC/views/categories/add.php');
	}
	public function store() {
        $target_dir = "../library/images/Banners/";  // thư mục chứa file upload
        $HinhAnh = "";

        $target_file = $target_dir . basename($_FILES["image"]["name"]); // link sẽ upload file lên

        $status_upload = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        if ($status_upload) { // nếu upload file không có lỗi 
            $HinhAnh =  "" . basename($_FILES["image"]["name"]);
        }
		$data = array(
			'image' => $HinhAnh,
			'TrangThai' => $_POST['TrangThai']
		);
		foreach ($data as $key => $value) {
            if (strpos($value, "'") != false) {
                $value = str_replace("'", "\'", $value);
                $data[$key] = $value;
            }
        }
		$this->banner_model->store($data);
	}
	public function detail() {
		$id = isset($_GET['id']) ? $_GET['id'] : 5;
		$data = $this->banner_model->find($id);
		require_once("MVC/Views/Admin/index.php");
		//require_once('MVC/views/categories/detail.php');
	}
	public function delete() {
		if (isset($_GET['id'])) {
			$this->banner_model->delete($_GET['id']);
		}
	}
	public function edit() {
		$id = isset($_GET['id']) ? $_GET['id'] : 1;
		$data = $this->banner_model->find($id);
		require_once("MVC/Views/Admin/index.php");
		//require_once('MVC/views/categories/edit.php');
	}
	public function update() {
        $target_dir = "../library/images/Banners/";  // thư mục chứa file upload
        $HinhAnh = "";

        $target_file = $target_dir . basename($_FILES["image"]["name"]); // link sẽ upload file lên

        $status_upload = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        if ($status_upload) { // nếu upload file không có lỗi 
            $HinhAnh =  "" . basename($_FILES["image"]["name"]);
        }
		$data = array(
			'id' => $_POST['id'],
			'image' =>  $HinhAnh,
			'TrangThai' => $_POST['TrangThai']
		);
		foreach ($data as $key => $value) {
            if (strpos($value, "'") != false) {
                $value = str_replace("'", "\'", $value);
                $data[$key] = $value;
            }
        }
        if ($HinhAnh == "") {
            unset($data['image']);
        }
		$this->banner_model->update($data);
	}
}
