<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Image_lib extends CI_Image_lib
{

    /**
     * Whether or not to enlarge if the source image is smaller than the destination image
     * @var boolean
     * @author Joost van Veen
     */
    private $_enlarge = FALSE;
    
    function __construct ()
    {
        parent::__construct();
    }
    
    /**
     * @return boolean $this->_enlarge
     * @author Joost van Veen
     */
    public function get_enlarge() {
        return $this->_enlarge;
    }

    public function set_enlarge($value) {
        $this->_enlarge = (bool) $value;
    }

    /**
     * Resize an image. If an aspects ratio is passed, also adjust the aspect ratio.
     * 
     * Typical usage:
     * // Create an array that holds the various image sizes
     * $configs = array();
     * $configs[] = array('source_image' => 'original.jpg', 'new_image' => 'thumbs/120/thumb.jpg', 'width' => 120, 'height' => 120);
     * $configs[] = array('source_image' => 'original.jpg', 'new_image' => 'thumbs/120x120/thumb.jpg', 'width' => 120, 'height' => 120, 'maintain_ratio' => FALSE);
     * $configs[] = array('source_image' => 'original.jpg', 'new_image' => 'thumbs/160x90/thumb.jpg', 'width' => 160, 'height' => 90, 'maintain_ratio' => FALSE);
     * $configs[] = array('source_image' => 'original.jpg', 'new_image' => 'thumbs/240/thumb.jpg', 'width' => 240, 'height' => 240);
     * $configs[] = array('source_image' => 'original.jpg', 'new_image' => 'thumbs/800/thumb.jpg', 'width' => 800, 'height' => 800);
     * 
     * // Loop through the array to create thumbs
     * $this->load->library('image_lib');
     * foreach ($configs as $config) {
     *    $this->image_lib->thumb($config, FCPATH . 'gfx/');
     * }
     * 
     * By default this lib does not resize an image if it is smaller than the new image should be (although this is CI's default behaviour).
     * Instead, it saves a copy of the original file as the destination image. If you want to enlargen small images, set $this->_enlarge to TRUE, by 
     * typing $this_image_lib->set_enlarge(TRUE);
     * 
     * @param array $config
     * @param string $base_path
     * @return void
     * @author Joost van Veen
     */
    public function thumb ($config, $base_path = '')
    {
        
        // Set defaults
        $config['source_image'] = $base_path . $config['source_image'];
        $config['new_image'] = isset($config['new_image']) ? $base_path . $config['new_image'] : $config['source_image'];
        isset($config['width']) || $config['width'] = 120;
        isset($config['height']) || $config['height'] = 120;
        isset($config['maintain_ratio']) || $config['maintain_ratio'] = TRUE;
        
        // Save a copy of the original file if the source image is smaller than the destination image, 
        // to avoid ugly enlarging.
        if ($this->_enlarge == FALSE) {
            $source_image_data = $this->_get_image_size($config['source_image']);
            if ($source_image_data['width'] <= $config['width'] && $source_image_data['height'] <= $config['height']) {
                copy($config['source_image'], $config['new_image']);
                return TRUE;
            }
        }
        
        // If we should change the aspect ratio, we will do that first
        do if ($config['maintain_ratio'] == FALSE) {
            
            // Calculate aspect ratio for source and destination image
            if ($this->_enlarge == TRUE) {
                $source_image_data = $this->_get_image_size($config['source_image']);
            }
            $source_ratio = $source_image_data['width'] / $source_image_data['height'];
            $new_ratio = $config['width'] / $config['height'];
            
            // Generic cropping settings
            $conf = array('source_image' => $config['source_image'], 'new_image' => $config['new_image'], 'maintain_ratio' => FALSE);
            
            // Calculate width, height and axis cropping settings from the 
            // destination image aspect ratio
            if ($new_ratio == $source_ratio) {
                // Image is already the proper ratio, no need to crop
                break;
            }
            elseif ($new_ratio > $source_ratio || ($new_ratio == 1 && $source_ratio < 1)) {
                // Destination ratio image is either more 'landscape shaped' than
                // the source ratio, or the image is a square and the source is
                // portrait. We will slice from top & bottom
                $conf['width'] = $source_image_data['width'];
                $conf['height'] = round($source_image_data['width'] / $new_ratio);
                $conf['y_axis'] = ($source_image_data['height'] - $conf['height']) / 2;
            }
            else {
                // We need to slice from left & right
                $conf['width'] = round($source_image_data['height'] * $new_ratio);
                $conf['height'] = $source_image_data['height'];
                $conf['x_axis'] = ($source_image_data['width'] - $conf['width']) / 2;
            }
            
            $this->initialize($conf);
            $this->crop();
            $this->clear();
            $config['source_image'] = $conf['new_image'];
        } while (false);
        
        // Resize the image
        $conf = array('source_image' => $config['source_image'], 'new_image' => $config['new_image'], 'maintain_ratio' => TRUE, 'width' => $config['width'], 'height' => $config['height']);
        $this->initialize($conf);
        $this->resize();
        $this->clear();
    }
    
    /**
     * Get the image sizes for an image
     * @param string $source_image
     * @return array
     * @author Joost van Veen
     */
	private function _get_image_size ($source_image)
    {
        $source_image_data = getimagesize($source_image);
        $source_image_data['width'] = $source_image_data[0];
        $source_image_data['height'] = $source_image_data[1];
        
        return $source_image_data;
    }


}