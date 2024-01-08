<?php

namespace App\Imports;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProjectImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $row){
            if(!isset($row['naimenovanie'])) continue;

            

            Project::create([
                'types' => $row['tip'],
                'title' => $row['naimenovanie'],
                'created_at_time' => $row['data_sozdania'],
                'deadline' => $row['dedlain'],
                'contracted_at' => $row['title'],
                'is_chain' => $row['setevik'],
                'is_on_time' => $row['sdaca_v_srok'],
                'has_outsource' => $row['nalicie_autsorsinga'],
                'has_invenstors' => $row['nalicie_investorov'],
                'worker_count' => $row['kolicestvo_ucastnikov'],
                'service_count' => $row['title'],

                'payment_first_step' => $row['vlozenie_v_pervyi_etap'],
                'payment_second_step' => $row['vlozenie_vo_vtoroi_etap'],
                'payment_third_step' => $row['vlozenie_v_trtii_etap'],
                'payment_fourth_step' => $row['vlozenie_v_cetvertyi_etap'],

                'comment' => $row['kommentarii'],

                'effective_value' => $row['znacenie_effektivnosti'],

            ]);
        }
    }

    
}
