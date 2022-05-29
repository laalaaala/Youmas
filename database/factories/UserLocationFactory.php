<?php

namespace Database\Factories;

use App\Models\UserLocation;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $locations = [
            '1' => 'Markgrafenstraße 38, 10117 Berlin, Germany',
            '2' => 'Schumannstraße 7b, 10117 Berlin, Germany',
            '3' => 'Große Hamburger 48, 10115 Berlin, Germany',
            '4' => 'Schmidstraße 6, 10179 Berlin, Germany',
            '5' => 'Oranienstraße 155-159, 10969 Berlin, Germany',
            '6' => 'Gartenstraße 7, 10115 Berlin, Germany',
            '7' => 'Torstraße 140, 10119 Berlin, Germany',
            '8' => 'Heinrich-Heine-Straße 36-74, 10179 Berlin, Germany',
            '9' => 'Stallschreiberstraße 53-54, 10969 Berlin, Germany',
            '10' => 'Oranienstraße 133, 10969 Berlin, Germany',
            '11' => 'Schwanthalerstraße 44, 80336 München, Germany',
            '12' => 'Gabelsbergerstraße 35, 80333 München, Germany',
            '13' => 'Türkenstraße 82, 80799 München, Germany',
            '14' => 'Arcisstraße 39-31, 80799 München, Germany',
            '15' => 'Weißenburger Pl. 8, 81667 München, Germany',
            '16' => 'Seeriederstraße 17, 81675 München, Germany',
            '17' => 'Ismaninger Str. 22, 81675 München, Germany',
            '18' => 'Brecherspitzstraße 8, 81541 München, Germany',
            '19' => 'Schyrenstraße 8, 81543 München, Germany',
            '20' => 'Karlstraße 10, 80333 München, Germany',
            '21' => 'Schwanthalerstraße 78-90, 80336 München, Germany',
            '22' => 'Johannesstraße 10A, 44137 Dortmund, Germany',
            '23' => 'Hamburger Str. 36, 44135 Dortmund, Germany',
            '24' => 'Hohe Str. 80, 44139 Dortmund, Germany',
            '25' => 'Königsallee 56, 40212 Düsseldorf, Germany',
            '26' => 'Jägerhofstraße 6, 40479 Düsseldorf, Germany',
            '27' => 'Wupperstraße 36, 40219 Düsseldorf, Germany',
            '28' => 'Zietenstraße 34, 40476 Düsseldorf, Germany',
            '29' => 'Weiherstraße 18, 53111 Bonn, Germany',
            '30' => 'Kölnstraße 10-16, 53111 Bonn, Germany',
            '31' => 'Loestraße 23, 53113 Bonn, Germany',
        ];
        $address = array_rand($locations, 1);
        $client = new Client;
        $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json?address=' . $locations[$address] . '&key=AIzaSyClHoIH1cHvphRKUtAdrCtoLOMdzYN2eMo');
        $results = json_decode($response->getBody()->getContents());

        if (!$results) {
            var_dump('no results');
            $this->definition();
        }
        if (!array_key_exists(0, $results->results)) {
            var_dump('no index');
            $this->definition();
        }
        if ($results->results[0]->address_components[0]->types[0] != 'street_number') {
            var_dump('no street_number');
            $this->definition();
        }

        $formatted_address = $results->results[0]->formatted_address;
        $lat = $results->results[0]->geometry->location->lat;
        $lng = $results->results[0]->geometry->location->lng;
        foreach ($results->results[0]->address_components as $component) {
            if ($component->types[0] == "postal_code") {
                $zip_code = $component->long_name;
            }
            if ($component->types[0] == "street_number") {
                $street_number = $component->long_name;
            }
            if ($component->types[0] == "route") {
                $street = $component->long_name;
            }
            if ($component->types[0] == "locality" && $component->types[1] == "political") {
                $city = $component->long_name;
            }
        }
        return [
            'street' => $street,
            'street_number' => $street_number,
            'zip_code' => $zip_code,
            'city' => $city,
            'formatted_address' => $formatted_address,
            'lat' => $lat,
            'lng' => $lng,
        ];
    }
}
