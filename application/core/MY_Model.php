<?php

class MY_Model extends CI_model
{
  # Just need to declare this but not needing it
  # I prefer more declarative class names than `MY_*`
}

class Admin_core_model extends CI_model {

  function __construct()
  {
    parent::__construct();
    $this->table = 'crud'; # Replace these properties on children
    $this->upload_dir = 'crud'; # Replace these properties on children
    $this->per_page = 15;
  }

  public function getTotalPages()
  {
    return ceil(count($this->db->get($this->table)->result()) / $this->per_page);
  }

  public function all()
  {
    $res = $this->db->get($this->table)->result();
    return $res;
  }

  public function add($data)
  {
    return $this->db->insert($this->table, $data);
  }

  public function get($id)
  {
    return $this->db->get_where($this->table, array('id' => $id))->row();
  }

  public function deleteUploadedMedia($id)
  {
    $this->db->where('id', $id);
    $path = "{$this->upload_dir}/" . $this->db->get($this->table)->row()->image_url;

    $file_deleted = false;

    try {
      @unlink($file_deleted);
      $file_deleted =  true;
    } catch (\Exception $e) {
      $file_deleted = false;
    }

    return $file_deleted;
  }

  public function delete($id)
  {
    $this->deleteUploadedMedia($id);

    $this->db->reset_query();
    $this->db->where('id', $id);
    return $this->db->delete($this->table);
  }

  public function upload($file_key)
  {
    @$file = $_FILES[$file_key];
    $upload_path = $this->upload_dir;

    $config['upload_path'] = $upload_path; # NOTE: Change your directory as needed
    $config['allowed_types'] = 'jpg|jpeg|png'; # NOTE: Change file types as needed
    $config['file_name'] = time() . '_' . $file['name']; # Set the new filename
    $this->upload->initialize($config);

    if (!is_dir($upload_path) && !mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true)){
      mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true); # You can set DEFAULT_FOLDER_PERMISSIONS constant in application/config/constants.php
    }
    if($this->upload->do_upload($file_key)){
      return [$file_key => $this->upload->data('file_name')];
    }else{
      return [];
    }
  }

  public function update($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }

}

class Crud_model extends CI_model
{
  /**
  * Your table name
  * @var string
  */
  protected $table;

  /**
  * The directory you want to upload to whose parent dir is `uploads` folder
  * @var [type]
  */
  protected $upload_dir;

  public function __construct()
  {
    parent::__construct();
    $this->table = 'crud'; # change this to the model's corresponding table
    $this->upload_dir = 'your_dir'; # uploads/your_dir
    $this->uploads_folder = "uploads/" . $this->upload_dir . "/";
    $this->full_up_path = base_url() . "uploads/" . $this->upload_dir . "/"; # override this block on your child class. just redeclare it

    # Use `$this->db->reset_query();` on the child class to override these two. Then redeclare them as needed
    // $this->db->order_by('id', 'DESC');

    $this->paginate(); # apply pagination to all methods
  }

  /**
  * Get all rows from the table
  * @return array
  */
  public function all()
  {
    return $this->db->get($this->table)->result();
  }

  /**
  * Get specific row via id
  * @param  int     $id
  * @return array   associative array of data
  */
  public function get($id)
  {
    $this->db->where('id', $id);
    return $this->db->get($this->table)->row();
  }

  /**
  * Inserts to the table with the associative array provided
  * @param  array $data
  * @return int   the last insert id
  */
  public function add($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  /**
  * Deletes the row via id
  * @param  int $id
  * @return int number of rows deleted
  */
  public function delete($id)
  {
    $this->db->where('id', $id);
    $this->db->delete($this->table);
    return $this->db->affected_rows();
  }

  /**
  * Simply updates the table matching the associative array provided
  * @param  int    $id    id of row to update
  * @param  array  $data  associative array of values to be updated
  * @return bool
  */
  public function update($id, $data)
  {
    if ($this->get($id) === [])
    return null; # Return null if entry is not existing

    $this->db->update($this->table, $data, ['id' => $id]);
    return $this->db->affected_rows(); # Returns 1 if update is successful, returns 0 if update is already made, but query is successful
  }

  /**
  * Batch upload of the given $_FILES[key] multiple upload input
  * TODO: Refactor this to accept the key only
  * @param  array   $files   example value is $_FILES[key]
  * @return array           returns a multidimensional array in this structure array[key] => [0 => 'file1', 1 => 'file2']
  */
  public function batch_upload($files = [])
  {

    if($files == [] || $files == null ) return []; # Immediately returns an empty array if a parameter is not provided or key is not existing with the help of @ operator. Example @$_FILES['nonexistent_key']

    # Defaults
    $k = key($files); # Gets the `key` of the uplaoded thing on your form

    $uploaded_files = []; # Initialize empty return array
    $upload_path = 'uploads/' . $this->upload_dir; # Your upload path starting from the `root folder`. NOTE: Change this as needed

    # Configs
    $config['upload_path'] = $upload_path; # Set upload path
    $config['allowed_types'] = 'gif|jpg|jpeg|png'; # NOTE: Change this as needed

    # Folder creation
    if (!is_dir($upload_path) && !mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true)){
      mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true); # You can set DEFAULT_FOLDER_PERMISSIONS constant in application/config/constants.php
    }

    foreach ($files['name'] as $key => $image) {
      $_FILES[$k]['name'] = $files['name'][$key];
      $_FILES[$k]['type'] = $files['type'][$key];
      $_FILES[$k]['tmp_name'] = $files['tmp_name'][$key];
      $_FILES[$k]['error'] = $files['error'][$key];
      $_FILES[$k]['size'] = $files['size'][$key];

      $filename = time() . "_" . $files['name'][$key]; # Renames the filename into timestamp_filename
      $images[] = $uploaded_files[$k][] = $filename; # Appends all filenames to our return array with the key

      $config['file_name'] = $filename;
      $this->upload->initialize($config);

      $this->upload->do_upload($k);
    }

    return $uploaded_files;
  }

  /**
  * Upload single file. Returns an empty array on failure
  * @param  string    $file_key   [description]
  * @return array                 [description]
  */
  public function upload($file_key)
  {
    @$file = $_FILES[$file_key];
    $upload_path = "uploads/" . $this->upload_dir;

    $config['upload_path'] = $upload_path; # NOTE: Change your directory as needed
    $config['allowed_types'] = 'gif|jpg|jpeg|png'; # NOTE: Change file types as needed
    $config['file_name'] = time() . '_' . $file['name']; # Set the new filename
    $this->upload->initialize($config);

    # Folder creation
    # TODO: Will refactor this and integrate it to the core upload class
    if (!is_dir($upload_path) && !mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true)){
      mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true); # You can set DEFAULT_FOLDER_PERMISSIONS constant in application/config/constants.php
    }

    if($this->upload->do_upload($file_key)){
      return [$file_key => $this->upload->data('file_name')];
    }else{
      // echo $this->upload->display_errors(); die();
      return [];
    }

  }

  /**
  * this is for pagination
  * uses $this->input->get('page') and $this->input->get('per_page')
  * @return [type] [description]
  */
  public function paginate()
  {
    if ($this->input->get('page')){
      $per_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 10; # Make 10 default $per_page if $per_page is not set
      $offset = ($_GET['page'] - 1) * $per_page;
      $this->db->limit($per_page, $offset);
    }
  }

  ###########################################
  # your custom methods go beyond this line #
  ###########################################


}
