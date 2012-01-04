<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Image_lib extends CI_Image_lib
{

    function __construct ()
    {
        parent::__construct();
    }

    /**
     * Resize an image. If an aspects ratio is passed, also adjust the aspect ratio.
     * @param array $config
     * @param string $base_path
     * @return void
     * @author Joost van Veen
     */
    public function thumb ($config, $base_path)
    {
        
        // Set defaults
        $config['source_image'] = $base_path . $config['source_image'];
        $config['new_image'] = isset($config['new_image']) ? $base_path . $config['new_image'] : $config['source_image'];
        isset($config['width']) || $config['width'] = 120;
        isset($config['height']) || $config['height'] = 120;
        isset($config['maintain_ratio']) || $config['maintain_ratio'] = TRUE;
        
        // If we should change the aspect ratio, we will do that first
        do if ($config['maintain_ratio'] == FALSE) {
            // Fetch the size of the source image
            $source_image_data = getimagesize($config['source_image']);
            $source_image_data['width'] = $source_image_data[0];
            $source_image_data['height'] = $source_image_data[1];
            
            // Calculate aspect ratio for source and destination image
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

}