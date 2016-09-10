<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 100; $i++) {

            $category= rand(1, 10);
            $price= (rand(10, 50))*10;
            $sold_count=rand(1, 80);

            DB::table('products')->insert([
                'product_id' => str_random(50),
                'category_id' => $category,
                'title' => "Test Product No. ".$i,
                'make' => "Sample Manufacturer ".$category,
                'description' => "Lorem ipsum dolor sit amet, nullam fabellas principes sit ex, pri eu utinam omittantur. Mel officiis referrentur id, pertinax postulant assentior his ne. Qui facete vocent diceret ei, homero albucius in ius, inimicus splendide ne has. Sea ludus principes voluptatum ex, hinc commodo detraxit cu mel.",
                'details' => "Lorem ipsum dolor sit amet, nullam fabellas principes sit ex, pri eu utinam omittantur. Mel officiis referrentur id, pertinax postulant assentior his ne. Qui facete vocent diceret ei, homero albucius in ius, inimicus splendide ne has. Sea ludus principes voluptatum ex, hinc commodo detraxit cu mel.

Id cum nisl brute prompta, ne mel inimicus repudiare voluptatibus. Qui magna placerat mediocritatem an, duo debet nostrud persecuti id, semper intellegat no sea. In sea decore quaeque. Vim at tantas periculis signiferumque.

Vis no alterum bonorum maluisset, et quo dictas admodum. Ex erat prima inciderint sit. Nihil legimus dissentias in nec, eam et vituperata argumentum reprehendunt. Pro eu assentior suscipiantur concludaturque, modo erant petentium te sit, dicant graecis vel ex. Ei causae meliore persequeris his, menandri lobortis evertitur mei in. Ea harum omnes ius, mei no congue dolores nominati, mei debet iuvaret discere eu.

An dicunt mediocritatem ius. Eum id ullum molestie salutandi, cum labitur electram sadipscing ea. Dico eros mea no. An vis dolore dictas alienum, eu eius deterruisset eam, eu vel populo aperiri aliquando.

Pri in zril malorum quaestio, has no laudem volumus. Mei id facilis scripserit reprehendunt. Legimus dolores voluptua mel an, dolor tantas sanctus cu eos. Et iisque commune temporibus nec, an elitr dolore delicata eos, mea assum deleniti consequat no. Eam audiam offendit an, nec dicta atomorum evertitur in.",
                'image' => "",
                'image_name' => "sample_file_123.png",
                'price' => number_format($price),
                'stock' => 100,
                'sold_count' => $sold_count,
                'is_featured' => 1,
                'status' => 1,
            ]);
        }
    }
}
