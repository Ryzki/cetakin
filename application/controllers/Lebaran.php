<?php
public class Lebaran extends Islam
{
    public function maaf()
    {
        $this->load->model('dosa_model');

        $jumlah_dosa = $this->dosa_model->getDosa()->num_rows();

        while ($jumlah_dosa >= 0) {
            mintaMaaf();
        }
        
        echo "Mohon maaf lahir dan batin!"
    }    
}
