<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DishesTableSeeder extends Seeder
{
    public function run()
    {
        
        $mainDishId = 1;  
        $saladsId = 2;
        $drinksId = 3;    
        $dessertsId = 4;  

        
        $dishes = [
            
         
           
            [
                'name' => 'Purple Dream',
                'description' => 'This stunning cooler features three distinctive layers of jasmine and chamomile tea, ginger ale, and blue pea flower which turns a deep purple upon the addition of lemon.',
                'price' => 7.99,
                'category_id' => $drinksId,
                'image' => 'Drinks/purple dream.PNG.png',
                'created_at' => Carbon::now()->subMinutes(4)
            ],
            
            [
                'name' => 'Impossible meatballs',
                'description' => 'Cajun potato mousseline, roasted mushrooms and a stretchy vegan mozzarella all mixed up creating impossibly tasteful meatballs',
                'price' => 12.49,
                'category_id' => $mainDishId,
                'image' => 'Food/Impossible Meatballs.PNG.png',
                'created_at' => Carbon::now()->subMinutes(4)
            ],
            
            [
                'name' => 'Golden Macaroons',
                'description' => 'Crisp, airy and filled with coconut Jelly, combined with perfect amount of white chocolate and a tropical mango ganache.',
                'price' => 10.49,
                'category_id' => $dessertsId,
                'image' => 'Food/Golden macaroons.PNG.png',
                'created_at' => Carbon::now()->subMinutes(3)
            ],
            [
                'name' => 'Ribeye Steak Frites',
                'description' => 'Medium smoked ribeye steak topped with melted chedar cheese and truffle mac, coming with fries and sauce in the dish',
                'price' => 18.99,
                'category_id' => $mainDishId,
                'image' => 'Food/Ribeye steak frites.png',
            ],
            [
                'name' => 'Tabbouleh',
                'description' => 'Perfect mix of tomatoes, parsley, mint and scallions, with detailed seasoning, served with young romaine leaves for scooping up the Tabbouleh',
                'price' => 10.49,
                'category_id' => $saladsId,
                'image' => 'Food/tabbouleh.png',
                'created_at' => Carbon::now()->subMinutes(3)
            ],

            [
                'name' => 'Mad Dog',
                'description' => 'Named after the notorious Irish-American mobsters in the 1900s described as "Mad Dog" assassins, this whiskey-based concoction is a nostalgic reminder of the fiery mafia',
                'price' => 9.49,
                'category_id' => $drinksId,
                'image' => 'Drinks/mad dog.PNG.png',
                'created_at' => Carbon::now()->subMinutes(2)
            ],
            [
                'name' => 'Chicken Wrap',
                'description' => 'Crisp chicken, chipotle aioli, romaine, heirloom tomatoes and pomegranate pearls mixed up and wrapped in delicate parcels.',
                'price' => 13.99,
                'category_id' => $mainDishId,
                'image' => 'Food/Salmon Wrap.png',
                'created_at' => Carbon::now()->subMinutes(1)
            ],
           
            [
                'name' => 'Pork Parcels',
                'description' => 'Three plump parcels of first marinated then smoked pork belly with cabbage slaw creating fantasy of flavours in your mouth',
                'price' => 13.99,
                'category_id' => $mainDishId,
                'image' => 'Food/pork parcels.png',
            ],
            [
                'name' => 'Cherry Street',
                'description' => 'A refreshing mixture of Pineapple Rum, Green Chartreuse, Taylor’s Velvet Falernum and lime, creating the perfect choice for you',
                'price' => 8.99,
                'category_id' => $drinksId,
                'image' => 'Drinks/Cherry Street.png',
            ],
            [
                'name' => 'Caprese Salad',
                'description' => 'Evenly sliced tomatoes, mozzarella cheese, basil and olive oil, topped with caramelised wine and served in vintage black plate',
                'price' => 9.99,
                'category_id' => $saladsId,
                'image' => 'Food/caprese salad.png',
            ],
            [
                'name' => 'Tryson Queek',
                'description' => 'Crunchy,yet soft biscuits surrounding home-made marshmallows by Lia Bouques recipe, filled with cherry syrup and tropical aroma ',
                'price' => 12.99,
                'category_id' => $dessertsId,
                'image' => 'Food/Tryson Queek.PNG.png',
                'created_at' => Carbon::now()->subMinutes(3)
            ],

            [
                'name' => 'Golden Crispy Salad',
                'description' => 'Golden crispy vegetables sitting pretty atop cauliflower cream and pomegranate pearls finished with pistachios and olive dust',
                'price' =>14.49,
                'category_id' => $saladsId,
                'image' => 'Food//Golden Crispy Salad.PNG.png',
            ],
            [
                'name' => 'Oleo Blank',
                'description' => 'This balanced cocktail is a melody of Lyre’s American Malt, Clarified Apple Juice, Oleo Saccharum and Lapsang Souchong Tea',
                'price' => 8.49,
                'category_id' => $drinksId,
                'image' => 'Drinks/Oleo Blank.PNG.png',
            ],
            [
                'name' => 'Silver Dollar Cookies',
                'description' => 'Naturally sweetened  from carrots, topped with smooth cinnamon-infused Chantilly cream and a pecan-crunch',
                'price' => 11.99,
                'category_id' => $dessertsId,
                'image' => 'Food/Silver Dollar Cookie.PNG.png',
                'created_at' => Carbon::now()->subMinutes(3)
            ],
            [
                'name' => 'Waldrof Salad',
                'description' => 'Fresh fall salad made with celery, apples, red grapes and walnuts, dressed up with mayonnaise and sour cream dressing, and served over a bed of fresh salad',
                'price' =>11.99,
                'category_id' => $saladsId,
                'image' => 'Food//Waldrof Salad.png',
            ],
            [
                'name' => 'Greensteiner',
                'description' => 'This grasshopper cocktail is symphony crafted  with milk punch, Michter’s Sour Mash and Crème de Menthe, all of this sweatened with grasp of apple juice',
                'price' => 7.49,
                'category_id' => $drinksId,
                'image' => 'Drinks/Greensteiner.PNG.png',
            ],
            [
                'name' => 'Strawberry Cream Eclairs',
                'description' => 'This visual treat crumbles in your mouth, oozing vodka-infused strawberry marmalade and cream with crunchy hazelnuts.',
                'price' => 8.99,
                'category_id' => $dessertsId,
                'image' => 'Food/Strawbery Cream Eclairs.PNG',
                'created_at' => Carbon::now()->subMinutes(3)
            ],
            [
                'name' => 'Cauliflower Salad',
                'description' => 'Lightly fried till crispy and golden, the batter shatters satisfyingly against creamy tahini, pops of ruby red pomegranate and the crunch of pistachios',
                'price' =>14.99,
                'category_id' => $saladsId,
                'image' => 'Food//cauliflower salad.png',
            ],
            [
                'name' => 'Chocolate Tarts',
                'description' => 'These bourbon and salted-caramel fudge treats are topped with whipped chocolate milk and are perfect paired with your sweet tipple of choice!',
                'price' => 9.49,
                'category_id' => $dessertsId,
                'image' => 'Food/chocolate tarts.PNG',
                'created_at' => Carbon::now()->subMinutes(3)
            ],
            [
                'name' => 'Panzanella',
                'description' => 'Tomatoes, bread, cheese and  grilled peach, all that combined with italian cousines and cucumber creating  mouth-watering experience for the consumer',
                'price' =>13.49,
                'category_id' => $saladsId,
                'image' => 'Food//panzanella.png',
            ],
            [
                'name' => 'Lobster Rolls',
                'description' => 'Butter-poached lobster, citrus aioli, tobiko roe and chives have their way into the squid ink colored bun',
                'price' => 17.99,
                'category_id' => $mainDishId,
                'image' => 'Food/lobster rolls.png',
            ],
            // ... rest of main dishes
            [
                'name' => 'Vega Alta',
                'description' => 'A rum-based cocktail inspired by the legendary Lin Manuel Miranda, laced with pineapple, turmeric, and coconut lime foam',
                'price' => 8.49,
                'category_id' => $drinksId,
                'image' => 'Drinks/vega alta.PNG.png',
            ],
            // ... rest of drinks
            [
                'name' => 'Grand Marnier',
                'description' => 'Grand Marnier-flambeed crêpes suzette with couple of blueberries and cup of ice cream for freshness',
                'price' => 9.49,
                'category_id' => $dessertsId,
                'image' => 'Food/grand marnier.png',
            ],
            [
                'name' => 'Barrel-Smoked Tomahawk',
                'description' => 'Just the usual whiskey-infused barrel-smoked Tomahawk coated with bacon flavoured oil, served with vegetables for creating balance.',
                'price' => 19.49,
                'category_id' => $mainDishId,
                'image' => 'Food/barrel-smoked tomahawk.PNG.png',
                'created_at' => Carbon::now()->subMinutes(5)
            ],
            // ... continue with all other dishes
        ];

        // Insert all dishes
        foreach ($dishes as $dish) {
            if (!isset($dish['created_at'])) {
                $dish['created_at'] = now();
            }
            $dish['updated_at'] = $dish['created_at'];
            DB::table('dishes')->insert($dish);
        }
    }
}