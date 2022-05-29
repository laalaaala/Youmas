<?php

namespace Database\Factories;

use App\Models\BusinessPicture;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessPictureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BusinessPicture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $images = [
            '1' => 'https://i.pinimg.com/originals/92/22/56/922256e54ba617ac482b7bc7b8792f3c.jpg',
            '2' => 'https://i.pinimg.com/originals/c5/5a/de/c55ade0f3c23b62ff5b7eb6af21ecdc6.jpg',
            '3' => 'https://images.homify.com/c_fill,f_auto,q_0,w_740/v1588783369/p/photo/image/3473404/portfolio_bc_beauty_salon_8.jpg',
            '4' => 'https://st2.depositphotos.com/1765433/6847/i/600/depositphotos_68471257-stock-photo-interior-of-empty-modern-hair.jpg',
            '5' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1NgkELY_uh-aqam279bT-n0ESAfzcj9_7Ag&usqp=CAU',
            '6' => 'https://st2.depositphotos.com/1004176/9345/i/950/depositphotos_93456550-stock-photo-interior-of-luxury-beauty-salon.jpg',
        ];
        $image_index = array_rand($images, 1);
        return [
            'link' => $images[$image_index],
            'order' => 1,
            'business_id' => $this->faker->numberBetween(3, 31),
        ];
    }
}
