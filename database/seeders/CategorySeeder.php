<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Sohibd\Laravelslug\Generate;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = Category::latest()->first();
        if (is_null($info)) {
            $categoryList = array(
                'SOAP',
                'SHAMPOO',
                'CHOCOLATE',
                'CONDITIONER',
                'RICE',
                'FOOD SUPPLIMENT',
                'CAKE',
                'BISCUITS',
                'PEANUTS',
                'TOOTHPASTE',
                'TOOTHBRUSH',
                'FACEWASH MEN',
                'FACEWASH WOMEN',
                'BODY SPRAY MEN',
                'BODY SPRAY WOMEN',
                'LOTION',
                'CREAM MEN',
                'CREAM WOMEN',
                'AIR FRESHENER',
                'HAIR OIL MEN',
                'HAIR OIL WOMEN',
                'TOILET CLEANER',
                'PERFUME MEN',
                'PERFUME WOMEN',
                'DISH WASH',
                'FABRIC WASH',
                'FLOOR CLEANER',
                'GLASS CLEANER',
                'HAND WASH',
                'BABY ITEMS',
                'HAIR SERUM',
                'SKIN SERUM',
                'HAIR GEL WOMEN',
                'HAIR GEL MEN',
                'HAIR COLOR',
                'SHOWER GEL',
                'SANITARY PAD',
                'ADULT DIAPER',
                'HAIR REMOVER',
                'SHAVING ITEM',
                'OLIVE OIL',
                'MAKE UP ITEMS',
                'TALCOM POWDER',
                'FACE POWDER',
                'TEA ITEMS',
                'DEODORANT',
                'FOOT CARE',
                'LIP ITEMS',
                'FACIAL ITEMS',
                'MEHEDY',
                'HONEY',
                'HERBAL PRODUCTS',
                'SOYABIN OIL',
                'PALM OIL',
                'SUNFLOWER OIL',
                'SUGAR',
                'ATTA',
                'FLOUR',
                'SUJI',
                'SPICES',
                'SALT',
                'SAUCE',
                'GLYCERIN',
                'TOOTH POWDER',
                'MOUTHWASH',
                'AEROSOL',
                'COEL',
                'MOIDA',
                'COLONGE SPRAY',
                'EU DE PERFUME',
                'BODY SPRAY',
                'MINERAL WATER',
                'BEVERAGE',
                'MUSTARD OIL',
                'CAKE SPICES',
                'MOTHER CARE',
                'DRY FOOD',
                'SOUP',
                'NOODLES',
                'COFFEE ITEMS',
                'KOKO CRUNCH',
                'CHANACHUR',
                'PICKLE',
                'DRY FRUITS',
                'CHIPS',
                'SEMAI',
                'JUICE',
                'MILK ITEMS',
                'DAAL',
                'TISSUE',
                'OINTMENT',
                'BODY WASH',
                'KITCHEN ITEMS',
                'STUDY',
                'TOY',
                'BABY CARE',
                'BAGS',
                'GHEE',
                'SUNGLASS',
                'EWER',
                'WRIST WATCH',
                'JELLY',
                'LIQUID VAPOURER',
                'MUM',
                'OIL',
                'FACE MASK',
                'BODY POWDER',
                'ANTISEPTIC',
                'UMBRELLA',
                'JEWELRY BOX',
                'SPICE',
                'HOME APPLIANCE',
                'GROOMING KIT'

               
                
            );
    
            foreach ($categoryList as $cate) {
                $category = new Category();
                $category->category_name = $cate;
                $category->slug = Generate::Slug($cate);
                $category->superadmin_id = 1;
                $category->save();
            }
    
            
        }
    }
}
