<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class UpdateFrequencyData extends Seeder
{
    public function run(): void
    {
        $data = '[{"freq":20,"db":-12},{"freq":50,"db":-4},{"freq":100,"db":0},{"freq":200,"db":2},{"freq":500,"db":3},{"freq":1000,"db":4},{"freq":2000,"db":2},{"freq":4000,"db":-1},{"freq":6000,"db":-4},{"freq":8000,"db":-8},{"freq":10000,"db":-12},{"freq":16000,"db":-18}]';

        Product::where('id', 6)->update(['frequency_data' => $data]);

        echo "Updated freq data for Moondrop Chu II\n";
    }
}